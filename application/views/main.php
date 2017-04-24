<?php
/** @var $portfolioModel Model_Portfolio */
$portfolioModel = Model::factory('Portfolio');
?>
<div id="carousel" class="owl-carousel lt_gray" data-cycle-fx=carousel data-cycle-swipe=true data-cycle-timeout=0 data-cycle-carousel-visible=2 data-cycle-carousel-fluid=true>
    <div class="cycle-next"></div>
    <?foreach ($projectList as $projectPair) {?>
        <article class="content_item">

                <?foreach ($projectPair as $item) {?>
            <div class="content_item_inner2 project-item">
                <a class="project-link" href="#!project<?=$item['id'];?>" data-id="<?=$item['id'];?>">
                    <span class="mediaHolder" style="height: 100%;">
                        <img src="<?=($portfolioModel->findMainItemImg($item['id']) !== null ? $portfolioModel->findMainItemImg($item['id']) : '/public/images/logo.png');?>" alt="" style="opacity: 1;">
                        <span class="mediaCaption">
                            <span><?=$item['title'];?></span>
                        </span>
                    </span>
                </a>
            </div>
                <?}?>

        </article>
    <?}?>
</div>
<script>
    ga('send', 'pageview', {
        'page': '/?_escaped_fragment_=main',
        'title': 'Главная'
    });
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    yaCounter44179814.hit('#!main', {
        title: 'Главная'
    });
</script>
<noscript><div></div></noscript>
<!-- /Yandex.Metrika counter -->