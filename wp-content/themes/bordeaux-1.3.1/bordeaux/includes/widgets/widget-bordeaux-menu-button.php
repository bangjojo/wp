<?php
add_action('widgets_init', create_function('', 'return register_widget("bordeaux_menu");'));

class bordeaux_menu extends WP_Widget {
	function bordeaux_menu() {
		 parent::WP_Widget(false, $name = 'Bordeaux Sidebar Menu Button');	
	}

	function form($instance) {
		 $title = esc_attr($instance['title']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , 'bordeaux' ));?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        ?>
			<?php echo $before_widget; ?>
				<p class="show-all last"><a href="<?php echo get_page_link(get_menucard_page()); ?>"><span><?php echo $title;?></span></a></p>
			<?php echo $after_widget; ?>
        <?php
	}
}
?>