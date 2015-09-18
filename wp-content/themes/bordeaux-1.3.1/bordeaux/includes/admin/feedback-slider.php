<!-- BEGIN .theme_feedback_setting -->
							<div id="theme_feedback_settings">
									<form method="post" action=""  id="feedback_settings">
									<input type="hidden" name="action" value="feedback_settings"/>
									<table>
									<tr class="item">
											<td colspan="2">
												<div>
													<p class="label"><b>Feedback Rotation Settings</b></p>
												</div>
												<?php
												
													$feedback_rotation = get_option("bordeaux_feedback_rotation");
													
													$feedback_1 = get_option("bordeaux_feedback_1");
													$feedback_1_image = get_option("bordeaux_feedback_1_image");
													$feedback_1_text = get_option("bordeaux_feedback_1_text");												

													$feedback_2 = get_option("bordeaux_feedback_2");
													$feedback_2_image = get_option("bordeaux_feedback_2_image");
													$feedback_2_text = get_option("bordeaux_feedback_2_text");													
													
													$feedback_3 = get_option("bordeaux_feedback_3");
													$feedback_3_image = get_option("bordeaux_feedback_3_image");
													$feedback_3_text = get_option("bordeaux_feedback_3_text");
													
												
												?>
												<div>
													<p class="label"><span>Enable feedback rotation:</span></p>
													<div class="setting">
														<input type="checkbox" name="feedback_rotation" class="styled"  <?php if($feedback_rotation == "on") { echo 'checked="yes"'; } ?>/>
													</div>
												</div>
												
											</td>
										</tr>
										<?php if($feedback_rotation == "on") { ?>
										<tr class="item-1">
											<td colspan="2">
												<div>
													<p class="label"><b>Feedback block 1</b></p>
												</div>
												
												<div>
													<div class="label"><span>Img URL:</span>
														<a href="#" class="info"><img src="<?php echo THEME_IMAGE_URL; ?>control-panel-images/ico-info-1.png" alt="" width="10" height="11" /></a>
														<?php echo orange_themes_info_message("Suggested image size is 470x144px");?>
													</div>
													<div class="setting">
														<input class="upload input-text-2" type="text" name="feedback_1_image" id="feedback_1_image" value="<?php echo $feedback_1_image;?>" />
														<div id="feedback_1_image_button" class="upload-button upload-logo" style="padding: 10px 0 0 15px;"><a><img src="<?php echo THEME_IMAGE_CPANEL_URL;?>browse-1.png"/></a></div>
														<script type="text/javascript">
															jQuery(document).ready(function($){ bordeaux.loadUploader(jQuery("div#feedback_1_image_button"), "<?php echo THEME_FUNCTIONS_URL;?>upload-handler.php", "<?php echo THEME_UPLOADS_URL;?>");});
														</script>	
													</div>
												</div>
												<div>
													<p class="label"><span>Author Name:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="feedback_1" value="<?php echo $feedback_1;?>" style="width: 261px;"  maxlength="50"/></span>
													</div>
												</div>
												
												<div>
													<p class="label"><span>Text:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="feedback_1_text" value="<?php echo $feedback_1_text;?>" style="width: 261px;" maxlength="50"/></span>
													</div>
												</div>
																							

											</td>
										</tr>	
										
										<tr class="item-1">
											<td colspan="2">
												<div>
													<p class="label"><b>Feedback block 2</b></p>
												</div>
																								
												<div>
													<div class="label"><span>Img URL:</span>
														<a href="#" class="info"><img src="<?php echo THEME_IMAGE_URL; ?>control-panel-images/ico-info-1.png" alt="" width="10" height="11" /></a>
														<?php echo orange_themes_info_message("Suggested image size is 470x144px");?>
													</div>
													<div class="setting">
														<input class="upload input-text-2" type="text" name="feedback_2_image" id="feedback_2_image" value="<?php echo $feedback_2_image;?>" />
														<div id="feedback_2_image_button" class="upload-button upload-logo" style="padding: 10px 0 0 15px;"><a><img src="<?php echo THEME_IMAGE_CPANEL_URL;?>browse-1.png"/></a></div>
														<script type="text/javascript">
															jQuery(document).ready(function($){ bordeaux.loadUploader(jQuery("div#feedback_2_image_button"), "<?php echo THEME_FUNCTIONS_URL;?>upload-handler.php", "<?php echo THEME_UPLOADS_URL;?>");});
														</script>	
													</div>
												</div>
												
												<div>
													<p class="label"><span>Author Name:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="feedback_2" value="<?php echo $feedback_2;?>" style="width: 261px;"  maxlength="50"/></span>
													</div>
												</div>
												
												<div>
													<p class="label"><span>Text:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="feedback_2_text" value="<?php echo $feedback_2_text;?>" style="width: 261px;" maxlength="50"/></span>
													</div>
												</div>
																							

											</td>
										</tr>
										
										<tr class="item">
											<td colspan="2">
												<div>
													<p class="label"><b>Feedback block 3</b></p>
												</div>
												
												<div>
													<div class="label"><span>Img URL:</span>
														<a href="#" class="info"><img src="<?php echo THEME_IMAGE_URL; ?>control-panel-images/ico-info-1.png" alt="" width="10" height="11" /></a>
														<?php echo orange_themes_info_message("Suggested image size is 470x144px");?>
													</div>
													<div class="setting">
														<input class="upload input-text-2" type="text" name="feedback_3_image" id="feedback_3_image" value="<?php echo $feedback_3_image;?>" />
														<div id="feedback_3_image_button" class="upload-button upload-logo" style="padding: 10px 0 0 15px;"><a><img src="<?php echo THEME_IMAGE_CPANEL_URL;?>browse-1.png"/></a></div>
														<script type="text/javascript">
															jQuery(document).ready(function($){ bordeaux.loadUploader(jQuery("div#feedback_3_image_button"), "<?php echo THEME_FUNCTIONS_URL;?>upload-handler.php", "<?php echo THEME_UPLOADS_URL;?>");});
														</script>	
													</div>
												</div>
												
												<div>
													<p class="label"><span>Author Name:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="feedback_3" value="<?php echo $feedback_3;?>" style="width: 261px;"  maxlength="50"/></span>
													</div>
												</div>
												
												<div>
													<p class="label"><span>Text:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="feedback_3_text" value="<?php echo $feedback_3_text;?>" style="width: 261px;" maxlength="50"/></span>
													</div>
												</div>
																							

											</td>
										</tr>
										<?php } ?>
										
										
										<tr class="item last">
											<td class="label"></td>
											<td class="setting"><p><a href="javascript:{}" onclick="document.getElementById('feedback_settings').submit(); return false;" class="btn-2"><span>Save Changes</span></a></p></td>
										</tr>
										
									</table>
								</form>	
								
							<!-- END .theme_feedback_setting -->
							</div>