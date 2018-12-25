@extends('layouts.app')

@section('content')
    <div class="container">
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.21.6.js"></script>
    <script>
        var pubnub = new PubNub({
            subscribeKey: "sub-c-e3a6b7dc-ff1f-11e8-a399-32ec39b2e34f",
            publishKey: "pub-c-94083343-a5ff-4f4b-90d3-d88866bf799b",
            ssl: true
        });
        pubnub.addListener({
            status: function(statusEvent) {
                if (statusEvent.category === "PNConnectedCategory") {
                    var newState = {
                        new: 'state'
                    };
                    pubnub.setState(
                        {
                            state: newState
                        },
                        function (status) {
                            // handle state setting response
                            console.log(status);
                        }
                    );
                }
            },
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
        pubnub.publish(
            {
                message: {
                    avatar: 'grumpy-cat.jpg',
                    text: 'Hello, hoomans!'
                },
                channel: 'room-1'
            },
            function (status, response) {
                // handle status, response
                console.log(response);
            }
        );
    </script>
@endsection
