<?php
function mytheme_admin_bar_render() {
        global $wp_admin_bar, $wpdb;

		$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(id) as Num FROM bordeaux_reservation WHERE approve=''"));		
		
		if($count!=0) $c="<span id=\"ab-awaiting-mod\" class=\"pending-count\">".$count."</span>";
        $wp_admin_bar->add_menu( array(

        'id' => 'reservations',
        'title' => __('Reservations '.$c.''),
        'href' => admin_url( 'admin.php?page=theme-configuration&p=theme_reservation_settings&pid=theme_reservation')
    ) );
}

function bordeaux_menu() {
		
	$labels = array(
    'name' => _x('Bordeaux Menu', 'bordeaux menu'),
    'singular_name' => _x('Bordeaux Menu', 'bordeaux menu'),
    'add_new' => _x('Add New', 'bordeaux menu'),
    'add_new_item' => __('Add New Item'),
    'edit_item' => __('Edit Item'),
    'new_item' => __('New Menu Item'),
    'view_item' => __('View Item'),
    'search_items' => __('Search Bordeaux Menu Items'),
    'not_found' =>  __('No bordeaux menu items found'),
    'not_found_in_trash' => __('No bordeaux menu items found in Trash'), 
    'parent_item_colon' => ''
	);
  
	register_taxonomy("menu_card", 
					    	array("Bordeaux Menu"), 
					    	array(	"hierarchical" => true, 
					    			"label" => "Bordeaux Menu Categories", 
					    			"singular_label" => "Bordeaux Menu Categories", 
					    			"rewrite" => true,
					    			"query_var" => true
					    		));  
		
		register_post_type( 'menu-card',
		array( 'labels' => $labels,
	         'public' => true,  
	         'show_ui' => true,  
	         'capability_type' => 'post',  
	         'hierarchical' => false,  
			 'taxonomies' => array('menu_card'),
	         'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes') ) );

}

$prefix = 'bordeaux_';
$image = '<img src="'.get_bloginfo('template_url').'/images/control-panel-images/logo-orangethemes-1.png" width="11" height="15" />';

$meta_box = array('id' => 'sticky-meta-box','title' => ''.$image.' Price', 'page' => 'menu-card', 'context' => 'side' ,'priority' => 'high', 'fields' => array(array('name' => 'Price','id' => $prefix . 'price','type' => 'text') ) );
$slider_box = array( 'id' => 'slider-meta-box', 'title' => ''.$image.' Add To Slider?', 'page' => 'menu-card', 'context' => 'side', 'priority' => 'high', 'fields' => array(array('name' => 'Slider', 'id' => $prefix. 'slider', 'type'=> 'checkbox' ) ) );
$popular_box = array( 'id' => 'popular-meta-box', 'title' => ''.$image.' A Popular Offering', 'page' => 'menu-card', 'context' => 'side', 'priority' => 'high', 'fields' => array(array('name' => 'Popular Offering', 'id' => $prefix. 'popular_offering', 'type'=> 'checkbox' ) ) );

$slider_image = array( 'id' => 'slider-image-box', 'title' => ''.$image.' Slider Image', 'page' => 'post', 'context' => 'side', 'priority' => 'high', 'fields' => array(array('name' => 'Image url', 'id' => $prefix. 'slider_image', 'type'=> 'text' ) ) );


// Add meta box
function add_sticky_box() {
	global $meta_box;
	global $slider_box;
	global $food_cat;
	global $popular_box;
	global $slider_image;
	
	add_meta_box($meta_box['id'], $meta_box['title'], 'sticky_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
	add_meta_box($food_cat['id'], $food_cat['title'], 'boderaux_food_menu_cat', $food_cat['page'], $food_cat['context'], $food_cat['priority']);
	add_meta_box($slider_box['id'], $slider_box['title'], 'slider_show_box', $slider_box['page'], $slider_box['context'], $slider_box['priority']);
	add_meta_box($popular_box['id'], $popular_box['title'], 'popular_show_box', $popular_box['page'], $popular_box['context'], $popular_box['priority']);
	add_meta_box($slider_image['id'], $slider_image['title'], 'slider_image_box', $slider_image['page'], $slider_image['context'], $slider_image['priority']);

}

// Callback function to show fields in meta box
function sticky_show_box() {
	global $meta_box, $post;

	echo '<input type="hidden" name="sticky_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<table class="form-table">';


	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		$post_num = htmlentities($_GET['post']);
		echo '<tr>','<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>','<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" ', $meta ? ' ' : '', ' value="', $meta ? remove_html_slashes($meta) : remove_html_slashes($field['std']), '"/> ' .get_option('boderaux_currency_category');
				//echo '<input type="text" value="'.$post_num.'" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' ' : '', ' />';
				break;
		}
		echo '<td>', '</tr>';
	}
	echo '</table>';
}

