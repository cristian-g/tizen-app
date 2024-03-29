$('document').ready(function(){
    'use strict';
    $('.wrapper').load('views/main.html', function(){
    	
    	
    	
        $.caph.focus.activate(function(nearestFocusableFinderProvider, controllerProvider) {
            controllerProvider.setInitialDepth(1);
        });
        
        //Llibreria PubNub
        var pubnub = new PubNub({
            subscribeKey: "sub-c-e3a6b7dc-ff1f-11e8-a399-32ec39b2e34f",
            publishKey: "pub-c-94083343-a5ff-4f4b-90d3-d88866bf799b",
            ssl: true
        });
        pubnub.addListener({
            message: function(message) {
                // handle message
                if (message.message.action === 'auth') {
                    localStorage.setItem('id_token', message.message.idToken);
                    localStorage.setItem('user_name', message.message.userInfo.name);
                    localStorage.setItem('image', message.message.userInfo.picture);
                    displayProfile(message.message.userInfo);
                }
                if (message.message.action === 'paid_video') {
                    myVideoApp.showDetail(myVideoApp.currentVideo);
                }
                if (message.message.action === 'logout') {
                    myVideoApp.logOut();
                }
                if (message.message.action === 'profile_update') {
                    $.ajax({
                        url: 'http://ztudy.tk/api/login',
                        method: "GET",
                        dataType: "json",
                        headers: {
                            "Authorization": "Bearer " + localStorage.getItem("id_token")
                        },
                        success: function(response) {
                            localStorage.setItem('image', response.user.picture);
                            document.querySelector('#profile-view img').src = response.user.picture;
                            $('#picture-modal img').attr('src', response.user.picture);
                            document.querySelector('#picture-modal img').addEventListener('load', function(){
                            	$('#picture-modal').fadeIn(500);
                                setTimeout(function(){ $('#picture-modal').fadeOut(500); }, 5500);
                            })
                        },
                        error: function(error, status) {
                            console.error(error, status);
                        }
                    });
                }
                if (message.message.action === 'notifications_update') {
                	 $.ajax({
                         url: 'http://ztudy.tk/api/notifications',
                         method: "GET",
                         dataType: "json",
                         headers: {
                             "Authorization": "Bearer " + localStorage.getItem("id_token")
                         },
                         success: function(response) {
                             myVideoApp.notification = response.notifications[0]
                             myVideoApp.showNotification();
                         },

                         error: function(error, status) {
                             console.error(error, status);
                         }
                     });
                }

            },
            presence: function(presenceEvent) {
                // handle presence
                console.log(presenceEvent);
            }
        });

        //funcionalitats botons
        $('#btnLogIn').on('focused', function(){
            myVideoApp.setOverviewDark(false);
        }).on('selected',function() {
            $.ajax({
                url: 'http://ztudy.tk/api/getCode',
                method: "POST",
                dataType: "json",
                data: {
                    action_code: 'auth'
                },

                success: function(response) {
                    $('#auth-link-message').html('Visit <span class="auth-url">ztudy.tk/' + response.code + '</span> using your smartphone');
                    
                    var nric = 'ztudy.tk/' + response.code;
                    var url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + nric + '&amp;size=500x500';
                    $('#barcode').attr('src', url);
                    
                    pubnub.subscribe({
                        channels: [response.code]
                    });
                    document.querySelector('#barcode').addEventListener('load', function(){
                    	myVideoApp.changeDepth(5);
                    })
                    
                },

                error: function(error, status) {
                    console.error(error, status);
                }
            });
        });
        
        $('#btnBack').on('selected', function(){
            myVideoApp.back();
        });   
        $('#btnBack4').on('selected', function(){
            myVideoApp.back();
        });
        $('#btnBack5').on('selected', function(){
            myVideoApp.back();
        });
        $('#btnBack6').on('selected', function(){
            myVideoApp.back();
        });
        $('#btnBack7').on('selected', function(){
            myVideoApp.back();
        });
        $('.select-opt').on('focused', function(){
        	myVideoApp.setOverviewDark(false);
        	myVideoApp.showCategoryList();
        }).on('blurred', function(){
        	myVideoApp.hideCategoryList();
        });
        
        //funcionalitats select categories
        $('#ctg1').on('focused', function(){
        	$('.select-opt').removeClass('opt-focused');
        	$('#ctg1').addClass('opt-focused');
        }).on('selected', function(){
        	myVideoApp.changeCategory('Technology')
        });
        $('#ctg2').on('focused', function(){
        	$('.select-opt').removeClass('opt-focused');
        	$('#ctg2').addClass('opt-focused');
        }).on('selected', function(){
        	myVideoApp.changeCategory('Biology')
        });
        $('#ctg3').on('focused', function(){
        	$('.select-opt').removeClass('opt-focused');
        	$('#ctg3').addClass('opt-focused');
        }).on('selected', function(){
        	myVideoApp.changeCategory('Sociology')
        });
        $('#ctg4').on('focused', function(){
        	$('.select-opt').removeClass('opt-focused');
        	$('#ctg4').addClass('opt-focused');
        }).on('selected', function(){
        	myVideoApp.changeCategory('Graphic Design')
        });
        
        $('#logOutOpt').on('focused', function(){
            myVideoApp.setOverviewDark(false);
        	$('#logOut').addClass('focus-in');
        	$('#description').css('opacity','0.1');
        	$('#profileSelect').css('opacity','1');
        }).on('blurred', function(){
        	$('#logOut').removeClass('focus-in');
        	$('#description').css('opacity','1');
        	$('#profileSelect').css('opacity','0');
        }).on('selected', function(){
        	
        	myVideoApp.logOut();
        });
        
        $('#btnPlay').on('selected', function(){
        	myVideoApp.isPreview = false;
        	$('#totalDuration').html(myVideoApp.currentVideo.duration);
        	setMediaControllerTimer();
            myVideoApp.changeDepth(myVideoApp._DEPTH.PLAYER);
            myVideoApp.launchPlayer();
        });
        
        $('#btnRecommend').on('selected', function(){
            myVideoApp.changeDepth(myVideoApp._DEPTH.RECOMMEND);
        });
        
        $('#btnPreview').on('selected', function(){
        	$('#caphPlayer video')[0].currentTime = 0;
        	myVideoApp.isPreview = true;
        	$('#totalDuration').html("01:00");
            setMediaControllerTimer();
            myVideoApp.changeDepth(myVideoApp._DEPTH.PLAYER);
            myVideoApp.launchPlayer();
        });

        
        $('#btnBuy').on('selected',function() {
        	var videoId = myVideoApp.currentVideo.id;
        	var headers = {};
            if (localStorage.getItem("id_token") !== null) {
                headers = {
                    "Authorization": "Bearer " + localStorage.getItem("id_token")
                };
                $.ajax({
                    url: 'http://ztudy.tk/api/getCode',
                    method: "POST",
                    dataType: "json",
                    data: {
                        action_code: 'individualPurchase',
                        video_id: videoId
                    },
                    headers: headers,

                    success: function(response) {
                        $('#buy-link-message').html('Visit ztudy.tk/' + response.code + ' using your smartphone');
                        var nric = 'ztudy.tk/' + response.code;
                        var url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + nric + '&amp;size=500x500';
                        $('#barcodeBuy').attr('src', url);
                        
                        pubnub.publish(
                            {
                                message: {
                                    action: 'pageChange'
                                },
                                channel: response.code
                            },
                            function (status, response) {
                                // handle status, response
                            }
                        );
                        document.querySelector('#barcodeBuy').addEventListener('load', function(){
                        	myVideoApp.changeDepth(4);
                        })
                        
                    },

                    error: function(error, status) {
                        console.error(error, status);
                    }
                });
            }else{
            	$.ajax({
                    url: 'http://ztudy.tk/api/getCode',
                    method: "POST",
                    dataType: "json",
                    data: {
                        action_code: 'auth'
                    },
                    /*headers: {
                        "Authorization": "Bearer " + accessToken
                    },*/

                    success: function(response) {
                        $('#auth-link-message').html('Visit <span class="auth-url">ztudy.tk/' + response.code + '</span> using your smartphone');
                        
                        var nric = 'ztudy.tk/' + response.code;
                        var url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + nric + '&amp;size=500x500';
                        $('#barcode').attr('src', url);
                        
                        pubnub.subscribe({
                            channels: [response.code]
                        });
                        document.querySelector('#barcode').addEventListener('load', function(){
                        	if(!myVideoApp.requestCodeRunning){
                        		myVideoApp.requestCodeRunning = true;
                        		myVideoApp.changeDepth(5);
                        	}
                        })
                    },
                    complete: function() {
                    	myVideoApp.requestCodeRunning = false;
                    },
                    error: function(error, status) {
                        console.error(error, status);
                    }
                });
            }
            
        });
        
        //mostrar pantalla inici
        myVideoApp.changeDepth(myVideoApp._DEPTH.INDEX);
        
    });
    //funcionalitats player
    var relatedPlaylistItems = [];

    myVideoApp.initVideoPlayer(); // Initialize video plugin.

    var mediaControllerTimer;
    var controllerElement = $('#caphPlayer .controls-bar');
    var isShowController = true;
    var showPlayerController = function(val){
        if(val === true){
            isShowController = true;
            controllerElement.css('opacity', 1);
        } else {
            isShowController = false;
            controllerElement.css('opacity', 0);
        }
    };
    var setMediaControllerTimer = function(){
        showPlayerController(true);
        if(mediaControllerTimer){
            clearTimeout(mediaControllerTimer);
        }
        mediaControllerTimer = setTimeout(function(){
            showPlayerController(false);
            mediaControllerTimer = null;
        }, CONSTANT.MEDIA_CONTROLLER_TIMEOUT);
    };
    controllerElement.on('mouseover', function(){
        setMediaControllerTimer();
    });

    $.caph.focus.controllerProvider.addBeforeKeydownHandler(function(context){
        if(myVideoApp.currentDepth === myVideoApp._DEPTH.PLAYER){
            if(!isShowController){
                setMediaControllerTimer();
                return false;
            } else {
                setMediaControllerTimer();
            }
        }
        switch(context.event.keyCode){
            case CONSTANT.KEY_CODE.RETURN:
            case CONSTANT.KEY_CODE.ESC:
                myVideoApp.back();
                break;
        }
    });
    
});

//funció d'autentificació
function displayProfile(userProfile) {
    // display the profile
    document.querySelector(
        '#profile-view .card-title'
    ).innerHTML = userProfile.name;

    document.querySelector('#profile-view img').src = userProfile.picture;
    
    $('#auth-link-message').html('Welcome back ' + userProfile.name + '!');
    $('#barcode').attr('src', userProfile.picture);

}

