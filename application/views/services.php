
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
    ga('send', 'pageview', {
        'page': '/?_escaped_fragment_=services',
        'title': 'Услуги'
    });

</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    yaCounter44179814.hit('#!services', {
        title: 'Услуги',
        referer: 'http://adavl.ru/#!main'
    });
</script>
<noscript>
    <div>
    </div>
</noscript>
<!-- /Yandex.Metrika counter -->