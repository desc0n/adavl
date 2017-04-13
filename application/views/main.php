<?php
/** @var $portfolioModel Model_Portfolio */
$portfolioModel = Model::factory('Portfolio');
?>
<div id="carousel" class="owl-carousel lt_gray" data-cycle-fx=carousel data-cycle-swipe=true data-cycle-timeout=0 data-cycle-carousel-visible=2 data-cycle-carousel-fluid=true>
    <div class="cycle-next"></div>
    <?foreach ($projectList as $projectPair) {?>
        <article class="content_item">

                <?foreach ($projectPair as $item) {?>
            <div class="content_item_inner2 project-item" style="height: 50%;">
                <a class="project-link" href="#!project<?=$item['id'];?>" data-id="<?=$item['id'];?>">
                    <span class="mediaHolder" style="height: 100%;">
                        <img src="<?=($portfolioModel->findMainItemImg($item['id']) !== null ? $portfolioModel->findMainItemImg($item['id']) : '/public/images/logo.png');?>" alt="" style="opacity: 1; height: 100%;">
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
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-97326796-1', 'auto');
    ga('send', 'pageview');

</script>