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
												<div class="main-title">
													<span>
														<b>
															<?php 
																global $query_string; 
																 if ( is_home() || is_front_page() ) { echo ( __( 'Latest blog posts, news &amp; information','bordeaux' )); }
																 elseif ( is_search() ) { print ( __( 'Search results' , 'bordeaux' )); } 
																 else { echo single_cat_title();}
															 ?>
														</b>
													</span>
												</div>
												
												<!-- BEGIN .blog-list-2 -->
												<div class="blog-list-2">
												<?php $counter = 1; ?>
												<?php global $query_string; ?>
													<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
												
														<!-- BEGIN .item -->
														<div class="item">
														
															<?php
																if(get_option("bordeaux_show_first_thumb") == "on") {
																	$image = get_post_thumb($post->ID,600,180);
																	if($image['show'] == true) { ?>
																		<div class="image">
																			<a href="<?php the_permalink();?>">
																				<img src="<?php echo $image['src'];?>" alt="<?php the_title(); ?>" width="600" height="180"/>
																			</a>
																		</div>
																	<?php } 
																}
															?>
														
														
															<div class="date">
																<p class="day"><?php echo the_time("j"); ?></p>
																<p class="month"><?php echo the_time("F"); ?></p>
																<p class="year"><?php echo the_time("Y"); ?></p>
																<p class="comments"><a href="#"> <?php comments_number('0', '1', '%'); ?> </a></p>
																<p class="section"><?php the_category(", ");?></p>
																<p class="author"><?php the_author_posts_link(); ?></p>
															</div>
															
															

															
															
															<div class="text">
																<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
																<?php if(get_option("bordeaux_show_first_pictures") == "off") { add_filter('the_content', 'remove_images'); } ?>
																<?php if(get_option("bordeaux_show_first_objects") == "off") { add_filter('the_content', 'remove_objects'); } ?>
																<?php add_filter('the_content', 'blog_read_more'); ?>
																<?php the_content(__('Read more', 'bordeaux')); ?>
															</div>
														
														<!-- END .item -->
														</div>
												
														<?php $counter++; ?>				
														<?php endwhile; else: ?>
														<p><?php printf ( __('No posts where found', 'bordeaux')); ?></p>
														<?php endif; ?>

												<!-- END .blog-list-1 -->
												</div>
			
													<?php
														if (is_search()) {
															global $query_string;
															customized_nav_btns($paged, $wp_query->max_num_pages, $query_string);
														 } else {
															customized_nav_btns($paged, $wp_query->max_num_pages);
														 } 
													?>
			
		
											<!-- END .left-side -->
											</div>
