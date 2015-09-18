<?php
	$reservation_support_mail = get_option("bordeaux_reservation_mail");

	if(isset($_POST['reservation_action'])) {
		$reservation_approve=mysql_real_escape_string($_POST['reservation_action']);
	}
	if(isset($_POST['approve_message'])) {
		$approve_message=stripslashes($_POST['approve_message']);
	}
	if(isset($_POST['approve'])) {
		$post_approve=mysql_real_escape_string($_POST['approve']);
	}
	if(isset($_POST['delete'])) {
		$post_delete=mysql_real_escape_string($_POST['delete']);
	}
	if(isset($_GET['approve'])) {
		$approve=mysql_real_escape_string($_GET['approve']);
	}
	if(isset($_GET['delete'])) {
		$delete=mysql_real_escape_string($_GET['delete']);
	}

	if(isset($approve) || isset($delete)) {
		$sql_A = "SELECT * FROM bordeaux_reservation WHERE id='$approve' OR id='$delete'";
				
		$results = $wpdb->get_results( $sql_A );
														
		foreach( $results as $result ) {										
			$name=stripslashes($result->name);
			$reservationFrom=stripslashes($result->reservationFrom);
			$reservationDate=stripslashes($result->reservationDate);
			$phone=stripslashes($result->phone);
			$mail_to=stripslashes($result->email);
			$message_r=stripslashes($result->notes);
															
		} //end foreach
	} //end if
	
	if(isset($post_approve) && $post_approve=="yes") {

		$wpdb->query( $wpdb->prepare("UPDATE bordeaux_reservation SET approve='yes', edited=NOW() WHERE id=$approve"  ) ); 
	
	}
	
	if(isset($post_delete) && $post_delete=="yes") {

		$wpdb->query( $wpdb->prepare("UPDATE bordeaux_reservation SET approve='no', edited=NOW() WHERE id=$delete"  ) ); 
	
	}

	if(isset($reservation_approve) && $reservation_approve=="reservation_approve") {
	
		$subject = get_bloginfo('name')." Reservations";
		$eol="\n";
		$mime_boundary=md5(time());
		$headers = "From: ".$reservation_support_mail." <".$reservation_support_mail.">".$eol;
		$headers .= "Reply-To: ".$mail_to."<".$mail_to.">".$eol;
		$headers .= "Message-ID: <".time()."-".$mail_to.">".$eol;
		$headers .= "X-Mailer: PHP v".phpversion().$eol;
		$headers .= 'MIME-Version: 1.0'.$eol;
		$headers .= "Content-Type: text/html; charset=UTF-8; boundary=\"".$mime_boundary."\"".$eol.$eol;
		
		$message = " ";
		$message.=$approve_message;
		$message.="<br/><br/><br/><br/><br/><br/>";
		$message.="<strong>Your Reservation Information</strong><br/><br/>";
		$message.="Name: ".$name."<br/>";
		$message.="Phone: ".$phone."<br/>";
		$message.="E-mail: ".$mail_to."<br/>";
		$message.="Reservation Time: ".$reservationDate."; ".$reservationFrom."<br/>";

		$mail_sent = mail($mail_to,$subject,$message,$headers);

	}

