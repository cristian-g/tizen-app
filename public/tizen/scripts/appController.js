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
    currentVideo: undefined,
    dialogSetting: undefined,
    playSetting: {
        chkAutoPlay: true,
        chkSubTitle: false
    },
    isPreview: false,
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
		case this._DEPTH.INDEX:
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
			this.loadHomePage();
			this.lastDepth = this.currentDepth;
		break;
		default:
			this.lastDepth = this.currentDepth;
			break;
		}
        
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
            		transform: 'translate3d(0, ' + (-CONSTANT.SCROLL_HEIGHT_OF_INDEX * (category - 0)) + 'px, 0)'
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
                })/*.on('selected', function($event){
                	var currentItem = myVideoApp.relatedPlaylistItems[$('.focused').attr('index')];
                    myVideoApp.setOverviewDark(false);
                    myVideoApp.showDetail(currentItem);
                });*/
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
                	if(!myVideoApp.isPreview){
                		myVideoApp.currentVideo.ended = true;
                    	myVideoApp.completeVideoView(myVideoApp.currentVideo.id);
                	}else{
                		_this.back();
                	}
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
    	var videoId = video.id;
    	var headers = {};
        if (localStorage.getItem("id_token") !== null) {
            headers = {
                "Authorization": "Bearer " + localStorage.getItem("id_token")
            };
        }
        $.ajax({
            url: 'http://ztudy.tk/api/videos/' + videoId,
            method: "GET",
            dataType: "json",
            headers: headers,

            success: function(response) {
                myVideoApp.currentVideo = response;
                myVideoApp.currentVideo.ended = false;
                $('#title-video').html(video.name);
            	$('#detail-description').html(video.description);
            	$('#detail-date').html(video.date);
            	$('#detail-author').html(video.author);
            	$('#detail-duration').html(video.duration);
            	$('#detail-repro').html(myVideoApp.currentVideo.views);
            	$('#detail-purch').html(myVideoApp.currentVideo.purchases);
            	if(myVideoApp.currentVideo.purchased){
            		$('#btnBuy').hide();
            		$('#btnPlay').show()
            	}else{
            		$('#btnPlay').hide();
            		$('#price').html(video.price);
            		$('#btnBuy').show();
                	if(localStorage.getItem('id_token') == null){
                		$('#logBuyMsg').show();
                	}else{
                		$('#logBuyMsg').hide();
                	}
            	}
            	
            	myVideoApp.updateRelatedPlaylist(video.category.key);
            	
            	myVideoApp.changeDepth(2);
            	$.caph.focus.controllerProvider.getInstance().focus(
                        $('#btnPreview')
                 );
            	myVideoApp.loadVideo();
            },

            error: function(error, status) {
                console.error(error, status);
            }
        });

    	
    },
    loadVideo: function(){
    	$('#videoSource').attr("src", myVideoApp.currentVideo.source);
    	$('#caphPlayer video').load()
    	var video = $('#caphPlayer video')[0];
    	if(myVideoApp.currentVideo.resume){
    		video.currentTime = myVideoApp.currentVideo.timeToResume;
    	}
        video.addEventListener("timeupdate", function(){
    	    if(myVideoApp.isPreview){
    	    	if(this.currentTime >= 60) {
        	        this.pause();
        	        this.currentTime = 0;
        	        myVideoApp.changeDepth(2);
    	    	}
    	    }
    	    $('#currentDuration').html(myVideoApp.sec2MMSS(Math.round(this.currentTime)));
        });
    },
    back: function(){
        if(this.currentDepth === this._DEPTH.INDEX){
            return;
        }
        var targetDepth;
        switch(this.currentDepth){
            case this._DEPTH.DETAIL:
    			if(myVideoApp.lastDepth != 6){
    				targetDepth = 1;
    			}else{
    				targetDepth = 6;
    			}
                break;
            case this._DEPTH.PLAYER:
            	var video = $('#caphPlayer video')[0];
            	
                if(this.videoControls && this.videoControls.pause && !video.paused){
                    this.videoControls.pause();
                }
                targetDepth = this.lastDepth;
                if(video.currentTime != 0){
                	if(!myVideoApp.isPreview && !myVideoApp.currentVideo.ended){
                		myVideoApp.registerVideoView(myVideoApp.currentVideo.id, Math.round(video.currentTime));
                	}
                }
                break;
            case this._DEPTH.LOGIN:
            	if(myVideoApp.lastDepth == myVideoApp._DEPTH.DETAIL){
            		targetDepth = myVideoApp._DEPTH.DETAIL;
            	}
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
            	if(localStorage.getItem('id_token') == null){
            		myVideoApp._dataCategory[myVideoApp._CATEGORY.NEW] = response[0].new;
                    myVideoApp._dataCategory[myVideoApp._CATEGORY.MOST_VIEWED] = response[1].most_viewed;
            	}else{
    	            console.log(response);
    	            myVideoApp._dataCategory[myVideoApp._CATEGORY.NEW] = response[1].new;
                    myVideoApp._dataCategory[myVideoApp._CATEGORY.MOST_VIEWED] = response[2].most_viewed;
            	}
            	
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
    	 var headers = {};
         if (localStorage.getItem("id_token") !== null) {
             headers = {
                 "Authorization": "Bearer " + localStorage.getItem("id_token")
             };
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
            				this.lastDepth = 6;
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
    },
    sec2MMSS: function(secs){
	    var sec_num = parseInt(secs, 10); // don't forget the second param
	    var minutes = Math.floor(sec_num / 60);
	    var seconds = sec_num - (minutes * 60);

	    if (minutes < 10) {minutes = "0"+minutes;}
	    if (seconds < 10) {seconds = "0"+seconds;}
	    return minutes+':'+seconds;
    },
    updateVideoDetails: function(videoId) {
        var headers = {};
        if (localStorage.getItem("id_token") !== null) {
            headers = {
                "Authorization": "Bearer " + localStorage.getItem("id_token")
            };
        }
        $.ajax({
            url: 'http://ztudy.tk/api/videos/' + videoId,
            method: "GET",
            dataType: "json",
            headers: headers,

            success: function(response) {
                myVideoApp.currentVideo = response;
                myVideoApp.currentVideo.ended = false;
            },

            error: function(error, status) {
                console.error(error, status);
            }
        });
    },
    registerVideoView: function(videoId, timeToResume) {
        if (localStorage.getItem("id_token") === null) return;
        $.ajax({
            url: 'http://ztudy.tk/api/videos/' + videoId + '/view',
            method: "PATCH",
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("id_token")
            },
            data: {
                time_to_resume: timeToResume
            },

            success: function(response) {
                myVideoApp.updateVideoDetails(myVideoApp.currentVideo.id);
            },

            error: function(error, status) {
                console.error(error, status);
            }
        });
    },
    completeVideoView: function(videoId) {
        if (localStorage.getItem("id_token") === null) return;
        $.ajax({
            url: 'http://ztudy.tk/api/videos/' + videoId + '/complete',
            method: "PATCH",
            dataType: "json",
            headers: {
                "Authorization": "Bearer " + localStorage.getItem("id_token")
            },

            success: function(response) {
                myVideoApp.showDetail(myVideoApp.currentVideo);
            },

            error: function(error, status) {
                console.error(error, status);
            }
        });
    }

};
