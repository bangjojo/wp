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
												
												<div class="main-title">
													<span><b><?php printf ( __( 'Photo Gallery' , 'bordeaux' ));?></b></span>
													<a href="<?php echo get_page_link(get_gallery_page());?>"><?php printf ( __( 'show all Photo galleries' , 'bordeaux' ));?></a>
												</div>
												
													<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
													<?php 
													$g = get_the_ID();
													global $query_string;
													$query_vars = explode('&',$query_string);
													foreach($query_vars as $key) {
														if(strpos($key,'page=') !== false) {
															$i = substr($key,8,12);
															break;
														}
													}
												
													if($i == 0) $i=0;
																
													$gallery_page = get_option("theme_gallery_page");
													$page = get_post($gallery_page);
													$gallery_slug = $page->post_name;
													
													$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $g, 'order'=> 'ASC' ); 
													$attachments = get_posts($args);
													if ($attachments) {
														$file = $attachments[$i]->guid;
														$count = count($attachments);
													
													?>
													
												<div class="photo-gallery-open">
													
													<h3><a href="#"><?php the_title();?></a></h3>
													
													<table class="navigation">
														<tr>
															<td><a href="<?php the_permalink(); if($i> 0) { echo $i-1; } elseif($i!=0) { echo $i; } ?>" class="previous">&nbsp;</a></td>
															<td class="nr"><?php echo $i+1;?> of <?php echo $count;?></td>							
															<td><a href="<?php the_permalink(); if($i+1 < $count) { echo $i + 1; } elseif($i!=0) { echo $i; } ?>" class="next">&nbsp;</a></td>
														</tr>
													</table>
													
													<a href="<?php the_permalink(); if($i+1 < $count) {echo $i + 1;} elseif($i!=0) {echo $i;} ?>"><img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=/<?php
														$imgs = explode("/wp-content/", $file); echo "wp-content/".$imgs[1];?>&amp;w=650&amp;h=420&amp;zc=1&amp;q=100" alt="<?php the_title();?>" class="image"  /></a>
													
													<table class="navigation">
														<tr>
															<td><a href="<?php the_permalink(); if($i> 0) { echo $i-1; } elseif($i!=0) { echo $i; } ?>" class="previous">&nbsp;</a></td>
															<td class="nr"><?php echo $i+1;?> of <?php echo $count;?></td>							
															<td><a href="<?php the_permalink(); if($i+1 < $count) { echo $i + 1; } elseif($i!=0) { echo $i; } ?>" class="next">&nbsp;</a></td>
														</tr>
													</table>
													<?php if (get_the_content() != "") { ?>
													<!-- BEGIN .description -->
													<div class="description">
															<?php
																add_filter('the_content','remove_images');
																add_filter('the_content','remove_objects');
																the_content();
															?>
													<!-- END .description -->
													</div>
													<?php } ?>
													<?php } else {
														echo ( __( 'This gallery has no pictures!' , 'bordeaux' ));
													} ?>
													
													<div class="thumbnails">
													<?php
															$c=0;
															foreach($attachments as $attachment)
															{
																$file = $attachment->guid;
																?>
																	<a href="<?php the_permalink(); echo $c.'/'; ?>" <?php if($c == $i) echo "class=\"active\""; ?>><img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=/<?php $imgs = explode("/wp-content/", $file); echo "wp-content/".$imgs[1];?>&amp;w=110&amp;h=110&amp;zc=1&amp;q=100" alt="<?php the_title();?>"  width="110" height="110" /></a>
																		
																<?php
																$c++;
															}
															?>
													
													<?php endwhile; ?>
													<?php endif;?>
														
													</div>
												
												</div>
												

											<!-- END .full-width-content -->
											</div>

											

										</div>
										
									</div>
									
								</td>

							</tr>
							
							<tr>
								<td class="full-width-content-wrapper-bottom"><p class="back-top"><a href="#top"><span><?php printf ( __( 'go back to the top' , 'bordeaux' ));?></span></a></p></td>
							</tr>
							
						</table>

					<!-- END .full-width-wrapper -->
					</div>


				<!-- END .content -->
				</div>
				
			<!-- END .content-wrapper -->
			</div>
			
<?php get_footer(); ?>