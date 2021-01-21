<?php if (!$label_hidden) : ?>
<div class="field-label"<?php print $title_attributes; ?>><?php print $label ?>:&nbsp;</div>
<?php endif; ?>

<?php
// Reduce number of images in teaser view mode to single image
if ($element['#view_mode'] == 'teaser') : ?>
<div class="field-item field-type-image even clearfix"<?php print $item_attributes[0]; ?>><div class="overlayed-teaser"><?php print render($items[0]); ?></div></div> 
<?php return; endif; ?>

<?php $node=$element['#object']; $lang="und"; ?>

<?php $numberOfImages=0; foreach ($node->field_image[$lang] as $key=>$file) { $numberOfImages++; } ?>

<div class="images-container clearfix">
<?php if ($numberOfImages>1) { ?>  

    <!-- #image-slider -->
    <div id="image-slider" class="flexslider">
        <ul class="slides">
            <?php $i=0; foreach ($node->field_image[$lang] as $key=>$file) { $i++; ?>
            <li>
                <a class="image-popup overlayed" href="<?php print file_create_url($node->field_image[$lang][$key]['uri']); ?>" title="<?php print $node->field_image[$lang][$key]['title']; ?>">
                <img src="<?php print image_style_url('large', $node->field_image[$lang][$key]['uri']); ?>" alt="<?php print $node->field_image[$lang][$key]['alt']; ?>" title="<?php print $node->field_image[$lang][$key]['title']; ?>"/>
                 <span class="overlay"><i class="fa fa-search-plus"></i></span>
                </a>
            </li>
            <?php } ?> 
        </ul>
    </div> 
    <!-- EOF:#image-slider -->

    <!-- #image-slider-carousel -->
    <div id="image-slider-carousel" class="flexslider">
        <ul class="slides">
            <?php $i=0; foreach ($node->field_image[$lang] as $key=>$file) { $i++; ?>
            <li><img src="<?php print image_style_url('mt_thumbnails', $node->field_image[$lang][$key]['uri']); ?>" alt="<?php print $node->field_image[$lang][$key]['alt']; ?>" title="<?php print $node->field_image[$lang][$key]['title']; ?>"/></li>
            <?php } ?> 
        </ul>
    </div>    
    <!-- EOF:#image-slider-carousel --> 

<?php } else { ?>

<div class="image-preview clearfix">
    <a class="image-popup overlayed" href="<?php print file_create_url($node->field_image[$lang][0]['uri']); ?>" title="<?php print $node->field_image[$lang][0]['title']; ?>">
    <img src="<?php print image_style_url('large', $node->field_image[$lang][0]['uri']); ?>" alt="<?php print $node->field_image[$lang][0]['alt']; ?>" title="<?php print $node->field_image[$lang][0]['title']; ?>"/>
    <span class="overlay"><i class="fa fa-search-plus"></i></span>
    </a>
</div>

<?php } ?>
</div>
<?php
drupal_add_js(drupal_get_path('theme', 'listingplus') .'/js/magnific-popup/jquery.magnific-popup.js', array('preprocess' => false));
drupal_add_css(drupal_get_path('theme', 'listingplus') . '/js/magnific-popup/magnific-popup.css');

drupal_add_js('
    jQuery(document).ready(function($) {
        $(window).load(function() {

			$(".image-popup").magnificPopup({
			type:"image",
			removalDelay: 300,
			mainClass: "mfp-fade",
			gallery: {
			enabled: true, // set to true to enable gallery
			}
			});

        });
    });',array('type' => 'inline', 'scope' => 'footer', 'weight' => 3)
);

$image_slider_effect=theme_get_setting('image_slider_effect');
if ($numberOfImages>1) {
drupal_add_js('
    jQuery(document).ready(function($) {
        // store the slider in a local variable
        var $window = $(window),
        flexslider;

        // tiny helper function to add breakpoints
        function getGridSize() {
        return (window.innerWidth < 768) ? 4 : 9;
        }

        $(window).load(function() {
        
        $("#image-slider").fadeIn("slow");
        $("#image-slider-carousel").fadeIn("slow");

        // The slider being synced must be initialized first
        $("#image-slider-carousel").flexslider({
        animation: "slide",
        controlNav: false,
        directionNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 77,
        itemMargin: 5,
        prevText: "",           
        nextText: "",
        asNavFor: "#image-slider",
        minItems: getGridSize(), // use function to pull in initial value
        maxItems: getGridSize(), // use function to pull in initial value
        start: function(slider){
        flexslider = slider;
        }        
        });

        $("#image-slider").flexslider({
        useCSS: false,            
        animation: "'.$image_slider_effect.'",
        controlNav: false,
        directionNav: true,
        prevText: "",
        nextText: "",
        animationLoop: false,
        slideshow: false,
        sync: "#image-slider-carousel"
        });
        
        });

        // check grid size on resize event
        $window.resize(function() {
        var gridSize = getGridSize();
        flexslider.vars.minItems = gridSize;
        flexslider.vars.maxItems = gridSize;
        });
    });',array('type' => 'inline', 'scope' => 'footer', 'weight' => 5));
}
?>