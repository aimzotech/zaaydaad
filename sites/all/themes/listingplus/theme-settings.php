<?php
/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function listingplus_form_system_theme_settings_alter(&$form, &$form_state) {

  $form['mtt_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('MtT Theme Settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );

  $form['mtt_settings']['tabs'] = array(
    '#type' => 'vertical_tabs',
    '#attached' => array(
      'css' => array(drupal_get_path('theme', 'listingplus') . '/listingplus.settings.form.css'),
    ),
  );
  
  $form['mtt_settings']['tabs']['basic_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Basic Settings'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  
  $form['mtt_settings']['tabs']['basic_settings']['breadcrumb'] = array(
    '#type' => 'item',
    '#markup' => t('<div class="theme-settings-title">Breadcrumb</div>'),
  );

  $form['mtt_settings']['tabs']['basic_settings']['breadcrumb_display'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show breadcrumb'),
    '#description'   => t('Use the checkbox to enable or disable Breadcrumb.'),
    '#default_value' => theme_get_setting('breadcrumb_display', 'listingplus'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['basic_settings']['breadcrumb_separator'] = array(
    '#type' => 'textfield',
    '#title' => t('Breadcrumb separator'),
    '#default_value' => theme_get_setting('breadcrumb_separator','listingplus'),
    '#size'          => 5,
    '#maxlength'     => 10,
  );

  $form['mtt_settings']['tabs']['basic_settings']['header'] = array(
   '#type' => 'item',
   '#markup' => t('<div class="theme-settings-title">Header positioning</div>'),
  );
  
  $form['mtt_settings']['tabs']['basic_settings']['fixed_header'] = array(
    '#type' => 'checkbox',
    '#title' => t('Fixed position'),
    '#description'   => t('Use the checkbox to apply fixed position to the header.'),
    '#default_value' => theme_get_setting('fixed_header', 'listingplus'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ); 

  $form['mtt_settings']['tabs']['basic_settings']['scrolltop'] = array(
    '#type' => 'item',
    '#markup' => t('<div class="theme-settings-title">Scroll to top</div>'),
  );
  
  $form['mtt_settings']['tabs']['basic_settings']['scrolltop_display'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show scroll-to-top button'),
    '#description'   => t('Use the checkbox to enable or disable scroll-to-top button.'),
    '#default_value' => theme_get_setting('scrolltop_display', 'listingplus'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  
  $form['mtt_settings']['tabs']['basic_settings']['frontpage_content'] = array(
    '#type' => 'item',
    '#markup' => t('<div class="theme-settings-title">Front Page Behavior</div>'),
  );
  
  $form['mtt_settings']['tabs']['basic_settings']['frontpage_content_print'] = array(
    '#type' => 'checkbox',
    '#title' => t('Drupal frontpage content'),
    '#description'   => t('Use the checkbox to enable or disable the Drupal default frontpage functionality. Enable this to have all the promoted content displayed in the frontpage.'),
    '#default_value' => theme_get_setting('frontpage_content_print', 'listingplus'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );  

  $form['mtt_settings']['tabs']['basic_settings']['bootstrap_js'] = array(
    '#type' => 'item',
    '#markup' => t('<div class="theme-settings-title">Bootstrap 3 Framework Javascript file</div>'),
  );
  
  $form['mtt_settings']['tabs']['basic_settings']['bootstrap_js_include'] = array(
    '#type' => 'checkbox',
    '#title' => t('Include Bootstrap 3 Framework Javascript file'),
    '#description'   => t('Use the checkbox to enable or disable bootstrap.min.js file.'),
    '#default_value' => theme_get_setting('bootstrap_js_include', 'listingplus'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['looknfeel'] = array(
    '#type' => 'fieldset',
    '#title' => t('Look\'n\'Feel'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['looknfeel']['color_schemes'] = array(
      '#type' => 'fieldset',
      '#title' => t('Color Schemes'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
  );
  
  $form['mtt_settings']['tabs']['looknfeel']['color_schemes']['color_scheme'] = array(
    '#type' => 'select',
    '#description'   => t('From the drop-down menu, select the color scheme you prefer.'),
    '#default_value' => theme_get_setting('color_scheme', 'listingplus'),
    '#options' => array(
    'default' => t('Gray Blue'),
    'gray-red' => t('Gray Red'),
    'gray-green' => t('Gray Green / Default'),
    'gray-orange' => t('Gray Orange'),
    'gray-purple' => t('Gray Purple'),
    'gray-pink' => t('Gray Pink'),
    'blue' => t('Blue'),
    'red' => t('Red'),
    'green' => t('Green'),
    'orange' => t('Orange'),
    'purple' => t('Purple'),
    'pink' => t('Pink'),
    'gray' => t('Gray'),
    ),
  );
  
  $form['mtt_settings']['tabs']['layout_modes'] = array(
      '#type' => 'fieldset',
      '#title' => t('Layout'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['layout_modes']['layout_mode'] = array(
    '#type' => 'select',
    '#title' => t('Layout Mode'),
    '#description'   => t('From the drop-down menu, select the layout mode you prefer.'),
    '#default_value' => theme_get_setting('layout_mode', 'listingplus'),
    '#options' => array(
    'wide' => t('Wide'),
    'boxed' => t('Boxed'),
    ),
  );

  $form['mtt_settings']['tabs']['node'] = array(
    '#type' => 'fieldset',
    '#title' => t('Nodes'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['node']['print_button'] = array(
    '#type' => 'checkbox',
    '#title' => t('Post print'),
    '#description'   => t('Use the checkbox to enable or disable the "Print this page" function.'),
    '#default_value' => theme_get_setting('print_button', 'listingplus'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['node']['reading_time'] = array(
    '#type' => 'checkbox',
    '#title' => t('Time to read'),
    '#description'   => t('Use the checkbox to enable or disable the "Time to read" indicator.'),
    '#default_value' => theme_get_setting('reading_time', 'listingplus'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['node']['post_progress'] = array(
    '#type' => 'checkbox',
    '#title' => t('Read so far'),
    '#description'   => t('Use the checkbox to enable or disable the reading progress indicator.'),
    '#default_value' => theme_get_setting('post_progress', 'listingplus'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['font'] = array(
    '#type' => 'fieldset',
    '#title' => t('Font Settings'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  
  $form['mtt_settings']['tabs']['font']['font_title'] = array(
    '#type' => 'item',
    '#markup' => 'For every region pick the <strong>font-family</strong> that corresponds to your needs.',
  );
  
  $form['mtt_settings']['tabs']['font']['sitename_font_family'] = array(
    '#type' => 'select',
    '#title' => t('Site name'),
    '#default_value' => theme_get_setting('sitename_font_family', 'listingplus'),
    '#options' => array(
      'sff-1' => t('Merriweather, Georgia, Times, Serif'),
      'sff-2' => t('Source Sans Pro, Helvetica Neuee, Arial, Sans-serif'),
      'sff-3' => t('Ubuntu, Helvetica Neue, Arial, Sans-serif'),
      'sff-4' => t('PT Sans, Helvetica Neue, Arial, Sans-serif'),
      'sff-5' => t('Roboto, Helvetica Neue, Arial, Sans-serif'),
      'sff-6' => t('Open Sans, Helvetica Neue, Arial, Sans-serif'),
      'sff-7' => t('Lato, Helvetica Neue, Arial, Sans-serif'),
      'sff-8' => t('Roboto Condensed, Arial Narrow, Arial, Sans-serif'),
      'sff-9' => t('Exo, Arial, Helvetica Neue, Sans-serif'),
      'sff-10' => t('Roboto Slab, Trebuchet MS, Sans-serif'),
      'sff-11' => t('Raleway, Helvetica Neue, Arial, Sans-serif'),
      'sff-12' => t('Josefin Sans, Georgia, Times, Serif'),
      'sff-13' => t('Georgia, Times, Serif'),
      'sff-14' => t('Playfair Display, Times, Serif'),
      'sff-15' => t('Philosopher, Georgia, Times, Serif'),
      'sff-16' => t('Cinzel, Georgia, Times, Serif'),               
      'sff-17' => t('Oswald, Helvetica Neue, Arial, Sans-serif'),    
      'sff-18' => t('Playfair Display SC, Georgia, Times, Serif'),
      'sff-19' => t('Cabin, Helvetica Neue, Arial, Sans-serif'),
      'sff-20' => t('Noto Sans, Arial, Helvetica Neue, Sans-serif'),
      'sff-21' => t('Helvetica Neue, Arial, Sans-serif'),
      'sff-22' => t('Droid Serif, Georgia, Times, Times New Roman, Serif'),
      'sff-23' => t('PT Serif, Georgia, Times, Times New Roman, Serif'),
      'sff-24' => t('Vollkorn, Georgia, Times, Times New Roman, Serif'),
      'sff-25' => t('Alegreya, Georgia, Times, Times New Roman, Serif'),
      'sff-26' => t('Noto Serif, Georgia, Times, Times New Roman, Serif'),
      'sff-27' => t('Crimson Text, Georgia, Times, Times New Roman, Serif'),
      'sff-28' => t('Gentium Book Basic, Georgia, Times, Times New Roman, Serif'),
      'sff-29' => t('Volkhov, Georgia, Times, Times New Roman, Serif'),
      'sff-30' => t('Times, Times New Roman, Serif'),
      'sff-31' => t('Alegreya SC, Georgia, Times, Times New Roman, Serif'),
      'sff-32' => t('Montserrat SC, Arial, Helvetica Neue, Sans-serif'),
      'sff-33' => t('Fira Sans, Arial, Helvetica Neue, Sans-serif'),
    ),
  );
  
  $form['mtt_settings']['tabs']['font']['slogan_font_family'] = array(
    '#type' => 'select',
    '#title' => t('Slogan'),
    '#default_value' => theme_get_setting('slogan_font_family', 'listingplus'),
    '#options' => array(
      'slff-1' => t('Merriweather, Georgia, Times, Serif'),
      'slff-2' => t('Source Sans Pro, Helvetica Neuee, Arial, Sans-serif'),
      'slff-3' => t('Ubuntu, Helvetica Neue, Arial, Sans-serif'),
      'slff-4' => t('PT Sans, Helvetica Neue, Arial, Sans-serif'),
      'slff-5' => t('Roboto, Helvetica Neue, Arial, Sans-serif'),
      'slff-6' => t('Open Sans, Helvetica Neue, Arial, Sans-serif'),
      'slff-7' => t('Lato, Helvetica Neue, Arial, Sans-serif'),
      'slff-8' => t('Roboto Condensed, Arial Narrow, Arial, Sans-serif'),
      'slff-9' => t('Exo, Arial, Helvetica Neue, Sans-serif'),
      'slff-10' => t('Roboto Slab, Trebuchet MS, Sans-serif'),
      'slff-11' => t('Raleway, Helvetica Neue, Arial, Sans-serif'),
      'slff-12' => t('Josefin Sans, Georgia, Times, Serif'),
      'slff-13' => t('Georgia, Times, Serif'),
      'slff-14' => t('Playfair Display, Times, Serif'),
      'slff-15' => t('Philosopher, Georgia, Times, Serif'),
      'slff-16' => t('Cinzel, Georgia, Times, Serif'),               
      'slff-17' => t('Oswald, Helvetica Neue, Arial, Sans-serif'),    
      'slff-18' => t('Playfair Display SC, Georgia, Times, Serif'),
      'slff-19' => t('Cabin, Helvetica Neue, Arial, Sans-serif'),
      'slff-20' => t('Noto Sans, Arial, Helvetica Neue, Sans-serif'),
      'slff-21' => t('Helvetica Neue, Arial, Sans-serif'),
      'slff-22' => t('Droid Serif, Georgia, Times, Times New Roman, Serif'),
      'slff-23' => t('PT Serif, Georgia, Times, Times New Roman, Serif'),
      'slff-24' => t('Vollkorn, Georgia, Times, Times New Roman, Serif'),
      'slff-25' => t('Alegreya, Georgia, Times, Times New Roman, Serif'),
      'slff-26' => t('Noto Serif, Georgia, Times, Times New Roman, Serif'),
      'slff-27' => t('Crimson Text, Georgia, Times, Times New Roman, Serif'),
      'slff-28' => t('Gentium Book Basic, Georgia, Times, Times New Roman, Serif'),
      'slff-29' => t('Volkhov, Georgia, Times, Times New Roman, Serif'),
      'slff-30' => t('Times, Times New Roman, Serif'),
      'slff-31' => t('Alegreya SC, Georgia, Times, Times New Roman, Serif'), 
      'slff-32' => t('Montserrat SC, Arial, Helvetica Neue, Sans-serif'),
      'slff-33' => t('Fira Sans, Arial, Helvetica Neue, Sans-serif'),
    ),
  );
  
  $form['mtt_settings']['tabs']['font']['headings_font_family'] = array(
    '#type' => 'select',
    '#title' => t('Headings'),
    '#default_value' => theme_get_setting('headings_font_family', 'listingplus'),
    '#options' => array(
      'hff-1' => t('Merriweather, Georgia, Times, Serif'),
      'hff-2' => t('Source Sans Pro, Helvetica Neuee, Arial, Sans-serif'),
      'hff-3' => t('Ubuntu, Helvetica Neue, Arial, Sans-serif'),
      'hff-4' => t('PT Sans, Helvetica Neue, Arial, Sans-serif'),
      'hff-5' => t('Roboto, Helvetica Neue, Arial, Sans-serif'),
      'hff-6' => t('Open Sans, Helvetica Neue, Arial, Sans-serif'),
      'hff-7' => t('Lato, Helvetica Neue, Arial, Sans-serif'),
      'hff-8' => t('Roboto Condensed, Arial Narrow, Arial, Sans-serif'),
      'hff-9' => t('Exo, Arial, Helvetica Neue, Sans-serif'),
      'hff-10' => t('Roboto Slab, Trebuchet MS, Sans-serif'),
      'hff-11' => t('Raleway, Helvetica Neue, Arial, Sans-serif'),
      'hff-12' => t('Josefin Sans, Georgia, Times, Serif'),
      'hff-13' => t('Georgia, Times, Serif'),
      'hff-14' => t('Playfair Display, Times, Serif'),
      'hff-15' => t('Philosopher, Georgia, Times, Serif'),
      'hff-16' => t('Cinzel, Georgia, Times, Serif'),               
      'hff-17' => t('Oswald, Helvetica Neue, Arial, Sans-serif'),    
      'hff-18' => t('Playfair Display SC, Georgia, Times, Serif'),
      'hff-19' => t('Cabin, Helvetica Neue, Arial, Sans-serif'),
      'hff-20' => t('Noto Sans, Arial, Helvetica Neue, Sans-serif'),
      'hff-21' => t('Helvetica Neue, Arial, Sans-serif'),
      'hff-22' => t('Droid Serif, Georgia, Times, Times New Roman, Serif'),
      'hff-23' => t('PT Serif, Georgia, Times, Times New Roman, Serif'),
      'hff-24' => t('Vollkorn, Georgia, Times, Times New Roman, Serif'),
      'hff-25' => t('Alegreya, Georgia, Times, Times New Roman, Serif'),
      'hff-26' => t('Noto Serif, Georgia, Times, Times New Roman, Serif'),
      'hff-27' => t('Crimson Text, Georgia, Times, Times New Roman, Serif'),
      'hff-28' => t('Gentium Book Basic, Georgia, Times, Times New Roman, Serif'),
      'hff-29' => t('Volkhov, Georgia, Times, Times New Roman, Serif'),
      'hff-30' => t('Times, Times New Roman, Serif'),
      'hff-31' => t('Alegreya SC, Georgia, Times, Times New Roman, Serif'),
      'hff-32' => t('Montserrat SC, Arial, Helvetica Neue, Sans-serif'),
      'hff-33' => t('Fira Sans, Arial, Helvetica Neue, Sans-serif'),      
    ),
  );
  
  $form['mtt_settings']['tabs']['font']['paragraph_font_family'] = array(
    '#type' => 'select',
    '#title' => t('Paragraph'),
    '#default_value' => theme_get_setting('paragraph_font_family', 'listingplus'),
    '#options' => array(
      'pff-1' => t('Merriweather, Georgia, Times, Serif'),
      'pff-2' => t('Source Sans Pro, Helvetica Neuee, Arial, Sans-serif'),
      'pff-3' => t('Ubuntu, Helvetica Neue, Arial, Sans-serif'),
      'pff-4' => t('PT Sans, Helvetica Neue, Arial, Sans-serif'),
      'pff-5' => t('Roboto, Helvetica Neue, Arial, Sans-serif'),
      'pff-6' => t('Open Sans, Helvetica Neue, Arial, Sans-serif'),
      'pff-7' => t('Lato, Helvetica Neue, Arial, Sans-serif'),
      'pff-8' => t('Roboto Condensed, Arial Narrow, Arial, Sans-serif'),
      'pff-9' => t('Exo, Arial, Helvetica Neue, Sans-serif'),
      'pff-10' => t('Roboto Slab, Trebuchet MS, Sans-serif'),
      'pff-11' => t('Raleway, Helvetica Neue, Arial, Sans-serif'),
      'pff-12' => t('Josefin Sans, Georgia, Times, Serif'),
      'pff-13' => t('Georgia, Times, Serif'),
      'pff-14' => t('Playfair Display, Times, Serif'),
      'pff-15' => t('Philosopher, Georgia, Times, Serif'),
      'pff-16' => t('Cinzel, Georgia, Times, Serif'),
      'pff-17' => t('Oswald, Helvetica Neue, Arial, Sans-serif'),    
      'pff-18' => t('Playfair Display SC, Georgia, Times, Serif'),
      'pff-19' => t('Cabin, Helvetica Neue, Arial, Sans-serif'),
      'pff-20' => t('Noto Sans, Arial, Helvetica Neue, Sans-serif'),
      'pff-21' => t('Helvetica Neue, Arial, Sans-serif'),
      'pff-22' => t('Droid Serif, Georgia, Times, Times New Roman, Serif'),
      'pff-23' => t('PT Serif, Georgia, Times, Times New Roman, Serif'),
      'pff-24' => t('Vollkorn, Georgia, Times, Times New Roman, Serif'),
      'pff-25' => t('Alegreya, Georgia, Times, Times New Roman, Serif'),
      'pff-26' => t('Noto Serif, Georgia, Times, Times New Roman, Serif'),
      'pff-27' => t('Crimson Text, Georgia, Times, Times New Roman, Serif'),
      'pff-28' => t('Gentium Book Basic, Georgia, Times, Times New Roman, Serif'),
      'pff-29' => t('Volkhov, Georgia, Times, Times New Roman, Serif'),
      'pff-30' => t('Times, Times New Roman, Serif'),
      'pff-31' => t('Alegreya SC, Georgia, Times, Times New Roman, Serif'),
      'pff-32' => t('Montserrat SC, Arial, Helvetica Neue, Sans-serif'),
      'pff-33' => t('Fira Sans, Arial, Helvetica Neue, Sans-serif'),      
    ),
  );
  
  $form['mtt_settings']['tabs']['slideshow'] = array(
    '#type' => 'fieldset',
    '#title' => t('Slideshows'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['slideshow']['revolution_slider_full'] = array(
      '#type' => 'fieldset',
      '#title' => t('Main Slideshow - Full Width'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['slideshow']['revolution_slider_full']['rs_slideshow_full_effect'] = array(
    '#type' => 'select',
    '#title' => t('Effects'),
    '#description'   => t('From the drop-down menu, select the slideshow effect you prefer.'),
    '#default_value' => theme_get_setting('rs_slideshow_full_effect', 'listingplus'),
    '#options' => array(
    'fade' => t('Fade'),
    'slideup' => t('Slide To Top'),
    'slidedown' => t('Slide To Bottom'),
    'slideright' => t('Slide To Right'),
    'slideleft' => t('Slide To Left'),
    'slidehorizontal' => t('Slide Horizontal'),
    'slidevertical' => t('Slide Vertical'),
    'boxslide' => t('Slide Boxes'),
    'slotslide-horizontal' => t('Slide Slots Horizontal'),
    'slotslide-vertical' => t('Slide Slots Vertical'),
    'boxfade' => t('Fade Boxes'),
    'slotfade-horizontal' => t('Fade Slots Horizontal'),
    'slotfade-vertical' => t('Fade Slots Vertical'),
    'fadefromright' => t('Fade and Slide from Right'),
    'fadefromleft' => t('Fade and Slide from Left'),
    'fadefromtop' => t('Fade and Slide from Top'),
    'fadefrombottom' => t('Fade and Slide from Bottom'),
    'fadetoleftfadefromright' => t('Fade To Left and Fade From Right'),
    'fadetorightfadefromleft' => t('Fade To Right and Fade From Left'),
    'fadetotopfadefrombottom' => t('Fade To Top and Fade From Bottom'),
    'fadetobottomfadefromtop' => t('Fade To Bottom and Fade From Top'),
    'parallaxtoright' => t('Parallax to Right'),
    'parallaxtoleft' => t('Parallax to Left'),
    'parallaxtotop' => t('Parallax to Top'),
    'parallaxtobottom' => t('Parallax to Bottom'),
    'scaledownfromright' => t('Zoom Out and Fade From Right'),
    'scaledownfromleft' => t('Zoom Out and Fade From Left'),
    'scaledownfromtop' => t('Zoom Out and Fade From Top'),
    'scaledownfrombottom' => t('Zoom Out and Fade From Bottom'),
    'zoomout' => t('ZoomOut'),
    'zoomin' => t('ZoomIn'),
    'slotzoom-horizontal' => t('Zoom Slots Horizontal'),
    'slotzoom-vertical' => t('Zoom Slots Vertical'),
    'curtain-1' => t('Curtain from Left'),
    'curtain-2' => t('Curtain from Right'),
    'curtain-3' => t('Curtain from Middle'),
    '3dcurtain-horizontal' => t('3D Curtain Horizontal'),
    '3dcurtain-vertical' => t('3D Curtain Vertical'),
    'cube' => t('Cube Vertical'),
    'cube-horizontal' => t('Cube Horizontal'),
    'incube' => t('In Cube Vertical'),
    'incube-horizontal' => t('In Cube Horizontal'),
    'turnoff' => t('TurnOff Horizontal'),
    'turnoff-vertical' => t('TurnOff Vertical'),
    'papercut' => t('Paper Cut'),
    'flyin' => t('Fly In'),
    'random-static' => t('Random Flat'),
    'random-premium' => t('Random Premium'),    
    'random' => t('Random Flat and Premium/Default'),
    ),
  );

  $form['mtt_settings']['tabs']['slideshow']['revolution_slider_full']['rs_slideshow_full_effect_time'] = array(
    '#type' => 'textfield',
    '#title' => t('Effect duration (sec)'),
    '#default_value' => theme_get_setting('rs_slideshow_full_effect_time', 'listingplus'),
    '#description'   => t('Set the speed of animations, in seconds.'),
  );

  $form['mtt_settings']['tabs']['slideshow']['revolution_slider_full']['rs_slideshow_full_preview'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable/disable the preview of next/previous slide on directional navigation controls.'),
    '#default_value' => theme_get_setting('rs_slideshow_full_preview', 'listingplus'),
  );

  $form['mtt_settings']['tabs']['slideshow']['revolution_slider_boxed'] = array(
      '#type' => 'fieldset',
      '#title' => t('Main Slideshow - Boxed Width'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['slideshow']['revolution_slider_boxed']['rs_slideshow_boxed_effect'] = array(
    '#type' => 'select',
    '#title' => t('Effects'),
    '#description'   => t('From the drop-down menu, select the slideshow effect you prefer.'),
    '#default_value' => theme_get_setting('rs_slideshow_boxed_effect', 'listingplus'),
    '#options' => array(
    'fade' => t('Fade'),
    'slideup' => t('Slide To Top'),
    'slidedown' => t('Slide To Bottom'),
    'slideright' => t('Slide To Right'),
    'slideleft' => t('Slide To Left'),
    'slidehorizontal' => t('Slide Horizontal'),
    'slidevertical' => t('Slide Vertical'),
    'boxslide' => t('Slide Boxes'),
    'slotslide-horizontal' => t('Slide Slots Horizontal'),
    'slotslide-vertical' => t('Slide Slots Vertical'),
    'boxfade' => t('Fade Boxes'),
    'slotfade-horizontal' => t('Fade Slots Horizontal'),
    'slotfade-vertical' => t('Fade Slots Vertical'),
    'fadefromright' => t('Fade and Slide from Right'),
    'fadefromleft' => t('Fade and Slide from Left'),
    'fadefromtop' => t('Fade and Slide from Top'),
    'fadefrombottom' => t('Fade and Slide from Bottom'),
    'fadetoleftfadefromright' => t('Fade To Left and Fade From Right'),
    'fadetorightfadefromleft' => t('Fade To Right and Fade From Left'),
    'fadetotopfadefrombottom' => t('Fade To Top and Fade From Bottom'),
    'fadetobottomfadefromtop' => t('Fade To Bottom and Fade From Top'),
    'parallaxtoright' => t('Parallax to Right'),
    'parallaxtoleft' => t('Parallax to Left'),
    'parallaxtotop' => t('Parallax to Top'),
    'parallaxtobottom' => t('Parallax to Bottom'),
    'scaledownfromright' => t('Zoom Out and Fade From Right'),
    'scaledownfromleft' => t('Zoom Out and Fade From Left'),
    'scaledownfromtop' => t('Zoom Out and Fade From Top'),
    'scaledownfrombottom' => t('Zoom Out and Fade From Bottom'),
    'zoomout' => t('ZoomOut'),
    'zoomin' => t('ZoomIn'),
    'slotzoom-horizontal' => t('Zoom Slots Horizontal'),
    'slotzoom-vertical' => t('Zoom Slots Vertical'),
    'curtain-1' => t('Curtain from Left'),
    'curtain-2' => t('Curtain from Right'),
    'curtain-3' => t('Curtain from Middle'),
    '3dcurtain-horizontal' => t('3D Curtain Horizontal'),
    '3dcurtain-vertical' => t('3D Curtain Vertical'),
    'cube' => t('Cube Vertical'),
    'cube-horizontal' => t('Cube Horizontal'),
    'incube' => t('In Cube Vertical'),
    'incube-horizontal' => t('In Cube Horizontal'),
    'turnoff' => t('TurnOff Horizontal'),
    'turnoff-vertical' => t('TurnOff Vertical'),
    'papercut' => t('Paper Cut'),
    'flyin' => t('Fly In'),
    'random-static' => t('Random Flat'),
    'random-premium' => t('Random Premium'),    
    'random' => t('Random Flat and Premium/Default'),
    ),
  );
  
  $form['mtt_settings']['tabs']['slideshow']['revolution_slider_boxed']['rs_slideshow_boxed_effect_time'] = array(
    '#type' => 'textfield',
    '#title' => t('Effect duration (sec)'),
    '#default_value' => theme_get_setting('rs_slideshow_boxed_effect_time', 'listingplus'),
    '#description'   => t('Set the speed of animations, in seconds.'),
  );

  $form['mtt_settings']['tabs']['slideshow']['revolution_slider_boxed']['rs_slideshow_boxed_preview'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable/disable the preview of next/previous slide on directional navigation controls.'),
    '#default_value' => theme_get_setting('rs_slideshow_boxed_preview', 'listingplus'),
  );

  $form['mtt_settings']['tabs']['slideshow']['testimonial_slideshow'] = array(
    '#type' => 'fieldset',
    '#title' => t('Testimonial Slideshow'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['slideshow']['testimonial_slideshow']['testimonial_slideshow_effect'] = array(
    '#type' => 'select',
    '#title' => t('Effects'),
    '#description'   => t('From the drop-down menu, select the slideshow effect you prefer.'),
    '#default_value' => theme_get_setting('testimonial_slideshow_effect', 'listingplus'),
    '#options' => array(
    'fade' => t('fade'),
    'slide' => t('slide'),
    ),
  );  

  $form['mtt_settings']['tabs']['slideshow']['testimonial_slideshow']['testimonial_slideshow_effect_time'] = array(
    '#type' => 'textfield',
    '#title' => t('Effect duration (sec)'),
    '#default_value' => theme_get_setting('testimonial_slideshow_effect_time', 'listingplus'),
    '#description'   => t('Set the speed of animations, in seconds.'),
  ); 

  $form['mtt_settings']['tabs']['slideshow']['carousel'] = array(
    '#type' => 'fieldset',
    '#title' => t('Agents/Partners Slideshow'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['slideshow']['carousel']['owl_include'] = array(
    '#type' => 'checkbox',
    '#title' => t('Include Owl Carousel css and js files'),
    '#default_value' => theme_get_setting('owl_include', 'listingplus'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['slideshow']['carousel']['owl_autoplay'] = array(
    '#type' => 'checkbox',
    '#title' => t('Autoplay'),
    '#default_value' => theme_get_setting('owl_autoplay', 'listingplus'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );  

  $form['mtt_settings']['tabs']['slideshow']['carousel']['owl_effect_time'] = array(
    '#type' => 'textfield',
    '#title' => t('Effect duration (sec)'),
    '#default_value' => theme_get_setting('owl_effect_time', 'listingplus'),
    '#description'   => t('Set the speed of animations, in seconds.'),
  ); 

  $form['mtt_settings']['tabs']['slideshow']['image_slider'] = array(
    '#type' => 'fieldset',
    '#title' => t('In Page Slideshow'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );  
  
  $form['mtt_settings']['tabs']['slideshow']['image_slider']['image_slider_effect'] = array(
    '#type' => 'select',
    '#title' => t('Effects'),
    '#description'   => t('From the drop-down menu, select the slideshow effect you prefer.'),
    '#default_value' => theme_get_setting('image_slider_effect', 'listingplus'),
    '#options' => array(
    'fade' => t('fade'),
    'slide' => t('slide'),
    ),
  );

  $form['mtt_settings']['tabs']['responsive_menu'] = array(
    '#type' => 'fieldset',
    '#title' => t('Responsive menu'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['responsive_menu']['responsive_multiLevel_menu'] = array(
    '#type' => 'fieldset',
    '#title' => t('Responsive Multilevel Menu'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['responsive_menu']['responsive_multiLevel_menu']['responsive_multilevelmenu_state'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable responsive menu'),
    '#description'   => t('Use the checkbox to enable the plugin which transforms the Main menu of your site to a responsive multilevel menu when your browser is at mobile widths.'),
    '#default_value' => theme_get_setting('responsive_multilevelmenu_state', 'listingplus'),
  );
    
  $form['mtt_settings']['tabs']['google_map'] = array(
    '#type' => 'fieldset',
    '#title' => t('Google Maps'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['mtt_settings']['tabs']['google_map']['google_map_contact'] = array(
    '#type' => 'fieldset',
    '#title' => t('Google Maps - Contact Page'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  
  $form['mtt_settings']['tabs']['google_map']['google_map_contact']['google_map_js'] = array(
    '#type' => 'checkbox',
    '#title' => t('Include Google Maps javascript code'),
    '#default_value' => theme_get_setting('google_map_js','listingplus'),
  );

  $form['mtt_settings']['tabs']['google_map']['google_map_contact']['google_map_latitude'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Maps Latitude'),
    '#description'   => t('For example 40.726576'),
    '#default_value' => theme_get_setting('google_map_latitude','listingplus'),
    '#size' => 5,
    '#maxlength' => 10,
  );  

  $form['mtt_settings']['tabs']['google_map']['google_map_contact']['google_map_longitude'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Maps Longitude'),
    '#description'   => t('For example -74.046822'),
    '#default_value' => theme_get_setting('google_map_longitude','listingplus'),
    '#size' => 5,
    '#maxlength' => 10,
  ); 
  
  $form['mtt_settings']['tabs']['google_map']['google_map_contact']['google_map_zoom'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Maps Zoom'),
    '#description'   => t('For example 13'),
    '#default_value' => theme_get_setting('google_map_zoom','listingplus'),
    '#size' => 5,
    '#maxlength' => 10,
  ); 
  
  $form['mtt_settings']['tabs']['google_map']['google_map_contact']['google_map_canvas'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Maps Canvas Id'),
    '#description'   => t('Set the Google Map Canvas Id. For example: map-canvas'),
    '#default_value' => theme_get_setting('google_map_canvas','listingplus'),
  ); 

}
