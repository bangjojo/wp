<?php
	add_shortcode('caption', 'caption_handler');

	

	
	function caption_handler($atts, $content=null, $code="") {
	
		/* title */
		if(isset($atts["title"])) {
			$title_i = $atts["title"];
		} else {
			$title_i = "";
		}
		
		/* url */
		if(isset($atts["url"])) {
			$url_i = $atts["url"];
		} else {
			$url_i = "";
		}
		$blog_url = get_template_directory_uri();
			$return =  '		
					<table class="image-caption aligncenter">
						<tr><td class="tl"><td class="tm"></td><td class="tr"></td></tr>
						<tr>
							<td class="ml"></td>
							<td class="mm">
								<a href="'.$url_i.'" target="blank"><img src="'.$blog_url.'/timthumb.php?src='.$url_i.'&amp;w=342&amp;h=227&amp;zc=1&amp;q=100" alt="'.$title_i.'"/></a>
								<p>'.$title_i.'</p>
							</td>
							<td class="mr"></td>
						</tr>
						<tr><td class="bl"><td class="bm"></td><td class="br"></td></tr>
						</table>';
					

		return $return;
	}

	
	
	
?>