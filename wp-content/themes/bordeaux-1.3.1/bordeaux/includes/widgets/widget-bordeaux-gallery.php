<?php
add_action('widgets_init', create_function('', 'return register_widget("bordeaux_gallery");'));

class bordeaux_gallery extends WP_Widget {
	function bordeaux_gallery() {
		 parent::WP_Widget(false, $name = 'Bordeaux Latest Galeries');	
	}

	function form($instance) {
		 $title = esc_attr($instance['title']);
		 $count = esc_attr($instance['count']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php  printf ( __( 'Title:' , 'bordeaux' )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php  printf ( __( 'Item shown:' , 'bordeaux' ));?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$count = $instance['count'];
        ?>
              <?php echo $before_widget; ?>
	

					<div class="title"><h3><?php echo $title;?></h3></div>
					<!-- BEGIN .popular-galleries -->
					<div class="popular-galleries">
				
						<?php
							$args = array( 'post_status' => null, 'numberposts' => $count, 'post_type' => 'gallery'); 
							$posts = get_posts($args);
							
								if(count($posts) > 0) {

									foreach($posts as $post) {
										$image = get_post_thumb($post->ID,51,51);
										?>
										<a href="<?php echo get_permalink($post->ID);?>">
											<img src="<?php echo $image['src']; ?>" alt="<?php echo $post->title;?>" title="<?php echo $post->title;?>" width="51" height="51" />
										</a>

										<?php
									}

							
								}
						?>
					<!-- END .popular-galleries -->
					</div>
					

												
				<?php echo $after_widget; ?>
        <?php
	}
}
?>