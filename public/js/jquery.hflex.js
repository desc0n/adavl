(function( $ ) {
	var methods = {
		init : function( options ) { 
			var options = $.extend({      // Declaring settings by default that can be reset in plugin call
				speed: 800,
				min_move_x: 20,
				min_move_y: 20,
				preventDefaultEvents: true
		    }, options);
			
			
			return this.each(function(){
				
				function startLoading(){
					if (aSrc.length==0) return;
					aSrc[0][0].one("load", function(){
						aSrc[0][0].removeAttr("data-original");
						pabs = "position:absolute;";
						opcty = 0;
						if ($(window).width() <= 768)
						{
							pabs = "";
							opcty = 0.99;
						}
						$li = $ul.append('<li class="extra_item fullheight na" style="'+pabs+'top:0px;left:0px;opacity:'+opcty+';width:10000px;"><img src="'+aSrc[0][1]+'" /></li>');
						aSrc.shift();
						setTimeout(startLoading, 50);
					}).attr("src", aSrc[0][1]);
				}
				
				function initDesktop()
				{
                                    
                                        if (!$ul.children("li:first").hasClass('slideshow_banner'))
                                        {
                                            var lastFirst = $ul.children("li.slideshow_banner").clone();
                                            $ul.children("li.slideshow_banner").remove();
                                            
                                            $ul.prepend(lastFirst);
                                            lastFirst.css({'width':'auto'});
                                            
                                            if (currentSlide == 1 || currentSlide == 0)
                                            {
                                                lastFirst.css({'opacity':'1'});
                                            }                                            
                                        }
                                        else
                                        {
                                            if ($("ul").is(".flex-direction-nav")) return;
                                        }                                   
                                        
					$ul.children("li").not(".slideshow_banner").each(function(){
						$img = $(this).children("img");
						$li = $(this);
						lx = $ul.children("li.slideshow_banner").outerWidth(true);
						$li.addClass("na").css({"position":"absolute", "top":"0px", "left":lx+"px", "width": "10000px"});
						if ($li.index()>1) $li.css({"left":"0px"});
						if ($li.index()>1 && currentSlide != $li.index()) $li.css({"opacity":"0"});
                                                if ($li.index() == 1 && (currentSlide == 1 || currentSlide == 0))
                                                {
                                                    $li.css({"opacity":"1"});
                                                }
						if ($img.is("[data-original]"))
						{
							aSrc.push([$img, $img.attr("data-original")]);
							$li.remove();
						}
					});
					
					$navi = $('<ul class="flex-direction-nav"/>');
					$prev = $('<li><a href="#" class="flex-prev"> </a></li>');
					$next = $('<li><a href="#" class="flex-next"> </a></li>');
					$navi.append($prev).append($next).css("z-index", 1000);
					$hFlex.append($navi);
					
					
					$ul.bind( 'transitionend', function() {
						$hFlex.animated = false;
					});
					
					
					
					$next.click(function(){

						if ($ul.children().length==2) return;
						if ($hFlex.animated) return;
						if (aSrc.length!=0 && currentSlide==$ul.children().length) return;
						$hFlex.animated = true;
						
						if (currentSlide==1) currentSlide=0;
						
						$li = $ul.children("li").eq(currentSlide);
						$li.css("transition", "all "+speed+" ease-in-out 0s");
						$li.css("opacity", 0);
							
						if (currentSlide==0)
						{
							currentSlide++;
							$li = $ul.children("li").eq(currentSlide);
							$li.css("transition", "all "+speed+" ease-in-out 0s");
							$li.css("opacity", 0);
						}
						
						currentSlide++;
						
						if (currentSlide==$ul.children().length)
						{
							currentSlide=0;
							$li = $ul.children("li").eq(currentSlide);
							$li.css("transition", "all "+speed+" ease-in-out "+speed);
							$li.css("opacity", 0.99);
							currentSlide++;
						}
						
						$li = $ul.children("li").eq(currentSlide);
						$li.css("transition", "all "+speed+" ease-in-out "+speed);
						$li.css("opacity", 0.99);
							
						
					});
					$prev.click(function(){

						if ($ul.children().length==2) return;
						if ($hFlex.animated) return;
						if (aSrc.length!=0 && (currentSlide==0 || currentSlide==1)) return;
						$hFlex.animated = true;
						
						if (currentSlide==0) currentSlide=1;
						
						$li = $ul.children("li").eq(currentSlide);
						$li.css("transition", "all "+speed+" ease-in-out 0s");
						$li.css("opacity", 0);
							
						if (currentSlide==1)
						{
							currentSlide--;
							$li = $ul.children("li").eq(currentSlide);
							$li.css("transition", "all "+speed+" ease-in-out 0s");
							$li.css("opacity", 0);
						}
						currentSlide--;
						
						
						if (currentSlide<0) currentSlide=$ul.children().length-1;
						
						$li = $ul.children("li").eq(currentSlide);
						$li.css("transition", "all "+speed+" ease-in-out "+speed);
						$li.css("opacity", 0.99);
						
						if (currentSlide==1)
						{
							currentSlide--;
							$li = $ul.children("li").eq(currentSlide);
							$li.css("transition", "all "+speed+" ease-in-out "+speed);
							$li.css("opacity", 0.99);
						}
						
					});
					
					if ('ontouchstart' in document.documentElement) {
						this.addEventListener('touchstart', onTouchStart, false);
					}

				}
				
				function initPreDesktop()
				{
                                        if ($ul.children("li:first").hasClass('slideshow_banner'))
                                        {
                                            var lastFirst = $ul.children("li:first").clone();
                                            $ul.children("li:first").remove();
                                            
                                            $ul.children("li:first").css('left',0).after(lastFirst);
                                            
                                            if (currentSlide == 1 || currentSlide == 0)
                                            {
                                                $ul.children("li").css({'opacity':'0'});
                                                $ul.children("li:first").css({'opacity':'1'});
                                            } 
                                        }
                                        else
                                        {
                                            if ($("ul").is(".flex-direction-nav")) return;
                                        }
					
					
					$ul .children("li")
                                            .css({"position":"absolute", "top":"0px", "opacity":"0", "left":"0px", "width": "10000px"})
                                            .not(".slideshow_banner").each(function(){
						$img = $(this).children("img");
						$li = $(this);
						//lx = $ul.children("li.slideshow_banner").outerWidth(true);
						$li.addClass("na");
						//if ($li.index()>1) $li.css({"opacity":"0", "left":"0px"});
						if ($img.is("[data-original]"))
						{
							aSrc.push([$img, $img.attr("data-original")]);
							$li.remove();
						}
					});
					$ul .children("li:eq("+currentSlide+")").css({"opacity":"1"});
                                        
					$navi = $('<ul class="flex-direction-nav"/>');
					$prev = $('<li><a href="#" class="flex-prev"> </a></li>');
					$next = $('<li><a href="#" class="flex-next"> </a></li>');
					$navi.append($prev).append($next).css("z-index", 1000);
					$hFlex.append($navi);
					
					
					$ul.bind( 'transitionend', function() {
						$hFlex.animated = false;
					});
					
					
					
					$next.click(function(){

						if ($ul.children().length==1) return;
						if ($hFlex.animated) return;
						if (aSrc.length!=0 && currentSlide==$ul.children().length) return;
						$hFlex.animated = true;
						
						//if (currentSlide==1) currentSlide=0;
						
						$li = $ul.children("li").eq(currentSlide);
						$li.css("transition", "all "+speed+" ease-in-out 0s");
						$li.css("opacity", 0);
							
						if (currentSlide==0)
						{
//							currentSlide++;
//							$li = $ul.children("li").eq(currentSlide);
//							$li.css("transition", "all "+speed+" ease-in-out 0s");
							$li.css("opacity", 0);
						}
						
						currentSlide++;
						
						if (currentSlide==$ul.children().length)
						{
							currentSlide=0;
//							$li = $ul.children("li").eq(currentSlide);
//							$li.css("transition", "all "+speed+" ease-in-out "+speed);
//							$li.css("opacity", 0.9);
//							currentSlide++;
						}
						
						$li = $ul.children("li").eq(currentSlide);
						$li.css("transition", "all "+speed+" ease-in-out "+speed);
						$li.css("opacity", 0.99);
							
						
					});
					$prev.click(function(){

						if ($ul.children().length==1) return;
						if ($hFlex.animated) return;
						if (aSrc.length!=0 && (currentSlide==0)) return;
						$hFlex.animated = true;
						
						//if (currentSlide==0) currentSlide=1;
						
						$li = $ul.children("li").eq(currentSlide);
						$li.css("transition", "all "+speed+" ease-in-out 0s");
						$li.css("opacity", 0);
							
						if (currentSlide==0)
						{
//							currentSlide--;
//							$li = $ul.children("li").eq(currentSlide);
//							$li.css("transition", "all "+speed+" ease-in-out 0s");
							$li.css("opacity", 0);
						}
						currentSlide--;
						
						
						if (currentSlide<0) currentSlide=$ul.children().length-1;
						
						$li = $ul.children("li").eq(currentSlide);
						$li.css("transition", "all "+speed+" ease-in-out "+speed);
						$li.css("opacity", 0.99);
						
//						if (currentSlide==1)
//						{
//							currentSlide--;
//							$li = $ul.children("li").eq(currentSlide);
//							$li.css("transition", "all "+speed+" ease-in-out "+speed);
//							$li.css("opacity", 0.9);
//						}
						
					});
					
					if ('ontouchstart' in document.documentElement) {
						this.addEventListener('touchstart', onTouchStart, false);
					}

				}
				
				function initMobile()
				{
					var $ul = $hFlex.children("ul");
                                    
                                        if (!$ul.children("li:first").hasClass('slideshow_banner'))
                                        {
                                            var lastFirst = $ul.children("li.slideshow_banner").clone();
                                            $ul.children("li.slideshow_banner").remove();
                                            
                                            $ul.prepend(lastFirst);
                                        }
                                        
					$ul.children("li").css("position","").removeClass("na").removeClass("active").css({"opacity":"0.99", "transition":"all 0s ease-in-out 0s", "float":"none", "left":"0px"});
					$ul.children("li.slideshow_banner").css("position","relative");
					$('ul.flex-direction-nav').remove();
					currentSlide = 0;
					if ('ontouchstart' in document.documentElement) {
						this.removeEventListener('touchstart', onTouchStart, false);
					}
				}
				
				
				function doResize()
				{
					$ul.css("transition", "all "+speed+" ease-in-out 0s");
					$ul.css("transform", "translateX(0px)");
					if ($(window).width() > 1024)
                                        {
                                            initDesktop();
                                        }					
					else 
                                        {
                                            if ($(window).width() > 768)
                                            {
                                                initPreDesktop();
                                            }
                                            else
                                            {
                                                initMobile();
                                            }
                                        }						
				}
				
				var startX;
				var startY;
				var isMoving = false;

				function cancelTouch() {
				 this.removeEventListener('touchmove', onTouchMove);
				 startX = null;
				 isMoving = false;
				}	

				function onTouchMove(e) {
					 if(options.preventDefaultEvents) {
						 e.preventDefault();
					 }
					 if(isMoving) {
						var x = e.touches[0].pageX;
						var y = e.touches[0].pageY;
						var dx = startX - x;
						var dy = startY - y;
						if(Math.abs(dx) >= options.min_move_x) {
							cancelTouch();
							if(dx > 0) {
								$next.click();
							}
							else {
								$prev.click();
							}
						}
						
					 }
				}

				function onTouchStart(e)
				{
				 if (e.touches.length == 1) {
					startX = e.touches[0].pageX;
					startY = e.touches[0].pageY;
					isMoving = true;
					this.addEventListener('touchmove', onTouchMove, false);
				 }
				}

								
				
				var $hFlex = $(this);
				var $ul = $hFlex.children("ul");
				var width = 0;
				var currentSlide = 0;
				var maxSlides = $ul.children("li").length;
				var curX = 0;
				var lastX = 0;
				var firstX = 0;
				var speed = (options.speed/1000)+"s";
				var aWidths = new Array();
				var aSrc = new Array();
				var $prev;
				var $next;
				$("body").data("hFlex", true);
				

				$hFlex.animated = false;
				$hFlex.isiPad = navigator.userAgent.match(/iPad/i) != null;
				
				
				//calcWidth();
				
				var resizeTimer;
				
				$(window).resize(function() {
					if ($("body").data("hFlex")){
					    clearTimeout(resizeTimer);
					    resizeTimer = setTimeout(doResize, 100);
					}
				});
				
				//,"background-position":"center center","background-image":"url(/images/preloader.gif)","background-repeat":"no-repeat"
				$ul.children("li.slideshow_banner").css({"position":"absolute", "top":"0px","left":"0px"});
				//$ul.children("li").not(".slideshow_banner").css({"float":"left","background-position":"center center","background-image":"url(/images/preloader.gif)","background-repeat":"no-repeat"}).addClass("na");
				
				
				
				if ($(window).width() > 1024)
					initDesktop();
				else 
				{
                                    if ($(window).width() > 768)
                                    {
                                        initPreDesktop();
                                    }
                                    else
                                    {
                                    
					$ul.children("li").not(".slideshow_banner").each(function(){
						$img = $(this).children("img");
						$li = $(this);
						//lx = $ul.children("li.slideshow_banner").outerWidth(true);
						//$li.addClass("na").css({"position":"absolute", "top":"0px", "left":lx+"px", "width": "10000px"});
						//if ($li.index()>1) $li.css({"opacity":"0", "left":"0px"});
						if ($img.is("[data-original]"))
						{
							aSrc.push([$img, $img.attr("data-original")]);
							$li.remove();
						}
					});
					initMobile();                                        
                                    }
				}
				
				startLoading();
				
			});
		},
		destroy : function( ) {
		  $(window).unbind("resize");
		  this.each(function(){
			var $hFlex = $(this);
			$("body").data("hFlex", false);
			var $ul = $hFlex.children("ul");
			$ul.children("li").css("position","").removeClass("na").removeClass("active").css({"opacity":"0.99", "transition":"all 0s ease-in-out 0s"});
			$('ul.flex-direction-nav').remove();
		  });
		}
	};
	
	$.fn.hFlex = function( method ) {
		// логика вызова метода
		if ( methods[method] ) {
		  return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
		  return methods.init.apply( this, arguments );
		} else {
		  $.error( 'Метод с именем ' +  method + ' не существует для jQuery.tooltip' );
		} 
	};
})(jQuery);
