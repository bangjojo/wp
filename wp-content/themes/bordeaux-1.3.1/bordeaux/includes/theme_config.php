<?php
	function orange_themes_css() {
		wp_enqueue_script('jquery');
		if(isset($_GET["page"]) && $_GET["page"]=="theme-configuration") {
			echo '<link rel="stylesheet" href="'.THEME_CSS_URL.'orange-themes-control-panel.css" type="text/css" />';
			echo '<script src="'.THEME_JS_URL.'jquery.min.js" type="text/javascript"></script>';
			echo '<script src="'.THEME_JS_URL.'custom-form-elements.js" type="text/javascript"></script>'; 
		}
		echo '<script src="'.THEME_JS_URL.'options.js" type="text/javascript"></script>';
		echo '<script src="'.THEME_JS_URL.'ajaxupload.js" type="text/javascript"></script>';
	
		if(isset($_GET["page"]) && $_GET["page"]=="other-themes") {
			echo '<link rel="stylesheet" href="'.THEME_CSS_URL.'more-themes.css" type="text/css" />';
		}
		
	}
	add_action('admin_head', 'orange_themes_css');


function wp_register_theme_activation_hook($code, $function) {
    $optionKey="theme_is_activated_" . $code;
    if(!get_option($optionKey)) {
        call_user_func($function);
        update_option($optionKey , 1);
    }
}

function wp_register_theme_deactivation_hook($code, $function) {
    $GLOBALS["wp_register_theme_deactivation_hook_function" . $code]=$function;
 
    $fn=create_function('$theme', ' call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option("theme_is_activated_' . $code. '");');

    add_action("switch_theme", $fn);
}

 function my_theme_activate() {
 
 		global $wpdb;
		
		$theme_logo = get_template_directory_uri()."/images/logo-bordeaux-1.png";
		add_option("bordeaux_logo",$theme_logo);
		add_option("bordeaux_cufon","on");
		add_option("bordeaux_homepage_slider","off");
		add_option("bordeaux_homepage_widget_title","Events");
		add_option('boderaux_currency_category', "$");
		add_option("bordeaux_title_befor_calendar", "<a href=\"#\">1. Pick your desired date for reservation</a>");										
		add_option("bordeaux_txt_befor_calendar", "Duis sed lobortis mi. Sed sed nibh urna, id eleifend velit. Cras quis risus hendrerit massa elementum pretium. Suspendisse potenti. Etiam sollicitudin ornare interdum. Lorem ipsum dolor sit amet.");										
		add_option("bordeaux_title_after_calendar","<a href=\"#\">2. Specify exact time &amp; other details for your reservation</a>");										
		add_option("bordeaux_txt_after_calendar", "Duis sed lobortis mi. Sed sed nibh urna, id eleifend velit. Cras quis risus hendrerit massa elementum pretium.");										
		add_option("bordeaux_title_after_form", "<a href=\"#\">Things to know, before you make your reservation</a>");										
		add_option("bordeaux_txt_after_form", "In sed odio libero, vitae elementum urna. Vestibulum et ligula sed lectus blandit pretium in non metus. Donec dapibus, ipsum vel vehicula tempor, purus urna vestibulum mi, eu tempor elit turpis vitae enim. Duis porttitor mi sed nisi rhoncus at porta tellus sagittis. Duis eget sapien metus, gravida auctor nulla.");		
		add_option("bordeaux_slider_image_hover","on");
		add_option('bordeaux_news_style', "style_1");
		
		add_option("bordeaux_time_from","9");
		add_option("bordeaux_time_till","19");
		add_option("bordeaux_table_count","10");

		if($wpdb->get_var("bordeaux_reservation") != 'bordeaux_reservation') 
		{
			$sql = "CREATE TABLE bordeaux_reservation (
			id int(10) NOT NULL AUTO_INCREMENT,
			name varchar(100) NOT NULL,
			phone varchar(30) NOT NULL,
			email varchar(100) NOT NULL,
			notes text NOT NULL,
			reservationFrom varchar(5) NOT NULL,
			reservationDate varchar(10) NOT NULL,
			reservated datetime NOT NULL,
			dat varchar(8) NOT NULL,
			approve varchar(3) NOT NULL,
			edited datetime NOT NULL,
			UNIQUE KEY id (id)
			);";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
  }
  
  wp_register_theme_activation_hook('bordeaux', 'my_theme_activate');



