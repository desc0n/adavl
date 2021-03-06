<?php
/** @var Model_Content $contentModel */
$contentModel = Model::factory('Content');
?>
<div id="carousel" class="owl-carousel lt_gray" data-cycle-fx=carousel data-cycle-swipe=true data-cycle-timeout=0 data-cycle-carousel-visible=2 data-cycle-carousel-fluid=true>
    <div class="cycle-next"></div>
    <article class="content_item">
        <div class="content_item_inner2">
            <h1 class="title1 ind1 lt_gray">
                Контактные данные
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
<script>
    ga('send', 'pageview', {
        'page': '/?_escaped_fragment_=contacts',
            'title': 'Контакты'
    });
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    yaCounter44179814.hit('#!contacts', {
        title: 'Контакты',
        referer: 'http://adavl.ru/#!main'
    });
</script>
<noscript><div></div></noscript>
<!-- /Yandex.Metrika counter -->