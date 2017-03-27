<?php
/** @var $portfolioModel Model_Portfolio */
$portfolioModel = Model::factory('Portfolio');
?>
<ul class="langWay clearfix" id="js_main_project_list" style="height: 664px;">
    <?foreach ($projectList as $projectPair) {?>
    <li style="width: 332px;">
        <?foreach ($projectPair as $item) {?>
        <a href="#">
            <span class="mediaHolder" style="height: 332px;">
                <img src="<?=($portfolioModel->findMainItemImg($item['id']) !== null ? $portfolioModel->findMainItemImg($item['id']) : '/public/images/logo.png');?>" alt="" style="opacity: 1; height: 334px;">
                <span class="mediaCaption">
                    <span><?=$item['title'];?></span>
                </span>
            </span>
        </a>
        <?}?>
    </li>
    <?}?>
</ul>