function slider_image_box() {
	global $slider_image, $post;
	
	echo '<input type="hidden" name="sticky_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';
	foreach ($slider_image['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		$post_num = htmlentities($_GET['post']);
		echo '<tr>','<th style="width:60%"><label for="', $field['id'], '">', $field['name'], '</label></th>','<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input class="upload input-text-1" type="text" name="', $field['id'], '" id="', $field['id'], '" value="',  $meta ? remove_html_slashes($meta) :  remove_html_slashes($field['std']), '" sstyle="width: 140px;"/>
						<div id="', $field['id'], '_button" class="upload-button upload-logo" style="padding: 10px 0 0 15px;"><a class="pex-button"><img src="'.THEME_IMAGE_CPANEL_URL.'btn-browse-1.png"/></a></div>
						<script type="text/javascript">
							jQuery(document).ready(function($){ bordeaux.loadUploader(jQuery("div#', $field['id'], '_button"), "'.THEME_FUNCTIONS_URL.'upload-handler.php", "'.THEME_UPLOADS_URL.'");});
						</script>';
				break;
		}
		echo '<td>', '</tr>';
	}
	echo '</table>';
}

function slider_show_box() {
	global $slider_box, $post;

	echo '<table class="form-table">';
	foreach ($slider_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		$post_num = htmlentities($_GET['post']);
		echo '<tr>','<th style="width:60%"><label for="', $field['id'], '">', $field['name'], '</label></th>','<td>';
		switch ($field['type']) {
			case 'checkbox':
				echo '<input type="checkbox" value="1" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo '<td>', '</tr>';
	}
	echo '</table>';
}

function popular_show_box() {
	global $popular_box, $post;

	echo '<table class="form-table">';
	foreach ($popular_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		$post_num = htmlentities($_GET['post']);
		echo '<tr>','<th style="width:60%"><label for="', $field['id'], '">', $field['name'], '</label></th>','<td>';
		switch ($field['type']) {
			case 'checkbox':
				echo '<input type="checkbox" value="1" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo '<td>', '</tr>';
	}
	echo '</table>';
}


// Save data from meta box
function save_sticky_data($post_id) {
	global $meta_box, $slider_box, $food_cat, $popular_box, $slider_image;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['sticky_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}//else if closer
	}//foreach closer
	
	foreach ($slider_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}//else if closer
	}//foreach closer	
	
	foreach ($popular_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}//else if closer
	}//foreach closer

	foreach ($slider_image['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}//else if closer
	}//foreach closer
	
} //function closer


$pageURLs= 'http://'.$_SERVER["SERVER_NAME"].dirname($_SERVER['PHP_SELF'])."/";


function add_new_gallery_columns($gallery_columns) {
	global $pageURLs;
	$new_columns['cb'] = '<input type="checkbox" />';
 
	$new_columns['title'] = _x('Item Title', 'column name');
	$new_columns['price'] = _x('Price', 'column name');
	$new_columns['slider'] = _x('Slider', 'column name');
	$new_columns['popular'] = _x('Popular', 'column name');
	$new_columns['category'] = _x('Category', 'column name');
	$new_columns['author'] = _x('Author', 'column name');
 
 
	$new_columns['date'] = _x('Date', 'column name');
 
	return $new_columns;
}

function manage_gallery_columns($column_name, $id) {
	global $wpdb, $pageURLs;
	switch ($column_name) {
	case 'id':
		echo $id;
		       break;
 
	case 'price':
		$price = $wpdb->get_var($wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key='bordeaux_price' AND post_id = {$id};"));
		
		if(!$price) $price="0";
		echo  "<a href=\"".$pageURLs."post.php?post=".$id."&action=edit\">".$price." ".get_option('boderaux_currency_category')."</a> ";
		break;
		
	case 'slider':
		$slider = $wpdb->get_var($wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key='bordeaux_slider' AND post_id = {$id};"));
	
		if($slider=="1") {
			$slider="Yes";
		}
		else {
			$slider="No";
		}
		echo "<a href=\"".$pageURLs."post.php?post=".$id."&action=edit\">".$slider."</a>";
		break;
		
	case 'popular':
		$popular_offering = $wpdb->get_var($wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key='bordeaux_popular_offering' AND post_id = {$id};"));
		
		if($popular_offering=="1") {
			$popular_offering="Yes";
		}
		else {
			$popular_offering="No";
		}
		echo "<a href=\"".$pageURLs."post.php?post=".$id."&action=edit\">".$popular_offering."</a>";
		break;
		
	case 'category':
		
		$terms=wp_get_post_terms($id, 'menu_card');
		$term_string="";
		$first=true;
		foreach($terms as $term){
			if(!$first) {
				$term_string.=', ';	
			}
				
			$term_string.="<a href=\"".$pageURLs."post.php?post=".$id."&action=edit\">".($term->name)."</a>";
			$first=false;
		}
		
		echo $term_string;
		break;
		
		default:
		break;
		
	} // end switch
	
}


	function bordeaux_category_order_scriptaculous() {
		if($_GET['page'] == "bordeaux-category-order"){
			wp_enqueue_script('scriptaculous');
		} 
	}
	
	
	function bordeaux_category_order_compare($a, $b) {
		
		if ($a->order == $b->order) {
			if($a->name == $b->name){
				return 0;
			}else{
				return ($a->name < $b->name) ? -1 : 1;
			}
			
		}
		
	    return ($a->order < $b->order) ? -1 : 1;
	}
	

	function bordeaux_category_order_head(){
		if(isset($_GET['page']) && $_GET['page'] == "bordeaux-category-order"){
			?>
			<style>
				#container{
					list-style: none;
					width: 225px;
				}
				
				#order{
				}
				
				.childrenlink{
					float: right;
					font-size: 12px;
				}
				
				.lineitem {
					background-color: #ececec;
					color: #000;
					margin-bottom: 5px;
					padding: .5em 1em;
					width: 350px;
					font-size: 13px;
					-moz-border-radius: 3px;
					-khtml-border-radius: 3px;
					-webkit-border-radius: 3px;
					border-radius: 3px;
					cursor: move;
				}
				
				.lineitem h4{
					font-weight: bold;
					margin: 0;
				}
			</style>
			<script src="<?php echo THEME_JS_URL;?>jquery.min.js" type="text/javascript"></script>
			 <script type="text/javascript" src="<?php echo THEME_JS_URL;?>jquery-ui-1.7.1.custom.min.js"></script>
			 <script type="text/javascript">
				$(document).ready(function(){ 
					$(function() {
						$("#order").sortable({ opacity: 0.6, cursor: 'move', update: function (){
							document.getElementById("category_order").value = $(this).sortable("toArray");
						}
						});
					});
				});
				
			</script> 
			<?php
		}
	}
	
	function bordeaux_category_order() {
		if(isset($_GET['childrenOf'])){
			$childrenOf = $_GET['childrenOf'];
		}else{
			$childrenOf = 0;
		}
		
		
		$options = get_option("bordeaux_category_order");
		$order = $options[$childrenOf];
		
		
		if(isset($_POST['submit'])){
			$options[$childrenOf] = $order = $_POST['category_order'];
			update_option("bordeaux_category_order", $options);
			$updated = true;
		}
		
		$allthecategories = get_categories("hide_empty=0&taxonomy=menu_card");
		if($childrenOf != 0){
			foreach($allthecategories as $category){
				if($category->cat_ID == $childrenOf){
					$father = $category->parent;
					$current_name = $category->name;
				}
			}
			
		}
		
		$categories = get_categories("hide_empty=0&taxonomy=menu_card&child_of=$childrenOf");
		
		if($order){
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
		
		<div class='wrap'>
			
			<?php if(isset($updated) && $updated == true): ?>
				<div id="message" class="fade updated"><p>Changes Saved.</p></div>
			<?php endif; ?>
			
			<form action="" method="POST">
				<input type="hidden" id="category_order" name="category_order" size="500" value="<?php echo $order; ?>">
				<input type="hidden" name="childrenOf" value="<?php echo $childrenOf; ?>" />
			<h2>Bordeaux Menu Category Order</h2>
			
			<?php if($childrenOf != 0): ?>
			<p><a href="<?php bloginfo("wpurl"); ?>/wp-admin/edit.php?post_type=menu-card&page=bordeaux-category-order&amp;childrenOf=<?php echo $father; ?>"><img src="<?php echo THEME_IMAGE_URL."btn-back-1.png";?>" alt="Back" title="Back" /></a></p>
			<h3><?php echo $current_name; ?></h3>
			<h5>Just drag &amp; drop them</h5>
			<?php else: ?>
			<h3>Top level categories</h3>
			<h5>Just drag &amp; drop them</h5>
			<?php endif; ?>
			
			<div id="container">
				<div id="order">
					<?php
					foreach($categories as $category) {
						
						if($category->parent == $childrenOf){
							
							echo "<div id='$category->cat_ID' class='lineitem'>";
							if(get_categories("hide_empty=0&taxonomy=menu_card&child_of=$category->cat_ID")){
								echo "<span class=\"childrenlink\"><a href=\"".get_bloginfo("wpurl")."/wp-admin/edit.php?post_type=menu-card&page=bordeaux-category-order&childrenOf=$category->cat_ID\">Order subcategories &raquo;</a></span>";
							}
							echo "<h4>$category->name</h4>";
							echo "</div>\n";
							
						}
					}
					?>
				</div>
				<p class="submit"><input type="submit" name="submit" Value="Save Changes"></p>
			</div>
			</form>
		</div>

		<?php
	}

	add_action('admin_head', 'bordeaux_category_order_head'); 
	add_action('admin_menu', 'bordeaux_category_order_scriptaculous');
	add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');
	add_action('init', 'bordeaux_menu');	
	add_action('admin_menu', 'add_sticky_box');	
	add_action('save_post', 'save_sticky_data');
	add_filter('manage_edit-menu-card_columns', 'add_new_gallery_columns');
	add_action('manage_menu-card_posts_custom_column', 'manage_gallery_columns', 10, 2);

?>
