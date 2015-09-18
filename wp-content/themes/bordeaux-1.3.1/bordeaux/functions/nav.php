<?php
function custom_nav_btn_links($search=0, $page_num) {
	$pageURL = 'http://';
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	if ($search == "") {
	$pos = strpos($pageURL,"/page/");
	$len = strlen($pageURL);
		if($pos > 0) {
			$pos = strpos($pageURL,"/page/");
			$pageURL = substr($pageURL, 0, $pos);
			return htmlentities($pageURL."/page/".$page_num);
		}
		if (substr($pageURL,$len-1) == "/") return htmlentities($pageURL."page/".$page_num);
		else return htmlentities($pageURL."/page/".$page_num);
	}
	else {
		$pos = strpos($pageURL,"&paged=");
		$len = strlen($pageURL);
		if($pos > 0) {
			$pos = strpos($pageURL,"&paged=");
			$pageURL = substr($pageURL, 0, $pos);
			return htmlentities($pageURL."&paged=".$page_num);
		}
		if (substr($pageURL,$len-1) == "/") return htmlentities($pageURL."&paged=".$page_num);
		else return htmlentities($pageURL."&paged=".$page_num);
	}
}


function customized_nav_btns($page_num,$max_num_pages,$search=0) {

	if($page_num == ''){$page_num = '1';}
	if($max_num_pages > 1 ){
					
		$adjacents = 1;
		$page=$page_num;
		$lastpage=$max_num_pages;
		$lpm1 = $lastpage - 1;	
		$pagination = "";
		$next = $page + 1;
		$prev = $page - 1;
					
		if($lastpage > 1)
		{
					
			//previous button
			if ($page > 1) 
				$pagination.= "<a class=\"previous\" href=\"".custom_nav_btn_links($search, $prev)."\"><span>". ( __('Previous' , 'bordeaux' ))."</span></a>";
			else
				$pagination.= "<a class=\"previous\" href=\"#\"><span>". ( __('Previous' , 'bordeaux' ))."</span></a>";	
							
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<a class=\"active\" href=\"".custom_nav_btn_links($search, $counter)."\"><span>$counter</span></a>";
					else
						$pagination.= "<a href=\"".custom_nav_btn_links($search, $counter)."\"><span>$counter</span></a>";					
				}
			}
						
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<a class=\"active\" href=\"".custom_nav_btn_links($search, $counter)."\"><span>$counter</span></a>";
						else
							$pagination.= "<a href=\"".custom_nav_btn_links($search, $counter)."\"><span>$counter</span></a>";					
					}
					$pagination.= "<a href=\"#\"><span>...</span></a>";
					$pagination.= "<a href=\"".custom_nav_btn_links($search, $lpm1)."\"><span>$lpm1</span></a>";
					$pagination.= "<a href=\"".custom_nav_btn_links($search, $lastpage)."\"><span>$lastpage</span></a>";		
				}
				
				//in middle; hide some front and some back
						
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"".custom_nav_btn_links($search, 1)."\"><span>1</span></a>";
					$pagination.= "<a href=\"".custom_nav_btn_links($search, 2)."\"><span>2</span></a>";
					$pagination.= "<a href=\"#\"><span>...</span></a>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<a class=\"active\" href=\"#\"><span>".$counter."</span></a>";
						else
							$pagination.= "<a href=\"".custom_nav_btn_links($search, $counter)."\"><span>".$counter."</span></a>";					
					}
					$pagination.= "<a href=\"#\"><span>...</span></a>";
					$pagination.= "<a href=\"".custom_nav_btn_links($search, $lpm1)."\"><span>$lpm1</span></a>";
					$pagination.= "<a href=\"".custom_nav_btn_links($search, $lastpage)."\"><span>$lastpage</span></a>";	
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=\"".custom_nav_btn_links($search, 1)."\"><span>1</span></a>";
					$pagination.= "<a href=\"".custom_nav_btn_links($search, 2)."\"><span>2</span></a>";
					$pagination.= "<a href=\"#\"><span>...</span></a>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<a class=\"active\" href=\"#\"><span>$counter</span></a>";
						else
							$pagination.= "<a href=\"".custom_nav_btn_links($search, $counter)."\"><span>$counter</span></a>";					
					}
				}
			}
						
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a class=\"next\" href=\"".custom_nav_btn_links($search, $next)."\"><span>". ( __('Next' , 'bordeaux' ))."</span></a>";	
			else
				$pagination.= "<a class=\"next\" href=\"#\"><span>". ( __('Next' , 'bordeaux' ))."</span></a>";	

		}
		?>
			<!-- BEGIN .pages -->
			<div class="pages">						
				<table>
					<tr>
						<td>
							<?php echo $pagination;?>
						</td>
					</tr>
				</table>					
			<!-- END .pages -->
			</div>
		<?php
	}
}

function gallery_nav_btns($page_num,$max_num_pages,$search=0) {

	if($page_num == '' && $page_num == 0){ $page_num = '1'; }
	
	if($max_num_pages > 1 ){
		?>
			<table>
				<tr>
					<td> 
						<a class="previous" href="<?php if ($page_num > 1) { $new_page = $page_num - 1;} else {$new_page = 1;} echo custom_nav_btn_links($search, $new_page); ?>"><span> <?php printf (__('Previous','bordeaux'));?></span></a>
						<?php
							if($page_num < 4 OR $max_num_pages < 8) {
								$start = 1;
								if($max_num_pages >= 7 ) {$end = 7;}
								else $end = $max_num_pages;
							}
							else {
								if($page_num + 3 > $max_num_pages) {
									$end = $max_num_pages;
									$start = $end - 7;
								}
								else {
									$start = $page_num - 3;
									$end = $page_num + 3;
								}
							}
							
							for($i = $start; $i <= $end; $i++)
							{
								?><a <?php if($i == $page_num) {?> class="active" <?php } ?> href="<?php echo custom_nav_btn_links($search, $i); ?>"><span><?php echo $i;?></span></a><?php
							}	
						?>
						<a class="next" href="<?php if ($page_num < $max_num_pages) {$new_page = $page_num + 1;} else {$new_page = $page_num;} echo custom_nav_btn_links($search, $new_page);?>"><span><?php printf (__('Next','bordeaux'));?> </span></a>
					</td>
				</tr>
			</table>
		<?php
	}
}
?>