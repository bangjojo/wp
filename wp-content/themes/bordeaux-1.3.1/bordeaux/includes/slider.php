			<!-- BEGIN .content-slider-wrapper -->
			<div class="content-slider-wrapper">
			<?php wp_reset_query(); ?>
				<!-- BEGIN .content-slider -->
				<div class="content-slider" id="content-slider">
					<!-- BEGIN .slider-item -->
					<div class="slider-item">
					<?php $args = array(
							'numberposts'     => 35,
							'offset'          => 0,
							'orderby'         => 'post_date',
							'order'           => 'DESC',
							'meta_key'        => 'bordeaux_slider',
							'meta_value'      => '1',
							'post_type'       => 'menu-card',
							'post_status'     => 'publish' );
					
						$myposts = get_posts( $args );	
						$count=-1;
						global $post;
						foreach( $myposts as $post ) :	setup_postdata($post); 
						$count++;
					
						$thePostID = $post->ID;
						
						$price=get_post_meta($thePostID, 'bordeaux_price', true);
						$boderaux_currency=get_option('boderaux_currency_category');
						if(!$price) $price=0;
						
						$image = get_post_thumb($thePostID,70,70,"menu_slider");
						$image_big = get_post_thumb($thePostID,180,180,"menu_slider");
						
						if($count>=7)
						{
							echo "
							</div>
							<div class=\"slider-item\">";
							$count=0;
						}
						
						
						$slider_hover=get_option('bordeaux_slider_image_hover');
					?>
					
					
						<div class="item">
							<span class="price"><?php echo $boderaux_currency;?> <?php echo $price;?></span>
							<a href="<?php the_permalink(); ?>" <?php if($slider_hover=="on") { ?> class="tTip"  title="&lt;img src=&quot;<?php echo $image_big['src']; ?>&quot; alt=&quot;<?php the_title();?>&quot; width=&quot;180&quot; height=&quot;180&quot; /&gt;" <?php } ?>><img src="<?php echo $image['src']; ?>" alt="" width="70" height="70" /></a>
						</div>
					
						
					<!-- END .slider-item -->
					
					<?php endforeach; ?>
					</div>
				<!-- END .content-slider -->
				</div>

			<!-- END .content-slider-wrapper -->
			</div>
			<?php wp_reset_query(); ?>
