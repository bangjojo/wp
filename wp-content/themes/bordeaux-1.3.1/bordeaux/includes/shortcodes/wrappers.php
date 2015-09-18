<?php
	add_shortcode('ingredients', 'ingredients_handler');
	add_shortcode('directions', 'directions_handler');
	

	
	function ingredients_handler($atts, $content=null, $code="") {
	
		/* title */
		if(isset($atts["title"])) {
			$title_i = $atts["title"];
		} else {
			$title_i = "";
		}

			$return =  '		
					<div class="ingredients-wrapper">
						<h3>'.$title_i.'</h3><div class="ingredients">'.$content.'</div>
						<div class="ingredients-bottom">&nbsp;</div>
					</div>';
					

		return $return;
	}
	
		function directions_handler($atts, $content=null, $code="") {
	
		/* title */
		if(isset($atts["title"])) {
			$title_i = $atts["title"];
		} else {
			$title_i = "";
		}



			$return =  '		
					<div class="directions-wrapper"><h3>'.$title_i.'</h3>'.$content.'</div>';
					
			
		return $return;
	}
	
	
	
?>