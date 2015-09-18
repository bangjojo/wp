<?php
	add_shortcode('blockquote', 'blockquote_handler');
	

	
	function blockquote_handler($atts, $content=null, $code="") {

		if($atts['style'] == 'curly-brackets') {
			$return =  '
					<table class="blockquote-curly-brackets">
						<tr><td class="tl"></td><td></td><td class="tr"></td></tr>
						<tr>
							<td class="ml"></td>
							<td class="mm">
								<blockquote>
								'.$content.'	
								</blockquote>
							</td>
							<td class="mr"></td>
						</tr>
						<tr><td class="bl"></td><td></td><td class="br"></td></tr>
					</table>';
			
		} elseif($atts['style'] == 'quote-marks') {
			$return =  '		
					<div class="blockquote-quote-marks">
						<blockquote>
							'.$content.'
						</blockquote>
					</div>';
					
		} elseif($atts['style'] == 'dashed-box') {
			$return =  '<blockquote class="blockquote-dashed-box">'.$content.'</blockquote>';
					
		} elseif($atts['style'] == 'curly-brackets') {
			$return =  '		
					<div class="blockquote-curly-brackets">
						<blockquote>
							'.$content.'
						</blockquote>
					</div>';
					
		}		elseif($atts['style'] == 'quotation-marks') {
			$return =  '<blockquote class="blockquote-quotation-marks">'.$content.'</blockquote>';
		} else {
			$return =  '<blockquote>'.$content.'</blockquote>';
		}
		return $return;
	}
?>