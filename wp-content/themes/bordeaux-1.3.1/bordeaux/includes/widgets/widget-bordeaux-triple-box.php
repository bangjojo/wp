<?php
add_action('widgets_init', create_function('', 'return register_widget("bordeaux_triple_box");'));

class bordeaux_triple_box extends WP_Widget {
	function bordeaux_triple_box() {
		 parent::WP_Widget(false, $name = 'Bordeaux Triple Box');	
	}

	function form($instance) {
		 $title = esc_attr($instance['title']);
		 $count = esc_attr($instance['count']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , 'bordeaux' )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>			
			
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Post count:' , 'bordeaux' )); ?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
			
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
		$widget_id = $args['widget_id'];
		
        ?>
		
				<!-- BEGIN .sidebar-block-1 -->
				<?php echo $before_widget; ?>

					<div class="title"><h3><?php if ( $title ) { echo $title; } ?></h3></div>
					
					<!-- BEGIN .tabs-1 -->
					<div class="tabs-1">
						<table>
							<tr>
								<td><a href="#" class="tab-1 bordeaux_triple_btn active" id="bordeaux_triple_popular_btn_<?php echo $widget_id;?>"><span><?php printf ( __( 'Popular' , 'bordeaux' ));?></span></a></td>
								<td><a href="#" class="tab-1 tab-1-disabled bordeaux_triple_btn" id="bordeaux_triple_recent_btn_<?php echo $widget_id;?>"><span><?php printf ( __( 'Recent' , 'bordeaux' ));?></span></a></td>
								<td><a href="#" class="tab-1 tab-1-disabled bordeaux_triple_btn" id="bordeaux_triple_comments_btn_<?php echo $widget_id;?>"><span><?php printf ( __( 'Comments' , 'bordeaux' ));?></span></a></td>
							</tr>
						</table>
					<!-- END .tabs-1 -->
					</div>
				
					<!-- BEGIN .latest-activity -->
					<div class="latest-activity" id="bordeaux_triple_popular_<?php echo $widget_id;?>">
							<?php
								add_filter( 'posts_where', 'filter_where' );
								$args=array(
								   'posts_per_page' => $count,
								   'orderby' => 'comment_count'
								);
								$the_query = new WP_Query($args);
								remove_filter( 'posts_where', 'filter_where' );
							?>
							<?php $counter=1; ?>
							<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
							<!-- BEGIN .activity-item -->
							<div class="activity-item <?php if($counter == $count) { echo "last"; } ?>">
								<div class="image">
								<?php $image = get_post_thumb($the_query->post->ID,60,60); ?>
									<a href="<?php the_permalink();?>"><img src="<?php if($image['src']) { echo $image['src']; } ?>" alt="<?php the_title();?>" width="60" height="60" /></a>
								</div>
								<div class="text">
									<h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
									<p><a href="<?php the_permalink();?>" class="more-link"><?php printf ( __( 'Read more' , 'bordeaux' ));?></a></p>
								</div>
							<!-- END .activity-item -->
							</div>

							<?php $counter++; ?>
							<?php endwhile; else: ?>
							<p><?php printf ( __( 'No posts where found' , 'bordeaux' ));?></p>
							<?php endif; ?>
					<!-- END .latest-activity -->
					</div>
					<div class="latest-activity" id="bordeaux_triple_recent_<?php echo $widget_id;?>" style="display: none;">
							<?php
								$args=array(
								   'posts_per_page'=> $count
								);
								$the_query = new WP_Query($args);
							?>
							<?php $counter=1; ?>
							<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
							<!-- BEGIN .activity-item -->
							<div class="activity-item <?php if($counter == $count) { echo "last"; } ?>">
								<div class="image">
								<?php $image = get_post_thumb($the_query->post->ID,60,60); ?>
									<a href="<?php the_permalink();?>"><img src="<?php if($image['src']) { echo $image['src']; } ?>" alt="<?php the_title();?>" width="60" height="60" /></a>
								</div>
								<div class="text">
									<h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
									<p><a href="<?php the_permalink();?>" class="more-link"><?php printf ( __( 'Read more' , 'bordeaux' ));?></a></p>
								</div>
							<!-- END .activity-item -->
							</div>
							<?php $counter++; ?>
							<?php endwhile; else: ?>
							<p><?php printf ( __( 'No posts where found' , 'bordeaux' ));?></p>
							<?php endif; ?>
					<!-- END .latest-activity -->
					</div>
					<div class="latest-activity" id="bordeaux_triple_comments_<?php echo $widget_id;?>" style="display: none;">
							<?php
								$comments = get_comments( array( 'number' => $count, 'status' => 'approve' ) );
								foreach($comments as $c) {
									$ids[] = $c->comment_post_ID ;
									
								}
								$args=array(
								   'post__in' => $ids,
								   'posts_per_page' => $count
								);
								$the_query = new WP_Query($args);
							?>
							<?php $counter=1; ?>
							<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
							<!-- BEGIN .activity-item -->
							<div class="activity-item <?php if($counter == $count) { echo "last"; } ?>">
								<div class="image">
								<?php $image = get_post_thumb($the_query->post->ID,60,60); ?>
									<a href="<?php the_permalink();?>"><img src="<?php if($image['src']) { echo $image['src']; } ?>" alt="<?php the_title();?>" width="60" height="60" /></a>
								</div>
								<div class="text">
									<h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
									<p><a href="<?php the_permalink();?>" class="more-link"><?php printf ( __( 'Read more' , 'bordeaux' ));?></a></p>
								</div>
							<!-- END .activity-item -->
							</div>
							<?php $counter++; ?>
							<?php endwhile; else: ?>
							<p><?php printf ( __( 'No posts where found' , 'bordeaux' )); ?></p>
							<?php endif; ?>
					<!-- END .latest-activity -->
					</div>
					
					
				<!-- END .sidebar-block-1 -->
				<?php echo $after_widget; ?>

        <?php
	}
}
?>