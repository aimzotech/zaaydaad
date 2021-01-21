<div class="container boxed-slideshow">
    <div id="slideshow" class="bannercontainer main-slider">
        <?php $rs_boxed_effect=theme_get_setting('rs_slideshow_boxed_effect'); ?>
        <div class="banner">
            <ul>
            <?php foreach ($rows as $id => $row) { ?>
            
                <?php $view = views_get_current_view();
                $nid = $view->result[$id]->nid; 
                $node = node_load($nid);
                $lang = 'und';
                $nodeurl =  url('node/'. $node->nid);

                $image = image_style_url('mt_slideshow_boxed', $node->field_mt_teaser_image[$lang][0]['uri']); 
                $title = $node->field_mt_teaser_image[$lang][0]['title'];
                $alt = $node->field_mt_teaser_image[$lang][0]['alt'];
                
                if ($node->type=='mt_slideshow_entry') {  ?>
                    <?php if ($node->field_mt_slideshow_entry_path) { ?>
                    <?php $path = $node->field_mt_slideshow_entry_path[$lang][0]['value']; ?>
                    <li data-link="<?php print url($path); ?>" data-transition="<?php print $rs_boxed_effect ?>" data-masterspeed="800">
                    <?php } else { ?>
                    <li data-transition="<?php print $rs_boxed_effect ?>" data-masterspeed="800">
                    <?php } ?>

                        <img src="<?php print $image; ?>" title="<?php print $title; ?>" alt="<?php print $alt; ?>"/>

                        <div class="tp-caption sft fadeout"
                        data-x="left"
                        data-y="top"
                        data-speed="500"
                        data-start="1200"
                        data-voffset="50"
                        data-easing="Power0.easeIn">
                            <div class="title">
                                <?php $title = $node->title; ?>
                                <?php if ($node->field_mt_slideshow_entry_path) { ?>
                                <?php $path = $node->field_mt_slideshow_entry_path[$lang][0]['value']; ?>
                                <a href="<?php print url($path); ?>"><?php print $title; ?></a>
                                <?php } else { ?>
                                <span>
                                <?php print $title; ?>
                                </span>
                                <?php } ?>
                            </div>
                        </div>
                    </li>
                <?php } else { ?>
                    <li data-transition="<?php print $rs_boxed_effect ?>" data-link="<?php print $nodeurl ?>" data-masterspeed="800">
                        <?php print $row; ?>
                    </li>
                <?php } ?> 

            <?php } ?>
            </ul>
            <div class="tp-bannertimer tp-bottom"></div>
        </div>
    </div>
</div>
<?php
$rs_boxed_effect_time = (int) theme_get_setting('rs_slideshow_boxed_effect_time')*1000;

if (theme_get_setting('rs_slideshow_boxed_preview')) {
    $rs_directional_preview = "preview1";
} else {
    $rs_directional_preview = "square";
}


drupal_add_js('

    var tpj=jQuery;
    tpj.noConflict();
    
    tpj(document).ready(function($) { 

    if (tpj.fn.cssOriginal!=undefined)
        tpj.fn.css = tpj.fn.cssOriginal;

    
    var api = tpj(".bannercontainer .banner").revolution({
        delay:"'.$rs_boxed_effect_time.'",
        startheight: 450,
        startwidth: 1140,
        onHoverStop: "off",
        navigationStyle: "'.$rs_directional_preview.'"
    });
    
    api.bind("revolution.slide.onloaded",function (e,data) {
         jQuery(".tparrows.default").css("display", "block");
         jQuery(".tp-bullets").css("display", "block");
         jQuery(".tp-bannertimer").css("display", "block");
    });

});',
array('type' => 'inline', 'scope' => 'header'));
	
?>