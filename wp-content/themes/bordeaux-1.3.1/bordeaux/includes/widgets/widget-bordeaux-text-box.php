<?php
add_action('widgets_init', create_function('', 'return register_widget("bordeaux_text_box");'));


class bordeaux_text_box extends WP_Widget {
	function bordeaux_text_box() {
		 parent::WP_Widget(false, $name = 'Bordeaux Text Box');	
	}

	function form($instance) {
		 $title = esc_attr($instance['title']);
		 $text = $instance['text'];
		
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , 'bordeaux' )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php  printf ( __( 'Text:' , 'bordeaux' )); ?> <textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea></label></p>
		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = wpautop($new_instance['text'], $br );
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$text = $instance['text'];
        ?>
              <?php echo $before_widget; ?>
	

					<div class="title"><h3><?php echo $title;?></h3></div>
					<!-- BEGIN .popular-galleries -->
					<div class="basic-1">
				
						<?php echo $text;?>
					<!-- END .popular-galleries -->
					</div>
					

												
				<?php echo $after_widget; ?>
        <?php
	}
}
?>