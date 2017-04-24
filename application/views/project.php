<?php
/** @var $portfolioModel Model_Portfolio */
$portfolioModel = Model::factory('Portfolio');
?>
<div id="slider" class="flexslider">
    <ul class="slides">
        <li class="slideshow_banner">
            <div class="slideshow_banner_inner">
                <h1 class="title1 slide_caption">
                    <?=Arr::get($projectData, 'title');?>
                </h1>
                <p class="p2">&nbsp;</p>
                <ul class="slide_list">
                    <?=Arr::get($projectData, 'description');?>
                </ul>
            </div>
        </li>
        <?foreach ($portfolioModel->findImgsByItemId(Arr::get($projectData, 'id')) as $img) {?>
        <?$srcType = !isset($srcType) ? 'src' : 'data-original';?>
        <li><img <?=$srcType;?>="/public/img/original/<?=$img['src'];?>" alt=""></li>
        <?}?>
    </ul>
</div>
<script>
    ga('send', 'pageview', {
        'page': '/?_escaped_fragment_=project',
        'title': 'Проекты'
    });
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    yaCounter44179814.hit('#!project', {
        title: 'Проекты',
        referer: 'http://adavl.ru/#!main'
    });
</script>
<noscript><div></div></noscript>
<!-- /Yandex.Metrika counter -->