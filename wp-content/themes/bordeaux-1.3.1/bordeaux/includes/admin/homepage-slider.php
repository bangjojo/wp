
 <script type="text/javascript" src="<?php echo THEME_JS_URL;?>jquery-ui-1.7.1.custom.min.js"></script>
 <script type="text/javascript">
$(document).ready(function(){ 


	$(function() {
		$(".settings ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=update_slider';
			$.post("<?php echo admin_url("admin-ajax.php");?>", order, function(theResponse){
				$("#contentRight").html(theResponse);
			});
		}
		});
	});


});

</script> 

<!-- BEGIN .theme_homepage_slider_setting -->
							<div id="theme_homepage_slider_settings">
									<form method="post" action=""  id="homepage_slider_setting">
									<input type="hidden" name="action" value="homepage_slider_setting"/>
									<table>
									<?php
										$homepage_slider_radio = get_option("bordeaux_homepage_slider");
										$homepage_image = get_option("bordeaux_homepage_image");
										if($has_homepage) {
									?>
										<tr class="item">
										<?php if($homepage_slider_radio=="on") { ?>
											<td colspan="2">
												<div class="label">
													<span><b>Homepage slide sequence</b></span><a href="#" class="info"><img src="<?php echo THEME_IMAGE_URL; ?>control-panel-images/ico-info-1.png" alt="" width="10" height="11" /></a>
													<?php echo orange_themes_info_message("To sort the slides just drag and drop them!");?>

																	
												</div>
												<?php 
													$cat = get_option("bordeaux_homepage_slider_cat");
													$my_query = new WP_Query('cat='.$cat.'&showposts=5&orderby=menu_order&order=ASC');
												?>
												<div class="settings">
													<ul>
													<?php if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
													<?php global $post; $thePostID = $post->ID;?>
													<?php $image = get_post_thumb($thePostID,45,45,'bordeaux_slider_image');  ?>
													<li id="recordsArray_<?php the_ID(); ?>">
														<div class="element last">
															<div class="content">
																<div class="image">
																	<a href="<?php the_permalink();?>"><img src="<?php echo $image['src']; ?>" alt="<?php the_title(); ?>" width="45" height="45" /></a>
																</div>
																<div class="text">
																	<p><b>Title:</b><?php the_title(); ?></p>
																	<p><b>Excerpt:</b><?php the_excerpt(); ?></p>
																</div>
															</div>
														</div>
													</li>
													<?php endwhile; else: ?>
													<?php endif; ?>			
													</ul>
												</div>
												
											</td>
										<?php } ?>
										</tr>
										<tr class="item">
											<td colspan="2">
												<div>
													<p class="label"><b>Custom Homepage slider</b></p>
												</div>
												<div>
													<p class="label"><span>Enable slider:</span></p>
													<div class="setting">
														 
														<input type="radio" name="homepage_slider" id="homepage_slider_radio_1" value="on" <?php if($homepage_slider_radio == "on") { echo 'checked="yes"'; } ?> class="styled"/>
													</div>
												</div>
												<div>
													<p class="label"><span>Use single image:</span></p>
													<div class="setting">
														 
														<input type="radio" name="homepage_slider" id="homepage_slider_radio_2" value="single" <?php if($homepage_slider_radio == "single") { echo 'checked="yes"'; } ?> class="styled" />
													</div>
												</div>								
												<div>
													<p class="label"><span>Disable slider:</span></p>
													<div class="setting">
														<input type="radio" name="homepage_slider" id="homepage_slider_radio_3" value="off" <?php if($homepage_slider_radio == "off") { echo 'checked="yes"'; } ?> class="styled" />
													</div>
												</div>	
											</td>
										</tr>												
												<?php if($homepage_slider_radio=="single") { ?>

										<tr class="item">
											<td colspan="2">
												<div>
													<p class="label"><b>Set Up The Image</b></p>
												</div>
												<div>
													<p class="label"><span>Url:</span></p>
													<div class="setting">
														<input class="upload input-text-2" type="text" name="homepage_image" id="homepage_image" value="<?php echo $homepage_image;?>" />
														<div id="homepage_image_button" class="upload-button upload-logo" style="padding: 10px 0 0 15px;"><a><img src="<?php echo THEME_IMAGE_CPANEL_URL;?>browse-1.png"/></a></div>
														<script type="text/javascript">
															jQuery(document).ready(function($){ bordeaux.loadUploader(jQuery("div#homepage_image_button"), "<?php echo THEME_FUNCTIONS_URL;?>upload-handler.php", "<?php echo THEME_UPLOADS_URL;?>");});
														</script>														</div>
												</div>
												<?php } ?>
											</td>
										</tr>
												<?php } else { ?>	

										<tr class="item">
											<td colspan="2">
												<div class="element">
													<div class="content">
														<div class="text">
															<p><b>You have NOT enabled homepage.</b></p>
															<p>To use homepage slider, you must first create two <a href="<?php  echo home_url();?>/wp-admin/post-new.php?post_type=page">new pages</a>, and one of them assign to "<b>Homepage</b>" template. Give each page a title, but avoid adding any text.</p>
															<p>Then enable homepage in <a href="<?php  echo home_url();?>/wp-admin/options-reading.php">wordpress reading settings</a> (See "Front page displays" option). Select your previously created pages from both dropdowns and save changes.</p>
														</div>
													</div>
												</div>
											</td>
										</tr>
												<?php } ?>

										<?php if($homepage_slider_radio == "on") { ?>
										<tr class="item">
											<td colspan="2">
												<div>
													<p class="label"><b>Slider Category</b></p>
												</div>
												
												<div style="margin-left:33px;">
													<?php
													global $wpdb;
													$cat = intval(get_option('bordeaux_homepage_slider_cat'));
													$table = $wpdb->prefix."term_taxonomy";
													$table2 = $wpdb->prefix."terms";
													$data = $wpdb->get_results("SELECT tt.term_id, t.name FROM $table as tt, $table2 as t WHERE tt.taxonomy = 'category' AND tt.term_id = t.term_id");
													
													if(count($data) > 0)
													{
														?>
														<select name="homepage_slider_cat" class="styled">
															<?php
															foreach($data as $d)
															{
																?><option value="<?php echo $d->term_id;?>" <?php if($cat==$d->term_id) echo 'SELECTED';?>><?php echo $d->name;?></option><?php
															}
															?>
														</select>
														<?php
													}
													?>
													<br/><br/>
													Select post category, that contains posts you wish to show in the homepage. It might be a good idea, to create a new specialized category for this purpose. Only the 5 latest posts will be shown.
													
												</div>
											</td>
										</tr>
										
										<tr class="item-1">
											<td class="label"><b>Slider Effects</b></td>
										</tr>

										<tr class="item-1">
										<?php
											$homepage_slider_title=get_option("bordeaux_homepage_slider_title");
											$homepage_slider_direction=get_option("bordeaux_homepage_slider_direction");
											$homepage_slider_effect=get_option("bordeaux_homepage_slider_effect");
											$homepage_slider_delay=get_option("bordeaux_homepage_slider_delay");
											$homepage_slider_strips=get_option("bordeaux_homepage_slider_strips");
											$homepage_slider_strip_speed=get_option("bordeaux_homepage_slider_strip_speed");
											$homepage_slider_title_speed=get_option("bordeaux_homepage_slider_title_speed");
										
										?>
											<td class="label">Title Position</td>
											<td class="setting">
														<select name="homepage_slider_title" class="styled">
															<option value="default" <?php if($homepage_slider_title=="default" || !$homepage_slider_title) echo "selected=\"selected\"";?>>Default</option>
															<option value="top" <?php if($homepage_slider_title=="top") echo "selected=\"selected\"";?>>Top</option>
															<option value="right" <?php if($homepage_slider_title=="right") echo "selected=\"selected\"";?>>Right</option>
															<option value="bottom" <?php if($homepage_slider_title=="bottom") echo "selected=\"selected\"";?>>Bottom</option>
															<option value="left" <?php if($homepage_slider_title=="left") echo "selected=\"selected\"";?>>Left</option>
														</select>
											</td>
										</tr>
										<tr class="item-1">
											<td class="label">Slide Direction</td>
											<td class="setting">
														<select name="homepage_slider_direction" class="styled">
															<option value="default" <?php if($homepage_slider_direction=="default" || !$homepage_slider_direction) echo "selected=\"selected\"";?>>Default</option>
															<option value="left" <?php if($homepage_slider_direction=="left") echo "selected=\"selected\"";?>>Left</option>
															<option value="right" <?php if($homepage_slider_direction=="right") echo "selected=\"selected\"";?>>Right</option>
															<option value="alternate" <?php if($homepage_slider_direction=="alternate") echo "selected=\"selected\"";?>>Alternate</option>
															<option value="random" <?php if($homepage_slider_direction=="random") echo "selected=\"selected\"";?>>Random</option>
														</select>
											</td>
										</tr>
										<tr class="item-1">
											<td class="label">Slide Effect</td>
											<td class="setting">
														<select name="homepage_slider_effect" class="styled">
															<option value="default" <?php if($homepage_slider_effect=="default" || !$homepage_slider_effect) echo "selected=\"selected\"";?>>Default</option>
															<option value="curtain" <?php if($homepage_slider_effect=="curtain") echo "selected=\"selected\"";?>>Curtain</option>
															<option value="zipper" <?php if($homepage_slider_effect=="zipper") echo "selected=\"selected\"";?>>Zipper</option>
															<option value="wave" <?php if($homepage_slider_effect=="wave") echo "selected=\"selected\"";?>>Wave</option>
															<option value="fountain" <?php if($homepage_slider_effect=="fountain") echo "selected=\"selected\"";?>>Fountain</option>
															<option value="cascade" <?php if($homepage_slider_effect=="cascade") echo "selected=\"selected\"";?>>Cascade</option>
															<option value="fade" <?php if($homepage_slider_effect=="fade") echo "selected=\"selected\"";?>>Fade</option>
															<option value="random" <?php if($homepage_slider_effect=="random") echo "selected=\"selected\"";?>>Random</option>
														</select>
											</td>
										</tr>
										<tr class="item-1">
											<td class="label">Slide Delay</td>
											<td class="setting">
														<select name="homepage_slider_delay" class="styled">
															<option value="default" <?php if($homepage_slider_delay=="default" || !$homepage_slider_delay) echo "selected=\"selected\"";?>>Default</option>
															<option value="1000" <?php if($homepage_slider_delay=="1000") echo "selected=\"selected\"";?>>1 second</option>
															<option value="2000" <?php if($homepage_slider_delay=="2000") echo "selected=\"selected\"";?>>2 second</option>
															<option value="3000" <?php if($homepage_slider_delay=="3000") echo "selected=\"selected\"";?>>3 second</option>
															<option value="4000" <?php if($homepage_slider_delay=="4000") echo "selected=\"selected\"";?>>4 second</option>
															<option value="5000" <?php if($homepage_slider_delay=="5000") echo "selected=\"selected\"";?>>5 second</option>
															<option value="6000" <?php if($homepage_slider_delay=="6000") echo "selected=\"selected\"";?>>6 second</option>
															<option value="7000" <?php if($homepage_slider_delay=="7000") echo "selected=\"selected\"";?>>7 second</option>
														</select>
											</td>
										</tr>
										<tr class="item-1">
											<td class="label">Slide Strip Count</td>
											<td class="setting">
														<select name="homepage_slider_strips" class="styled">
															<option value="default" <?php if($homepage_slider_strips=="default" || !$homepage_slider_strips) echo "selected=\"selected\"";?>>Default</option>
															<option value="10" <?php if($homepage_slider_strips=="10") echo "selected=\"selected\"";?>>10</option>
															<option value="15" <?php if($homepage_slider_strips=="15") echo "selected=\"selected\"";?>>15</option>
															<option value="20" <?php if($homepage_slider_strips=="20") echo "selected=\"selected\"";?>>20</option>
															<option value="25" <?php if($homepage_slider_strips=="25") echo "selected=\"selected\"";?>>25</option>
															<option value="30" <?php if($homepage_slider_strips=="30") echo "selected=\"selected\"";?>>30</option>
															<option value="35" <?php if($homepage_slider_strips=="35") echo "selected=\"selected\"";?>>35</option>
															<option value="40" <?php if($homepage_slider_strips=="40") echo "selected=\"selected\"";?>>40</option>
															<option value="50" <?php if($homepage_slider_strips=="50") echo "selected=\"selected\"";?>>50</option>
															<option value="60" <?php if($homepage_slider_strips=="60") echo "selected=\"selected\"";?>>60</option>
															<option value="70" <?php if($homepage_slider_strips=="70") echo "selected=\"selected\"";?>>70</option>
														</select>
											</td>
										</tr>
										<tr class="item-1">
											<td class="label">Slide Strip Speed</td>
											<td class="setting">
														<select name="homepage_slider_strip_speed" class="styled">
															<option value="default" <?php if($homepage_slider_strip_speed=="default" || !$homepage_slider_strip_speed) echo "selected=\"selected\"";?>>Default</option>
															<option value="100" <?php if($homepage_slider_strip_speed=="100") echo "selected=\"selected\"";?>>0.1 second</option>
															<option value="200" <?php if($homepage_slider_strip_speed=="200") echo "selected=\"selected\"";?>>0.2 second</option>
															<option value="300" <?php if($homepage_slider_strip_speed=="300") echo "selected=\"selected\"";?>>0.3 second</option>
															<option value="400" <?php if($homepage_slider_strip_speed=="400") echo "selected=\"selected\"";?>>0.4 second</option>
															<option value="500" <?php if($homepage_slider_strip_speed=="500") echo "selected=\"selected\"";?>>0.5 second</option>
															<option value="600" <?php if($homepage_slider_strip_speed=="600") echo "selected=\"selected\"";?>>0.6 second</option>
															<option value="700" <?php if($homepage_slider_strip_speed=="700") echo "selected=\"selected\"";?>>0.7 second</option>
															<option value="800" <?php if($homepage_slider_strip_speed=="800") echo "selected=\"selected\"";?>>0.8 second</option>
															<option value="900" <?php if($homepage_slider_strip_speed=="900") echo "selected=\"selected\"";?>>0.9 second</option>
															<option value="1000" <?php if($homepage_slider_strip_speed=="1000") echo "selected=\"selected\"";?>>1 second</option>
														</select>
											</td>
										</tr>
										<tr class="item-1">
											<td class="label">Slide Title Speed</td>
											<td class="setting">
														<select name="homepage_slider_title_speed" class="styled">
															<option value="default" <?php if($homepage_slider_title_speed=="default" || !$homepage_slider_title_speed) echo "selected=\"selected\"";?>>Default</option>
															<option value="100" <?php if($homepage_slider_title_speed=="100") echo "selected=\"selected\"";?>>0.1 second</option>
															<option value="200" <?php if($homepage_slider_title_speed=="200") echo "selected=\"selected\"";?>>0.2 second</option>
															<option value="300" <?php if($homepage_slider_title_speed=="300") echo "selected=\"selected\"";?>>0.3 second</option>
															<option value="400" <?php if($homepage_slider_title_speed=="400") echo "selected=\"selected\"";?>>0.4 second</option>
															<option value="500" <?php if($homepage_slider_title_speed=="500") echo "selected=\"selected\"";?>>0.5 second</option>
															<option value="600" <?php if($homepage_slider_title_speed=="600") echo "selected=\"selected\"";?>>0.6 second</option>
															<option value="700" <?php if($homepage_slider_title_speed=="700") echo "selected=\"selected\"";?>>0.7 second</option>
															<option value="800" <?php if($homepage_slider_title_speed=="800") echo "selected=\"selected\"";?>>0.8 second</option>
															<option value="900" <?php if($homepage_slider_title_speed=="900") echo "selected=\"selected\"";?>>0.9 second</option>
															<option value="1000" <?php if($homepage_slider_title_speed=="1000") echo "selected=\"selected\"";?>>1 second</option>

														</select>
											</td>
										</tr>
										<?php } ?>
										<?php if($has_homepage) { ?>
										<tr class="item last">
											<td class="label"></td>
											<td class="setting"><p><a href="javascript:{}" onclick="document.getElementById('homepage_slider_setting').submit(); return false;" class="btn-2"><span>Save Changes</span></a></p></td>
										</tr>
										<?php } ?>
									</table>
								</form>	
								
							<!-- END .theme_homepage_slider_settings -->
							</div>