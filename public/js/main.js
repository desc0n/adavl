var scrollerOptions = {
    autoScroll: false,
    autoScrollDirection: 'left',
    autoScrollSpeed: 10000,
    looped: false,
    scrollerAlignment: 'vertical',
    scrollerOffset: 0,
    scrollSpeed: 'slow',
    beforeCreateFunction: null,
    afterCreateFunction: null
}

var flexslideroptions = {
	animation: "fade",
	animationLoop: true,
	easing: "linear", 
	itemWidth: ' ',
	touch: true,
	controlNav: false,
	slideshow: false,
	smoothHeight: false,
	variableImageWidth: true,
	startAt: 0
	//bannerSelector: "div.slideshow_banner",
	//useCSS: false
	//itemBannerShowClass: 'show-banner'

}

var owlparams = {
	items : 2,
	itemsDesktop : [1199,2],
	itemsDesktopSmall : [980,2],
	addClassActive: true,
	navigation: true,
	pagination: false,
	navigationText:  [" "," "],
	slideSpeed: 1800,
	rewindSpeed : 4000
}

var owl;
var isContacts = false;
var isiPad = navigator.userAgent.match(/iPad/i) != null;

var carousel;

// add Google API


/*
function addMarker() 
{
    markers.push(new google.maps.Marker({
    position: egglabs,
    raiseOnDrag: false,
    icon: image,
      map: map,
      draggable: false
      }));
    
}
var map;
var egglabs = new google.maps.LatLng(55.783644,37.601241);
var mapCoordinates = new google.maps.LatLng(55.783644,37.601241);

var markers = [];
var image = new google.maps.MarkerImage(
  'https://dl.dropboxusercontent.com/u/5337679/ADM/Layout/Desktop/adm_marker.png',
  new google.maps.Size(133,66),
  new google.maps.Point(0,0),
  new google.maps.Point(42,56)
);
function initialize() {

	w = $("div.map_wrapper").width();
	h = "500px";
	//$("div#map-canvas").css({width:w+"px",height:h});	
	
	var mapOptions = {
	backgroundColor: "#ffffff",
	zoom: 16,
	disableDefaultUI: true,
	  center: mapCoordinates,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
	addMarker();
}
*/

function projectListClick()
{
	$("ul#projects_list>li.portfolio_item a").click(function(){
		var path = $(this).attr("href");
		//$("ul#projects_list>li.portfolio_item").removeClass("current_item");
		//var $parent = $(this).closest("li");
		//$parent.addClass("current_item");
		global_images = 0;
		$("div#preloader").fadeIn("fast", function()
		{
			$.get(path, {}, function(data)
			{
				var div = $('<div></div>');
				var img = $(data.replace(/^\s+|\s+$/g, '')).find('img:first');
				
				img.appendTo(div);
				img.load(function()
				{
					// $("div#content_inner").html(data);
					$("div.open_nav_btns a#nbgallery").css("display","block");
					$("div.open_nav_btns a#about_btn").css("display", "none");
					initHomeResize();
					$("div#preloader").fadeOut();
				})
				.each(function() 
				{
					if($(this).complete) $(this).load();
				});

			});
		});


		return false;
	});
}


