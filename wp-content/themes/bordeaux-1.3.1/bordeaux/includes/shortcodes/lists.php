<?php
	add_shortcode('list', 'list_handler');
	add_shortcode('item', 'list_handler');

	function list_handler($atts, $content=null, $code="") {
		if($code == "item") {
			return '<li>'.$content.'</li>';
		} elseif($code == "list") {
			if($atts['style'] == 'light') {
				$content = '<ul class="light">'.$content.'</ul>';
			} elseif($atts['style'] == "checkmark") {
				$content = '<ul class="checkmark">'.$content.'</ul>';
			} elseif($atts['style'] == "cross") {
				$content = '<ul class="cross">'.$content.'</ul>';
			} elseif($atts['style'] == "block") {
				$content = '<ul class="block">'.$content.'</ul>';
			} elseif($atts['style'] == "star") {
				$content = '<ul class="star">'.$content.'</ul>';
			} elseif($atts['style'] == "default") {
				$content = '<ul class="list-style-default">'.$content.'</ul>';
			} else {
				$content = '<ul class="list-style-default">'.$content.'</ul>';
			}
		}
		$content = do_shortcode($content);
		$content = remove_br($content);
		return $content;
	}
	
?>