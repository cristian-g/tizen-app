$('document').ready(function(){
    'use strict';
    $('.wrapper').load('views/main.html', function(){
        $.caph.focus.activate(function(nearestFocusableFinderProvider, controllerProvider) {
            controllerProvider.setInitialDepth(1);
        });
        myVideoApp.initDialogSetting();
        
        //auth
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
            },
            presence: function(presenceEvent) {
                // handle presence
                console.log(presenceEvent);
            }
        });

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
                    myVideoApp.changeDepth(5);
                },

                error: function(error, status) {
                    console.error(error, status);
                }
            });
        });
        
        //buttons
        $('#btnSetting').on('focused', function(){
            myVideoApp.setOverviewDark(false);
        }).on('selected', function(){
            myVideoApp.changeDepth(4);
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
        $('.select-opt').on('focused', function(){
        	myVideoApp.setOverviewDark(false);
        	myVideoApp.showCategoryList();
        }).on('blurred', function(){
        	myVideoApp.hideCategoryList();
        });
        
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
        	$('#logOut').css('opacity','1');
        }).on('blurred', function(){
        	$('#logOut').css('opacity','0');
        }).on('selected', function(){
        	myVideoApp.logOut();
        });
        
        $('#btnPlay').on('selected', function(){
            setMediaControllerTimer();
            myVideoApp.changeDepth(myVideoApp._DEPTH.PLAYER);
            myVideoApp.launchPlayer();
        });

        myVideoApp.loadHomePage(function(){
        	 var focusHandler = function($event, category){
                 var currentItem = myVideoApp._dataCategory[category][$($event.target).data('index')];
                 myVideoApp.setOverviewDark(false);
                 myVideoApp.updateOverview(currentItem);
                 myVideoApp.setListContainer($event, category);
             };

             var selectHandler = function($event, category){
            	 var currentItem = myVideoApp._dataCategory[category][$($event.target).data('index')];
                 myVideoApp.setOverviewDark(false);
                 myVideoApp.showDetail(currentItem);
             };

             var blurHandler = function(){
                 if(myVideoApp.currentDepth === myVideoApp._DEPTH.INDEX){
                     myVideoApp.setOverviewDark(true);
                 }
             };
             
             $('#category_2').caphList({
                 items: myVideoApp._dataCategory[myVideoApp._CATEGORY.NEW],
                 template: 'playlist',
                 containerClass: 'list-container',
                 wrapperClass: "list-scroll-wrapper"
             }).on('focused', function($event){
                 focusHandler($event, myVideoApp._CATEGORY.NEW);
             }).on('selected', function($event){
                 selectHandler($event, myVideoApp._CATEGORY.NEW);
             }).on('blurred', function(){
                 blurHandler();
             });
             
             $('#category_3').caphList({
                 items: myVideoApp._dataCategory[myVideoApp._CATEGORY.MOST_VIEWED],
                 template: 'playlist',
                 containerClass: 'list-container',
                 wrapperClass: "list-scroll-wrapper"
             }).on('focused', function($event){
                 focusHandler($event, myVideoApp._CATEGORY.MOST_VIEWED);
             }).on('selected', function($event){
                 selectHandler($event, myVideoApp._CATEGORY.MOST_VIEWED);
             }).on('blurred', function(){
                 blurHandler();
             });
             
             myVideoApp.relatedPlaylistItems = myVideoApp._dataCategory[myVideoApp._CATEGORY.NEW];
             $('#related-play-list').caphList({
                 items: myVideoApp.relatedPlaylistItems,
                 template: 'relatedPlaylist',
                 containerClass: 'list-container',
                 wrapperClass: 'list-scroll-wrapper'
             }).on('selected', function(){
                 setMediaControllerTimer();
                 myVideoApp.changeDepth(myVideoApp._DEPTH.PLAYER);
                 myVideoApp.launchPlayer();
             });
             
             myVideoApp.changeDepth(myVideoApp._DEPTH.INDEX);

             $.caph.focus.controllerProvider.getInstance().focus(
                 $('#' + myVideoApp._dataCategory[myVideoApp._CATEGORY.NEW][0].id)
             );
             myVideoApp.setListContainer(null, myVideoApp._CATEGORY.NEW);
        });
        /*
        myVideoApp.initCategoryListData(function(){
            var focusHandler = function($event, category){
                var currentItem = myVideoApp._dataCategory[category][$($event.target).data('index')];
                myVideoApp.setOverviewDark(false);
                myVideoApp.updateOverview(currentItem);
                myVideoApp.setListContainer($event, category);
            };

            var selectHandler = function(category){
                myVideoApp.setOverviewDark(false);
                myVideoApp.changeDepth(myVideoApp._DEPTH.DETAIL);
                updateRelatedPlaylist(myVideoApp._dataCategory[category]);
            };

            var blurHandler = function(){
                if(myVideoApp.currentDepth === myVideoApp._DEPTH.INDEX){
                    myVideoApp.setOverviewDark(true);
                }
            };

            $('#category_0').caphList({
                items: myVideoApp._dataCategory[myVideoApp._CATEGORY.TECHNOLOGY],
                template: 'playlist',
                containerClass: 'list-container',
                wrapperClass: "list-scroll-wrapper"
            }).on('focused', function($event){
                focusHandler($event, myVideoApp._CATEGORY.TECHNOLOGY);
            }).on('selected', function(){
                selectHandler(myVideoApp._CATEGORY.TECHNOLOGY);
            }).on('blurred', function(){
                blurHandler();
            });

            $('#category_1').caphList({
                items: myVideoApp._dataCategory[myVideoApp._CATEGORY.ALPHABETS],
                template: 'playlist',
                containerClass: 'list-container',
                wrapperClass: "list-scroll-wrapper"
            }).on('focused', function($event){
                focusHandler($event, myVideoApp._CATEGORY.ALPHABETS);
            }).on('blurred', function(){
                blurHandler();
            }).on('selected', function($event){
                selectHandler(myVideoApp._CATEGORY.ALPHABETS);
            });

            $('#category_2').caphList({
                items: myVideoApp._dataCategory[myVideoApp._CATEGORY.NUMBERS],
                template: 'playlistSm',
                containerClass: 'list-container',
                wrapperClass: "list-scroll-wrapper"
            }).on('focused', function($event){
                focusHandler($event, myVideoApp._CATEGORY.NUMBERS)
            }).on('blurred', function(){
                blurHandler();
            }).on('selected', function($event){
                selectHandler(myVideoApp._CATEGORY.NUMBERS);
            });

            relatedPlaylistItems = myVideoApp._dataCategory[myVideoApp._CATEGORY.TECHNOLOGY];
            $('#related-play-list').caphList({
                items: relatedPlaylistItems,
                template: 'relatedPlaylist',
                containerClass: 'list-container',
                wrapperClass: 'list-scroll-wrapper'
            }).on('selected', function(){
                setMediaControllerTimer();
                myVideoApp.changeDepth(myVideoApp._DEPTH.PLAYER);
                myVideoApp.launchPlayer();
            });

            myVideoApp.changeDepth(myVideoApp._DEPTH.INDEX);

            $.caph.focus.controllerProvider.getInstance().focus(
                $('#' + CONSTANT.VIDEOS.TECHNOLOGY[0].id)
            );
            myVideoApp.setListContainer(null, myVideoApp._CATEGORY.TECHNOLOGY);
        });*/
    });

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

//------------------------------------------------------
// START OF AUTH BLOCK
// ------------------------------------------------------
function displayProfile(userProfile) {
    // display the profile
    document.querySelector(
        '#profile-view .card-title'
    ).innerHTML = userProfile.name;

    document.querySelector('#profile-view img').src = userProfile.picture;
    
    $('#auth-link-message').html('Welcome back ' + userProfile.name + '!');
    $('#barcode').attr('src', userProfile.picture);

}



// ------------------------------------------------------
// END OF AUTH BLOCK
// ------------------------------------------------------