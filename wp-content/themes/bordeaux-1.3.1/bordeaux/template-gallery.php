<?php
/* Template Name: Bordeaux Gallery */
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
													<span><b><?php the_title();?></b></span>
													<a href="<?php echo home_url(); ?>"><?php printf ( __( 'back to Homepage' , 'bordeaux' ));?></a>
												</div>
												
												<!-- BEGIN .photo-gallery -->
												<div class="photo-gallery">
												
													<!-- BEGIN .index-list -->
													<div class="index-list">
													<?php
															$paged = get_query_string_paged();
															$posts_per_page = get_option('bordeaux_gallery_items');
															if($posts_per_page == "") {
																$posts_per_page = get_option('posts_per_page');
															}
															$my_query = new WP_Query(array('post_type' => 'gallery', 'paged' => $paged, 'posts_per_page' => $posts_per_page)); 
														$counter=1;
													
													?>					

													<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
													
													<?php if ($counter == 1) { ?><!-- BEGIN .row --><div class="row"> <?php } ?>
													
													<!-- BEGIN .index-item -->
													<div class="index-item">
														<?php $src = get_post_thumb($post->ID,135,135); ?>
														<a href="<?php the_permalink();?>"><img src="<?php echo $src["src"]; ?>" alt="<?php the_title();?>" width="135" height="135"/></a>
														<a href="<?php the_permalink();?>"><?php the_title();?></a>
													<!-- END .index-item -->
													</div>	
													
													<?php if ($counter == 4) { ?><!-- END .row --></div>

							
													<?php $counter=0; } ?>
													<?php $counter++; ?>
													
													<?php endwhile; ?>
													<?php if($counter <= 4 && $counter != 1) { ?><!-- END .row --></div>

													<?php } ?>
													<?php else : ?>
													<h2 class="title"><?php printf ( __( 'No galleries were found' , 'bordeaux' ));?></h2>
													<?php endif; ?>
						
													<!-- BEGIN .pages -->				
													<div class="pages">
													<?php gallery_nav_btns($paged, $my_query->max_num_pages); ?>
													<!-- END .pages -->
													</div>
													
												<!-- END .index-list -->
												</div>
												
											<!-- END .photo-gallery -->
											</div>
											<div class="clear"></div>
												
											<p class="show-all last"><a href="<?php echo home_url(); ?>"><span><?php printf ( __( 'back to Homepage' , 'bordeaux' ));?></span></a></p>
													
											<?php endwhile; else: ?>
												<p><?php printf ( __('Sorry, no posts matched your criteria.' , 'bordeaux' )); ?></p>
											<?php endif; ?>
										<!-- END .left-side -->
										</div>

										<!-- BEGIN .right-side -->
										<div class="right-side">
											<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Gallery Sidebar") ) : ?>
											<?php endif; ?>
										<!-- END .right-side -->
										</div>
										
										<div class="clear"></div>					
										</div>
										
									</div>
									
								</td>
								<!-- END .homepage-about -->

							</tr>
							
							<tr>
								<td class="main-content-wrapper-bottom"><p class="back-top"><a href="#top"><span><?php printf ( __( 'go back to the top' , 'bordeaux' ));?></span></a></p></td>
							</tr>
							
						</table>

					<!-- END .homepage-wrapper -->
					</div>

				<!-- END .content -->
				</div>
				
			<!-- END .content-wrapper -->
			</div>
			

	<?php get_footer(); ?>