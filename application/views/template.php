
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>ADVL</title>
    <meta name = "format-detection" content = "telephone=no" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta charset="utf-8" />


    <link rel="icon" href="/public/images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/public/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" media="screen" href="/public/css/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/public/css/responsive.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/public/css/others.css" />
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/jquery.easing.1.3.js"></script>
    <script src="/public/js/jquery.popupWindow.js"></script>
    <script src="/public/js/jquery.tinycarousel.js"></script>
    <script src="/public/js/jquery.thumbnailScroller.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script src="/public/bitrix/templates/adm/components/bitrix/map.google.view/g_map/script.js"></script>
    <script src="/public/js/jquery.hflex.js"></script>
    <script src="/public/js/jquery.mousewheel.js"></script>
    <script src="/public/js/jquery.touchwipe.js"></script>
    <script src="/public/js/imagesloaded.pkgd.js"></script>
    <script src="/public/js/scrollingCarousel.js"></script>
    <script src="/public/js/jquery.cycle2.js"></script>
    <script src="/public/js/jquery.cycle2.carousel.js"></script>
    <script src="/public/js/jquery.cycle2.swipe.js"></script>
    <script src="/public/js/jquery.preloader.js"></script>
    <script src="/public/js/main.js"></script>

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
        <a href="#" id="show_menu">Меню</a>
        <a href="/public/master/?ajax=Y" id="about_btn" data-page="about_page">Мастерская</a>
        <a href="/public/gallery_structure/?ajax=Y" data-page="projects" id="nbgallery">Портфолио</a>
    </div>

    <nav class="m_navigation">
        <div class="nav_inner">
            <div class="wrapper reg nav_top">
                <!-- Logo -->
                <div class="f_left logo"><a id="main-logo-id" href="/">ADAVL</a></div>
            </div>
            <ul class="reg menu" id="menu">
                <li class="menu_item"><a href="#">Портфолио</a></li>
                <li class="menu_item"><a href="#">Услуги</a></li>
                <li class="menu_item"><a href="#">Наша деятельность</a></li>
                <li class="menu_item"><a href="#">Контакты</a></li>
            </ul>
        </div>
    </nav>

    <nav class="sub-menu">
        <div class="nav_inner">
            <ul class="flex-menu">
                <li><a href="#">архитектура</a></li>
                <li><a href="#">дизайн</a></li>
                <li><a href="#">визуализация</a></li>
                <li><a href="#">3d моделинг</a></li>
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
            <ul class="langWay clearfix" id="js_main_project_list" style="height: 664px;">
                <li style="width: 332px;">
                    <a href="#">
                        <span class="mediaHolder" style="height: 332px;">
                            <img src="/public/img/thumb/dfd9948f3bcb7418f20a1fc044711d97.jpg" alt="" style="opacity: 1; height: 334px;">
                            <span class="mediaCaption">
                                <span>Проект1</span>
                            </span>
                        </span>
                    </a>
                    <a href="#">
                        <span class="mediaHolder" style="height: 332px;">
                            <img src="/public/img/thumb/0d7a2c81010e0bd1aef16cf077a03136.jpg" alt="" style="opacity: 1; height: 334px;">
                            <span class="mediaCaption">
                                <span>Проект2</span>
                            </span>
                        </span>
                    </a>
                </li>
                <li style="width: 332px;">
                    <a href="#">
                        <span class="mediaHolder" style="height: 332px;">
                            <img src="/public/img/thumb/4a516ef6f97cebe2b0bc74a7bc83f86b.jpg" alt="" style="opacity: 1; height: 334px;">
                            <span class="mediaCaption">
                                <span>Проект3</span>
                            </span>
                        </span>
                    </a>
                    <a href="#">
                        <span class="mediaHolder" style="height: 332px;">
                            <img src="/public/img/thumb/f68d58ea1e0bf147376e63542e70e315.jpg" alt="" style="opacity: 1; height: 334px;">
                            <span class="mediaCaption">
                                <span>Проект4</span>
                            </span>
                        </span>
                    </a>
                </li>
                <li style="width: 332px;">
                    <a href="#">
                        <span class="mediaHolder" style="height: 332px;">
                            <img src="/public/img/thumb/027540eec9e6984d633be0cb9b9420bb.jpg" alt="" style="opacity: 1; height: 334px;">
                            <span class="mediaCaption">
                                <span>Проект5</span>
                            </span>
                        </span>
                    </a>
                    <a href="#">
                        <span class="mediaHolder" style="height: 332px;">
                            <img src="/public/img/thumb/64339f9f1dbe40f091532966b4c1f759.jpg" alt="" style="opacity: 1; height: 334px;">
                            <span class="mediaCaption">
                                <span>Проект6</span>
                            </span>
                        </span>
                    </a>
                </li>
                <li style="width: 332px;">
                    <a href="#">
                        <span class="mediaHolder" style="height: 332px;">
                            <img src="/public/img/thumb/abe2ea2a8e3bb68655cefac3649879bc.jpg" alt="" style="opacity: 1; height: 334px;">
                            <span class="mediaCaption">
                                <span>Проект7</span>
                            </span>
                        </span>
                    </a>
                    <a href="#">
                        <span class="mediaHolder" style="height: 332px;">
                            <img src="/public/img/thumb/113bd7a5f7015dcfbba48fc7184ea054.jpg" alt="" style="opacity: 1; height: 334px;">
                            <span class="mediaCaption">
                                <span>Проект8</span>
                            </span>
                        </span>
                    </a>
                </li>
                <li style="width: 332px;">
                    <a href="#">
                        <span class="mediaHolder" style="height: 332px;">
                            <img src="/public/img/thumb/caf25c264c70222634ab66e3079efb2d.jpg" alt="" style="opacity: 1; height: 334px;">
                            <span class="mediaCaption">
                                <span>Проект9</span>
                            </span>
                        </span>
                    </a>
                    <a href="#">
                        <span class="mediaHolder" style="height: 332px;">
                            <img src="/public/img/thumb/58b7e2f9e78178a3988b640b63f5f629.jpg" alt="" style="opacity: 1; height: 334px;">
                            <span class="mediaCaption">
                                <span>Проект10</span>
                            </span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <div class="p_abs nav_bottom">
        <!-- Social block -->
        <div class="wrapper social_icons">
            <a href="https://plus.google.com" class="soc_icon" id="gshare"><img src="/public/images/soc1.jpg" alt=""></a>
            <a href="http://twitter.com" class="soc_icon" id="tshare"><img src="/public/images/soc2.jpg" alt=""></a>
            <a href="http://www.facebook.com" class="soc_icon" id="fbshare"><img src="/public/images/soc3.jpg" alt=""></a>
            <a href="http://www.linkedin.com" class="soc_icon" id="linshare"><img src="/public/images/soc4.jpg" alt=""></a>

        </div>
        <!-- End of social block -->
        <div class="created_by">

        </div>
    </div>
</div>
</body>
</html>
