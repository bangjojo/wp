<?php
/*
Template Name: Reservations
*/	
?>
<?php get_header(); ?>
<?php include (THEME_INCLUDES .'/top.php'); ?>
			<?php 
			$slider_enabled=get_option('bordeaux_slider_enabled')	;
			if ($slider_enabled == "on") 
			{
				include (THEME_INCLUDES . '/slider.php');
			} else if ($slider_enabled == "off") 
			{
				echo "<div class=\"no-content-slider\">&nbsp;</div>";
			}
			?>	
			<?php
				$work_time_from = get_option("bordeaux_time_from");
				$work_time_till = get_option("bordeaux_time_till");
				$max_places = get_option("bordeaux_table_count");
			?>
		<?php
			$reservations="Yes";
			
			if(isset($_POST["u_name"])){
				$u_name=$_POST["u_name"];
			}
			if(isset($_POST["reservationdate"])){
				$reservationdate=$_POST["reservationdate"];
			}
			if(isset($_POST["fulltime"])){
				$fulltime=$_POST["fulltime"];
				$date=date("Y-n-j",strtotime($fulltime));
				$date_res=strtotime(date("Y-n-j",strtotime($fulltime)));
				$dat=date("Y-n",strtotime($fulltime));
			}


			$date_now=strtotime(date("Y-n-j"));
			if(isset($_POST["phone"])){
				$phone=mysql_real_escape_string($_POST["phone"]);
			}
			if(isset($_POST["email"])){
				$email=mysql_real_escape_string($_POST["email"]);
			}
			if(isset($_POST["timefrom"])){
				$timefrom=mysql_real_escape_string($_POST["timefrom"]);
			}
			if(isset($_POST["minutes"])){
				$minutes=($_POST["minutes"]);
			}
			if(isset($_POST["minutes"]) && $_POST["timefrom"]){
				$timefrom=$timefrom.":".$minutes;
			}
			if(isset($_POST["notes"])){
				$notes=mysql_real_escape_string($_POST["notes"]);
			}
			$error="";
			

			if(isset($_POST["addnew"])){
				$addnew=$_POST["addnew"];
					

				$before="<tr><td colspan=\"2\"><div class=\"top-error-message\">";
				$after="</div></td></tr>";
				
				if($reservationdate=="dd / mm / gggg") $error.=$before."Please set up your reservation date!".$after;
				if($date_res<$date_now) $error.=$before."Please indicate the correct date!".$after;
				if(!$u_name) $error.=$before."Please enter your name!".$after;
				if(!$phone) $error.=$before."Please enter your phone!".$after;
				if(!$email) $error.=$before."Please enter your e-mail!".$after;
				if($email && !preg_match("/@/i", "$email")) $error.=$before."Please enter a valid e-mail!".$after;
				if($timefrom=="no") $error.=$before."Please enter reservation time!".$after;
				if($timefrom && $minutes=="no") $error.=$before."Please enter reservation time!".$after;

			}
			if(isset($addnew) && !$error)
			{
				$wpdb->query( $wpdb->prepare("INSERT INTO bordeaux_reservation(name, phone, email, notes, reservationFrom, reservationDate, reservated, dat ) 
				VALUES ('$u_name', '$phone', '$email', '$notes', '$timefrom', '$date', NOW(), '$dat' )"  ) ); 
			}										
			
		
		?>

		<?php
			$title_befor_calendar = stripslashes(get_option("bordeaux_title_befor_calendar"));
			$txt_befor_calendar = stripslashes(get_option("bordeaux_txt_befor_calendar"));
			$title_after_calendar = stripslashes(get_option("bordeaux_title_after_calendar"));
			$txt_after_calendar = stripslashes(get_option("bordeaux_txt_after_calendar"));
			$title_after_form = stripslashes(get_option("bordeaux_title_after_form"));
			$txt_after_form = stripslashes(get_option("bordeaux_txt_after_form"));
		?>
			<!-- BEGIN .content-wrapper -->
			<div class="content-wrapper<?php if($slider_enabled == "off") echo " no-content-slider-wrapper";?>">
			
				<!-- BEGIN .content -->
				<div class="content<?php if($slider_enabled == "off") echo " no-content-slider-content";?>">
				
					<!-- BEGIN .homepage-wrapper -->
					<div class="homepage-wrapper">
					
						<table>
							<tr>
							
								<td class="main-content-wrapper">
								
									<div class="top"></div>
								
									<div class="content-wrapper">
										
										<div class="content">
											
											
											<!-- BEGIN .left-side -->
											<div class="left-side">
												<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
												<div class="main-title">
													<span><b><?php the_title();?></b></span>
													<a href="<?php echo home_url(); ?>"><?php printf ( __( 'back to Homepage' , 'bordeaux' ));?></a>
												</div>
												
												<!-- BEGIN .post -->
												<div class="post">
												<?php
													if(!isset($addnew) || $error)
													{
												?>
													<h3><?php echo $title_befor_calendar;?></h3>

													<p><?php echo $txt_befor_calendar;?></p>
													
													<!-- BEGIN .reservations-wrapper -->
													<div class="reservations-wrapper">
													<div id="Calendar" align="center" style="display: none;"></div>

													<!-- END .reservations-wrapper -->
													</div>
													
													<h3><?php echo $title_after_calendar;?></h3>
													
													<p><?php echo $txt_after_calendar;?></p>

													
													
													<form action="" name="AddressForm" id="AddressForm" method="post">
													<input type="hidden"  name="addnew" value="yes" />
													<input type="hidden"  name="fulltime" class="fulltime" value=""/>
													<input type="hidden"  name="selected_day" class="selected_day" value=" "/>
														<!-- BEGIN .reservations-wrapper -->
														<div class="reservations-wrapper">
														
															<table class="reservations">
															
																<?php echo $error;?>

																<tr>
																	<td class="label"><label><?php printf ( __( 'Date:' , 'bordeaux' ));?></label></td>
																	<td>
																		<p class="input-text-1" id="date_input"><span><input type="text"  name="reservationdate" maxlength="10" value="dd / mm / gggg" class="date" DISABLED /></span></p>
																		<p class="error-message" id="date_message" style="display: none;"><s id="date_error"></s></p>
																	</td>
																</tr>
																
																<tr>
																	<td class="label"><label><?php printf ( __( 'Time:' , 'bordeaux' ));?></label></td>
																	<td class="time">
																	
																		
																			<select name="timefrom" class="timefrom" id="time_input">
																				<option value="no"><?php printf ( __( 'Hour' , 'bordeaux' ));?></option>
																				<?php work_time($work_time_from,$work_time_till);?>
																			</select>
																				<b>:</b>
																			<select name="minutes" >
																				<option value="00"><?php printf ( __( 'Minutes' , 'bordeaux' ));?></option>
																				<option>00</option>
																				<option>15</option>
																				<option>30</option>
																				<option>45</option>
																				
																			</select>
																			<p class="error-message" id="time_message" style="display: none; margin:0 0 0 50px;"><s id="time_error"></s></p>

																	
																	<td>
																		
																	
																	</td>
																</tr>
																
																<tr>
																	<td class="label"><label><?php printf ( __( 'Name:' , 'bordeaux' ));?></label></td>
																	<td>
																		<p class="input-text-1" id="name_input"><span><input type="text" name="u_name" style="width:268px;"/></span></p>
																		<p class="error-message" id="name_message" style="display: none;"><s id="name_error"></s></p>
																		
																	</td>
																</tr>
																
																<tr><td class="spacer" colspan="2"></td></tr>
																
																<tr>
																	<td class="label"><label><?php printf ( __( 'Phone:' , 'bordeaux' ));?></label></td>
																	<td>
																		<p class="input-text-1" id="phone_input"><span><input type="text" name="phone" style="width:268px;"/></span></p>
																		<p class="error-message" id="phone_message" style="display: none;"><s id="phone_error"></s></p>
																	</td>
																</tr>
																
																<tr><td class="spacer" colspan="2"></td></tr>
																
																<tr>
																	<td class="label"><label><?php printf ( __( 'E-mail:' , 'bordeaux' ));?></label></td>
																	<td>
																		<p class="input-text-1" id="mail_input"><span><input type="text" name="email" style="width:268px;"/></span></p>
																		<p class="error-message" id="mail_message" style="display: none;"><s id="mail_error"></s></p>
																	</td>
																</tr>
																
																<tr><td class="spacer" colspan="2"></td></tr>
																
																<tr>
																	<td class="label notes"><label><?php printf ( __( 'Notes' , 'bordeaux' ));?></label></td>
																	<td>
																		<div class="text-area-2">
																			<div class="top">
																				<textarea name="notes"></textarea>
																			</div>
																			<div class="bottom"></div>
																		</div>
																	</td>
																</tr>
																
																<tr><td class="spacer" colspan="2"></td></tr>
																
																<tr>
																	<td></td>
																	<td colspan="2"><p class="show-all"><a href="javascript:{}" onclick="return Validate(); submitform();"><span><?php printf ( __( 'Send reservation' , 'bordeaux' ));?></span></a></p></td>
																</tr>

															</table>
														
														<!-- END .reservations-wrapper -->
														</div>	
															
													</form>

													<h3><?php echo $title_after_form;?></h3>
													
													<p><?php echo $txt_after_form;?></p>
													<?php } ?>													
													<?php
													if(isset($addnew) && !$error)
													{
													?>
													<div class="success">
														<p><b><?php printf ( __( 'Thanks!' , 'bordeaux' ));?></b></p>
														<p><?php printf ( __( 'Your registration has been sent!<br/>We will contact you as soon as possible.' , 'bordeaux' ));?></p>
													</div>
													<?php } ?>
												<!-- END .post -->
												</div>
												
												<div class="clear"></div>
												
												<p class="show-all last"><a href="<?php echo home_url(); ?>"><span><?php printf ( __( 'back to Homepage' , 'bordeaux' ));?></span></a></p>
											<?php endwhile; else: ?>
												<p><?php printf ( __('Sorry, no posts matched your criteria.' , 'bordeaux' )); ?></p>
											<?php endif; ?>
											<!-- END .left-side -->
											</div>
											
											
											<!-- BEGIN .right-side -->
											<div class="right-side">
											
												<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Reservation Sidebar") ) : ?>
												<?php endif; ?>

											<!-- END .right-side -->
											</div>
											
											
											<div class="clear"></div>
											

										</div>
										
									</div>
									
								</td>
								<!-- END .homepage-about -->

							</tr>
							
							<tr>
								<td class="main-content-wrapper-bottom"><p class="back-top"><a href="#top"><span><?php printf ( __( 'go back to the top' , 'bordeaux' ));?></span></a></p></td>
							</tr>
							
						</table>

					<!-- END .homepage-wrapper -->
					</div>


				<!-- END .content -->
				</div>
				
			<!-- END .content-wrapper -->
			</div>


												
			<?php get_footer(); ?>