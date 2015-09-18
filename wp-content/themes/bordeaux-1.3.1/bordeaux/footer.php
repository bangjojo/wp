			<div class="clear-footer"></div>
			
		<!-- END .container -->
		</div>			
      
		<!-- BEGIN .main-footer-wrapper -->
		<div class="main-footer-wrapper">	
			
			<!-- BEGIN .footer -->
			<div class="footer">			
			<?php
				
				$phone = get_option("bordeaux_phone");
				$mail = get_option("bordeaux_mail");
				$name = filter_var(stripslashes(get_option("bordeaux_rest_name")), FILTER_SANITIZE_SPECIAL_CHARS);
				$address = filter_var(stripslashes(get_option("bordeaux_rest_address")), FILTER_SANITIZE_SPECIAL_CHARS);
				
				$twitter = get_option("bordeaux_twitter_url");						
				$facebook = get_option("bordeaux_facebook_url");						
				$linkedin = get_option("bordeaux_linkedin_url");	

				global $wpdb;
				$google_loc = $wpdb->get_var($wpdb->prepare("SELECT post_content FROM $wpdb->posts WHERE post_type = 'boderaux_google_loc'"));
				
				if(get_option("show_rss_icon")) {							
				$rss = get_option("theme_rss_url");							
				if($rss == "") $rss = get_bloginfo("rss_url");						
				} else { $rss = false; }						
			?>
	 
	 
	 
			<table>
					<tr>
						<?php if($name || $address || $phone || $mail) { ?>	
						<td class="contact-information-wrapper">
							<h3><?php printf ( __( 'Contact Information' , 'bordeaux' ));?></h3>
							<div class="address">
								<p><b><?php echo $name;?></b></p>
								<p><?php echo $address;?></p>
							</div>
							<div class="phone">
								<p><?php echo $phone;?></p>
							</div>
							<div class="email">
								<p><a href="mailto:<?php echo $mail;?>"><?php echo $mail;?></a></p>
							</div>
						</td>
						<?php } ?>	
						
						<?php if($facebook || $twitter || $linkedin || $rss) { ?>	
						<td class="social-networks-wrapper">
							<h3><?php printf ( __( 'Social Networks' , 'bordeaux' ));?></h3>
							<ul>
								<?php if($twitter) { ?><li class="twitter"><a href="<?php echo $twitter;?>"><?php printf ( __( 'Follow us on <b>Twitter</b>' , 'bordeaux' ));?></a></li><?php } ?>	
								<?php if($facebook) { ?><li class="facebook"><a href="<?php echo $facebook;?>"><?php printf ( __( 'Friend us on <b>Facebook</b>' , 'bordeaux' ));?></a></li><?php } ?>	
								<?php if($linkedin) { ?><li class="linkedin"><a href="<?php echo $linkedin;?>"><?php printf ( __( 'Check us out on <b>Linked In</b>' , 'bordeaux' ));?></a></li><?php } ?>	
								<?php if($rss) { ?><li class="rss"><a href="<?php echo $rss;?>"><?php printf ( __( 'Check out our <b>RSS feeds</b>' , 'bordeaux' ));?></a></li><?php } ?>	
							</ul>
						</td>
						<?php } ?>	
						
						<?php if($google_loc) { ?>
						<td class="map-wrapper">
							<h3><?php printf ( __( 'Where To Find Us' , 'bordeaux' ));?></h3>
							<div class="map">
								<iframe width="250" height="132" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $google_loc;?>&amp;iwloc=A&amp;output=embed"></iframe>
							</div>
						</td>
						<?php } ?>
						
					</tr>
				</table>

			<!-- END .footer -->
			</div>
		
		<!-- END .main-footer-wrapper -->
		</div>


		<!-- BEGIN .main-footer-wrapper-2 -->
		<div class="main-footer-wrapper-2">
			
			<!-- BEGIN .footer-2 -->
			<div class="footer-2">
			
				<div class="left">
					Copyright &copy; 2011 <b>Orange-Themes.com</b>
				</div>
				
				<div class="right">
					Design by <b><a href="http://www.orange-themes.com" target="_blank">Orange-Themes.com</a></b>
				</div>
			
			<!-- END .footer-2 -->
			</div>
			
		<!-- END .main-footer-wrapper-2 -->
		</div>
		<?php global $reservations; if($reservations=="Yes") { require_once(THEME_SCRIPTS."calendar.php");  require_once(THEME_SCRIPTS."reservation-validation.php"); }?>
		
		<?php wp_footer(); ?>	
	</body>
</html>