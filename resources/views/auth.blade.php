@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- home view -->
        <div id="home-view">
            <h4>Auth</h4>
            <button id="btn-home-view" class="btn btn-primary btn-margin">
                Home
            </button>

            <button id="btn-login" class="btn btn-primary btn-margin">
                Log In
            </button>

            <button id="btn-logout" class="btn btn-primary btn-margin">
                Log Out
            </button>
        </div>

        <!-- profile view -->
        <div id="profile-view" class="panel panel-default profile-area">
            <div class="panel-heading"><h3>Profile</h3></div>
            <div class="panel-body">
                <img class="avatar" alt="avatar">
                <div>
                    <label><i class="glyphicon glyphicon-user"></i> Nickname</label>
                    <h3 class="nickname"></h3>
                </div>
                <pre class="full-profile"></pre>
            </div>


            <input name="file" type="file" class="cloudinary-fileupload" data-cloudinary-field="image_id" data-form-data="{ &quot;upload_preset&quot;: &quot;tizenapp&quot;, &quot;callback&quot;: &quot;https://www.example.com/cloudinary_cors.html&quot;}" />
            <div class="preview"></div>

        </div>
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
    <script src="https://cdn.auth0.com/js/auth0/9.5.1/auth0.min.js"></script>
    <script>
        // app.js
        var webAuth = new auth0.WebAuth({
            domain: 'tizen.auth0.com',
            clientID: 'ZkJXvv7dDjS6OeiqbA1pfQ54XfeIhMLy',
            responseType: 'token id_token',
            scope: 'openid profile',
            redirectUri: window.location.href
        });

        var loginBtn = document.getElementById('btn-login');

        loginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            webAuth.authorize();
        });

        var loginStatus = document.querySelector('.container h4');
        var loginView = document.getElementById('login-view');
        var homeView = document.getElementById('home-view');

        // buttons and event listeners
        var homeViewBtn = document.getElementById('btn-home-view');
        var loginBtn = document.getElementById('btn-login');
        var logoutBtn = document.getElementById('btn-logout');

        homeViewBtn.addEventListener('click', function() {
            homeView.style.display = 'inline-block';
            loginView.style.display = 'none';
        });

        logoutBtn.addEventListener('click', logout);

        function handleAuthentication() {
            webAuth.parseHash(function(err, authResult) {
                if (authResult && authResult.accessToken && authResult.idToken) {
                    window.location.hash = '';
                    setSession(authResult);
                    loginBtn.style.display = 'none';
                    homeView.style.display = 'inline-block';
                    getProfile();
                } else if (err) {
                    homeView.style.display = 'inline-block';
                    console.log(err);
                    alert(
                        'Error: ' + err.error + '. Check the console for further details.'
                    );
                }
                displayButtons();
            });
        }
        handleAuthentication();

        function setSession(authResult) {
            // Set the time that the Access Token will expire at
            var expiresAt = JSON.stringify(
                authResult.expiresIn * 1000 + new Date().getTime()
            );
            localStorage.setItem('access_token', authResult.accessToken);
            localStorage.setItem('id_token', authResult.idToken);
            localStorage.setItem('expires_at', expiresAt);
        }

        function logout() {
            // Remove tokens and expiry time from localStorage
            localStorage.removeItem('access_token');
            localStorage.removeItem('id_token');
            localStorage.removeItem('expires_at');
            displayButtons();
        }

        function isAuthenticated() {
            // Check whether the current time is past the
            // Access Token's expiry time
            var expiresAt = JSON.parse(localStorage.getItem('expires_at'));
            return new Date().getTime() < expiresAt;
        }

        function displayButtons() {
            if (isAuthenticated()) {
                loginBtn.style.display = 'none';
                logoutBtn.style.display = 'inline-block';
                loginStatus.innerHTML = 'You are logged in!';
            } else {
                loginBtn.style.display = 'inline-block';
                logoutBtn.style.display = 'none';
                loginStatus.innerHTML =
                    'You are not logged in! Please log in to continue.';
            }
        }

        var userProfile;

        function getProfile() {
            if (!userProfile) {
                var accessToken = localStorage.getItem('access_token');

                if (!accessToken) {
                    console.log('Access Token must exist to fetch profile');
                }

                webAuth.client.userInfo(accessToken, function(err, profile) {
                    if (profile) {
                        userProfile = profile;
                        displayProfile();
                    }
                });
            } else {
                displayProfile();
            }
        }

        function displayProfile() {
            // display the profile
            document.querySelector('#profile-view .nickname').innerHTML =
                userProfile.nickname;

            document.querySelector(
                '#profile-view .full-profile'
            ).innerHTML = JSON.stringify(userProfile, null, 2);

            document.querySelector('#profile-view img').src = userProfile.picture;
        }

        function updateProfilePicture(userId, url) {
            var accessToken = localStorage.getItem('access_token');
            console.log('access_token: ' + accessToken);
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "https://tizenapp.auth0.com/api/v2/users/" + userId,
                "method": "PATCH",
                "headers": {
                    "authorization": "Bearer " + accessToken,
                    "content-type": "application/json"
                },
                "processData": false,
                "data": "{\"user_metadata\": {\"picture\": \"" + url + "\"}}"
            }

            $.ajax(settings).done(function (response) {
                console.log(response);
            });
        }
    </script>

    <script src="public/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="public/lib/blueimp-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="public/lib/blueimp-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
    <script src="public/lib/blueimp-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
    <script src="public/lib/cloudinary-jquery-file-upload/cloudinary-jquery-file-upload.js" type="text/javascript"></script>

    <script>
        $.cloudinary.config({ cloud_name: 'tizenapp', secure: true});
        //$.cloudinary.image("family_bench.jpg", {width: 250, height: 250, gravity: "faces", crop: "fill"});

        $(document).ready(function() {
            if($.fn.cloudinary_fileupload !== undefined) {
                $("input.cloudinary-fileupload[type=file]").cloudinary_fileupload();
                $('.cloudinary-fileupload').bind('cloudinarydone', function(e, data) {

                    console.log(data.result.url);
                    var html = $.cloudinary.imageTag(data.result.public_id,
                        { format: data.result.format, version: data.result.version,
                            crop: 'scale', width: 200 });

                    console.log(html.toString());

                    $('.preview').html('<img src="' + data.result.url + '"></img>');



                    $('.image_public_id').val(data.result.public_id);
                    return true;});
            }
        });

    </script>
@endsection
