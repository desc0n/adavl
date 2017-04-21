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
    });


    $("ul#menu>li>a, ul#portfolioMenu>li>a, div.open_nav_btns>a").click(function(){
        $("body").removeClass("openNav");
        $(".m_navigation").removeClass("in");
        var page = $(this).data('page');
        var param = $(this).data('param');
            loadPage(page, param);



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
                    $("div#content_inner").html(data);
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

    $("body").on('click', 'a.project-link', function(){
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
        );

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

        if ($(window).width() > 767) {
            if(!$(this).parent('.portfolio-menu-item').length) {
                $('.sub-menu').animate({left:'-200px'}, 1000);
            } else {
                $('.sub-menu').animate({left:'200px'}, 1000);
            }
        }
    });
});

function loadPage(page, param)
{
    var path = '/ajax/get_page_content?page=' + page + '&param=' + param;
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

    global_images = 0;
    $("div#preloader").fadeIn("fast", function(){
        $.get(path, {}, function(data){
            $("div#content_inner").html(data);

            if ($("div#content_inner img").length) {
                $("div#content_inner img").one('load', function () {
                    global_images++;
                    if (global_images >= $("div#content_inner img").length) {
                        initContentResize();

                        if (isContacts) {
                        }
                        $("div#preloader").fadeOut();
                    }

                }).each(function () {
                    if (this.complete) $(this).load();

                });
            } else {
                $("div#preloader").fadeOut();
            }
        });
    });
    return false;
}