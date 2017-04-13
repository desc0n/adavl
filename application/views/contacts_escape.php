<!DOCTYPE html>
<html lang="ru">
<head>
    <title>ADVL. Контакты.</title>
    <meta name = "format-detection" content = "telephone=no" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta charset="utf-8" />
    <link rel="icon" href="/public/images/logo.png" sizes="38x38" type="image/png">
    <link rel="stylesheet" type="text/css" media="screen" href="/public/css/style.css?v=5" />
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
    <script src="/public/js/main.js?v=5"></script>
    <script src="/public/js/extra.js"></script>
 </head>
<?php
/** @var Model_Content $contentModel */
$contentModel = Model::factory('Content');
?>
<body id="home_page">
<div class="spinner">
    <div class="p_abs spinner_logo">
    </div>
    <div class="timeline"></div>
</div>

<div class="global_wrap">
    <div class="open_nav_btns">
        <a href="#">Контакты</a>
        <a href="#">Портфолио</a>
    </div>

    <nav class="m_navigation">
        <div class="nav_inner">
            <div class="wrapper reg nav_top">
                <!-- Logo -->
                <div class="f_left logo"><a id="main-logo-id" href="/">ADAVL</a></div>
            </div>
            <ul class="reg menu" id="menu">
                <li class="menu_item portfolio-menu-item"><a href="#" >Портфолио</a></li>
                <li class="menu_item"><a href="#">Услуги</a></li>
                <li class="menu_item"><a href="#">Наша деятельность</a></li>
                <li class="menu_item"><a href="#">Контакты</a></li>
            </ul>
        </div>
    </nav>

    <nav class="sub-menu">
        <div class="nav_inner">
            <ul class="flex-menu" id="portfolioMenu">
                <?foreach ($portfolioCategories as $id => $name) {?>
                <li><a href="#"><?=$name;?></a></li>
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
            <div id="carousel" class="owl-carousel lt_gray" data-cycle-fx=carousel data-cycle-swipe=true data-cycle-timeout=0 data-cycle-carousel-visible=2 data-cycle-carousel-fluid=true>
                <div class="cycle-next"></div>
                <article class="content_item">
                    <div class="content_item_inner2">
                        <h1 class="title1 ind1 lt_gray">
                            Адрес
                        </h1>
                        <ul class="address_list">
                            <li class="wrapper">
                                <div class="label">
                                    Адрес:&nbsp;
                                </div>
                                <div class="address_description">
                                    <?foreach ($contentModel->getContacts(['address']) as $contact){?>
                                        <div><?=$contact['value'];?></div>
                                    <?}?>
                                </div>
                            </li>
                            <li class="wrapper">
                                <div class="label">
                                    Телефоны:&nbsp;
                                </div>
                                <div class="address_description">
                                    <?foreach ($contentModel->getContacts(['phone']) as $contact){?>
                                        <div><a href="callto:+<?=preg_replace('/[\D]+/','', $contact['value']);?>" ><?=$contact['value'];?></a></div>
                                    <?}?>
                                </div>
                            </li>

                            <li class="wrapper">
                                <div class="label">
                                    Email:&nbsp;
                                </div>
                                <div class="address_description">
                                    <?foreach ($contentModel->getContacts(['email']) as $contact){?>
                                        <div><a href="mailto:<?=$contact['value'];?>" class="link1"><?=$contact['value'];?></a></div>
                                    <?}?>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="p_abs content_img">
                        <div class="map_wrapper">
                            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A09be7e7ddd6410e14576d7374d5b742b4104b0138377ecc28bf6836132ba8526&width=550&height=400&lang=ru_RU&scroll=true"></script>
                        </div>
                    </div>
                </article>
                <article class="content_item">
                    <img class="contactImage" src="/public/images/contact_img.jpg"/></article>
            </div>
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
</body>
</html>
