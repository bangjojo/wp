<?php
add_action('widgets_init', create_function('', 'return register_widget("bordeaux_last_articles");'));

class bordeaux_last_articles extends WP_Widget {
	function bordeaux_last_articles() {
		 parent::WP_Widget(false, $name = 'Bordeaux Articles');	
	}

	function form($instance) {
		 $title = esc_attr($instance['title']);
		 $cat = esc_attr($instance['cat']);
		 $count = esc_attr($instance['count']);
		 $type = esc_attr($instance['type']);
		 $lenght = esc_attr($instance['lenght']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , 'bordeaux' )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('cat'); ?>"><?php printf ( __( 'Category:' , 'bordeaux' ));?>
			<?php
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 1,
				'hierarchical'             => 1,
				'taxonomy'                 => 'category');
				$args = get_categories( $args ); 
			?> 	
			<select name="<?php echo $this->get_field_name('cat'); ?>" style="width: 100%; clear: both; margin: 0;">
				<?php foreach($args as $ar) { ?>
					<option value="<?php echo $ar->cat_name; ?>" <?php if($ar->cat_name==$cat)  {echo 'selected="selected"';} ?>><?php echo $ar->cat_name; ?></option>
				<?php } ?>
			</select>
			
			</label></p>
			
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Post count:' , 'bordeaux' ));?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('type'); ?>"><?php printf ( __( 'Type:' , 'bordeaux' ));?>
				<select name="<?php echo $this->get_field_name('type'); ?>" style="width: 100%; clear: both; margin: 0;">
					<option value="1" <?php if($type==1)  {echo 'selected="selected"';} ?>>Image + Title</option>
					<option value="2" <?php if($type==2)  {echo 'selected="selected"';} ?>>Title + Excerpt</option>
				</select>
			</label></p>
			
			<?php if($type==2) { ?>
				<p><label for="<?php echo $this->get_field_id('lenght'); ?>"><?php printf ( __( 'Exceprt lenght (words):' , 'bordeaux' ));?> <input class="widefat" id="<?php echo $this->get_field_id('lenght'); ?>" name="<?php echo $this->get_field_name('lenght'); ?>" type="text" value="<?php echo $lenght; ?>" /></label></p>
			<?php } ?>
			
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['type'] = strip_tags($new_instance['type']);
		$instance['lenght'] = strip_tags($new_instance['lenght']);
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$cat = $instance['cat'];
		$count = $instance['count'];
		$type = $instance['type'];
		$lenght = $instance['lenght'];
        ?>
						<!-- BEGIN .sidebar-block-1 -->
						<?php echo $before_widget; ?>
								<?php $category_id = get_cat_ID($cat);
									  $category_link = get_category_link( $category_id );
								?>
							<div class="title"><h3> <?php if ( $title ) { echo $title; } ?></h3><a href="<?php echo $category_link;?>"><?php printf ( __( 'show all' , 'bordeaux' ));?></a></div>

								<?php if($type==1 OR $type=="") { ?>		
									<!-- BEGIN .latest-news -->
									<div class="latest-news random-items">
										<?php
											$args=array(
											   'category_name' => $cat,
											   'posts_per_page'=> $count
											);
											$the_query = new WP_Query($args);
										?>
										<?php $counter=1; ?>
										<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
											<!-- BEGIN .latest-news-item -->
											<?php $image = get_post_thumb($the_query->post->ID,60,60); ?>
											
											<div class="news-item <?php if($counter == $count) {echo "last";} ?>">
												<div class="image">
													<a href="<?php the_permalink();?>"><img src="<?php if($image['src']) { echo $image['src']; } ?>" alt="" width="60" height="60" /></a>
												</div>
												<div class="text">
													<h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
													<p><a href="<?php the_permalink();?>" class="more-link"><?php printf ( __( 'Read more' , 'bordeaux' ));?></a></p>
												</div>
											
											<!-- END .latest-news-item -->
											</div>
											<?php $counter++; ?>
										<?php endwhile; else: ?>
										<p><?php printf ( __( 'No posts where found' , 'bordeaux' ));?></p>
										<?php endif; ?>

									<!-- END .latest-news-->
									</div>
								<?php } else { ?>
								<!-- BEGIN .latest-events -->
								<div class="latest-news">
									<?php
										$args=array(
										   'category_name' => $cat,
										   'posts_per_page'=> $count
										);
										$the_query = new WP_Query($args);
									?>
									<?php $counter=1; ?>
									<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
											<div class="news-item <?php if($counter == $count) {echo "last";} ?>">
												<p class="news-title"><a href="<?php the_permalink();?>" class="title"><?php the_title();?></a></p>
												<p><?php echo word_trim(get_the_excerpt(),$lenght);?></p>
												<p class="last"><a href="<?php the_permalink();?>" class="more-link"><?php printf ( __( 'Read more' , 'bordeaux' ));?></a></p>
											<!-- END .latest-news-item -->
											</div>
									<?php $counter++; ?>
									<?php endwhile; else: ?>
									<p><?php printf ( __( 'No posts where found' , 'bordeaux' ));?></p>
									<?php endif; ?>
									
								<!-- END .latest-news -->
								</div>								
								<?php } ?>
							
						<!-- END .block-1 -->
						<?php echo $after_widget; ?>
        <?php
	}
}
?>