function hide_spinner(){
	
	if ($(window).width() > 768){
		$(".spinner").fadeOut(1300);
		$("body").addClass("show");
		$("div#preloader").css("opacity", "1");
		//$.get("/index.php?ajax=Y",{}, function(data){
			//$("div#content_inner").html(data);
			initHomeResize();
			$("div#preloader").fadeOut("fast");
		//});
	}
	else
	{
		$(".m_navigation").addClass("in");
		$("body").addClass("openNav");
		$(".global_wrap").css('height', $(window).height());
		//$("a#nbgallery").css("display","none");
		//$("a#about_btn").css("display", "block");
		$.get(document.location.pathname + "gallery_structure/?ajax=Y",function(data){
			$(".spinner").fadeOut(1500);
			$("body").addClass("show");
			$("div#preloader").css("opacity", "1");
			// $("div#content_inner").html(data);
			projectListClick();
			initHomeResize();
			$("div#preloader").fadeOut("fast");
		});
	}
}
function imgSize(){
	$(".slides li").each(function(){
		var imgW = $(this).find("img").width();
		var imgH = $(this).find("img").height();
		var contentW = $("#content").width();
		var contentH = $("#content").height();
		
		if($(window).width() > 768){
			if(imgW >= imgH)
			{
				//$(this).find("img").width(contentW).css({"height": "auto"});
				imgH = $(this).find("img").height();
				//$(this).addClass("fullheight");
				//$(this).find("img").height(contentH).css({"width": "auto"});
				//$(this).find("img").css({"height": "auto"});
			}
			/*
			if(imgH > contentH){
				$(this).addClass("extra_item");
			}
			if(imgW < imgH){
				$(this).addClass("fullheight");
			}*/
			$(this).find("img").height(contentH).css({"width": "auto"});
			if (!$(this).hasClass("slideshow_banner"))
				$(this).addClass("extra_item").addClass("fullheight");
		}
	});
	
}
function initContentResize()
{
var isiPad = navigator.userAgent.match(/iPad/i) != null;
	if (window.cycleplugin!=undefined)
		window.cycleplugin=undefined;
	if (carousel!=undefined)
		carousel.cycle('destroy');
	if( $('body').data('hFlex') )
			    $('.flexslider').hFlex('destroy');
				
	if ($(window).width() > 768){
	    var carousel = $("#carousel");
		if (window.cycleplugin==undefined)
		 {
			carousel.cycle({manualSpeed: 600, speed: 600});
			carousel.cycle('stop');
			var isIE = /msie/.test(navigator.userAgent.toLowerCase());
		    if (!isIE){
		     	//carousel.preloader();
		    }
		 }
	}
	/*
if ($(window).width() < 769 ){

			if( $('body').data('hFlex') ) {
			    
			    $('.flexslider').hFlex('destroy');



			}
document.getElementById('content').scrollIntoView();
	
		} */


	$(window).unbind("resize");
	$(window).resize(function(){
		var carousel = $("#carousel");
		if ($(window).width() < 769){
			if (window.cycleplugin!=undefined)
				carousel.cycle('destroy');
		} 
		else {
		 	if (window.cycleplugin==undefined)
			{
				carousel.cycle({manualSpeed: 600, speed: 600});
				var isIE = /msie/.test(navigator.userAgent.toLowerCase());
			    if (!isIE){
			     //carousel.preloader();
			    }
			}
		}
	});

}
function initHomeResize(){
	var isiPad = navigator.userAgent.match(/iPad/i) != null;
	

	document.getElementById('content').scrollIntoView();
	imgSize();

	//if ($(window).width() > 768 )
	{
						
			if (!isiPad){
			//$("#portfolio_slider .viewport").scrollingCarousel(scrollerOptions);
				/*$('.flexslider img').lazyload({
					 container: $("div#slider"),
					 event: "transitionend"
				});*/
				$('.flexslider').hFlex();
			}   
			else
			{
				setTimeout(function(){$('.flexslider').hFlex(); $("div#preloader").fadeOut();}, 200);
			}
			//setTimeout(function(){$('.flexslider').hFlex();}, 200)
    }

}

$(document).ready(function(){
	var isiPad = navigator.userAgent.match(/iPad/i) != null;
	if ($(window).width() > 768 && isiPad){
          $("body").addClass("ipad");
    }
});

function reInitPortfolioSlider()
{

	$('#portfolio_slider').tinycarousel({
            axis: 'y',
            display: 3,
            controls: true,
            interval: false,
			infinite: false,
			intervaltime: 1,
            duration: 1200,
           mouseWheel: true
        });

    slider_portfolio = $("#portfolio_slider").data("plugin_tinycarousel");

	$("#portfolio_slider div.viewport").attr("id", "slider_viewport");
$("#portfolio_slider").touchwipe({
     wipeLeft: function() {  },
     wipeRight: function() {  },
     wipeUp: function() { $('#portfolio_slider .prev').trigger('click'); },
     wipeDown: function() { $('#portfolio_slider .next').trigger('click'); },
     min_move_x: 10,
     min_move_y: 10,
     preventDefaultEvents: true
});
}

