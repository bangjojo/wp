	<script  type="text/javascript" language="javascript">		function Validate() 	{		var errors = "";		var reason_name = "";		var reason_mail = "";		var reason_date = "";		var reason_phone = "";		var reason_time = "";		reason_name += validateName(document.getElementById('AddressForm').u_name);		reason_mail += validateEmail(document.getElementById('AddressForm').email);		reason_date += validateDate(document.getElementById('AddressForm').reservationdate);		reason_phone += validatePhone(document.getElementById('AddressForm').phone);		reason_time += validateTime(document.getElementById('AddressForm').timefrom);		if (reason_name != "") 		{			$("#name_error").text(reason_name).fadeIn(1000);			jQuery("#name_input").addClass("input-text-1-error");			document.getElementById('name_message').style.display = 'block';			errors = "Error";		}		else{			jQuery("#name_input").removeClass("input-text-1-error");			document.getElementById('name_message').style.display = 'none';		}		if (reason_mail != "") 		{			$("#mail_error").text(reason_mail).fadeIn(1000);			jQuery("#mail_input").addClass("input-text-1-error");			document.getElementById('mail_message').style.display = 'block';			errors = "Error";		}		else{			jQuery("#mail_input").removeClass("input-text-1-error");			document.getElementById('mail_message').style.display = 'none';		}						if (reason_date != "") 		{			$("#date_error").text(reason_date).fadeIn(1000);			jQuery("#date_input").addClass("input-text-1-error");			document.getElementById('date_message').style.display = 'block';			errors = "Error";		}		else{			jQuery("#date_input").removeClass("input-text-1-error");			document.getElementById('date_message').style.display = 'none';		}						if (reason_phone != "") 		{			$("#phone_error").text(reason_phone).fadeIn(1000);			jQuery("#phone_input").addClass("input-text-1-error");			document.getElementById('phone_message').style.display = 'block';			errors = "Error";		}		else{			jQuery("#phone_input").removeClass("input-text-1-error");			document.getElementById('phone_message').style.display = 'none';		}						if (reason_time != "") 		{			$("#time_error").text(reason_time).fadeIn(1000);			jQuery("#time_input").addClass("input-text-1-error");			document.getElementById('time_message').style.display = 'block';			errors = "Error";		}		else{			jQuery("#time_input").removeClass("input-text-1-error");			document.getElementById('time_message').style.display = 'none';		}						if (errors != ""){			return false;		}				document.getElementById('AddressForm').submit(); return false;	}			function validateName(fld) 	{		var error = "";				if (fld.value == '')		{			error = "<?php printf ( __( 'Please Enter Your First Name.' , 'bordeaux' ));?>\n";		}		else if ((fld.value.length < 2) || (fld.value.length > 50))		{			error = "<?php printf ( __( 'First Name Is Wrong Length.' , 'bordeaux' ));?>\n";		}		return error;	}		function validateEmail(fld) 	{		var error="";		var illegalChars = /^[^@]+@[^@.]+\.[^@]*\w\w$/;				if (fld.value == ""){			error = "<?php printf ( __( 'Please Enter a email address.' , 'bordeaux' ));?>\n";		}		else if ( fld.value.match( illegalChars ) == null){			error = "<?php printf ( __( 'The email address contains illegal characters.' , 'bordeaux' ));?>\n";		}		return error;	}	function validateDate(fld) 	{		var error="";				if (fld.value == "dd / mm / gggg"){			error = "<?php printf ( __( 'Please Set Up Your Reservation date!' , 'bordeaux' ));?>\n";		}		return error;	}		function validatePhone(fld) 	{		var error="";				if (fld.value == '')		{			error = "<?php printf ( __( 'Please Enter Your Phone.' , 'bordeaux' ));?>\n";		}		else if ((fld.value.length < 2) || (fld.value.length > 50))		{			error = "<?php printf ( __( 'Phone Is Wrong Length.' , 'bordeaux' ));?>\n";		}		return error;	}				function validateTime(fld) 	{		var error="";				if (fld.value == 'no')		{			error = "<?php printf ( __( 'Please Set Up Reservation Time.' , 'bordeaux' ));?>\n";		}		return error;	}	</script>