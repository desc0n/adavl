<?php
/** @var Model_Content $contentModel */
$contentModel = Model::factory('Content');
?>
<div id="carousel" class="owl-carousel lt_gray" data-cycle-fx=carousel data-cycle-swipe=true data-cycle-timeout=0 data-cycle-carousel-visible=2 data-cycle-carousel-fluid=true>
    <div class="cycle-next"></div>
    <article class="content_item">
        <div class="content_item_inner2">
            <h1 class="title1 ind1 lt_gray">
                <?=Arr::get($pageData, 'title', '');?>
            </h1>
            <div>
                <?=Arr::get($pageData, 'content', '');?>
            </div>
        </div>
    </article>
    <article class="content_item">
        <img class="contactImage" src="/public/images/activity_img.jpg"/>
    </article>
</div>
<script>
    ga('send', 'pageview', {
        'page': '/?_escaped_fragment_=activity',
        'title': 'Наша деятельность'
    });

</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    yaCounter44179814.hit('#!activity', {
        title: 'Наша деятельность',
        referer: 'http://adavl.ru/#!main'
    });
</script>
<noscript><div></div></noscript>
<!-- /Yandex.Metrika counter -->