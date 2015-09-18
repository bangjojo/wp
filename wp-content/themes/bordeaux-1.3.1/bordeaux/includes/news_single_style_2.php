			<?php 
			$slider_enabled=get_option('bordeaux_slider_enabled')	;
			if ($slider_enabled == "on") 
			{
				include (THEME_INCLUDES . '/slider.php');
			} else if ($slider_enabled == "off") 
			{
				echo "<div class=\"no-content-slider\">&nbsp;</div>";
			}
			?>	

			<!-- BEGIN .content-wrapper -->
			<div class="content-wrapper<?php if($slider_enabled == "off") echo " no-content-slider-wrapper";?>">

				<!-- BEGIN .content -->
				<div class="content<?php if($slider_enabled == "off") echo " no-content-slider-content";?>">
					
					<!-- BEGIN .homepage-wrapper -->
					<div class="homepage-wrapper">

						<table>
							<tr>
							
								<td class="main-content-wrapper">
								
									<div class="top"></div>
								
									<div class="content-wrapper">
										
										<div class="content">
										
											<!-- BEGIN .left-side -->
											<div class="left-side">
												<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
												<div class="main-title">
													<span><b><?php printf ( __( 'Blog' , 'bordeaux' ));?></b></span>
													<a href="<?php echo home_url(); ?>"><?php printf ( __( 'back to Homepage' , 'bordeaux' ));?></a>
												</div>
												
												<!-- BEGIN .post -->
												<div class="post">
												
													<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
													
													<div class="date">
														<p class="day"><?php echo the_time("j. F, Y"); ?></p>
														<p class="author"><?php the_author_posts_link(); ?></p>
														<p class="section"> <?php the_category(", ");?> </p>
														<p class="comments"><a href="#"><?php comments_number('0', '1', '%'); ?></a></p>
													</div>
												
													
														
														<?php if(get_option("bordeaux_show_single_thumb") == "on") { add_filter('the_content', 'add_image_thumb_2'); }?>
														<?php add_filter('the_content', 'wrap_img_tags'); ?>
														<?php add_filter('the_content', 'wrap_art_img'); ?>
														<?php add_filter('the_content', 'BigFirstChar', 5); ?>
														<?php the_content(); ?>
														<?php remove_filter('the_content', 'add_image_thumb_2'); ?>
												</div>
													<div class="clear"></div>
													
													<p class="show-all last"><a href="<?php echo home_url(); ?>"><span><?php printf ( __( 'Back to Homepage' , 'bordeaux' ));?></span></a></p>

													<?php if ( comments_open() ) : ?>
													<!-- BEGIN .comments -->
													<div class="comments">
														<div class="main-title">
															<span><b><?php printf ( __( 'Comments' , 'bordeaux' ));?></b></span>
														</div>
													
														

													<?php comments_template(); // Get comments.php template ?>
													
													</div>
													
													
													<?php endif; ?>
	
													<?php endwhile; else: ?>
														<p><?php printf ( __('Sorry, no posts matched your criteria.' , 'bordeaux' )); ?></p>
													<?php endif; ?>

											<!-- END .left-side -->
											</div>