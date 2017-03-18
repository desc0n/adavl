var isContacts = false;
var carousel;

function projectListClick()
{
	$("ul#projects_list>li.portfolio_item a").click(function(){
		var path = '/ajax/get_project_page_content?id=' + $(this).data('id');
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
					 $("div#content_inner").html(data);
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
			//$("div#content_inner").html(data);
			initHomeResize();
			$("div#preloader").fadeOut("fast");
	}
	else
	{
		$(".m_navigation").addClass("in");
		$("body").addClass("openNav");
		$(".global_wrap").css('height', $(window).height());
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
				imgH = $(this).find("img").height();
			}
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
		    }
		 }
	}

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
				$('.flexslider').hFlex();
			}   
			else
			{
				setTimeout(function(){$('.flexslider').hFlex(); $("div#preloader").fadeOut();}, 200);
			}
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
        var path = '/ajax/get_project_page_content?id=' + $(this).data('id');

        $("li.portfolio_item").removeClass("current_item");
        var i = 1;
        $.each($('li.portfolio_item .portfolio_title>a'),function(){
                i++;
                if ($(this).data('id') == path){
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
					 $("div#content_inner").html(data);
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
							 $("div#content_inner").html(data);
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
	
	loadMainPage();
	

	$("a#nbgallery").click(function(){
		path = $(this).attr("href");
		$.get(path, {}, function(data){
					// $("div#content_inner").html(data);
					$(".m_navigation").removeClass("in");
					$("div#content_inner").scrollTop(0);
					projectListClick();					
		});
		return false;
	});

	$(".menu_item a, .open_nav_btns a").click(function(){
		var nameOfPage = $(this).data("page");
		if(nameOfPage){
			$("body").attr("id",nameOfPage);
		}
	});
});

function loadMainPage()
{
	$.get('/ajax/get_main_page_content', {}, function(data)
	{		
		 $("div#content_inner").html(data);
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



