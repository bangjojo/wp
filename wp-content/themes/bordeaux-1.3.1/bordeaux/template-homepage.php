<?php
/*
Template Name: Homepage
*/	
?>
<?php get_header(); ?>
<?php include (THEME_INCLUDES . '/top.php'); ?>

		<?php
			if(get_option("bordeaux_homepage_slider") != "off"  && get_option("bordeaux_homepage_slider")) { ?>
			<!-- BEGIN .homepage-slider-wrapper -->
			<div class="homepage-slider-wrapper">
			
				<!-- BEGIN .homepage-slider -->
				<div class="homepage-slider">
				
					<div id="control"></div>
				
					<span class="border-overlay">&nbsp;</span>
			
				
					<?php if(get_option("bordeaux_homepage_slider") == "on") { ?>
					<div id="homepage-slider">
							<?php 
								$cat = get_option("bordeaux_homepage_slider_cat");
								$my_query = new WP_Query('cat='.$cat.'&showposts=5&orderby=menu_order&order=ASC');
							?>
							<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
							<?php $image = get_post_thumb($post->ID,950,350,'bordeaux_slider_image'); ?>
								<img src="<?php echo $image['src']; ?>" alt="&lt;a href=&quot;<?php the_permalink();?>&quot;&gt;&lt;b&gt;<?php the_title(); ?>&lt;/b&gt;&lt;/a&gt;&lt;p&gt;<?php the_excerpt(); ?>&lt;/p&gt;" width="950" height="350" />

							<?php endwhile; else: ?>
							<?php endif; ?>					
					</div>
					<!-- BEGIN .navigation -->
					<div id="navigation"></div>		
					<?php } else if(get_option("bordeaux_homepage_slider") == "single"){
						$homepage_image=get_option("bordeaux_homepage_image");
					?>
						<div id="homepage-image">
							<img src="<?php echo $homepage_image; ?>" width="950" height="350" />
						</div>
					<?php } ?>
				
				</div>
			</div>
			<?php } ?>
			<?php
				$homepage_infoblocks_enabled = get_option("bordeaux_homepage_infoblocks_enabled");
				$ib1_title = stripslashes(get_option("ib1_title"));
				$ib1_image = stripslashes(get_option("ib1_image"));
				$ib1_url = stripslashes(get_option("ib1_url"));
				$ib1_text = stripslashes(get_option("ib1_text"));
				
				$ib2_title = stripslashes(get_option("ib2_title"));
				$ib2_image = stripslashes(get_option("ib2_image"));
				$ib2_url = stripslashes(get_option("ib2_url"));
				$ib2_text = stripslashes(get_option("ib2_text"));
				
				$ib3_title = stripslashes(get_option("ib3_title"));
				$ib3_image = stripslashes(get_option("ib3_image"));
				$ib3_url = stripslashes(get_option("ib3_url"));
				$ib3_text = stripslashes(get_option("ib3_text"));
				
			?>
			<!-- BEGIN .content-wrapper -->
			<div class="content-wrapper<?php if(get_option("bordeaux_homepage_slider") == "off") echo " no-content-slider-wrapper"; ?>">
			
				<!-- BEGIN .content -->
				<div class="content<?php if(get_option("bordeaux_homepage_slider") == "off") echo " no-content-slider-content"; ?>">
				
					<!-- BEGIN .homepage-wrapper -->
					<div class="homepage-wrapper">
			<?php if($homepage_infoblocks_enabled == "on") { ?>

						<!-- BEGIN .homepage-columns -->
						<div class="homepage-columns">
						<!-- BEGIN .homepage-columns-item -->
							<div class="homepage-columns-item">
								<div class="title">
									<div style="background: url(<?php echo $ib1_image;?>) 0 0 no-repeat; padding-left: 68px;"><?php echo $ib1_title;?></div>
								</div>
								<div class="text">
									<p><?php echo $ib1_text;?></p>
									<?php if($ib1_url!="") { ?><p class="last"><a href="<?php echo $ib1_url;?>" class="more-link"><?php printf ( __( 'Read more' , 'bordeaux' ));?></a></p><?php } ?>
								</div>
							<!-- END .homepage-columns-item -->
							</div>
							
							<!-- BEGIN .homepage-columns-item -->
							<div class="homepage-columns-item">
								<div class="title">
									<div style="background: url(<?php echo $ib2_image;?>) 0 0 no-repeat; padding-left: 82px;"><?php echo $ib2_title;?></div>
								</div>
								<div class="text">
									<p><?php echo $ib2_text;?></p>
									<?php if($ib2_url!="") { ?><p class="last"><a href="<?php echo $ib2_url;?>" class="more-link"><?php printf ( __( 'Read more' , 'bordeaux' ));?></a></p><?php } ?>
								</div>
							<!-- END .homepage-columns-item -->
							</div>
							
							<!-- BEGIN .homepage-columns-item -->
							<div class="homepage-columns-item last">
								<div class="title">
									<div style="background: url(<?php echo $ib3_image;?>) 0 0 no-repeat; padding-left: 68px;"><?php echo $ib3_title;?></div>
								</div>
								<div class="text">
									<p><?php echo $ib3_text;?></p>
									<?php if($ib3_url!="") { ?><p class="last"><a href="<?php echo $ib3_url;?>" class="more-link"><?php printf ( __( 'Read more' , 'bordeaux' ));?></a></p><?php } ?>
								</div>
							<!-- END .homepage-columns-item -->
							</div>
			
						<!-- END .homepage-columns -->
						</div>

			<?php } ?>
			
			
			<?php
			$homepage_footer = get_option("bordeaux_homepage_footer");
			if($homepage_footer == "on") {
			?>
			
						<table>
							<tr>

								<!-- BEGIN .homepage-about -->
								<td class="homepage-about">
									<?php
										$homepage_enable_popular_offerings = get_option("bordeaux_homepage_enable_popular_offerings");
						
										if($homepage_enable_popular_offerings == "on") { 
										
										$popular_menu_title = stripslashes(get_option("bordeaux_popular_menu_title"));
										$popular_menu_link = get_option("bordeaux_popular_menu_link");
										$popular_menu_text = stripslashes(get_option("bordeaux_popular_menu_text"));
													
									?>
									<div class="content">
										
										<div class="main-title">
											<span><b><?php echo $popular_menu_title; ?></b></span>
											<a href="<?php echo get_page_link(get_menucard_page()); ?>"><?php printf ( __( 'show menu card' , 'bordeaux' ));?></a>
										</div>

										<p class="caps"><?php echo $popular_menu_text; ?></p>
										
										<div class="main-spacer">&nbsp;</div>
										
										<!-- BEGIN .menu-display-1-wrapper -->
										<div class="menu-display-1-wrapper">
										
											<div class="menu-display-1">
												<?php $args = array(
														'numberposts'     => 6,
														'offset'          => 0,
														'orderby'         => 'post_date',
														'order'           => 'DESC',
														'meta_key'        => 'bordeaux_popular_offering',
														'meta_value'      => '1',
														'post_type'       => 'menu-card',
														'post_status'     => 'publish' );
												
													$myposts = get_posts( $args );	
													$count=0;
													global $post;
													foreach( $myposts as $post ) :	setup_postdata($post); 
													$count++;
												
													$thePostID = $post->ID;
													
													$price=get_post_meta($thePostID, 'bordeaux_price', true);
													if(!$price) $price=0;
													
													$boderaux_currency=get_option('boderaux_currency_category');
													
													$image = get_post_thumb($thePostID,180,120);
													

												?>
												
												
												
												
												<div class="item">
													<h5><?php the_title(); ?></h5>
													<a href="<?php the_permalink();?>" class="image">
														<span class="price"><?php echo $boderaux_currency;?><?php echo $price;?></span>
														<img src="<?php echo $image['src'];?>" alt="<?php the_title(); ?>" width="180" height="120" />
													</a>
													<p><?php the_excerpt(); ?></p>
													<p><a href="<?php the_permalink();?>" class="more-link"><?php printf ( __( 'Read more' , 'bordeaux' ));?></a></p>
												</div>
												
												
												<?php
												if($count>=3)
													{
														echo "
														<div class=\"main-spacer\">&nbsp;</div>";
														$count=0;
													}
												
												
												?>
												<?php endforeach; ?>
												
												
												<div class="clear"></div>

											</div>
											
										<!-- END .menu-display-1-wrapper -->	
										</div>
										
										<p class="show-all"><a href="<?php echo get_page_link(get_menucard_page()); ?>"><span><?php printf ( __( 'Show entire menu card' , 'bordeaux' ));?></span></a></p>
										
									</div>
									<?php } ?>
									
									<?php
										$footer_post = get_option("bordeaux_homepage_footer_post");
						
										if($footer_post && $homepage_enable_popular_offerings == "off") { 
										
										$args=array(
										   'p' => $footer_post,
										   'post_type' => 'page'
										);
										$the_query = new WP_Query($args);
										global $more; $more = false;
										if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
									?>
									<div class="content">
										
										<div class="main-title">
											<span><b><?php the_title();?></b></span>
											<a href="<?php the_permalink();?>"><?php printf ( __( 'read more' , 'bordeaux' ));?></a>
										</div>

										<p class="caps">
											<?php add_filter('the_content','page_read_more');?>
											<?php add_filter('the_content', 'big_first_char', 5); ?>
											<?php the_content(); ?>
										</p>
										
										<div class="main-spacer">&nbsp;</div>
									
										
									</div>
									<?php endwhile; else: ?>
									<p><?php printf ( __( 'No posts where found' , 'bordeaux' ));?></p>
									<?php endif; ?>
									<?php } ?>
									
									
									
									
								</td>
								<!-- END .homepage-about -->
								
								<td class="spacer"></td>
							
								<!-- BEGIN .events -->
								<td class="events">
									<div class="content">
										<?php 
											$homepage_widget_title=stripslashes(get_option('bordeaux_homepage_widget_title'));
											$homepage_widget_cat=stripslashes(get_option('bordeaux_homepage_widget_cat'));
											$homepage_widget_button=get_option('bordeaux_homepage_widget_button');
											
											$my_query = new WP_Query('cat='.$homepage_widget_cat.'&showposts=3');
											
											$category_link = get_category_link( $homepage_widget_cat );
										?>
										<div class="main-title">
											<?php if ( $homepage_widget_title ) { ?><span><b><?php echo $homepage_widget_title; ?></b></span><?php } ?>
											<a href="<?php echo $category_link;?>">show all</a>
										</div>
										<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

										<div class="item">
											<h6><?php echo the_time("n / j /Y"); ?><span>&bull;</span><?php echo the_time("h:i A"); ?></h6>
											<h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
											<p><?php echo word_trim(get_the_excerpt(), 19);?></p>
											<p><a href="<?php the_permalink();?>" class="more-link"><?php printf ( __( 'Read more' , 'bordeaux' ));?></a></p>
										</div>
										<?php endwhile; else: ?>
										<p><?php printf ( __( 'No posts where found' , 'bordeaux' ));?></p>
										<?php endif; ?>
										
										
										<?php if($homepage_widget_button) { ?>
											<p class="show-all"><a href="<?php echo get_page_link(get_menucard_page()); ?>"><span><?php printf ( __( 'Show entire menu card' , 'bordeaux' ));?></span></a></p>
										<?php } ?>
									</div>
								</td>
								<!-- END .events -->
								
							</tr>
							
							<tr>
								<td class="homepage-about-bottom"><p class="back-top"><a href="#top"><span><?php printf ( __( 'go back to the top' , 'bordeaux' ));?></span></a></p></td>
								<td class="spacer"></td>
								<td class="events-bottom"><p class="back-top"><a href="#top"><span><?php printf ( __( 'go back to the top' , 'bordeaux' ));?></span></a></p></td>
							</tr>
							
						</table>
						<?php } ?>
						
					<!-- END .homepage-wrapper -->
					</div>


				<!-- END .content -->
				</div>
				
			<!-- END .content-wrapper -->
			</div>
			<?php get_footer(); ?>