<!-- BEGIN .container -->
<div class="container">

	<!-- BEGIN .main-header-wrapper -->
	<div class="main-header-wrapper">
	
		<!-- BEGIN .header -->
		<div class="header">
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
					<?php if($feedback_rotation=="on") { ?>
					<?php if($feedback_1||$feedback_1_image||$feedback_1_text) { ?>
					<!-- BEGIN .feedback -->

					<div id="feedback-1" class="feedback" style="background: url(<?php echo $feedback_1_image;?>) 0 0 no-repeat;">
						<table>
							<tr>
								<td>
									<p class="text">
										<span>&quot;<?php echo $feedback_1_text ;?>&quot;</span>
									</p>
									<p class="author">
										<span>- <?php echo $feedback_1 ;?></span>
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
									</p>
								</td>
							</tr>
						</table>
					<!-- END .feedback -->
					</div>
					<?php } ?>
					<?php if($feedback_2||$feedback_2_image||$feedback_2_text) { ?>
					<!-- BEGIN .feedback -->
					<div id="feedback-2" class="feedback" style="background: url(<?php echo $feedback_2_image;?>) 0 0 no-repeat;">
						<table>
							<tr>
								<td>
									<p class="text">
										<span>&quot;<?php echo $feedback_2_text ;?>&quot;</span>
									</p>
									<p class="author">
										<span>- <?php echo $feedback_2 ;?></span>
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
									</p>
								</td>
							</tr>
						</table>
					<!-- END .feedback -->
					</div>
					<?php } ?>
					<?php if($feedback_3||$feedback_3_image||$feedback_3_text) { ?>
					<!-- BEGIN .feedback -->
					<div id="feedback-3" class="feedback" style="background: url(<?php echo $feedback_3_image;?>) 0 0 no-repeat;">
						<table>
							<tr>
								<td>
									<p class="text">
										<span>&quot;<?php echo $feedback_3_text ;?>&quot;</span>
									</p>
									<p class="author">
										<span>- <?php echo $feedback_3 ;?></span>
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
										<img src="<?php echo get_template_directory_uri(); ?>/images/ico-star-1.png" alt="" width="11" height="11" />
									</p>
								</td>
							</tr>
						</table>
					<!-- END .feedback -->
					</div>
					<?php } ?>
					<?php } ?>
					<!-- BEGIN .logo -->
					<div class="logo">
					
					<?php 
						$logo = get_option('bordeaux_logo');
						if($logo)
						{
							?><a href="<?php echo home_url(); ?>"><img src="<?php echo $logo;?>" alt="<?php echo bloginfo('name'); ?>" width="333" height="103"/></a><?php
						}
						else
						{
							?>
							<!-- BEGIN .no-logo -->
							<table class="no-logo">
								<tr>
									<td>
										<p><b><?php echo bloginfo('name'); ?></b></p>
										<p><?php echo bloginfo('description'); ?></p>
									</td>
								</tr>
							<!-- END .no-logo -->
							</table>
							<?php
						}
					?>
					
					<!-- END .logo -->
					</div>
					
		<!-- END .header -->	
		</div>
				
	<!-- END .main-header-wrapper -->
	</div>
			<!-- BEGIN .menu-primary-wrapper -->
			<div class="menu-primary-wrapper">
			
				<!-- BEGIN .menu-primary -->
				<div class="menu-primary">
					<table>
						<tr>
							<td class="menu">
								<?php			
									if ( function_exists( 'register_nav_menus' ))
									{
										$args = array(
											'container' => '',
											'theme_location' => 'top_menu',
											"link_before" => '<i>',
											"link_after" => '</i>' ,
											'depth' => 3,
											"echo" => false
											);

											echo add_menu_arrows(wp_nav_menu($args));

									}

								?>
							</td>
						</tr>
					</table>
				
				<!-- END .menu-primary -->
				</div>

			<!-- END .menu-primary-wrapper -->
			</div>

		