?>	
	
							<!-- BEGIN .theme_reservation -->
							<div id="theme_reservation">
							<?php if(!isset($approve) && !isset($delete)) { ?>
									<form method="post" action="<?php echo $pageURL;?>?page=theme-configuration"  id="reservation">
									<input type="hidden" name="action" value="reservation"/>
									<table>
										<?php
											$sql_R = "SELECT * FROM bordeaux_reservation
														WHERE approve=''
														ORDER BY id DESC";							
										?>
										<tr class="item">
											<td colspan="2" class="table">
											<?php if(!$reservation_support_mail) { ?>
												<div class="element">
													<a href="<?php echo $pageURL;?>?page=theme-configuration&p=theme_reservation_settings&pid=theme_reservation_settingss" class="delete">&nbsp;</a>
													<div class="content">
														<div class="text">
															<p><b>Warning!</b>Please set up the <a href="<?php echo $pageURL;?>?page=theme-configuration&p=theme_reservation_settings&pid=theme_reservation_settingss">Reservation Support mail!</a></p>
														</div>
													</div>
												</div>
											<?php } ?>
												<div>
													<p class="label-wide"><b>Pending Approval</b></p>
												</div>
												<table>
													<tbody>
														<tr class="title">
															<td>Nr.</td>
															<td>Name</td>
															<td>Reservation Date</td>
															<td>Phone</td>
															<td>Option</td>
														</tr>
													<?php
														$nr="0";
														$results = $wpdb->get_results( $sql_R );
														foreach( $results as $result )
														{
															$nr++;
															$name=stripslashes($result->name);
															$reservationFrom=stripslashes($result->reservationFrom);
															$reservationDate=stripslashes($result->reservationDate);
															$phone=stripslashes($result->phone);
															$id=$result->id;
															if($nr%2==0) $class="class=\"odd\""; else $class="";
													
													?>
														<tr <?php echo $class;?>>
															<td><?php echo $nr;?>.</td>
															<td><?php echo $name;?></td>
															<td><?php echo $reservationDate;?><br/><?php echo $reservationFrom;?></td>
															<td><?php echo $phone;?></td>
															<td>
																<a href="<?php echo $pageURL;?>?page=theme-configuration&p=theme_reservation_settings&pid=theme_reservation&approve=<?php echo $id;?>"><img src="<?php echo THEME_IMAGE_URL."btn-check-1.png";?>" alt="Approve" title="Approve" /></a> 
																<a href="<?php echo $pageURL;?>?page=theme-configuration&p=theme_reservation_settings&pid=theme_reservation&delete=<?php echo $id;?>"><img src="<?php echo THEME_IMAGE_URL."btn-cross-1.png";?>" alt="Reject" title="Reject" /></a>
															</td>
														</tr>
													<?php } ?>
													</tbody>
												</table>
											</td>
										</tr>
										
										<?php
													$sql_R = "SELECT * FROM bordeaux_reservation
														WHERE approve='yes'
															AND edited >=  CURDATE() - INTERVAL 20 DAY
														ORDER BY edited DESC";		
										
										?>
										<tr class="item">
											<td colspan="2" class="table">
												<div>
													<p class="label-wide"><b>Approved Reservations In Last 20 Days</b></p>
												</div>
												<table>
													<tbody>
														<tr class="title">
															<td>Nr.</td>
															<td>Name</td>
															<td>Reservation Date</td>
															<td>Phone</td>
															<td>Option</td>
														</tr>
													<?php
														$nr="0";
														$results = $wpdb->get_results( $sql_R );
														
														foreach( $results as $result ) {
														
															$nr++;
															$id=$result->id;
															$name=stripslashes($result->name);
															$reservationFrom=stripslashes($result->reservationFrom);
															$reservationDate=stripslashes($result->reservationDate);
															$phone=stripslashes($result->phone);
															
															if($nr%2==0) $class="class=\"odd\""; else $class="";
													
													?>
														<tr <?php echo $class;?>>
															<td><?php echo $nr;?>.</td>
															<td><?php echo $name;?></td>
															<td><?php echo $reservationDate;?><br/><?php echo $reservationFrom;?></td>
															<td><?php echo $phone;?></td>
															<td>
																<a href="<?php echo $pageURL;?>?page=theme-configuration&p=theme_reservation_settings&pid=theme_reservation&approve=<?php echo $id;?>"><img src="<?php echo THEME_IMAGE_URL."btn-check-1.png";?>" alt="Approve" title="Approve" /></a> 
																<a href="<?php echo $pageURL;?>?page=theme-configuration&p=theme_reservation_settings&pid=theme_reservation&delete=<?php echo $id;?>"><img src="<?php echo THEME_IMAGE_URL."btn-cross-1.png";?>" alt="Reject" title="Reject" /></a>
															</td>
														</tr>
													<?php } ?>
													</tbody>
												</table>
											</td>
										</tr>
										<?php
													$sql_D = "SELECT * FROM bordeaux_reservation
														WHERE approve='no'
															AND edited >=  CURDATE() - INTERVAL 5 DAY
														ORDER BY edited DESC";		
										
										?>
										<tr class="item">
											<td colspan="2" class="table">
												<div>
													<p class="label-wide"><b>Rejected Reservations In Last 5 Days</b></p>
												</div>
												<table>
													<tbody>
														<tr class="title">
															<td>Nr.</td>
															<td>Name</td>
															<td>Reservation Date</td>
															<td>Phone</td>
															<td>Option</td>
														</tr>
													<?php
														$nr="0";
														$results = $wpdb->get_results( $sql_D );
														foreach( $results as $result )
														{
															$nr++;
															$id=$result->id;
															$name=stripslashes($result->name);
															$reservationFrom=stripslashes($result->reservationFrom);
															$reservationDate=stripslashes($result->reservationDate);
															$phone=stripslashes($result->phone);
															if($nr%2==0) $class="class=\"odd\""; else $class="";
													
													?>
														<tr <?php echo $class;?>>
															<td><?php echo $nr;?>.</td>
															<td><?php echo $name;?></td>
															<td><?php echo $reservationDate;?><br/><?php echo $reservationFrom;?></td>
															<td><?php echo $phone;?></td>
															<td>
																<a href="<?php echo $pageURL;?>?page=theme-configuration&p=theme_reservation_settings&pid=theme_reservation&approve=<?php echo $id;?>"><img src="<?php echo THEME_IMAGE_URL."btn-check-1.png";?>" alt="Approve" title="Approve" /></a> 
																<a href="<?php echo $pageURL;?>?page=theme-configuration&p=theme_reservation_settings&pid=theme_reservation&delete=<?php echo $id;?>"><img src="<?php echo THEME_IMAGE_URL."btn-cross-1.png";?>" alt="Reject" title="Reject" /></a>
															</td>
														</tr>
													<?php } ?>
													</tbody>
												</table>
											</td>
										</tr>
										<tr class="item last"></tr>
										
									</table>
								</form>	
							<?php } ?>
									
									<table>
										<?php if((isset($approve) || isset($delete)) && !isset($reservation_approve)) { ?>
											<tr class="item">
												<td colspan="2">
													<div>
														<p class="label"><b>Full Reservation Order</b></p><span style="margin-left:240px;" ><a href="<?php echo $pageURL;?>?page=theme-configuration&p=theme_reservation_settings&pid=theme_reservation" style=" text-decoration: none;"><img src="<?php echo THEME_IMAGE_URL."btn-back-1.png";?>" alt="Back" title="Back" /></a></span>
													</div>
													<div>
														<p class="label"><span><strong>Reservation Date:</strong></span></p>
														<div class="setting">
															<strong>Time:</strong> <?php echo $reservationFrom;?><br/>
															<strong>Date:</strong> <?php echo $reservationDate;?>
														</div>
													</div>
													<div>
														<p class="label"><span><strong>Name:</strong></span></p>
														<div class="setting">
															<?php echo $name;?>
														</div>
													</div>
													<div>
														<p class="label"><span><strong>Phone:</strong></span></p>
														<div class="setting">
															<?php echo $phone;?>
														</div>
													</div>
													<div>
														<p class="label"><span><strong>Mail:</strong></span></p>
														<div class="setting">
															<?php echo $mail_to;?>
														</div>
													</div>
													<div>
														<p class="label"><span><strong>Message:</strong></span></p>
														<div class="setting">
															<?php echo $message_r;?>
														</div>
													</div>
												</td>
											</tr>
									<?php } ?>		
									<?php if((isset($approve) || isset($delete)) && !isset($reservation_approve)) { ?>
											<form method="post" action="<?php echo $pageURL;?>?page=theme-configuration&p=theme_reservation_settings&pid=theme_reservation<?php if($approve) echo "&approve=".$approve ;?><?php if($delete) echo "&delete=".$delete ;?>"  id="reservation_approve">
												<input type="hidden" name="reservation_action" value="reservation_approve"/>
												<input type="hidden" name="action" value="reservation_approve"/>
												<?php if($approve) { ?><input type="hidden" name="approve" value="yes" /><?php } ?>
												<?php if($delete) { ?><input type="hidden" name="delete" value="yes" /><?php } ?>
												
												<tr class="item">
													<td colspan="2">
														<div>
															<?php if($approve) { ?><p class="label"><b>Approve The Reservation</b></p><?php } ?>
															<?php if($delete) { ?><p class="label"><b>Reject The Reservation</b></p><?php } ?>
														</div>
														<div>
														
														<div style="margin-left:33px;">
																	<p>To approve the reservation, write a text and press "Send & <?php if($approve) { echo "Approve"; } if($delete) { echo "Reject";}?>". The Customer will recieve that message in his e-mail.</p>
																	<p>Orange Themes is not responsible if the e-mail goes in the Spam box.</p>
																	<p>More information you can find <a href="http://www.ehow.com/about_6388252_email-go-everyone_s-spam-folder_.html" target="blank">here</a></p>
														</div>
														
															
															<p class="label"><span><strong>Text:</strong></span></p>
															<div class="setting">
																<textarea name="approve_message" class="text-area-1"></textarea>
															</div>
														</div>
														
													</td>
												</tr>
			
												<tr class="item last">
													<td class="label"></td>
													<?php if($approve) { ?><td class="setting"><p><a href="javascript:{}" onclick="document.getElementById('reservation_approve').submit(); return false;" class="btn-2"><span>Send & Approve</span></a></p></td><?php } ?>
													<?php if($delete) { ?><td class="setting"><p><a href="javascript:{}" onclick="document.getElementById('reservation_approve').submit(); return false;" class="btn-2"><span>Send & Reject</span></a></p></td><?php } ?>
												</tr>
												
											</form>
									<?php } ?>
									<?php if(isset($reservation_approve) && $reservation_approve=="reservation_approve") { ?>
											
												<tr class="item last">
													<td colspan="2">
														<div style="height:300px;">
															<div>
																<p class="label"><b> </b></p><span style="margin-left:493px;" ><a href="<?php echo $pageURL;?>?page=theme-configuration&p=theme_reservation_settings&pid=theme_reservation" style=" text-decoration: none;"><img src="<?php echo THEME_IMAGE_URL."btn-back-1.png";?>" alt="Back" title="Back" /></a></span>
															</div>
															<div>
															
																<div style="margin-left:33px;">
																			<p style="align:center; font-weight:bold;" >The message has been sent!</p>
																</div>
															</div>

														</div>
													</td>
												</tr>
											
									<?php } ?>
								
									</table>
									
							
							
							<!-- END .theme_reservation -->
							</div>