<?php
/**
 * @file
 * Override of the default maintenance page.
 *
 * This is an override of the default maintenance page. Used for Garland and
 * Minnelli, this file should not be moved or modified since the installation
 * and update pages depend on this file.
 *
 * This mirrors closely page.tpl.php for Garland in order to share the same
 * styles.
 */
?><!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
    <head>
    <?php print $head ?>
    <title><?php print $head_title ?></title>
    <?php print $styles ?>
    <?php print $scripts ?>
    </head>
    
    <body class="<?php print $classes; ?> no-banner" <?php print $attributes;?>>
        <!-- #page-container -->
        <div id="page-container">

            <!-- #header-top -->
            <div id="header-top" class="clearfix">
                <div class="container">

                    <!-- #header-top-inside -->
                    <div id="header-top-inside" class="clearfix">
                        <div class="row">
                            
                            
                            <div class="col-md-8">
                                <!-- #header-top-left -->
                                <div id="header-top-left" class="clearfix">
                                    <div class="header-top-area">
                                        
                                    </div>
                                </div>
                                <!-- EOF:#header-top-left -->
                            </div>
                        
                            <div class="col-md-4">
                                <!-- #header-top-right -->
                                <div id="header-top-right" class="clearfix">
                                    <div class="header-top-area">                    

                                    </div>
                                </div>
                                <!-- EOF:#header-top-right -->
                            </div>
                        
                        </div>
                    </div>
                    <!-- EOF: #header-top-inside -->

                </div>
            </div>
            <!-- EOF: #header-top -->

            <!-- #header -->
            <header id="header">
                <div class="container">
                    
                    <!-- #header-inside -->
                    <div id="header-inside" class="clearfix">
                        <div class="row">

                            <div class="col-md-4">
                                <!-- #header-inside-left -->
                                <div id="header-inside-left" class="clearfix">
                                    <div class="header-area">
                                        <div id="logo-and-site-name-wrapper" class="clearfix">
                                            <?php if ($logo):?>
                                            <div id="logo">
                                            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"> <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /> </a>
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
                            <div class="col-md-8">
                                <!-- #header-inside-right -->
                                <div id="header-inside-right" class="clearfix">
                                    <div class="header-area">

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

            <!-- #page-intro -->
            <div id="page-intro">

                <!-- #breadcrumb -->
                <div id="breadcrumb" class="clearfix">
                    <div class="container">
                        <!-- #breadcrumb-inside -->
                        <div id="breadcrumb-inside">
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>
                        <!-- EOF:#breadcrumb-inside -->
                    </div>
                </div>
                <!-- EOF: #breadcrumb -->

                <!-- #banner -->
                <div id="banner">
                </div>
                <!-- EOF: #banner -->

                <!-- #highlighted -->
                <div id="highlighted">
                    <div class="container">

                        <!-- #highlighted-inside -->
                        <div id="highlighted-inside" class="clearfix">
                            <div class="highlighted-area">
                                <div class="row">
                                    <div class="col-md-12">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- EOF: #highlighted-inside -->

                    </div>
                </div>
                <!-- EOF: #highlighted -->

            </div>
            <!-- EOF:#page-intro -->

            <!-- #page -->
            <div id="page" class="clearfix">
                <div class="container">

                    <!-- #main-content -->
                    <div id="main-content">
                        <div class="row">

                            <section class="col-md-12">

                                <!-- #featured -->
                                <div id="featured" class="clearfix">
                                    <!-- #featured-inside -->
                                    <div id="featured-inside" class="clearfix">

                                    </div>
                                    <!-- EOF: #featured-inside -->
                                </div>
                                <!-- EOF: #featured -->

                                <!-- #main -->
                                <div id="main" class="clearfix">
                                    <?php print $messages; ?>
                                    <?php if ($title): ?><h1 class="page-title"><?php print $title; ?></h1> <?php endif; ?>
                                    <?php print $content; ?>
                                </div>
                                <!-- EOF:#main -->

                            </section>

                            <aside class="col-md-12">
                                <!--#sidebar-->
                                <section id="sidebar-second" class="sidebar clearfix">
                                
                                </section>
                                <!--EOF:#sidebar-->
                            </aside>
                            
                        </div>
                    </div>
                    <!-- EOF:#main-content -->

                </div>
            </div>
            <!-- EOF: #page -->

            <!-- #bottom-highlighted -->
            <div id="bottom-highlighted">
                <div class="container">
                    
                    <!-- #bottom-highlighted-inside -->
                    <div id="bottom-highlighted-inside" class="clearfix">
                        <div class="bottom-highlighted-area">
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- EOF:#bottom-highlighted-inside -->

                </div>
            </div>
            <!-- EOF: #bottom-highlighted -->

            <!-- #footer-top -->
            <div id="footer-top">
                <div class="container">
                    
                    <!-- #footer-top-inside -->
                    <div id="footer-top-inside" class="clearfix">
                        <div class="footer-top-area">
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- EOF:#footer-top-inside -->

                </div>
            </div>
            <!-- EOF: #footer-top -->

            <!-- #footer -->
            <footer id="footer" class="clearfix">
                <div class="container">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="footer-area">
                            
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="footer-area">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="footer-area">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="footer-area">

                            </div>
                        </div>

                    </div>

                </div>
            </footer> 
            <!-- EOF #footer -->

            <!-- #subfooter -->
            <div id="subfooter" class="clearfix">
                <div class="container">
                    
                    <!-- #subfooter-inside -->
                    <div id="subfooter-inside" class="clearfix">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- #subfooter-left -->
                                <div class="subfooter-area left">
                                </div>
                                <!-- EOF: #subfooter-left -->
                            </div>
                            <div class="col-md-8">
                                <!-- #subfooter-right -->
                                <div class="subfooter-area right">
                                </div>
                                <!-- EOF: #subfooter-right -->
                            </div>
                        </div>
                    </div>
                    <!-- EOF: #subfooter-inside -->
                
                </div>
            </div>
            <!-- EOF:#subfooter -->

        </div>
        <!-- EOF:#page-container -->
    </body>
</html>