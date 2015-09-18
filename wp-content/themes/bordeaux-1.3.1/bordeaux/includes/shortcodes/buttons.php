<?php
add_shortcode('button', 'button_handler');

function button_handler($atts, $content=null, $code="") {
	$class="";
	
	/* Size */
	if($atts["size"] == "small" || !isset($atts["size"])) {	
		$btn_type = "btn-1";
	} elseif ($atts["size"] == "big") {
		$btn_type = "btn-2";
	}
	$class.= $btn_type;	//btn-1
	
	/* Color */
	if($atts["color"] == "default" || !isset($atts["color"])) {
		$class.= " ".$btn_type."-color-default";
	} elseif($atts["color"] == "blue") {
		$class.= " ".$btn_type."-color-blue";
	} elseif($atts["color"] == "red") {
		$class.= " ".$btn_type."-color-red";
	} elseif($atts["color"] == "green") {
		$class.= " ".$btn_type."-color-green";
	} elseif($atts["color"] == "yellow") {
		$class.= " ".$btn_type."-color-yellow";
	} elseif($atts["color"] == "grey") {
		$class.= " ".$btn_type."-color-grey";
	} elseif($atts["color"] == "white") {
		$class.= " ".$btn_type."-color-white";
	} elseif($atts["color"] == "disabled") {
		$class.= " ".$btn_type."-color-disabled";
	}
	
	
	/* Align */
	if($atts["align"] == "left" || !isset($atts["align"])) {
		$class.= " ".$btn_type."-align-left";
	} elseif($atts["align"] == "right") {
		$class.= " ".$btn_type."-align-right";
	} elseif($atts["align"] == "center") {
		$align_center = true;
	}
	
	/* Direction */
	if($atts["direction"] == "right") {
		$class.= " btn-2-next";
	} elseif($atts["direction"] == "left") {
		$class.= " btn-2-previous";
	}
	
	/* link */
	if(isset($atts["link"])) {
		$link = $atts["link"];
	} else {
		$link = "#";
	}
	
	if($align_center == true) {
		$return = '<table class="btn-align-center"><tbody><tr><td><a class="'.$class.'" href="'.$link.'"><i>&nbsp;</i><b><span>'.$content.'</span></b><u>&nbsp;</u></a></td></tr></tbody></table>';
	} else {
		$return = '<a class="'.$class.'" href="'.$link.'"><span>'.$content.'</span></a>';
	}
	return $return;
}

?>