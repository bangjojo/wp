		
							<div id="theme_contact_settings">
								<form method="post" action=""  id="contact_settings">
									<input type="hidden" name="action" value="contact_settings"/>
									<table>
										<tr class="item">
											<td colspan="2">
												<div>
													<p class="label"><b>Contact Form</b></p>
												</div>
												<?php

													$contact_mail = get_option("bordeaux_contact_mail");
												
												?>											
												
												<div>
													<p class="label"><span>Email:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="bordeaux_contact_mail" value="<?php echo $contact_mail;?>" style="width: 261px;" /></span>
													</div>
												</div>
												

												
											</td>
										</tr>
										<tr class="item">
											<td colspan="2">
												<div>
													<p class="label"><b>Contact Information</b></p>
												</div>
												<?php
													$phone = get_option("bordeaux_phone");
													$mail = get_option("bordeaux_mail");
													$name = filter_var(stripslashes(get_option("bordeaux_rest_name")), FILTER_SANITIZE_SPECIAL_CHARS);
													$address = filter_var(stripslashes(get_option("bordeaux_rest_address")), FILTER_SANITIZE_SPECIAL_CHARS);
												
												?>
												<div>
													<p class="label"><span>Restaurant Name:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="bordeaux_rest_name" value="<?php echo $name;?>" style="width: 261px;" /></span>
													</div>
												</div>
												
												<div>
													<p class="label"><span>Address:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="bordeaux_rest_address" value="<?php echo $address;?>" style="width: 261px;" /></span>
													</div>
												</div>
												
												<div>
													<p class="label"><span>Phone:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="bordeaux_phone" value="<?php echo $phone;?>" style="width: 261px;" /></span>
													</div>
												</div>												
												
												<div>
													<p class="label"><span>Email:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="bordeaux_mail" value="<?php echo $mail;?>" style="width: 261px;" /></span>
													</div>
												</div>
												

												
											</td>
										</tr>
										
										<tr class="item">
											<td colspan="2">
												<div>
													<p class="label"><b>Social Networks and RSS</b></p>
												</div>
												<?php

												
													$twitter = get_option("bordeaux_twitter_url");
													$facebook = get_option("bordeaux_facebook_url");
													$linkedin = get_option("bordeaux_linkedin_url");
													$rss = get_option("bordeaux_rss_url");
													if($rss == "") $rss = get_bloginfo("rss_url");
													$rss_icon = get_option("show_rss_icon");
												?>
												<div>
													<p class="label"><span>Twitter:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="twitter" value="<?php echo $twitter;?>" style="width: 261px;" /></span>
													</div>
												</div>
												
												<div>
													<p class="label"><span>Facebook:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="facebook" value="<?php echo $facebook;?>" style="width: 261px;" /></span>
													</div>
												</div>
												
												<div>
													<p class="label"><span>Linkedin:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="linkedin" value="<?php echo $linkedin;?>" style="width: 261px;" /></span>
													</div>
												</div>												
												
												<div>
													<p class="label"><span>RSS:</span></p>
													<div class="setting">
														<span class="input-text-1"><input type="text" name="rss" value="<?php echo $rss;?>" style="width: 261px;" /></span>
													</div>
												</div>
												
												<div>
													<p class="label"><span>Show RSS icon:</span></p>
													<div class="setting">
														<input type="checkbox" name="show_rss_icon" class="styled" <?php if($rss_icon) {echo "checked=\"yes\""; } ?>/>
													</div>
												</div>
												
											</td>
										</tr>
										
										<tr class="item">
											<td colspan="2">
												<div>
													<div class="label">
														<span>Google maps</span>
														<a href="#" class="info"><img src="<?php echo THEME_IMAGE_URL; ?>control-panel-images/ico-info-1.png" alt="" width="10" height="11" /></a>
														<?php echo orange_themes_info_message("More information You can find in the docomentation");?>
													</div>
												</div>
												<?php
													global $wpdb;
													$google_loc = $wpdb->get_var($wpdb->prepare("SELECT post_content FROM $wpdb->posts WHERE post_type = 'boderaux_google_loc' ORDER BY ID DESC"));
														
												?>
												<div>
													<p class="label"><span>Your location:</span></p>
													<div class="setting">
														<textarea name="google_loc" class="text-area-1"><?php echo filter_var(stripslashes($google_loc), FILTER_SANITIZE_SPECIAL_CHARS);?></textarea>
													</div>
												</div>
												
											</td>
										</tr>	
										
										<tr class="item last">
											<td class="label"></td>
											<td class="setting"><p><a href="javascript:{}" onclick="document.getElementById('contact_settings').submit(); return false;" class="btn-2"><span>Save Changes</span></a></p></td>
										</tr>
										
									</table>
								</form>
								
							</div>