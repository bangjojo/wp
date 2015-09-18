<?php get_header(); ?>
<?php
$news_style = get_option("bordeaux_news_style");
$post_type = get_post_type();

	if($post_type == "gallery") {
		include (THEME_INCLUDES . '/gallery-single.php');
	} else if($post_type == "menu-card") {
		include (THEME_INCLUDES . '/menu-card-single.php');
	}  else {
	include (THEME_INCLUDES . '/top.php');
	
	if($news_style=="style_1") {
		include (THEME_INCLUDES . '/news_single_style_1.php');
	} else if($news_style=="style_2") {
		include (THEME_INCLUDES . '/news_single_style_2.php');
	} else 
	{	include (THEME_INCLUDES . '/news_single_style_1.php'); 
	}
	
	include (THEME_INCLUDES . '/sidebar_single.php');
	get_footer();
}



?>