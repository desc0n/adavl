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
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-97326796-1', 'auto');
    ga('send', 'pageview');

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
<noscript><div><img src="https://mc.yandex.ru/watch/44179814" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->