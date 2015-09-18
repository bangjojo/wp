<?php
	add_shortcode('spacer', 'spacer_handler');

	function spacer_handler($atts, $content=null, $code="") {
		if($atts['style'] == 'star') {
			return '<div class="spacer-star">&nbsp;</div>';
		} elseif($atts['style'] == 'dashed') {
			return '<div class="spacer-dashed">&nbsp;</div>';
		} elseif($atts['style'] == 'thick-dashed') {
			return '<div class="spacer-thick-dashed">&nbsp;</div>';
		} elseif($atts['style'] == 'zig-zag') {
			return '<div class="spacer-zig-zag">&nbsp;</div>';
		} elseif($atts['style'] == 'yellow-ribbon') {
			return '<div class="spacer-yellow-ribbon">&nbsp;</div>';
		} elseif($atts['style'] == 'red-ribbon') {
			return '<div class="spacer-red-ribbon">&nbsp;</div>';
		} else {
			return '<div class="spacer-default">&nbsp;</div>';
		}
	}
?>