add_action('admin_menu', 'theme_menu');

function theme_menu() {
	add_menu_page('Bordeaux Management', 'Bordeaux Management', 'administrator', 'theme-configuration', 'theme_configuration',get_template_directory_uri().'/images/control-panel-images/logo-orangethemes-1.png');
	add_submenu_page("edit.php?post_type=menu-card", 'Bordeaux Menu Category Order', 'Bordeaux Menu Category Order', 'administrator', "bordeaux-category-order", 'bordeaux_category_order');
}

	




function theme_configuration() {

	$pageURL= 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
	
	if(isset($_POST["action"])){ 
		$action = $_POST['action'];
	
		
		//////Theme General Settings//////
		
		if($action == "page_settings") 
		{
			//add theme logo
			$theme_logo = $_POST["logo_upload"];
			if($theme_logo) {
				update_option("bordeaux_logo",$theme_logo);
			}
			else delete_option(bordeaux_logo);
		
			//cufon settings
			$cufon = $_POST["cufon"];
			if($cufon == "on") {
				update_option("bordeaux_cufon",$cufon);
			}
			else {
				update_option("bordeaux_cufon","off");
			}
			
			//News style settings
			$news_style = $_POST["news_style"];
			update_option("bordeaux_news_style",$news_style);
			
			//Currency settings
			$currency = $_POST["currency_category"];
			update_option('boderaux_currency_category', $currency);
			
			$p = "theme_general_settings";
			$pid = "theme_page_settings";
		
		}
		
		
		//add gallery pages
		if($action == "gallery_settings") 
		{
			$gallery_items = $_POST["show_gallery_items"];
			update_option("bordeaux_gallery_items",$gallery_items);

			$p = "theme_general_settings";
			$pid = "theme_gallery_settings";
		}

		
		//Post thumbnails
		if($action == "blog_settings")
		{
			$single_thumb = $_POST["show_single_thumb"];
			$no_image_thumb = $_POST["show_no_image_thumb"];
			$first_thumb = $_POST["show_first_thumb"];
			
			if($first_thumb == "on") {
				update_option("bordeaux_show_first_thumb",$first_thumb);
			}
			else {
				update_option("bordeaux_show_first_thumb","off");
			}
			
			if($single_thumb == "on") {
				update_option("bordeaux_show_single_thumb",$single_thumb);
			}
			else {
				update_option("bordeaux_show_single_thumb","off");
			}
			
			if($no_image_thumb == "on") {
				update_option("bordeaux_show_no_image_thumb",$no_image_thumb);
			}
			else {
				update_option("bordeaux_show_no_image_thumb","off");
			}

			///Post settings
			$show_first_pictures = $_POST["show_first_pictures"];
			$show_first_objects = $_POST["show_first_objects"];
			
			if($show_first_pictures == "on") {
				update_option("bordeaux_show_first_pictures",$show_first_pictures);
			}
			else {
				update_option("bordeaux_show_first_pictures","off");
			}
			
			if($show_first_objects == "on") {
				update_option("bordeaux_show_first_objects",$show_first_objects);
			}
			else {
				update_option("bordeaux_show_first_objects","off");
			}
			
			$p = "theme_general_settings";
			$pid = "theme_blog_settings";
		}
		
		if($action == "homepage_settings")  {
			
			///Add info block
			$homepage_infoblocks_enabled = $_POST["homepage_enable_infoblocks"];
			
			if($homepage_infoblocks_enabled == "on") {
				update_option("bordeaux_homepage_infoblocks_enabled",$homepage_infoblocks_enabled);
			} else {
				update_option("bordeaux_homepage_infoblocks_enabled","off");
			}
			
			if($homepage_infoblocks_enabled == "on" && isset($_POST["ib1_title"])) {
				$ib1_title = $_POST["ib1_title"];
				$ib1_image = $_POST["ib1_image"];
				$ib1_url = $_POST["ib1_url"];
				$ib1_text = $_POST["ib1_text"];
				
				$ib2_title = $_POST["ib2_title"];
				$ib2_image = $_POST["ib2_image"];
				$ib2_url = $_POST["ib2_url"];
				$ib2_text = $_POST["ib2_text"];
				
				$ib3_title = $_POST["ib3_title"];
				$ib3_image = $_POST["ib3_image"];
				$ib3_url = $_POST["ib3_url"];
				$ib3_text = $_POST["ib3_text"];
				
				$ib4_title = $_POST["ib4_title"];
				$ib4_image = $_POST["ib4_image"];
				$ib4_url = $_POST["ib4_url"];
				$ib4_text = $_POST["ib4_text"];
						
				update_option("ib1_title",$ib1_title);
				update_option("ib1_image",$ib1_image);
				update_option("ib1_url",$ib1_url);
				update_option("ib1_text",$ib1_text);
				
				update_option("ib2_title",$ib2_title);
				update_option("ib2_image",$ib2_image);
				update_option("ib2_url",$ib2_url);
				update_option("ib2_text",$ib2_text);
				
				update_option("ib3_title",$ib3_title);
				update_option("ib3_image",$ib3_image);
				update_option("ib3_url",$ib3_url);
				update_option("ib3_text",$ib3_text);
				
			}
			
			
			///Add hemepage info block
			$homepage_footer = $_POST["homepage_enable_footer"];
			$homepage_footer_post = $_POST["homepage_footer_post"];
			$homepage_enable_popular_offerings = $_POST["homepage_enable_popular_offerings"];
			
			if($homepage_footer == "on") {
				update_option("bordeaux_homepage_footer",$homepage_footer);
			} else {
				update_option("bordeaux_homepage_footer","off");
			}	
			
			if($homepage_enable_popular_offerings == "on") {
				update_option("bordeaux_homepage_enable_popular_offerings",$homepage_enable_popular_offerings);
			} else {
				update_option("bordeaux_homepage_enable_popular_offerings","off");
			}
			if($homepage_enable_popular_offerings == "on" && isset($_POST["popular_menu_title"]) && isset($_POST["popular_menu_text"])) {
			
				$popular_menu_title = $_POST["popular_menu_title"];
				$popular_menu_text = $_POST["popular_menu_text"];
			
				update_option("bordeaux_popular_menu_title",$popular_menu_title);
				update_option("bordeaux_popular_menu_text",$popular_menu_text);
			
			}
			
			if($homepage_footer_post != "") {
				update_option("bordeaux_homepage_footer_post",$homepage_footer_post);
			}
			
			
			$homepage_widget_title = $_POST["homepage_widget_title"];
			$homepage_widget_cat = $_POST["homepage_widget_cat"];
			$homepage_widget_button = $_POST["homepage_widget_button"];
			
			update_option("bordeaux_homepage_widget_title",$homepage_widget_title);
			update_option("bordeaux_homepage_widget_cat",$homepage_widget_cat);
			update_option("bordeaux_homepage_widget_button",$homepage_widget_button);
			
			$p = "theme_general_settings";
			$pid = "theme_homepage_settings";
		}
		
		if($action == "contact_settings") {
		
			//add share information
			$twitter = $_POST["twitter"];
			$facebook = $_POST["facebook"];
			$linkedin = $_POST["linkedin"];
			$rss = $_POST["rss"];
			$rss_icon = $_POST["show_rss_icon"];
					
			update_option("bordeaux_twitter_url",$twitter);
			update_option("bordeaux_facebook_url",$facebook);
			update_option("bordeaux_linkedin_url",$linkedin);
			if($rss != get_bloginfo("rss_url")) {
				update_option("bordeaux_rss_url",$rss);
			}
			update_option("show_rss_icon",$rss_icon);
			
			
			//add google location
			$google_loc = $_POST["google_loc"];
		
			global $wpdb;
			$google_loc_o = $wpdb->get_var($wpdb->prepare("SELECT post_content FROM $wpdb->posts WHERE post_type = 'boderaux_google_loc' ORDER BY ID DESC"));
		
			if(!$google_loc_o) 
			{

				$my_post = array(
					'post_title' => 'google location',
					'post_content' => $google_loc,
					'post_type' => 'boderaux_google_loc',
					'post_author' => $user_ID,
					'post_parent' => 0,
					'menu_order' => 0,
					'post_password' => '123',
					'import_id' => 0);

					wp_insert_post( $my_post );
			}
			else{
				
				global $wpdb;
				$wpdb->query("UPDATE $wpdb->posts SET post_content='".$google_loc."' WHERE post_type = 'boderaux_google_loc'"  ); 

			}
			
			
			///contact form settings
			$contact_mail = $_POST["bordeaux_contact_mail"];
			update_option("bordeaux_contact_mail",$contact_mail);
			
			
			//add contacts
			$phone = $_POST["bordeaux_phone"];
			$mail = $_POST["bordeaux_mail"];
			$address = $_POST["bordeaux_rest_address"];
			$name = $_POST["bordeaux_rest_name"];
					
			update_option("bordeaux_phone",$phone);
			update_option("bordeaux_mail",$mail);
			update_option("bordeaux_rest_address",$address);
			update_option("bordeaux_rest_name",$name);
			
			
			$p = "theme_general_settings";
			$pid = "theme_contact_settings";
		
		}
		
		
		//////Theme Slider Settings//////
		if($action == "homepage_slider_setting") {
			
			//Homepage slider settings
			$homepage_slider = $_POST["homepage_slider"];
			if($homepage_slider != "") {
				update_option("bordeaux_homepage_slider",$homepage_slider);
			} else {
				update_option("bordeaux_homepage_slider","off");
			}
			

			$homepage_slider_cat = $_POST["homepage_slider_cat"];
			$show_featured_tag = $_POST["show_featured_tag"];
		
			if($homepage_slider_cat != "") {
				update_option("bordeaux_homepage_slider_cat",$homepage_slider_cat);
			}
			
			if($show_featured_tag != "" ) {
				update_option("bordeaux_show_featured_tag",$show_featured_tag);
			} else {
				update_option("bordeaux_show_featured_tag","off");
			}
			
			//Homepage single image
			$homepage_image=$_POST['homepage_image'];
			update_option("bordeaux_homepage_image",$homepage_image);
			
			
			//Homepage slider effects
			$homepage_slider_title=$_POST['homepage_slider_title'];
			$homepage_slider_direction=$_POST['homepage_slider_direction'];
			$homepage_slider_effect=$_POST['homepage_slider_effect'];
			$homepage_slider_delay=$_POST['homepage_slider_delay'];
			$homepage_slider_strips=$_POST['homepage_slider_strips'];
			$homepage_slider_strip_speed=$_POST['homepage_slider_strip_speed'];
			$homepage_slider_title_speed=$_POST['homepage_slider_title_speed'];
			
			update_option("bordeaux_homepage_slider_title",$homepage_slider_title);
			update_option("bordeaux_homepage_slider_direction",$homepage_slider_direction);
			update_option("bordeaux_homepage_slider_effect",$homepage_slider_effect);
			update_option("bordeaux_homepage_slider_delay",$homepage_slider_delay);
			update_option("bordeaux_homepage_slider_strips",$homepage_slider_strips);
			update_option("bordeaux_homepage_slider_strip_speed",$homepage_slider_strip_speed);
			update_option("bordeaux_homepage_slider_title_speed",$homepage_slider_title_speed);
			
			
			$p = "theme_slider_settings";
			$pid = "theme_homepage_slider_settings";
		}
		
		// Menu slider settings
		if($action == "menu_slider_settings") {
			
			if($_POST["slider_enabled"] == "on") {
				update_option("bordeaux_slider_enabled",$_POST['slider_enabled']);
			}
			else {
				update_option("bordeaux_slider_enabled","off");
			}		
			
			if($_POST["slider_image_hover"] == "on") {
				update_option("bordeaux_slider_image_hover",$_POST['slider_image_hover']);
			}
			else {
				update_option("bordeaux_slider_image_hover","off");
			}

			$p = "theme_slider_settings";
			$pid = "theme_menu_slider_settings";
		}

		// Feedback rotation
		if($action == "feedback_settings") {
			
			//Feedback rotation
			$feedback_rotation = $_POST["feedback_rotation"];
			if($feedback_rotation != "") {
				update_option("bordeaux_feedback_rotation",$feedback_rotation);
			} else {
				update_option("bordeaux_feedback_rotation","off");
			}

			
			$feedback_1 = $_POST["feedback_1"];
			$feedback_1_image = $_POST["feedback_1_image"];
			$feedback_1_text = $_POST["feedback_1_text"];
			
			$feedback_2 = $_POST["feedback_2"];
			$feedback_2_image = $_POST["feedback_2_image"];
			$feedback_2_text = $_POST["feedback_2_text"];
			
			$feedback_3 = $_POST["feedback_3"];
			$feedback_3_image = $_POST["feedback_3_image"];
			$feedback_3_text = $_POST["feedback_3_text"];
			
			
			update_option("bordeaux_feedback_1",$feedback_1);
			update_option("bordeaux_feedback_1_image",$feedback_1_image);
			update_option("bordeaux_feedback_1_text",$feedback_1_text);		
			
			update_option("bordeaux_feedback_2",$feedback_2);
			update_option("bordeaux_feedback_2_image",$feedback_2_image);
			update_option("bordeaux_feedback_2_text",$feedback_2_text);		
			
			update_option("bordeaux_feedback_3",$feedback_3);
			update_option("bordeaux_feedback_3_image",$feedback_3_image);
			update_option("bordeaux_feedback_3_text",$feedback_3_text);

			
			$p = "theme_slider_settings";
			$pid = "theme_feedback_settings";
		}
		
		//////Theme Reservation Settings//////
		if($action == "reservation_settingss") {

			//Set up work time
			$work_time_from = $_POST["bordeaux_time_from"];
			$work_time_till = $_POST["bordeaux_time_till"];

			update_option("bordeaux_time_from",$work_time_from);
			update_option("bordeaux_time_till",$work_time_till);
				
			//Set reservation support mail
			$reservation_support_mail = $_POST["reservation_support_mail"];
			update_option("bordeaux_reservation_mail",$reservation_support_mail);
			
			//Set reservation settings
			$table_count = $_POST["bordeaux_table_count"];
			update_option("bordeaux_table_count",$table_count);
			
			
			$title_befor_calendar = $_POST["title_befor_calendar"];
			$txt_befor_calendar = $_POST["txt_befor_calendar"];
			$title_after_calendar = $_POST["title_after_calendar"];
			$txt_after_calendar = $_POST["txt_after_calendar"];
			$title_after_form = $_POST["title_after_form"];
			$txt_after_form = $_POST["txt_after_form"];
													
			update_option("bordeaux_title_befor_calendar",$title_befor_calendar);										
			update_option("bordeaux_txt_befor_calendar",$txt_befor_calendar);										
			update_option("bordeaux_title_after_calendar",$title_after_calendar);										
			update_option("bordeaux_txt_after_calendar",$txt_after_calendar);										
			update_option("bordeaux_title_after_form",$title_after_form);										
			update_option("bordeaux_txt_after_form",$txt_after_form);	


			//Day book out
			$full_year = $_POST["full_year"];
			$full_month = $_POST["full_month"];
			$full_day = $_POST["full_day"];	

			if($full_year!="na" || $full_month!="na" || $full_day!="na") {
				
				$full_date=$full_year."-".$full_month."-".$full_day;
				
				global $wpdb;
				$wpdb->query( $wpdb->prepare("INSERT INTO bordeaux_reservation(approve, reservationDate) VALUES('out', '$full_date')")); 
				
			}
			
													
			$p = "theme_reservation_settings";
			$pid = "theme_reservation_settingss";
		}	
		

		
		//Theme Reservations
		if($action == "reservation_approve") {

			
			$p = "theme_reservation_settings";
			$pid = "theme_reservation";
		}

	}

	//remove full day
	if($_GET["action"] == "delete_full_day") {
		$day_id=$_GET["day"];
		
		if(is_numeric($day_id)) {
		
			global $wpdb;
			$wpdb->query("DELETE FROM bordeaux_reservation WHERE id='$day_id'"); 
			
			$p = "theme_reservation_settings";
			$pid = "theme_reservation_settingss";

			echo '<script type="text/javascript">window.location = "admin.php?page=theme-configuration&p='.$p.'&pid='.$pid.'"</script>';
		
		}
	}

	?>
	
		<script type="text/javascript">
				jQuery(document).ready(function() {
				
				jQuery('.config_tab').click(function() {
				//General menu
					jQuery("#theme_general_settings").hide();
					jQuery("#theme_slider_settings").hide();
					jQuery("#theme_reservation_settings").hide();
					jQuery("#theme_documentation_settings").hide();


				//General menu tabs	
					jQuery("#tab_theme_general_settings").removeClass("active");
					jQuery("#tab_theme_slider_settings").removeClass("active");
					jQuery("#tab_theme_reservation_settings").removeClass("active");
					jQuery("#tab_theme_documentation_settings").removeClass("active");

				//First tabs	
					jQuery("#tab_theme_homepage_slider_settings").addClass("active");
					jQuery("#tab_theme_page_settings").addClass("active");
					jQuery("#tab_theme_reservation").addClass("active");
					jQuery("#tab_theme_documentation").addClass("active");
					
					jQuery("#theme_page_settings").show();
					jQuery("#theme_homepage_slider_settings").show();
					jQuery("#theme_reservation").show();
					jQuery("#theme_documentation").show();
				
				//Other tabs
					jQuery("#theme_menu_slider_settings").hide();
					jQuery("#theme_blog_settings").hide();
					jQuery("#theme_gallery_settings").hide();
					jQuery("#theme_homepage_settings").hide();
					jQuery("#theme_contact_settings").hide();
					jQuery("#theme_reservation_settingss").hide();
					jQuery("#theme_feedback_settings").hide();
					
					
					jQuery("#tab_theme_menu_slider_settings").removeClass("active");
					jQuery("#tab_theme_blog_settings").removeClass("active");
					jQuery("#tab_theme_homepage_settings").removeClass("active");
					jQuery("#tab_theme_gallery_settings").removeClass("active");
					jQuery("#tab_theme_contact_settings").removeClass("active");
					jQuery("#tab_theme_reservation_settingss").removeClass("active");
					jQuery("#tab_theme_feedback_settings").removeClass("active");
					
					var id = jQuery(this).attr("id");
					id = id.substring(4);
					show(id);
					
					jQuery("#tab_"+id).addClass("active");
					return false;
				});
			
				function show(page) {
					jQuery("#theme_general_settings").hide();
					jQuery("#theme_slider_settings").hide();
					jQuery("#theme_reservation_settings").hide();

					jQuery("#"+page).show();
					
					jQuery("#tab_theme_general_settings").removeClass("active");
					jQuery("#tab_theme_slider_settings").removeClass("tab-active");
					jQuery("#tab_theme_reservation_settings").removeClass("active");

					jQuery("#tab_"+page).addClass("active");
					
				}
				var page = '<?php if($p == "") { $p = $_GET["p"]; } if($p=="") { echo "theme_general_settings"; } else { echo $p; } ?>';
				show(page);
			});
			
			jQuery(document).ready(function() {
				
				jQuery('.config_stab').click(function() {

					jQuery("#theme_homepage_slider_settings").hide();
					jQuery("#theme_menu_slider_settings").hide();
					jQuery("#theme_page_settings").hide();
					jQuery("#theme_blog_settings").hide();
					jQuery("#theme_contact_settings").hide();
					jQuery("#theme_gallery_settings").hide();
					jQuery("#theme_reservation").hide();
					jQuery("#theme_feedback_settings").hide();
					jQuery("#theme_documentation_settings").hide();
					

					jQuery("#tab_theme_homepage_slider_settings").removeClass("active");
					jQuery("#tab_theme_menu_slider_settings").removeClass("active");
					jQuery("#tab_theme_page_settings").removeClass("active");
					jQuery("#tab_theme_blog_settings").removeClass("active");
					jQuery("#tab_theme_contact_settings").removeClass("active");
					jQuery("#tab_theme_gallery_settings").removeClass("active");
					jQuery("#tab_theme_reservation").removeClass("active");
					jQuery("#tab_theme_reservation_settingss").removeClass("active");
					jQuery("#tab_theme_feedback_settings").removeClass("active");
					jQuery("#tab_theme_documentation_settings").removeClass("active");
					
					var id = jQuery(this).attr("id");
					id = id.substring(4);
					show(id);
					
					jQuery("#tab_"+id).addClass("active");
					return false;
				});
			
				function show(sub_page) {
					jQuery("#theme_homepage_slider_settings").hide();
					jQuery("#theme_menu_slider_settings").hide();
					jQuery("#theme_page_settings").hide();
					jQuery("#theme_blog_settings").hide();
					jQuery("#theme_contact_settings").hide();
					jQuery("#theme_gallery_settings").hide();
					jQuery("#theme_homepage_settings").hide();
					jQuery("#theme_reservation_settingss").hide();
					jQuery("#theme_reservation").hide();
					jQuery("#theme_feedback_settings").hide();
					jQuery("#theme_documentation_settings").hide();
					
					jQuery("#"+sub_page).show();
					
					jQuery("#tab_theme_homepage_slider_settings").removeClass("active");
					jQuery("#tab_theme_menu_slider_settings").removeClass("active");
					jQuery("#tab_theme_page_settings").removeClass("active");
					jQuery("#tab_theme_blog_settings").removeClass("active");
					jQuery("#tab_theme_contact_settingss").removeClass("active");
					jQuery("#tab_theme_gallery_settings").removeClass("active");
					jQuery("#tab_theme_homepage_settings").removeClass("active");
					jQuery("#tab_theme_reservation_settingss").removeClass("active");
					jQuery("#tab_theme_reservation").removeClass("active");
					jQuery("#tab_theme_feedback_settings").removeClass("active");
					jQuery("#tab_theme_documentation").removeClass("active");

					jQuery("#tab_"+sub_page).addClass("active");
					
				}
				
				var sub_page = '<?php if($pid == "") {$pid = $_GET["pid"];} if($pid=="") { echo "theme_page_settings"; } else { echo $pid; } ?>';
				show(sub_page);
			});
			
			var global_image_box = '';
			
			function show_pics(box) {
				if(box == 1) {
					global_image_box = document.getElementById("logo_box");
					document.getElementById("pic_list").style.display = "inline";
				} else if(box == 2) {
					global_image_box = document.getElementById("footer_image_box");
					document.getElementById("pic_list").style.display = "inline";
				} else {
					global_image_box = document.getElementById("homepage_single_image");
					document.getElementById("pic_list_homepage").style.display = "inline";
				}
				
			}
			
			function hide_pics() {
				document.getElementById("pic_list").style.display = "none";
			}
			
			function hide_pics_homepage() {
				document.getElementById("pic_list_homepage").style.display = "none";
			}
			
			function copy_src(obj) {
				var src = obj.getAttribute("src");
				global_image_box.value = src;
				hide_pics();
			}
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				$(".info").toggle(
				  function () {
				    $(this).siblings('.popup-help').removeClass('popup-help-hidden');
				  },
				  function () {
				    $(this).siblings('.popup-help').addClass('popup-help-hidden');
				  }
				);

			});
			$(document).ready(function() {
				var height = $('.popup-help').height();
				$('.popup-help').css('margin-top',-height/2+9);

			});
			$(document).ready(function() {
				
				jQuery('.close').click(function() {
				jQuery(".popup-help").addClass('popup-help-hidden');
				});
			});
		</script>
		
		<div class="wrap">
			<!-- BEGIN .control-panel-wrapper -->
			<div class="control-panel-wrapper">
			
				<!-- BEGIN .header -->
				<div class="header">
					<a href="http://www.orange-themes.com" class="logo" target="blank">&nbsp;</a>
					<p><a href="http://www.themeforest.net/user/orange-themes/portfolio?ref=orange-themes" target="blank"><b>get more from Orange Themes!</b></a></p>
				<!-- END .header -->
				</div>
				
				<!-- BEGIN .content -->
				<div class="content">

					<!-- BEGIN .menu -->
					<div class="menu">
						<a href="#" class="general<?php if($_GET["p"] == "theme_general_settings" || $_GET["p"] == "") { ?> active<?php } ?> config_tab" id="tab_theme_general_settings"><span>General</span></a>
						<a href="#" class="slider<?php if($_GET["p"] == "theme_slider_settings") { ?> active<?php } ?> config_tab" id="tab_theme_slider_settings"><span>Slider Settings</span></a>
						<a href="#" class="reservations<?php if($_GET["p"] == "theme_reservation_settings") { ?> active<?php } ?> config_tab" id="tab_theme_reservation_settings"><span>Reservations</span></a>
						
						<a href="#" class="documentation<?php if($_GET["p"] == "theme_documentation_settings") { ?> active<?php } ?> config_tab" id="tab_theme_documentation_settings"><span>Documentation</span></a>
					<!-- END .menu -->
					</div>
					
					<div id="theme_general_settings">
						<!-- BEGIN .settings -->
						<div class="settings">
						
							<!-- BEGIN .tabs -->
							<div class="tabs">
								<a href="#" class="<?php if($_GET["pid"] == "theme_page_settings" || $_GET["pid"] == "") { ?> active<?php } ?> config_stab" id="tab_theme_page_settings"><span>Page</span></a>
								<a href="#" class="<?php if($_GET["pid"] == "theme_blog_settings") { ?> active<?php } ?> config_stab" id="tab_theme_blog_settings"><span>Blog</span></a>
								<a href="#" class="<?php if($_GET["pid"] == "theme_homepage_settings") { ?> active<?php } ?> config_stab" id="tab_theme_homepage_settings"><span>Homepage</span></a>
								<a href="#" class="<?php if($_GET["pid"] == "theme_gallery_settings") { ?> active<?php } ?> config_stab" id="tab_theme_gallery_settings"><span>Gallery</span></a>
								<a href="#" class="<?php if($_GET["pid"] == "theme_contact_settings") { ?> active<?php } ?> config_stab" id="tab_theme_contact_settings"><span>Contact</span></a>
								
							<!-- END .tabs -->
							</div>
					
							<?php include THEME_ADMIN_INCLUDES."page.php";?>
							<?php include THEME_ADMIN_INCLUDES."blog.php";?>
							<?php include THEME_ADMIN_INCLUDES."homepage.php";?>
							<?php include THEME_ADMIN_INCLUDES."gallery.php";?>
							<?php include THEME_ADMIN_INCLUDES."contact.php";?>
							<?php orange_themes_follow();?>

						<!-- END .settings -->		
						</div>	

					<!-- END .theme_general_settings -->
					</div>
					
					<div id="theme_slider_settings">
						<!-- BEGIN .settings -->
						<div class="settings">
						
							<!-- BEGIN .tabs -->
							<div class="tabs">
								<a href="#" class="<?php if($_GET["pid"] == "theme_homepage_slider_settings" || $_GET["pid"] == "") { ?> active<?php } ?> config_stab" id="tab_theme_homepage_slider_settings"><span>Homepage Slider</span></a>
								<a href="#" class="<?php if($_GET["pid"] == "theme_menu_slider_settings") { ?> active<?php } ?> config_stab" id="tab_theme_menu_slider_settings"><span>Menu Slider</span></a>
								<a href="#" class="<?php if($_GET["pid"] == "theme_feedback_settings") { ?> active<?php } ?> config_stab" id="tab_theme_feedback_settings"><span>Feedback Rotation</span></a>
							<!-- END .tabs -->
							</div>
							
							<?php include THEME_ADMIN_INCLUDES."homepage-slider.php";?>
							<?php include THEME_ADMIN_INCLUDES."menu-slider.php";?>
							<?php include THEME_ADMIN_INCLUDES."feedback-slider.php";?>
							<?php orange_themes_follow();?>
							
						<!-- END .settings -->
						</div>
						
					</div>
				
					<div id="theme_reservation_settings">
					
						<!-- BEGIN .settings -->
						<div class="settings">
						
							<!-- BEGIN .tabs -->
							<div class="tabs">
								<a href="#" class="<?php if($_GET["pid"] == "theme_reservation" || $_GET["pid"] == "") { ?> active<?php } ?> config_stab" id="tab_theme_reservation"><span>Reservations</span></a>
								<a href="#" class="<?php if($_GET["pid"] == "theme_reservation_settingss") { ?> active<?php } ?> config_stab" id="tab_theme_reservation_settingss"><span>Settings</span></a>
							<!-- END .tabs -->
							</div>
							
							<?php include THEME_ADMIN_INCLUDES."reservations.php";?>
							<?php include THEME_ADMIN_INCLUDES."reservation-settings.php";?>
							

							<?php orange_themes_follow();?>
							
						<!-- END .settings -->
						</div>
						
					</div>
					
					<div id="theme_documentation_settings">
						<!-- BEGIN .settings -->
						<div class="settings">
						
							<!-- BEGIN .tabs -->
							<div class="tabs">
								<a href="#" class="<?php if($_GET["pid"] == "theme_documentation" || $_GET["pid"] == "") { ?> active<?php } ?> config_stab" id="tab_theme_documentation"><span>Documentation</span></a>
							<!-- END .tabs -->
							</div>
							
							<?php include THEME_ADMIN_INCLUDES."documentation.php";?>
							<?php orange_themes_follow();?>
							
						<!-- END .settings -->
						</div>
						
					</div>
				<!-- END .content -->
				</div>
			
			<!-- END .control-panel-wrapper -->
			</div>

		</div>
	<?php
}
?>