$(window).load(function() {
	reInitPortfolioSlider();

/*	$("#slider_viewport").swipe({
	  swipeDown:function(event, direction, distance, duration, fingerCount) {
		//alert(distance);
		//This only fires when the user swipes left
		$('#portfolio_slider .prev').trigger('click');
	  },
  	  swipeUp:function(event, direction, distance, duration, fingerCount) {
		//This only fires when the user swipes left
		$('#portfolio_slider .next').trigger('click');
	  }

	});

 */

			/*slider.on('swipeup', function(e) {
			  $('#portfolio_slider .next').trigger('click');
			})
			 .on('swipedown', function(e) {
			  $('#portfolio_slider .prev').trigger('click');
			});*/


	$("#show_menu").click(function(){
          $(".m_navigation").addClass("in");
		  $("body").addClass("openNav");
    });
	
	$(".spinner").addClass("show");
	$('body').imagesLoaded( function() {
  		setTimeout(hide_spinner, 100);
    		$("body").addClass("show");
	});
    
	$("#fbshare,#gshare,#linshare,#tshare").click(function(){
		var url = $(this).attr("href");
		open(url,"displayWindow","width=520,height=300,left=350,top=170,status=no,toolbar=no,menubar=no,resizable=yes,scrollbars=yes");
		return false;
	})
	

	 $("ul#menu>li>a, a#about_btn, a#nbgallery").click(function(){
		$("body").removeClass("openNav");
		$(".m_navigation").removeClass("in");
		var path = $(this).attr("href");
		isContacts = (path.indexOf("contacts")==-1)?false:true;
		$("li.portfolio_item").removeClass("current_item");
		$("ul#menu>li").removeClass("current");
		$(this).parent("li").addClass("current");
		var global_images = 0;
		if ($(this).attr("id")=="about_btn" || $(this).attr("data-page")=="about_page")
		{
			$("div.open_nav_btns a#nbgallery").css("display","block");
			$("div.open_nav_btns a#about_btn").css("display", "none");
		}
		else
		{
			$("div.open_nav_btns a#nbgallery").css("display","none");
			$("div.open_nav_btns a#about_btn").css("display", "block");
		}
		if($(this).attr("id")=="nbgallery")
		{
			$.get(path, {}, function(data){
					//$("div#content_inner").html("");
					$("body,html").scrollTop(0);
					// $("div#content_inner").html(data);
					$(".m_navigation").removeClass("in");
					projectListClick();					
					$("body,html").scrollTop(0);
		})
		return false;
		}
		global_images = 0;
		$("div#preloader").fadeIn("fast", function(){
			$.get(path, {}, function(data){
				$("div#content_inner").html(data);	
				$("div#content_inner img").one('load', function() {
					global_images++;
					if (global_images>=$("div#content_inner img").length)
					{
						initContentResize();

						if (isContacts) 
						{
							//initialize();
						}
						$("div#preloader").fadeOut();
					}

				}).each(function() {
				  if(this.complete) $(this).load();

				});
				
			});
		});
			
		
		return false;
	});

	
	$("body").on('click.portfolio_item', "div#portfolio_slider li.portfolio_item a", function()
	{
		$("ul#menu>li").removeClass("current");
		var path = $(this).attr("href");
		$("li.portfolio_item").removeClass("current_item");
		var $parent = $(this).closest("li");
		$parent.addClass("current_item");
		
		var global_images = 0;
		$("div#preloader").fadeIn("fast", function(){
			$.get(path, {}, function(data)
			{	
				var isiPad = navigator.userAgent.match(/iPad/i) != null;
				
				if (!isiPad)
				{
					// $("div#content_inner").html(data);
					initHomeResize();
					$("div#preloader").fadeOut();
				}
				else {
					var div = $('<div></div>');
					var img = $(data.replace(/^\s+|\s+$/g, '')).find('img');
					
					var global_images = 0;
					img.appendTo(div);
					
					
					img.one("load", function()
					{			
						global_images++;
						if (global_images>=img.length)
						{
							// $("div#content_inner").html(data);
							initHomeResize();
							var isiPad = navigator.userAgent.match(/iPad/i) != null;
							if (!isiPad)
							{
								$("div#preloader").fadeOut();
							}
						}
					})
					.each(function() 
					{
						if(this.complete) $(this).load();
					});
				}
			});
		});


		return false;
	});

    $("body").on('click', '#js_main_project_list a', function(){
        $("ul#menu>li").removeClass("current");
        var path = $(this).attr("href");

        $("li.portfolio_item").removeClass("current_item");
        var i = 1;
        $.each($('li.portfolio_item .portfolio_title>a'),function(){
                i++;
                if ($(this).attr('href') == path){
                    slider_portfolio.move(i-2)
                    $(this).closest('li').addClass("current_item");
                }
            }

        )

        var global_images = 0;
        $("div#preloader").fadeIn("fast", function(){
            $.get(path, {}, function(data){
				var isiPad = navigator.userAgent.match(/iPad/i) != null;
				
				if (!isiPad)
				{
					// $("div#content_inner").html(data);
					initHomeResize();
					$("div#preloader").fadeOut();
				}
				else
				{
					var div = $('<div></div>');
					var img = $(data.replace(/^\s+|\s+$/g, '')).find('img');
					
					var global_images = 0;
					img.appendTo(div);
					
					
					img.one("load", function()
					{			
						global_images++;
						if (global_images>=img.length)
						{
							// $("div#content_inner").html(data);
							initHomeResize();
							var isiPad = navigator.userAgent.match(/iPad/i) != null;
							if (!isiPad)
							{
								$("div#preloader").fadeOut();
							}
						}
					})
					.each(function() 
					{
						if(this.complete) $(this).load();
					});
				}
				/*
                $("div#content_inner img").one('load', function() {
                    global_images++;
                    if (global_images>=$("div#content_inner img").length)
                    {
                        initHomeResize();
                        $("div#preloader").fadeOut();
                    }
                }).each(function() {
                        if(this.complete) $(this).load();

                    });*/
            });
        });


        return false;
    });
	
	loadMainPage();
	
	/*$("a#main-logo-id").click(function(e){
		e.preventDefault();
		path = '/?ajax=Y';
		$.get(path, {}, function(data){
					$("div#content_inner").html(data);
					$(".m_navigation").removeClass("in");
					$("div#content_inner").scrollTop(0);
					projectListClick();					
		})
		return false;
	});*/
	
	$("a#nbgallery").click(function(){
		path = $(this).attr("href");
		$.get(path, {}, function(data){
					// $("div#content_inner").html(data);
					$(".m_navigation").removeClass("in");
					$("div#content_inner").scrollTop(0);
					projectListClick();					
		})
		return false;
	})

	$(".menu_item a, .open_nav_btns a").click(function(){
		var nameOfPage = $(this).attr("data-page");
		if(nameOfPage){
			$("body").attr("id",nameOfPage);
		}
	});
	
	//$(".slideshow_banner").css("width","512px");

	
	/*��������� ������� ��������*/
	
});

