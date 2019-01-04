@extends('layouts.app')

@section('styles')
    <style>
        body {
            background-color: darkslategray;
        }
        .StripeElement {
            background-color: white;
            height: 40px;
            padding-left: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
            width: 100%;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
        .card {
            margin-top: 20px !important;
            padding-top: 20px !important;
            padding-bottom: 20px !important;
        }
        #payment-form {
            margin-top: 20px !important;
        }
        .text-green {
            color: greenyellow;
        }
        .success-message {
            margin-top: 20px !important;
            text-align: center;
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">

        <div class="success-message text-green">Purchased! You can now watch it on the TV.</div>

        <form action="/charge" method="post" id="payment-form">
            <div class="form-row">
                <label for="card-element">
                    Credit or debit card
                </label>
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>

            <div style="padding-top: 10px">
                <span class="text-green" style="padding-right: 10px">{{ $video->price }} €</span><button class="btn btn-primary">Purchase</button>
            </div>
        </form>

        <div class="card" id="video-details">
            <div class="row">
                <div class="col-md-4" style="text-align: center; padding-bottom: 10px">
                    <img src="{{ $video->photo_urls_url }}" class="w-100" style="width: 200px !important;">
                </div>
                <div class="col-md-8 px-3">
                    <div class="card-block px-3">
                        <h4 class="card-title">{{ $video->name }} - {{ $video->author }}</h4>
                        <p class="card-text">{{ $video->date }}</p>
                        <p class="card-text">{{ $video->description }}</p>
                        <p class="card-text">Duration: {{ $video->duration }} minutes</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.21.6.js"></script>
    <script src="lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script>
        var pubnub = new PubNub({
            subscribeKey: "sub-c-e3a6b7dc-ff1f-11e8-a399-32ec39b2e34f",
            publishKey: "pub-c-94083343-a5ff-4f4b-90d3-d88866bf799b",
            ssl: true
        });
        pubnub.addListener({
            message: function(message) {
                // handle message
                console.log(message);
            },
            presence: function(presenceEvent) {
                // handle presence
                console.log(presenceEvent);
            }
        });
        pubnub.subscribe({
            channels: ['room-1']
        });
    </script>
    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_7AtBtTjy354RGisOiYkTZKJP');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                }
                else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {

            var stripeToken = token.id;
            var idToken = localStorage.getItem('id_token');

            $.ajax({
                url: '/api/purchase',
                method: "POST",
                dataType: "json",
                data: {
                    video_id: '{{ $video->id }}',
                    stripe_token: stripeToken
                },
                headers: {
                    "Authorization": "Bearer " + idToken
                },

                success: function() {

                    // Notify pubnub
                    pubnub.publish(
                        {
                            message: {
                                action: 'paid_video'
                            },
                            channel: localStorage.getItem('redirect_code')
                        },
                        function (status, response) {
                            // handle status, response
                            $('#payment-form').hide();
                            $('#video-details').hide();
                            $('.success-message').fadeIn();
                        }
                    );
                },

                error: function(error, status) {
                    console.error(error, status);
                }
            });
        }
    </script>
@endsection
