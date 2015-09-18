<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package ProfitMag
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
        $settings = get_option( 'profitmag_options' );    
?>

<div id="page" class="hfeed site">
    

    <header id="masthead" class="site-header clearfix" role="banner">
        

        <div class="wrapper header-wrapper clearfix">
                <div class="header-container"> 
                
                    
                    
                    <div class="site-branding clearfix">
                        <div class="site-logo f-left">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                <?php if( get_header_image() ): ?>
                                    <img src="<?php header_image(); ?>" alt="<?php bloginfo('name') ?>" />
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri().'/images/profitmag.png'; ?>" >
                                <?php endif; ?>
                            </a>
                        </div>
                        
                        <?php if( !empty( $settings['header_ads'] ) && $settings['header_ads'] != '' ): ?>
                                   <div class="header-ads f-right">
                                        <?php echo $settings['header_ads']; ?>
                                   </div>
                        <?php endif; ?>
                                    
                    </div>
            
                    <nav id="site-navigation" class="main-navigation clearfix <?php do_action( 'profitmag_menu_alignment' ); ?>" role="navigation" >
                        <div class="desktop-menu clearfix">
                        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                        <div class="search-block">
                            <?php //if( !empty( $settings['show_search']) && $settings['show_search'] == 1 ): ?>
                                <?php //echo get_search_form(); ?>
                            <?php //endif; ?>
                        </div>
                        </div>
                        <div class="responsive-slick-menu clearfix"></div>
                        
                    </nav><!-- #site-navigation -->
        
                </div> <!-- .header-container -->
        </div><!-- header-wrapper-->
        
    </header><!-- #masthead -->
    

    <div class="wrapper content-wrapper clearfix">

        <div style="float:left;width:73%;">
            <div style="float:left;">
            <img src="/wordpress/wp-content/themes/profitmag/images/food/grob_tha_r04.png" width="900">

            </div>

            
        </div>


        <div class="secondary-sidebar">
             <img src="/wordpress/wp-content/themes/profitmag/images/food/grob_tha_r04_a.png">
             <img src="/wordpress/wp-content/themes/profitmag/images/food/downloaddoc.png"width="100%">
             <img src="/wordpress/wp-content/themes/profitmag/images/food/Untitled-1.png"width="100%">
             <img src="/wordpress/wp-content/themes/profitmag/images/food/Untitled-2.png"width="100%">
             <img src="/wordpress/wp-content/themes/profitmag/images/food/Untitled-3.png"width="100%">
        </div>
        <br clear="all">

        <div class="slider-feature-wrap clearfix">
            <!-- Slider -->
            <?php do_action( 'profitmag_slider' ); ?>
            
            <!-- Featured Post Beside Slider -->
            <?php do_action( 'profitmag_featured_post_beside' ); ?>
            
            <?php
                if(is_home() || is_front_page() ){
                $profitmag_content_id = "home-content";
                }else{
                $profitmag_content_id ="content";
                } 
             ?>
        </div> 

        
            <div id="<?php echo $profitmag_content_id; ?>" class="site-content">