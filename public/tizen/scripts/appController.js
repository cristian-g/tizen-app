'use strict';
var myVideoApp = {
    _CATEGORY : CONSTANT.CATEGORY,
    _DEPTH : {
        INDEX: 1,
        DETAIL: 2,
        PLAYER: 3,
        SETTING: 4,
        LOGIN: 5,
        CATEGORIES: 6
    },
    _dataCategory: [],
    newVideos: [],
    mostViewed: [],
    relatedPlaylistItems: [],
    currentCategory: undefined,
    currentDepth: undefined,
    categoryList: undefined,
    lastDepth: undefined,
    dialogSetting: undefined,
    playSetting: {
        chkAutoPlay: true,
        chkSubTitle: false
    },
    videoControls: undefined,
    initCategoryListData: function(callback){
        var focusController = $.caph.focus.controllerProvider.getInstance();
        setTimeout(function(){
            var welcomeElement = $('.welcome');
            /*this.updateCategoryListData(CONSTANT.PREPARED_DATA.COLORS, this._CATEGORY.COLORS, true);
            this.updateCategoryListData(CONSTANT.PREPARED_DATA.ALPHABETS, this._CATEGORY.ALPHABETS, true);
            this.updateCategoryListData(CONSTANT.PREPARED_DATA.NUMBERS, this._CATEGORY.NUMBERS, true);
            welcomeElement.addClass('fade-out');
            focusController.focus($('#' + this._CATEGORY.COLORS + '-' + CONSTANT.PREPARED_DATA.COLORS[0].id));*/
            
            this.updateCategoryListData(CONSTANT.VIDEOS.TECHNOLOGY, this._CATEGORY.TECHNOLOGY, true);
            this.updateCategoryListData(CONSTANT.PREPARED_DATA.ALPHABETS, this._CATEGORY.ALPHABETS, true);
            this.updateCategoryListData(CONSTANT.PREPARED_DATA.NUMBERS, this._CATEGORY.NUMBERS, true);
            welcomeElement.addClass('fade-out');
            focusController.focus($('#' + this._CATEGORY.COLORS + '-' + CONSTANT.PREPARED_DATA.COLORS[0].id));
            callback && callback();
        }.bind(this), 0);//3000);
    },
    updateCategoryListData: function(response, category, reload){
        this._dataCategory[category] = response;
    },
    setOverviewDark: function(dark){
        var container = $('#move-container');
        if(dark){
            container.addClass('opacity-dark');
            container.removeClass('opacity-light');
        } else {
            container.addClass('opacity-light');
            container.removeClass('opacity-dark');
        }
    },
    changeDepth: function(depth){
        for(var dth in this._DEPTH){
            if(this._DEPTH[dth] !== depth){
                $('.depth' + this._DEPTH[dth]).hide();
            }
        }
        $('.depth' + depth).show();
        
        switch (depth) {
		case 1:
			if(localStorage.getItem('id_token')){
				//logged
				$('.groupNotLogged').hide();
				$('.groupLogged').show();
				document.querySelector(
				        '#profile-view .card-title'
				    ).innerHTML = localStorage.getItem('user_name');
				document.querySelector('#profile-view img').src = localStorage.getItem('image');;
			}else{
				//not logged
				$('.groupLogged').hide();
				$('.groupNotLogged').show();
			}
			break;

		default:
			break;
		}
        
        this.lastDepth = this.currentDepth;
        this.currentDepth = depth;
        $.caph.focus.controllerProvider.getInstance().setDepth(depth);
    },
    setListContainer: function($event, category){
        if(myVideoApp.currentDepth === myVideoApp._DEPTH.INDEX){
            $('#list-category > .list-area').addClass('list-fadeout'); // fade-out for each list
            $('#category_' + category).parent().removeClass('list-fadeout');

            // Move Container
            if(category === myVideoApp.currentCategory){
                return;
            }
            if(localStorage.getItem('id_token') == null){
            	$('#list-category').css({
	            	
            		transform: 'translate3d(0, ' + (-CONSTANT.SCROLL_HEIGHT_OF_INDEX * (category - 2)) + 'px, 0)'
            
            	});
        	}else{
	            $('#list-category').css({
	            	
	            		transform: 'translate3d(0, ' + (-CONSTANT.SCROLL_HEIGHT_OF_INDEX * category) + 'px, 0)'
	            
	            });
        	}
            myVideoApp.currentCategory = category;
        }
    },
    updateOverview: function(item){
        $('.overview > .font-header').html(item.name).css('color', item.color);
        $('.desc').html(item.description);
        $('#wrapper').css('borderColor', item.color);
    },
    updateRelatedPlaylist: function(category){
    	$.ajax({
            url: 'http://ztudy.tk/api/category/' + category,
            method: "GET",
            dataType: "json",
            success: function(response) {
            	myVideoApp.relatedPlaylistItems = response.videos;
            	$('#related-play-list').html('');
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
            },
            error: function(error, status) {
                console.error(error, status);
            }
        });

    },
    initDialogSetting: function(){ // Initialize the setting dialog box.
        var _this = this;
        if(!this.dialogSetting){
            this.dialogSetting = $('#dialogSetting').caphDialog({
                position: {x:551, y:287},
                focusOption: {
                    depth: myVideoApp._DEPTH.SETTING
                },
                onSelectButton: function(buttonIndex, event){
                    _this.dialogSetting.caphDialog('close');
                }
            });
            $('#chkAutoPlay').caphCheckbox({
                focusOption: {
                    depth: myVideoApp._DEPTH.SETTING
                },
                checked: _this.playSetting.chkAutoPlay,
                onSelected :function(){
                    _this.playSetting.chkAutoPlay = !_this.playSetting.chkAutoPlay;
                }
            });
            $('#chkSubTitle').caphCheckbox({
                focusOption: {
                    depth: myVideoApp._DEPTH.SETTING
                },
                checked: _this.playSetting.chkSubTitle,
                onSelected :function(){
                    _this.playSetting.chkSubTitle = !_this.playSetting.chkSubTitle;
                }
            });
        }
    },
    openDialogSetting: function(){
        if(!this.dialogSetting){
            this.initDialogSetting();
        }
        this.dialogSetting.caphDialog('open');
    },
    initVideoPlayer: function(){ // Initialize video plugin using caphMedia.
        var btnPlay = $('#btnPlayerPlay .btn-icon-player');
        var _this = this;
        this.player = $('#caphPlayer').caphMedia({
            controller: { // Button's ID for controlling.
                restart: 'btnPlayerRestart',
                rewind: 'btnPlayerRewind',
                togglePlay: 'btnPlayerPlay',
                forward: 'btnPlayerForward',
                next: 'btnPlayerNext'
            },
            onPlay: function(){ // The event handler when the video starts playing.
                btnPlay.removeClass('icon-caph-play').addClass('icon-caph-pause');
            },
            onPause: function(){ // The event handler when the video stops playing.
                btnPlay.addClass('icon-caph-play').removeClass('icon-caph-pause');
            },
            onEnded: function(){ // The event handler when the video ends playing.
                if(_this.currentDepth === _this._DEPTH.PLAYER){
                    _this.back();
                }
            },
            onError: function(){ // The event handler when the error occurs during playing.
                if(_this.currentDepth === _this._DEPTH.PLAYER){
                    _this.back();
                }
            }
        });
        this.videoControls = {
            play: function(){
                $('#btnPlayerPlay').trigger('selected');
            },
            pause: function(){
                $('#btnPlayerPlay').trigger('selected');
            },
            restart: function(){
                $('#btnPlayerRestart').trigger('selected');
            },
            rewind: function(){
                $('#btnPlayerRewind').trigger('selected');
            },
            forward: function(){
                $('#btnPlayerForward').trigger('selected');
            },
            next: function(){
                $('#btnPlayerNext').trigger('selected');
            }
        };
        $('#btnPlayerReturn').on('selected', function(){
            this.back()
        }.bind(this));
    },
    launchPlayer: function(){
        if(this.playSetting.chkSubTitle){
            this.player[0].caphMedia.subTitle(true);
        }
        if(this.playSetting.chkAutoPlay){
            this.player[0].caphMedia.play();
        }
        $.caph.focus.controllerProvider.getInstance().focus('btnPlayerPlay');
    },
    showDetail: function(video){
    	console.log(video);
    	$('#title-video').html(video.name);
    	$('#detail-description').html(video.description);
    	$('#detail-date').html(video.date);
    	$('#detail-author').html(video.author);
    	$('#detail-duration').html(video.duration);
    	$('#detail-repro').html(video.views);
    	$('#detail-purch').html(video.purchases);
    	$('#price').html(video.price);
    	$('#comp-price').html(video.business_price);
    	
    	this.updateRelatedPlaylist(video.category.key);
    	
    	myVideoApp.changeDepth(2);
    },
    back: function(){
        if(this.currentDepth === this._DEPTH.INDEX){
            return;
        }
        var targetDepth;
        switch(this.currentDepth){
            case this._DEPTH.DETAIL:
                targetDepth = this._DEPTH.INDEX;
                break;
            case this._DEPTH.PLAYER:
                if(this.videoControls && this.videoControls.pause){
                    this.videoControls.pause();
                }
                targetDepth = this.lastDepth;
                break;
            default:
                targetDepth = this._DEPTH.INDEX;
        }
        this.changeDepth(targetDepth);
    },
    showCategoryList: function(){
    	$('#ctgOpt').css('opacity','1');
    	$('#description').css('opacity','0.1');
    	$('.rotate').addClass("down"); 
    },
    hideCategoryList: function(){
    	$('#ctgOpt').css('opacity','0');
    	$('#description').css('opacity','1');
    	$('.rotate').removeClass("down"); 
    },
    logOut: function(){
    	localStorage.removeItem('id_token');
    	$('.groupLogged').hide();
		$('.groupNotLogged').show();
    },
    loadHomePage: function(callback) {
        var headers = {};
        if (localStorage.getItem("id_token") !== null) {
            headers = {
                "Authorization": "Bearer " + localStorage.getItem("id_token")
            };
        }
        $.ajax({
            url: 'http://ztudy.tk/api/home',
            method: "GET",
            dataType: "json",
            headers: headers,

            success: function(response) {
                myVideoApp._dataCategory[myVideoApp._CATEGORY.NEW] = response[0].new;
                myVideoApp._dataCategory[myVideoApp._CATEGORY.MOST_VIEWED] = response[1].most_viewed;
                
                var focusController = $.caph.focus.controllerProvider.getInstance();
                
                setTimeout(function(){
                	var welcomeElement = $('.welcome');
                    welcomeElement.addClass('fade-out');
                    focusController.focus($('#' + myVideoApp._dataCategory[myVideoApp._CATEGORY.NEW][0].id));
                    callback && callback();
                }.bind(this), 0);//3000);
            },

            error: function(error, status) {
                console.error(error, status);
                return;
            }
        });
        
    },
    changeCategory: function(category){
    	$('#category-title').html(category);
    	var url;
    	switch (category) {
		case 'Technology':
			url = 'technology';
			break;
		case 'Biology':
			url = 'biology';
			break;
		case 'Sociology':
			url = 'sociology';
			break;
		case 'Graphic Design':
			url = 'graphic_design';
			break;
		default:
			break;
		}
    	$.ajax({
            url: 'http://ztudy.tk/api/category/' + url,
            method: "GET",
            dataType: "json",
            success: function(response) {
            	console.info(response)
            	myVideoApp.categoryList = response.videos;
            	var size = response.videos.length;
            	var i = 0;
            	$('#category-item-title').html('');
            	$('#description .overview').html('');
            	$('#list_0').html('');
            	$('#list_1').html('');
            	if(size > 0){
            		while (i < 3 || i < size){
            			$('#list_0').append('<div style="position: relative; transform: translate3d(0px, 0px, 0px); margin-right:15px" class=""><div id="'+ response.videos[i].id +'" info-num='+ i + ' class="item" ng-class="{\'item-blank\': item.isBlank === true}" focusable="" data-focusable-depth="6" data-index="0" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">'+
            									'<div class="loader hide" ng-show="item.loaded === false"></div>'+
            										'<div class="content" ng-hide="item.loaded === false" style="background: url('+ response.videos[i].photo_urls.url +');-webkit-background-size:100%;">'+
            											'<div class="text font-label">'+
            												'<div class="font-info">'+ response.videos[i].name +'</div>'+
            											'</div>'+
            										'</div>'+
            									'</div>'+
            								'</div>');

            			$('#list_0 #' + response.videos[i].id).on('selected', function(){
            				myVideoApp.showDetail(myVideoApp.categoryList[$(this).attr('info-num')]);
            			}).on('focused', function(){
            				$('#category-item-title').html(myVideoApp.categoryList[$(this).attr('info-num')].name);
                        	$('#description .overview').html(myVideoApp.categoryList[$(this).attr('info-num')].description);
            			});
            			
            			
            			
            			i++;
            		}
            		
            		if(size > 4){
            			while (i < 7 || i < size){
                			$('#list_1').append('<div style="position: relative; transform: translate3d(0px, 0px, 0px); margin-right:15px" class=""><div id="'+ response.videos[i].id +'" info-num='+ i + ' class="item" ng-class="{\'item-blank\': item.isBlank === true}" focusable="" data-focusable-depth="6" data-index="0" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">'+
                									'<div class="loader hide" ng-show="item.loaded === false"></div>'+
                										'<div class="content" ng-hide="item.loaded === false" style="background: url('+ response.videos[i].photo_urls.url +');-webkit-background-size:100%;">'+
                											'<div class="text font-label">'+
                												'<div class="font-info">'+ response.videos[i].name +'</div>'+
                											'</div>'+
                										'</div>'+
                									'</div>'+
                								'</div>');
                			$('#list_1 #' + response.videos[i].id).on('selected', function(){
                				myVideoApp.startVideoPlayer(myVideoApp.categoryList[$(this).attr('info-num')]);
                			}).on('focused', function(){
                				$('#category-item-title').html(myVideoApp.categoryList[$(this).attr('info-num')].name);
                            	$('#description .overview').html(myVideoApp.categoryList[$(this).attr('info-num')].description);
                			});
                			i++;
                		}
            		}
            		


            	}
            	myVideoApp.changeDepth(6);
        		$.caph.focus.activate(function(nearestFocusableFinderProvider, controllerProvider) {

    			});
            },

            error: function(error, status) {
                console.error(error, status);
            }
        });
    }
};
