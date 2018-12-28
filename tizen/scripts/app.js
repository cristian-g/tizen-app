$('document').ready(function(){
    'use strict';
    $('.wrapper').load('views/main.html', function(){
        $.caph.focus.activate(function(nearestFocusableFinderProvider, controllerProvider) {
            controllerProvider.setInitialDepth(1);
        });
        myVideoApp.initDialogSetting();

        $('#btnSetting').on('focused', function(){
        	myVideoApp.hideCategoryList();
            myVideoApp.setOverviewDark(false);
        }).on('selected', function(){
            myVideoApp.changeDepth(4);
        });

        $('#btnLogIn').on('focused', function(){
        	myVideoApp.hideCategoryList();
            myVideoApp.setOverviewDark(false);
        });
        
        $('#btnBack').on('selected', function(){
            myVideoApp.back();
        });
        $('#btnBack4').on('selected', function(){
            myVideoApp.back();
        });
        $('.select-opt').on('focused', function(){
        	myVideoApp.setOverviewDark(false);
        	myVideoApp.showCategoryList();
        });
        
        $('#ctg1').on('focused', function(){
        	$('.select-opt').removeClass('opt-focused');
        	$('#ctg1').addClass('opt-focused');
        	
        });
        $('#ctg2').on('focused', function(){
        	$('.select-opt').removeClass('opt-focused');
        	$('#ctg2').addClass('opt-focused');
        });
        $('#ctg3').on('focused', function(){
        	$('.select-opt').removeClass('opt-focused');
        	$('#ctg3').addClass('opt-focused');
        });
        $('#ctg4').on('focused', function(){
        	$('.select-opt').removeClass('opt-focused');
        	$('#ctg4').addClass('opt-focused');
        });
        
        $('#btnPlay').on('selected', function(){
            setMediaControllerTimer();
            myVideoApp.changeDepth(myVideoApp._DEPTH.PLAYER);
            myVideoApp.launchPlayer();
        });

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
                items: myVideoApp._dataCategory[myVideoApp._CATEGORY.COLORS],
                template: 'playlist',
                containerClass: 'list-container',
                wrapperClass: "list-scroll-wrapper"
            }).on('focused', function($event){
                focusHandler($event, myVideoApp._CATEGORY.COLORS);
                myVideoApp.hideCategoryList();
            }).on('selected', function(){
                selectHandler(myVideoApp._CATEGORY.COLORS);
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
                myVideoApp.hideCategoryList();
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
                myVideoApp.hideCategoryList();
            }).on('blurred', function(){
                blurHandler();
            }).on('selected', function($event){
                selectHandler(myVideoApp._CATEGORY.NUMBERS);
            });

            relatedPlaylistItems = myVideoApp._dataCategory[myVideoApp._CATEGORY.COLORS];
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
            $('#btnSetting').hide();

            $.caph.focus.controllerProvider.getInstance().focus(
                $('#' + CONSTANT.PREPARED_DATA.COLORS[0].id)
            );
            myVideoApp.setListContainer(null, myVideoApp._CATEGORY.COLORS);
        });
    });

    var relatedPlaylistItems = [];

    myVideoApp.initVideoPlayer(); // Initialize video plugin.

    var updateRelatedPlaylist = function(listData){
        relatedPlaylistItems = listData;
        $('#related-play-list')[0].caphList.update();
    };

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