<!-- #page-container -->
<div id="page-container">

    <?php if (theme_get_setting('scrolltop_display')): ?>
    <div id="toTop"><i class="fa fa-angle-up"></i></div>
    <?php endif; ?>

    <?php if ($page['header_top_left'] || $page['header_top_right']):?>
    <!-- #header-top -->
    <div id="header-top" class="clearfix">
        <div class="container">

            <!-- #header-top-inside -->
            <div id="header-top-inside" class="clearfix">
                <div class="row">
                    
                    <?php if ($page['header_top_left']) :?>
                    <div class="<?php print $header_top_left_grid_class; ?>">
                        <!-- #header-top-left -->
                        <div id="header-top-left" class="clearfix">
                            <div class="header-top-area">
                                <?php print render($page['header_top_left']); ?>
                            </div>
                        </div>
                        <!-- EOF:#header-top-left -->
                    </div>
                    <?php endif; ?>
                
                
                    <?php if ($page['header_top_right']) :?>
                    <div class="<?php print $header_top_right_grid_class; ?>">
                        <!-- #header-top-right -->
                        <div id="header-top-right" class="clearfix">
                            <div class="header-top-area">                    
                                <?php print render($page['header_top_right']); ?>
                            </div>
                        </div>
                        <!-- EOF:#header-top-right -->
                    </div>
                    <?php endif; ?>
                
                </div>
            </div>
            <!-- EOF: #header-top-inside -->

        </div>
    </div>
    <!-- EOF: #header-top -->
    <?php endif; ?>

    <!-- #header -->
    <div class="fix-header"></div>
    <header id="header">
        <div class="container">
            
            <!-- #header-inside -->
            <div id="header-inside" class="clearfix">
                <div class="row">

                    <div class="col-xs-3 col-md-4">
                    	<!-- #header-inside-left -->
                        <div id="header-inside-left" class="clearfix">
                            <div class="header-area">
    	                        <div id="logo-and-site-name-wrapper" class="clearfix">
    	                            <?php if ($logo):?>
    	                            <div id="logo">
    	                            <a class="logo-link" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"> <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /> <span>Zaaydaad</span></a>
    	                            </div>
    	                            <?php endif; ?>
    	                            
    	                            <?php if ($site_name):?>
    	                            <div id="site-name">
    	                            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
    	                            </div>
    	                            <?php endif; ?>
    	                            
    	                            <?php if ($site_slogan):?>
    	                            <div id="site-slogan">
    	                            <?php print $site_slogan; ?>
    	                            </div>
    	                            <?php endif; ?>
    	                        </div>

                            </div>
                        </div>
                        <!-- EOF:#header-inside-left -->
                    </div>
                    <div class="col-xs-9 col-md-8">
                        <!-- #header-inside-right -->
                        <div id="header-inside-right" class="clearfix">
                            <div class="header-area">

                                <?php if ($page['search_area']) :?>
                                <div id="search-area" class="clearfix">
                                <?php print render($page['search_area']); ?>
                                </div>
                                <?php endif; ?>
                                
                                <!-- #main-navigation -->
                                <div id="main-navigation" class="clearfix <?php if ($page['search_area']) { ?> with-search-bar <?php } ?>">
                                    <nav role="navigation"> 
                                        <?php if ($page['navigation']) :?>
                                        <?php print render($page['navigation']); ?>
                                        <?php else : ?>
                                        <div id="main-menu">
                                        <?php //print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('class' => array('main-menu', 'menu'), ), 'heading' => array('text' => t('Main menu'), 'level' => 'h2', 'class' => array('element-invisible'), ), )); ?>
                                        </div>
                                        <?php endif; ?>
                                    </nav>
                                </div>
                                <!-- EOF: #main-navigation -->
                            </div>
                        </div>
                        <!-- EOF:#header-inside-right -->
                    </div>

                </div>
            </div>
            <!-- EOF: #header-inside -->

        </div>
    </header>
    <!-- EOF: #header -->

    <?php if (($breadcrumb && theme_get_setting('breadcrumb_display')) || $page['banner'] || $messages || $page['highlighted']) :?>
    <!-- #page-intro -->
    <div id="page-intro">
        <?php if ($breadcrumb && theme_get_setting('breadcrumb_display')):?> 
        <!-- #breadcrumb -->
        <div id="breadcrumb" class="clearfix">
            <div class="container">
                <!-- #breadcrumb-inside -->
                <div id="breadcrumb-inside">
                    <div class="row">
                        <div class="col-md-12">
                        <?php print $breadcrumb; ?>
                        </div>
                    </div>
                </div>
                <!-- EOF:#breadcrumb-inside -->
            </div>
        </div>
        <!-- EOF: #breadcrumb -->
        <?php endif; ?>
        <div class="header-menu-links">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <?php if ($page['header']) :?>
                  <?php print render($page['header']); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        
        <?php if ($page['banner']):?>
        <!-- #banner -->
        <div id="banner">
            <?php print render($page['banner']); ?>
        </div>
        <!-- EOF: #banner -->
        <?php endif; ?>
        
        <?php if ($page['banner_left'] || $page['banner_right']):?>
          <div id="middle-content-wrapper">
            <div class="container-fluid">
              <div class="row">
                <div class="col-xs-12 col-sm-6">
                <?php print render($page['banner_left']); ?>
                </div>
                <div class="col-xs-12 col-sm-6">
                <?php print render($page['banner_right']); ?>
                </div>
              </div>    
            </div>
          </div>
        <?php endif; ?>

        <?php if ($messages):?>
        <!-- #messages-console -->
        <div id="messages-console" class="clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <?php print $messages; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- EOF: #messages-console -->
        <?php endif; ?>

        <?php if ($page['highlighted']):?>
        <!-- #highlighted -->
        <div id="highlighted">
            <div class="container">

                <!-- #highlighted-inside -->
                <div id="highlighted-inside" class="clearfix">
                    <div class="highlighted-area">
                        <div class="row">
                            <div class="col-md-12">
                            <?php print render($page['highlighted']); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- EOF: #highlighted-inside -->

            </div>
        </div>
        <!-- EOF: #highlighted -->
        <?php endif; ?>
    </div>
    <!-- EOF:#page-intro -->
    <?php endif; ?>

    <!-- #page -->
    <div id="page" class="clearfix">
        <div class="container">
           
            <!-- #main-content -->
            <div id="main-content">
                <div class="row">

                    <?php if ($page['sidebar_first']):?>
                    <aside class="<?php print $sidebar_first_grid_class; ?>">
                        <!--#sidebar-->
                        <section id="sidebar-first" class="sidebar clearfix">
                        <?php print render($page['sidebar_first']); ?>
                        </section>
                        <!--EOF:#sidebar-->
                    </aside>
                    <?php endif; ?>

                    <section class="<?php print $main_grid_class; ?>">

                        <?php if ($page['featured']):?>
                        <!-- #featured -->
                        <div id="featured" class="clearfix">
                            <!-- #featured-inside -->
                            <div id="featured-inside" class="clearfix">
                            <?php print render($page['featured']); ?>
                            </div>
                            <!-- EOF: #featured-inside -->
                        </div>
                        <!-- EOF: #featured -->
                        <?php endif; ?>

                        <!-- #main -->
                        <div id="main" class="clearfix <?php if (theme_get_setting('frontpage_content_print') || !drupal_is_front_page()) { print ' ' . 'content'; } ?>">

                            <?php print render($title_prefix); ?>
                            <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
                            <?php print render($title_suffix); ?>

                            <!-- #tabs -->
                            <?php if ($tabs):?>
                                <div class="tabs">
                                <?php print render($tabs); ?>
                                </div>
                            <?php endif; ?>
                            <!-- EOF: #tabs -->

                            <?php print render($page['help']); ?>

                            <!-- #action links -->
                            <?php if ($action_links):?>
                                <ul class="action-links">
                                <?php print render($action_links); ?>
                                </ul>
                            <?php endif; ?>
                            <!-- EOF: #action links -->

                            <?php if (theme_get_setting('frontpage_content_print') || !drupal_is_front_page()):?> 
                            <?php print render($page['content']); ?>
                            <?php print $feed_icons; ?>
                            <?php endif; ?>

                        </div>
                        <!-- EOF:#main -->

                    </section>

                    <?php if ($page['sidebar_second']):?>
                    <aside class="<?php print $sidebar_second_grid_class; ?>">
                        <!--#sidebar-->
                        <section id="sidebar-second" class="sidebar clearfix">
                        <?php print render($page['sidebar_second']); ?>
                        </section>
                        <!--EOF:#sidebar-->
                    </aside>
                    <?php endif; ?>
                    
                </div>
            </div>
            <!-- EOF:#main-content -->

        </div>
    </div>
    <!-- EOF: #page -->
    <?php if ($page['content_left'] || $page['content_right']):?>
    <div id="middle-content-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
          <?php print render($page['content_left']); ?>
          </div>
          <div class="col-xs-12 col-sm-6">
          <?php print render($page['content_right']); ?>
          </div>
        </div>    
      </div>
    </div>
    <?php endif; ?>
    <?php if ($page['bottom']):?>
    <!-- #bottom -->
    <div id="">
        <div class="container">
            
            <!-- #bottom-inside -->
            <div id="bottom-inside" class="clearfix">
                <div class="bottom-area">
                    <div class="row">
                        <div class="col-md-12">
                        <?php print render($page['bottom']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- EOF:#bottom-inside -->

        </div>
    </div>
    <!-- EOF: #bottom -->
    <?php endif; ?>

    <?php if ($page['bottom_highlighted']):?>
    <!-- #bottom-highlighted -->
    <div id="bottom-highlighted">
        <div class="container">
            
            <!-- #bottom-highlighted-inside -->
            <div id="bottom-highlighted-inside" class="clearfix">
                <div class="bottom-highlighted-area">
                    <div class="row">
                        <div class="col-md-12">
                        <?php print render($page['bottom_highlighted']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- EOF:#bottom-highlighted-inside -->

        </div>
    </div>
    <!-- EOF: #bottom-highlighted -->
    <?php endif; ?>

    <?php if ($page['footer_top']):?>
    <!-- #footer-top -->
    <div id="footer-top">
        <div class="container">
            
            <!-- #footer-top-inside -->
            <div id="footer-top-inside" class="clearfix">
                <div class="footer-top-area">
                    <div class="row">
                        <div class="col-md-12">
                        <?php print render($page['footer_top']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- EOF:#footer-top-inside -->

        </div>
    </div>
    <!-- EOF: #footer-top -->
    <?php endif; ?>

    <?php if ($page['footer_first'] || $page['footer_second'] || $page['footer_third'] || $page['footer_fourth']):?>
    <!-- #footer -->
    <footer id="footer" class="clearfix">
        <div class="container">

            <div class="row">
                <?php if ($page['footer_first']):?>
                <div class="<?php print $footer_grid_class; ?>">
                    <div class="footer-area">
                    <?php print render($page['footer_first']); ?>
                    </div>
                </div>
                <?php endif; ?>      

                <?php if ($page['footer_second']):?>      
                <div class="<?php print $footer_grid_class; ?>">
                    <div class="footer-area">
                    <?php print render($page['footer_second']); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($page['footer_third']):?>
                <div class="<?php print $footer_grid_class; ?>">
                    <div class="footer-area">
                    <?php print render($page['footer_third']); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($page['footer_fourth']):?>
                <div class="<?php print $footer_grid_class; ?>">
                    <div class="footer-area">
                    <?php print render($page['footer_fourth']); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </footer> 
    <!-- EOF #footer -->
    <?php endif; ?>

    <?php if ($page['sub_footer_left'] || $page['footer']):?>
    <!-- #subfooter -->
    <div id="subfooter" class="clearfix">
    	<div class="container">
    		
    		<!-- #subfooter-inside -->
    		<div id="subfooter-inside" class="clearfix">
                <div class="row">
        			<div class="col-md-4">
                        <!-- #subfooter-left -->
                        <?php if ($page['sub_footer_left']):?>
                        <div class="subfooter-area left">
                        <?php print render($page['sub_footer_left']); ?>
                        </div>
                        <?php endif; ?>
                        <!-- EOF: #subfooter-left -->
        			</div>
        			<div class="col-md-8">
                        <!-- #subfooter-right -->
                        <?php if ($page['footer']):?>
                        <div class="subfooter-area right">
                        <?php print render($page['footer']); ?>
                        </div>
                        <?php endif; ?>
                        <!-- EOF: #subfooter-right -->
        			</div>
                </div>
    		</div>
    		<!-- EOF: #subfooter-inside -->
    	
    	</div>
    </div><!-- EOF:#subfooter -->
    <?php endif; ?>
    
</div>
<!-- EOF:#page-container -->