<!-- BEGIN .theme_menu_slider_setting -->
							<div id="theme_menu_slider_settings">
									<form method="post" action=""  id="menu_slider_settings">
									<input type="hidden" name="action" value="menu_slider_settings"/>
									<table>
									<?php
										$slider_enabled = get_option("bordeaux_slider_enabled");
										$slider_image_hover = get_option("bordeaux_slider_image_hover");
										
									?>
										<tr class="item">
											<td colspan="2">
												<div>
													<p class="label"><b>Custom Menu Slider</b></p>
												</div>
												<div>
													<p class="label"><span>Enable Menu Slider:</span></p>
													<div class="setting">
														<input type="checkbox" name="slider_enabled" class="styled" value="on" <?php if($slider_enabled == "on") { echo 'checked="yes"'; } ?>/>
													</div>
												</div>
												<?php if($slider_enabled=="on") { ?>
												<div>
													<p class="label"><span>Enable Image Hover:</span></p>
													<div class="setting">
														<input type="checkbox" name="slider_image_hover" class="styled" value="on" <?php if($slider_image_hover == "on") { echo 'checked="yes"'; } ?>/>
													</div>
												</div>
												<?php } ?>
											</td>
										</tr>
										
										
										<tr class="item last">
											<td class="label"></td>
											<td class="setting"><p><a href="javascript:{}" onclick="document.getElementById('menu_slider_settings').submit(); return false;" class="btn-2"><span>Save Changes</span></a></p></td>
										</tr>
										
									</table>
								</form>	
								
							<!-- END .theme_menu_slider_setting -->
							</div>