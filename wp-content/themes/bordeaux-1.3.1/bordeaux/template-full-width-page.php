<?php
/* Template Name: Full Width Page*/
?>
<?php get_header(); ?>
<?php include (THEME_INCLUDES .'/top.php'); ?>
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

					<!-- BEGIN .full-width-wrapper -->
					<div class="full-width-wrapper">

						<table>
							<tr>
						
								<td class="full-width-content-wrapper">
								
									<div class="top"></div>
								
									<div class="content-wrapper">
										<div class="content">
											<!-- BEGIN .full-width-content -->
											<div class="full-width-content">
												<?php if (have_posts()) : while (have_posts()) : the_post(); ?><div class="main-title">
												<span><b><?php the_title();?></b></span>
													<a href="<?php echo home_url(); ?>"><?php printf ( __( 'back to Homepage' , 'bordeaux' ));?></a>
												</div>

												<div class="full-width">
												

													<?php add_filter('the_content', 'wrap_img_tags'); ?>
													
													<?php the_content(); ?>
													<?php remove_filter('the_content', 'add_image_thumb'); ?>	
													<?php endwhile; else: ?>
													<p><?php  printf (__('Sorry, no posts matched your criteria.' , 'bordeaux')); ?></p>
													<?php endif; ?>
												
												</div>

											<!-- END .full-width-content -->
											</div>

											
										</div>
										
									</div>
									
								</td>

							</tr>
							
							<tr>
								<td class="full-width-content-wrapper-bottom"><p class="back-top"><a href="#top"><span><?php  printf (__('go back to the top' , 'bordeaux')); ?></span></a></p></td>
							</tr>
							
						</table>

					<!-- END .full-width-wrapper -->
					</div>


				<!-- END .content -->
				</div>
				
			<!-- END .content-wrapper -->
			</div>
			

	<?php get_footer(); ?>