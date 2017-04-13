
<div id="carousel" class="owl-carousel lt_gray" data-cycle-fx=carousel data-cycle-swipe=true data-cycle-timeout=0 data-cycle-carousel-visible=2 data-cycle-carousel-fluid=true>
    <div class="cycle-next"></div>
    <?foreach ($servicesList as $service) {?>
    <article class="content_item">
        <div class="content_item_inner2">
            <h1 class="title1 ind1 lt_gray">
                <?=$service['title'];?>
            </h1>
            <div>
                <?=$service['description'];?>
            </div>

            <div>
                <br />
            </div>

            <div>
                <br />
            </div>

        </div>
        <div class="p_abs content_img">
            <figure>
                <?if (is_file('public/img/services/' . $service['id'] . '.jpg')) {?>
                <img src="/public/img/services/<?=$service['id'];?>.jpg?v=<?=time();?>" alt="">
                <?}?>
            </figure>
        </div>
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