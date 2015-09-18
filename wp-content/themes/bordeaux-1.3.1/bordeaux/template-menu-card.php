<?php
/*
Template Name: Menu Card
*/	
?>
<?php get_header(); ?>
<?php include (THEME_INCLUDES . '/top.php'); ?>

		<?php 
			$slider_enabled=get_option('bordeaux_slider_enabled');
			
			if ($slider_enabled == "on") {
				include (THEME_INCLUDES . '/slider.php');
			} else if ($slider_enabled == "off") {
				echo "<div class=\"no-content-slider\">&nbsp;</div>";
			}
			
			$current_page=$_GET['page'];
			if($current_page && is_numeric ($current_page)) { $page=$current_page; } else { $page=1;}
			

			$categories = get_categories("hide_empty=0&taxonomy=menu_card&hierarchical=1");
					
			$options = get_option("bordeaux_category_order");
			$order = $options[0];
					
			if($order) {
			
				$order_array = explode(",", $order);
				$i=0;
			
				foreach($order_array as $id){
					foreach($categories as $n => $category){
						if(is_object($category) && $category->term_id == $id){
							$categories[$n]->order = $i;
							$i++;
						}
					}
								
					foreach($categories as $n => $category){
						if(is_object($category) && !isset($category->order)){
							$categories[$n]->order = 99999;
						}
					}
				}
						
				usort($categories, "bordeaux_category_order_compare");
						
			}
			
			?>	

			<!-- BEGIN .content-wrapper -->
			<div class="content-wrapper<?php if($slider_enabled == "off") echo " no-content-slider-wrapper";?>">

				<!-- BEGIN .content -->
				<div class="content<?php if($slider_enabled == "off") echo " no-content-slider-content";?>">
				<?php 
					if($categories) {
				?>

						<table class="menu-card">
							<tr>
								<td class="navigation"><a href="#" class="previous" id="card-prev">&nbsp;</a></td>
								<td class="menu-card-content-wrapper">
									<div class="top">&nbsp;</div>

									<!-- BEGIN .content-wrapper -->
									<div class="content-wrapper">

										<!-- BEGIN .card-container -->
										<div id="card-container" activepage="<?php echo $page;?>">

											<!-- BEGIN .card-slider -->
											<div class="content" id="card-slider">
												<?php
													$pageCount=0;
													$sliderCount=1;

													foreach($categories as $category) {
														if($category->parent==0) {
														
															$pageCount++;
															if($pageCount==1) { 
															?>

																<!-- BEGIN .card-page -->
																<div class="card-page" id="cardpageid-<?php echo $sliderCount;?>">
																	
																	<!-- BEGIN .left-side -->
																	<div class="left-side">
															
																	<div class="menu-card-title"><?php printf ( __( 'Menu Card' , 'bordeaux' ));?></div>

														<?php 
															}
															
															if($pageCount%2==1 && $pageCount!=1) { 
																$sliderCount++;
														?>
															
																	<!-- END .right-side -->
																	</div>
																	
																	<div class="clear"></div>
																
																<!-- END .card-page -->
																</div>
															
																<!-- BEGIN .card-page -->
																<div class="card-page" id="cardpageid-<?php echo $sliderCount;?>">
																	
																	<!-- BEGIN .left-side -->
																	<div class="left-side">
															
																	<div class="menu-card-title"><?php printf ( __( 'Menu Card' , 'bordeaux' ));?></div>

														<?php 
															} elseif($pageCount%2==0) {
														?>
																	<!-- END .left-side -->
																	</div>
																	
																	<!-- BEGIN .right-side -->
																	<div class="right-side">
																	<div class="menu-card-link"><a href="<?php echo get_page_link(get_reservation_page()); ?>"><?php printf ( __( 'check &amp; order your Reservation' , 'bordeaux' ));?></a></div>
														<?php
															}

															echo "<h3>".$category->name."</h3>"; 
															
															//*** category description ***//
															$cat_description=$category->description;
															//echo $cat_description;	
															
															$sub_cats=get_categories("hide_empty=1&taxonomy=menu_card&child_of=$category->cat_ID");

															if($sub_cats) {
																	
																$cat=$category->cat_ID;
																$order = $options[$cat];
							
																if($order){
																	$order_array = explode(",", $order);
																	
																	$i=0;
																	
																	foreach($order_array as $id){
																		foreach($sub_cats as $n => $category){
																			if(is_object($category) && $category->term_id == $id){
																				$sub_cats[$n]->order = $i;
																				$i++;
																			}
																		}
																			
																			
																		foreach($sub_cats as $n => $category){
																			if(is_object($category) && !isset($category->order)){
																				$sub_cats[$n]->order = 99999;
																			}
																		}

																	}
																		
																	usort($sub_cats, "bordeaux_category_order_compare");
																		
																}
																	
																foreach($sub_cats as $sub_cat) {
																	echo "<h4>$sub_cat->name</h4>";
																	
																	//*** category description ***//
																	$scat_description=$sub_cat->description;
																	//echo $scat_description;	
																	
																	$slug=$sub_cat->slug;

																	$args = array(
																		'tax_query' => array(
																			array(
																				'taxonomy' => 'menu_card',
																				'field' => 'slug',
																				'terms' => $slug,
																			)
																		),
																		'posts_per_page'=>100,
																		'orderby'=>'menu_order',
																		'order'=>'DESC'
																	);
																	
																	$my_query = new WP_Query( $args);
																	if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post();
																	$thePostID = $post->ID;
																		
																	$image = get_post_thumb($thePostID,54,54,"menu_item_slider");
																	$image_hover = get_post_thumb($thePostID,180,180,"menu_item_slider_hover");
																		
																	$price=get_post_meta($thePostID, 'bordeaux_price', true);
																	if(!$price) $price=0;
																		
																	$boderaux_currency=get_option('boderaux_currency_category');
																	$get_the_content=get_the_content();
																		
																	preg_match('|\[ingredients title="(.*)"\](.*)\[\/ingredients\]|si', $get_the_content, $content); 

																?>
																	<table class="item">
																		<tr>
																			<td class="image"><a href="<?php the_permalink(); ?>" class="tTip" title="&lt;img src=&quot;<?php echo $image_hover['src'];?>&quot; alt=&quot;&quot; width=&quot;180&quot; height=&quot;180&quot; /&gt;"><img src="<?php echo $image['src'];?>" alt="" width="54" height="54"  /></a></td>
																			<td class="text">
																				<p class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
																				<p class="description"><?php if(isset($content[2]) && $content[2]) { echo WordLimiter(strip_tags($content[2])); } else { the_excerpt(); } ?></p>
																			</td>
																			<td class="menu-price"><p><?php echo $boderaux_currency.$price;?></p></td>
																		</tr>
																	</table>
																<?php
																	
																endwhile; else: endif; 
																	
																} //end foreach
																	
															} //end if sub_cats
																
														}//end if 
														
													} // end foreach

												?>
												
												
																<!-- END .right-side -->
																</div>
																
																<div class="clear"></div>
															
															<!-- END .card-page -->
															</div>

												
		
											<!-- END .card-slider -->
											</div>
										
										<!-- END .card-container -->
										</div>
										
									<!-- END .content-wrapper -->	
									</div>

								</td>
								<!-- END .homepage-about -->
								
								<td class="navigation"><a href="#" class="next" id="card-next">&nbsp;</a></td>

							</tr>
							
							<tr>
								<td></td>
								<td class="menu-card-content-wrapper-bottom"></td>
								<td></td>
							</tr>
							
						</table>
					<?php 
					
					$count_posts = wp_count_posts('menu-card');
					$published_posts = $count_posts->publish;
					
					} else if($published_posts==0){
						echo "<span style=\"color:#fff; font-size:14pt;\">You need to add at least one post in the menu card, you can do it <a  style=\"color:#fff; font-size:14pt;\" href=\"".admin_url()."post-new.php?post_type=menu-card\">here</a>!</span>";
					}
					else if(!$categories){
						echo "<span style=\"color:#fff; font-size:14pt;\">You need to add at least one category and one sub-category for the menu card, you can do it  <a  style=\"color:#fff; font-size:14pt;\" href=\"".admin_url()."post-new.php?post_type=menu-card\">here</a>!</span>";
					}
					?>	
				<!-- END .content -->
				</div>

			<!-- END .content-wrapper -->
			</div>
												
			<?php get_footer(); ?>