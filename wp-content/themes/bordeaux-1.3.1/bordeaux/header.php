<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<!-- BEGIN head -->
	<head>
	
		<!-- Title -->
		<title>
		<?php
                 if ( is_single() ) { single_post_title(); print ' - '; bloginfo('name'); }      
                 elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); }
                 elseif ( is_page() ) { single_post_title(''); print ' - '; bloginfo('description'); }
                 elseif ( is_search() ) { bloginfo('name'); print ' | Search results ' . esc_html($s); }
                 elseif ( is_404() ) { bloginfo('name'); print ' - Page not found'; }
                 else { bloginfo('name'); wp_title('-'); }
		?>
		</title>

		<!-- Meta Tags -->
		<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />
		
		<!-- Stylesheets -->
		<link id="main_stylesheet" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sexy-slider.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main-stylesheet.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/content-slider.css" type="text/css" />
		<!--[if IE 7]><link rel="stylesheet" href="css/ie7.css" type="text/css" type="text/css" /><![endif]-->

		<?php wp_enqueue_script('jquery'); ?>
		<?php wp_head(); ?>
		
		<!-- Scripts --> 
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.sexyslider.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.contentslider.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/cufon-yui.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/museo.font.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.tinytips.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.menucardslider.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js" type="text/javascript"></script>
		<?php
			$cufon = get_option("bordeaux_cufon");
			if($cufon=="on" || !$cufon){
			$cufon_on=",";
		?>
		<script type="text/javascript">
			Cufon.replace('.menu > ul > li', { hover: true, hoverables: { li: true }, ignore: { ul: true } } );
			Cufon.replace('.sexyslider-title a', { textShadow: '#000 0 1px', hover: 'true' } );
			Cufon.replace('.homepage-columns-item .title', { textShadow: '#47250f 0 1px' } );
			Cufon.replace('.main-title span', { textShadow: '#560000 0 1px' } );
			Cufon.replace('.menu-card-title', { textShadow: '#560000 0 1px' } );
			Cufon.replace('.show-all', { textShadow: '#fff 0 1px', hover: 'true' } );
			Cufon.replace('.price', { textShadow: '#a11b00 0 1px' } );
			Cufon.replace('h2, h3, h4, h5, h6', { hover: 'true' } );
			Cufon.replace('.no-logo p', { textShadow: '#4b4b4b 0 1px' } );
			Cufon.replace('.date', { hover: 'true' } );
			Cufon.replace('.pages a', { hover: 'true' } );
			Cufon.replace('.news-title a', { textShadow: '#fff 0 1px', hover: 'true' } );
			Cufon.replace('blockquote', { hover: 'true' } );
			Cufon.replace('.menu-card .item .title a', { hover: 'true' } );
			Cufon.replace('.photo-gallery-open .nr', { hover: 'true' } );
			Cufon.replace('.btn-1-color-default', { textShadow: '#fff 0 1px', hover: 'true' } );
			Cufon.replace('.btn-1-color-grey', { textShadow: '#fff 0 1px', hover: 'true' } );
			Cufon.replace('.btn-1-color-red', { textShadow: '#3e0000 0 1px', hover: 'true' } );
			Cufon.replace('.btn-1-color-yellow', { textShadow: '#f5d399 0 1px', hover: 'true' } );
			Cufon.replace('.btn-1-color-green', { textShadow: '#234b04 0 1px', hover: 'true' } );
			Cufon.replace('.btn-1-color-blue', { textShadow: '#022842 0 1px', hover: 'true' } );
			Cufon.replace('.btn-1-disabled', { textShadow: 'none' } );
			Cufon.replace('.btn-2-color-default', { textShadow: '#fff 0 1px', hover: 'true' } );
			Cufon.replace('.btn-2-color-grey', { textShadow: '#fff 0 1px', hover: 'true' } );
			Cufon.replace('.btn-2-color-red', { textShadow: '#3e0000 0 1px', hover: 'true' } );
			Cufon.replace('.btn-2-color-yellow', { textShadow: '#f5d399 0 1px', hover: 'true' } );
			Cufon.replace('.btn-2-color-green', { textShadow: '#234b04 0 1px', hover: 'true' } );
			Cufon.replace('.btn-2-color-blue', { textShadow: '#022842 0 1px', hover: 'true' } );
			Cufon.replace('.btn-2-disabled', { textShadow: 'none' } );
		</script>
		<?php
		}
			$homepage_slider_title=get_option("bordeaux_homepage_slider_title");
			$homepage_slider_direction=get_option("bordeaux_homepage_slider_direction");
			$homepage_slider_effect=get_option("bordeaux_homepage_slider_effect");
			$homepage_slider_delay=get_option("bordeaux_homepage_slider_delay");
			$homepage_slider_strips=get_option("bordeaux_homepage_slider_strips");
			$homepage_slider_strip_speed=get_option("bordeaux_homepage_slider_strip_speed");
			$homepage_slider_title_speed=get_option("bordeaux_homepage_slider_title_speed");
										
		?>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#homepage-slider").SexySlider({

				<?php if($homepage_slider_strips && $homepage_slider_strips!="default") { echo "strips : ".$homepage_slider_strips.","; }?>
				auto            : true,
				autopause       : true,
				<?php if($homepage_slider_delay && $homepage_slider_delay!="default") { echo "delay : ".$homepage_slider_delay.","; }?>
				<?php if($homepage_slider_strip_speed && $homepage_slider_strip_speed!="default") { echo "stripSpeed : ".$homepage_slider_strip_speed.","; }?> 
				<?php if($homepage_slider_title_speed && $homepage_slider_title_speed!="default") { echo "titleSpeed : ".$homepage_slider_title_speed.","; }?> 
				<?php if($homepage_slider_title && $homepage_slider_title!="default") { echo "titlePosition : '".$homepage_slider_title."',"; }?> 
				<?php if($homepage_slider_direction && $homepage_slider_direction!="default") { echo "direction : '".$homepage_slider_direction."',"; }?> 
				<?php if($homepage_slider_effect && $homepage_slider_effect!="default") { echo "effect : '".$homepage_slider_effect."'".$cufon_on.""; }?> 
				<?php if($cufon=="on" || !$cufon){ ?> onTitleHide     : function() { Cufon.replace('.sexyslider-title a', { textShadow: '#3e0000 0 1px', hover: 'true' } ); } <?php } ?>
				});
			});
		</script>
		
		<script type="text/javascript">
			function addLoadEvent(func) { 
			  var oldonload = window.onload;
			  if(typeof window.onload != 'function') {
					  window.onload = func;
			  }else{
					  window.onload = function() {
							  if(oldonload) {
									  oldonload();
							  }
							
					  }
			  }
			}
		</script>
		

		
		<script type="text/javascript">
			$(document).ready(function(){

				// hide #back-top first
				// $("#back-top").hide();
				
				// fade in #back-top
				$(function () {
					$(window).scroll(function () {
						if ($(this).scrollTop() > 100) {
							$('.back-top').fadeIn();
						} else {
							$('.back-top').fadeOut();
						}
					});

					// scroll body to 0px on click
					$('.back-top a').click(function () {
						$('body,html').animate({
							scrollTop: 0
						}, 800);
						return false;
					});
				});

			});
		</script>
		<?php 
			$feedback_rotation = get_option("bordeaux_feedback_rotation");
			if($feedback_rotation=="on") { ?>
				<script type="text/javascript">
				
				<?php						
					$feedback_1 = get_option("bordeaux_feedback_1");
					$feedback_1_image = get_option("bordeaux_feedback_1_image");
					$feedback_1_text = get_option("bordeaux_feedback_1_text");												

					$feedback_2 = get_option("bordeaux_feedback_2");
					$feedback_2_image = get_option("bordeaux_feedback_2_image");
					$feedback_2_text = get_option("bordeaux_feedback_2_text");													
														
					$feedback_3 = get_option("bordeaux_feedback_3");
					$feedback_3_image = get_option("bordeaux_feedback_3_image");
					$feedback_3_text = get_option("bordeaux_feedback_3_text");								
			
					$feed_count="0";
					
					if($feedback_1||$feedback_1_image||$feedback_1_text) $feed_count++;
					if($feedback_2||$feedback_2_image||$feedback_2_text) $feed_count++;
					if($feedback_3||$feedback_3_image||$feedback_3_text) $feed_count++;
				
				
				?>
	
					function randomiseDiv()
						{
							// Define how many divs we have
							var divCount = <?php echo $feed_count;?>;

							// Get our random ID (based on the total above)
							var randomId = Math.floor(Math.random()*divCount+1);

							// Get the div that's been randomly selectted
							var chosenDiv = document.getElementById('feedback-' + randomId);

							// If the content is available on the page
							if (chosenDiv)
							{
								// Update the display
								chosenDiv.style.display = 'block';
							}
						}
						
						addLoadEvent(randomiseDiv);
			
				</script>
		<?php } ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$('a.tTip').tinyTips('title');
			});
		</script>
       <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts'), esc_html( get_bloginfo('name'), 1 ) ); ?>" />
       <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments'), esc_html( get_bloginfo('name'), 1 ) ); ?>" />
       <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		
	<!-- END head -->
	</head>
	
	<!-- BEGIN body -->
	<body <?php body_class("top"); ?>>
