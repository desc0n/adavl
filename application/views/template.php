<!DOCTYPE html>
<html lang="ru">
<head>
    <title>ADVL</title>
    <meta name = "format-detection" content = "telephone=no" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta charset="utf-8" />
    <link rel="icon" href="/public/images/logo.png" sizes="38x38" type="image/png">
    <link rel="stylesheet" type="text/css" media="screen" href="/public/css/style.css?v=7" />
    <link rel="stylesheet" type="text/css" media="screen" href="/public/css/responsive.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/public/css/others.css" />
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/jquery.easing.1.3.js"></script>
    <script src="/public/js/jquery.popupWindow.js"></script>
    <script src="/public/js/jquery.tinycarousel.js"></script>
    <script src="/public/js/jquery.thumbnailScroller.js"></script>
    <script src="/public/js/jquery.hflex.js"></script>
    <script src="/public/js/jquery.mousewheel.js"></script>
    <script src="/public/js/jquery.touchwipe.js"></script>
    <script src="/public/js/imagesloaded.pkgd.js"></script>
    <script src="/public/js/scrollingCarousel.js"></script>
    <script src="/public/js/jquery.cycle2.js"></script>
    <script src="/public/js/jquery.cycle2.carousel.js"></script>
    <script src="/public/js/jquery.cycle2.swipe.js"></script>
    <script src="/public/js/jquery.preloader.js"></script>
    <script src="/public/js/main.js?v=7"></script>
    <script src="/public/js/extra.js"></script>
 </head>
<body id="home_page">

<div class="spinner">
    <div class="p_abs spinner_logo">
<!--        <img class="spinner_img1" src="/public/images/spinner_logo1.png" alt="">-->
<!--        <img class="spinner_img2" src="/public/images/spinner_logo2.png" alt="">-->
    </div>
    <div class="timeline"></div>
</div>

<div class="global_wrap">
    <div class="open_nav_btns">
        <a href="#" data-page="contacts">Контакты</a>
        <a href="#" data-page="main">Портфолио</a>
    </div>
    <nav class="m_navigation">
        <div class="nav_inner">
            <div class="wrapper reg nav_top">
                <!-- Logo -->
                <div class="f_left logo"><a id="main-logo-id" href="/">ADAVL</a></div>
            </div>
            <ul class="reg menu" id="menu">
                <li class="menu_item portfolio-menu-item"><a href="#!main" data-page="main">Портфолио</a></li>
                <li class="menu_item"><a href="#!services" data-page="services">Услуги</a></li>
                <li class="menu_item"><a href="#!activity" data-page="activity">Наша деятельность</a></li>
                <li class="menu_item"><a href="#!contacts" data-page="contacts">Контакты</a></li>
            </ul>
        </div>
    </nav>

    <nav class="sub-menu">
        <div class="nav_inner">
            <ul class="flex-menu" id="portfolioMenu">
                <?foreach ($portfolioCategories as $id => $name) {?>
                <li><a href="#" data-page="portfolio_category" data-param="<?=$id;?>"><?=$name;?></a></li>
                <?}?>
            </ul>
        </div>
    </nav>

    <section id="content">
        <div id="preloader" style="opacity: 1; display: none;">
            <div class="windows8">
                <div class="wBall" id="wBall_1">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_2">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_3">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_4">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_5">
                    <div class="wInnerBall">
                    </div>
                </div>
            </div>
        </div>
        <div id="content_inner">

        </div>
    </section>
    <div class="p_abs nav_bottom">
        <!-- Social block -->
        <div class="wrapper social_icons">
            <a href="<?=Arr::get($googlePlusNetwork, 'value', '#');?>" class="soc_icon" id="gshare"><img src="/public/images/soc1.jpg" alt=""></a>
            <a href="<?=Arr::get($twitterNetwork, 'value', '#');?>" class="soc_icon" id="tshare"><img src="/public/images/soc2.jpg" alt=""></a>
            <a href="<?=Arr::get($facebookNetwork, 'value', '#');?>" class="soc_icon" id="fbshare"><img src="/public/images/soc3.jpg" alt=""></a>
        </div>
        <!-- End of social block -->
        <div class="created_by">

        </div>
    </div>
</div>
<script>
    $(window).load(function () {
        loadPage('main', null);
    });
</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-97326796-1', 'auto');
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter44179814 = new Ya.Metrika({
                    id:44179814,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
