<?php get_header(); ?>
<?php include (THEME_INCLUDES . '/top.php'); ?>
<?php 
	global $query_string;
	global $post;
	//print_r($post);

	$news_style = get_option("bordeaux_news_style");

	$query = explode('%2',$query_string);
	
	if(in_array('pagename=gallery',$query)) {
		//echo "here";
	} 
	//print_r($query);
	
	if($news_style=="style_1") {
		include (THEME_INCLUDES . '/news_style_1.php');
	} else if($news_style=="style_2") {
		include (THEME_INCLUDES . '/news_style_2.php');
	}
?>
<?php include (THEME_INCLUDES . '/sidebar.php'); ?>
<?php get_footer(); ?>