function loadMainPage()
{
	path = document.location.pathname+'?ajax=Y';
        
	$.get(path, {}, function(data)
	{		
		// $("div#content_inner").html(data);
		$(".m_navigation").removeClass("in");
		$("body").removeClass("openNav");

		$("div#content_inner").scrollTop(0);
		
		$("div#content_inner img").css('opacity', 0);
		projectListClick();		
		if (typeof extraLoaded == 'function')
		{
			extraLoaded();
		}		
		$("div#content_inner img").imagesLoaded(function(){});
			
		var imgs = $("div#content_inner").find('img');
		
		imgs.css('opacity', 0).load(function() 
		{
			$(this).animate({'opacity': 1}, 1000);
		})
		.each(function() 
		{
		  if(this.complete) $(this).load();
		});
	});
	
	$.get(document.location.pathname + 'ajax/left-menu.php', {}, function(data){
            
		$('#left-menu-desctop').html(data);
		reInitPortfolioSlider();
			
		var imgs = $('#left-menu-desctop').find('img');
		
		imgs.css('opacity', 0).load(function() 
		{
			$(this).animate({'opacity': 1}, 1000);
		})
		.each(function() 
		{
		  if(this.complete) $(this).load();
		});
	});
	
	
	setInterval(function(){
		if ($(".langWay li .mediaHolder img").length) {
			var r = $(".langWay li .mediaHolder img").width();
			$(".langWay li").width(r-2);
		} else {};
	},1000);
	
	$(window).resize(function(){
		setInterval(function(){
			if ($(".langWay li .mediaHolder img").length) {
				var r = $(".langWay li .mediaHolder img").width();
				$(".langWay li").width(r-2);
			} else {};
		},1000);
	});
	
	
	return false;
}	



