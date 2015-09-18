<?php
/*
Template Name: Contact Page
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
		
			$mail_to = get_option("bordeaux_contact_mail"); 
			if(isset($_POST["phone"])){
				$phone=stripslashes($_POST["phone"]);
			}
			if(isset($_POST["email"])){
				$email=stripslashes($_POST["email"]);
			}
			if(isset($_POST["u_name"])){
				$u_name=stripslashes($_POST["u_name"]);
			}
			if(isset($_POST["message"])){
				$message=stripslashes($_POST["message"]);
			}
			
			$ip = $_SERVER['REMOTE_ADDR'];


			$error="";
			if(isset($_POST["addnew"])){
				$addnew=$_POST["addnew"];
														
				if($addnew)
				{
					$before="<tr><td colspan=\"2\"><div class=\"top-error-message\">";
					$after="</div></td></tr>";
					
					if(!$u_name) $error.=$before.( __( 'Please enter your name!' , 'bordeaux' )).$after;
					if(!$email) $error.=$before.( __( 'Please enter your e-mail!' , 'bordeaux' )).$after;
					if($email && !preg_match("/@/i", "$email")) $error.=$before.( __( 'Please enter a valid e-mail!' , 'bordeaux' )).$after;
					if(!$message) $error.=$before.( __( 'Please enter your message!' , 'bordeaux' )).$after;

				}
			}
			
			if((isset($addnew) && !$error))
			{	

				$subject = ( __( 'From' , 'bordeaux' ))." ".get_bloginfo('name')." ".( __( 'Contact Page' , 'bordeaux' ));
				
				$eol="\n";
				$mime_boundary=md5(time());
				$headers = "From: ".$email." <".$email.">".$eol;
				$headers .= "Reply-To: ".$email."<".$email.">".$eol;
				$headers .= "Message-ID: <".time()."-".$email.">".$eol;
				$headers .= "X-Mailer: PHP v".phpversion().$eol;
				$headers .= 'MIME-Version: 1.0'.$eol;
				$headers .= "Content-Type: text/html; charset=UTF-8; boundary=\"".$mime_boundary."\"".$eol.$eol;
				


				ob_start(); 
		?>
<?php printf ( __( 'Message:' , 'bordeaux' ));?> <?php echo $message;?>
<div style="padding-top:100px;">
<?php printf ( __( 'Name:' , 'bordeaux' ));?> <?php echo $u_name;?><br/>
<?php printf ( __( 'Phone:' , 'bordeaux' ));?> <?php echo $phone;?><br/>
<?php printf ( __( 'E-mail:' , 'bordeaux' ));?> <?php echo $email;?><br/>
<?php printf ( __( 'IP Address:' , 'bordeaux' ));?> <?php echo $ip;?><br/>
</div>
		<?php
				$message = ob_get_clean();
				$mail_sent = mail($mail_to,$subject,$message,$headers);
			}
			
		?>
		
<script language = "Javascript">
		
	function Validate() 
	{

		var errors = "";
		var reason_name = "";
		var reason_mail = "";
		var reason_message = "";


		reason_name += validateName(document.getElementById('contact-form').u_name);
		reason_mail += validateEmail(document.getElementById('contact-form').email);
		reason_message += validateMessage(document.getElementById('contact-form').message);



		if (reason_name != "") 
		{
			$("#name_error").text(reason_name).fadeIn(1000);
			jQuery("#name_input").addClass("input-text-1-error");
			document.getElementById('name_error').style.display = 'block';
			errors = "Error";
		}
		else{
			jQuery("#name_input").removeClass("input-text-1-error");
			document.getElementById('name_error').style.display = 'none';
		}


		if (reason_mail != "") 
		{
			$("#mail_error").text(reason_mail).fadeIn(1000);
			jQuery("#mail_input").addClass("input-text-1-error");
			document.getElementById('mail_error').style.display = 'block';
			errors = "Error";
		}
		else{
			jQuery("#mail_input").removeClass("input-text-1-error");
			document.getElementById('mail_error').style.display = 'none';
		}
		
		if (reason_message != "") 
		{
			$("#message_error").text(reason_message).fadeIn(1000);
			jQuery("#message_input").addClass("input-text-1-error");
			document.getElementById('message_error').style.display = 'block';
			errors = "Error";
		}
		else{
			jQuery("#message_input").removeClass("input-text-1-error");
			document.getElementById('message_error').style.display = 'none';
		}
		
		if (errors != ""){
			return false;
		}
		
		document.getElementById('contact-form').submit(); return false;
	}
	
		function validateName(fld) 
	{

		var error = "";
		
		if (fld.value == '')
		{
			error = "<?php printf ( __( "You didn't enter Your First Name." , 'bordeaux' ));?>\n";
		}
		else if ((fld.value.length < 2) || (fld.value.length > 50))
		{
			error = "<?php printf ( __( "First Name is the wrong length." , 'bordeaux' ));?>\n";
		}


		return error;
	}
	
		function validateEmail(fld) 
	{

		var error="";
		var illegalChars = /^[^@]+@[^@.]+\.[^@]*\w\w$/;
		
		if (fld.value == ""){
			error = "<?php printf ( __( "You didn't enter an email address." , 'bordeaux' ));?>\n";
		}
		else if ( fld.value.match( illegalChars ) == null){
			error = "<?php printf ( __( "The email address contains illegal characters." , 'bordeaux' ));?>\n";
		}


		return error;

	}
	
	function validateMessage(fld) 
	{

		var error = "";
		
		if (fld.value == '')
		{
			error = "<?php printf ( __( "You didn't enter Your message." , 'bordeaux' ));?>\n";
		}
		else if (fld.value.length<3)
		{
			error = "<?php printf ( __( "The message is to short." , 'bordeaux' ));?>\n";
		}


		return error;
	}

		
	</script>

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
											<?php if($mail_to) { ?>
											
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
														<?php remove_filter('the_content', 'big_first_char', 5); ?>
														<?php add_filter('the_content', 'wrap_img_tags'); ?>
														<?php the_content(); ?>
														<?php add_filter( 'the_content', 'wpautop' ); ?>

												
													
													
														<form method="post" class="contact-form" id="contact-form" name="contact-form" action="">
														<input type="hidden"  name="addnew" value="yes" />
															<table>	
																<?php echo $error;?>
																<tr>
																	<td class="label"><?php printf ( __( 'Name:' , 'bordeaux' ));?></td>
																	<td>
																		<p class="input-text-1" id="name_input"><span><input type="text" name="u_name" value="<?php echo $u_name;?>" /></span></p>
																		<p class="error-message"><s id="name_error" style="display: none;"></s></p>
																	</td>
																</tr>
																<tr><td class="spacer-1" colspan="2"></td></tr>
																<tr>
																	<td class="label"><?php printf ( __( 'E-mail:' , 'bordeaux' ));?></td>
																	<td>
																		<p class="input-text-1" id="mail_input"><span><input type="text" name="email" value="<?php echo $email;?>" /></span></p>
																		<p class="error-message"><s id="mail_error" style="display: none;"></s></p>
																	</td>
																</tr>
																<tr><td class="spacer-1" colspan="2"></td></tr>
																<tr>
																	<td class="label"><?php printf ( __( 'Phone number:' , 'bordeaux' ));?></td>
																	<td>
																		<p class="input-text-1"><span><input type="text" name="phone" value="<?php echo $phone;?>" /></span></p>
																		
																	</td>
																</tr>
																<tr><td class="spacer-1" colspan="2"></td></tr>
																<tr>
																	<td class="label"><?php printf ( __( 'Comment:' , 'bordeaux' ));?></td>
																	<td>
																		<div class="text-area-1">
																			<div class="top">
																				<textarea name="message" id="message_input"><?php echo $message;?></textarea>
																				<p class="error-message"><s id="message_error" style="display: none;"></s></p>
																			</div>
																			<div class="bottom"></div>
																		</div>
																	</td>
																</tr>
																<tr><td class="spacer-2" colspan="2"></td></tr>
																<tr>
																	<td></td>
																	<td> 
																		<p class="show-all"><a href="javascript:{}" onclick="return Validate(); submitform();"><span><?php printf ( __( 'Send contact form' , 'bordeaux' ));?></span></a></p>
																	</td>
																</tr>
															</table>
														</form>
														<?php } ?>													
														<?php
														if(isset($addnew) && !$error)
														{
														?>
														<div class="success">
															<p><b><?php printf ( __( 'Thanks!' , 'bordeaux' ));?></b></p>
															<p><?php printf ( __( 'Your message has been sent!' , 'bordeaux' ));?></p>
														</div>
														<?php } ?>
													<!-- END .post -->
													</div>
													
													<div class="clear"></div>
													
													<p class="show-all last"><a href="<?php echo home_url(); ?>"><span><?php printf ( __( 'back to Homepage' , 'bordeaux' ));?></span></a></p>
												
		
												<?php endwhile; else: ?>
													<p><?php printf ( __('Sorry, no posts matched your criteria.' , 'bordeaux' )); ?></p>
												<?php endif; ?>
											<?php } else { echo "<span style=\"color:#000; font-size:14pt;\">You need to set up Your contact mail, you can do it  <a  style=\"color:#000; font-size:14pt;\" href=\"".admin_url()."admin.php?page=theme-configuration&p=theme_general_settings&pid=theme_contact_settings\">here</a>!</span>"; } ?>
											
											<!-- END .left-side -->
											</div>
											
											
											<!-- BEGIN .right-side -->
											<div class="right-side">
											
												<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Contact Sidebar") ) : ?>
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
								<td class="main-content-wrapper-bottom"><p class="back-top"><a href="#top"><span><?php printf ( __('go back to the top' , 'bordeaux' )); ?></span></a></p></td>
							</tr>
							
						</table>

					<!-- END .homepage-wrapper -->
					</div>


				<!-- END .content -->
				</div>
				
			<!-- END .content-wrapper -->
			</div>


												
			<?php get_footer(); ?>