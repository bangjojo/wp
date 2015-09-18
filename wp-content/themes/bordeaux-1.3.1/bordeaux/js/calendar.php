<?php
			$max_places = get_option("bordeaux_table_count");
			$avarage_places=round($max_places/2);
			
			global $wpdb;
			$sql = "SELECT reservationDate, approve
					FROM bordeaux_reservation WHERE approve='yes' || approve='out'";
				$reservationarray="";
				$results = $wpdb->get_results($sql);
				
				foreach( $results as $result ) {
	
					$reservationDate=$result->reservationDate;
					$status=$result->approve;
					
					if($status == "out") {
					
						for($i = 1; $i <= $max_places; $i++) {
						
							$reservationarray.="'".$reservationDate."', ";
							
						} //end for
						
					} else {
	
						$reservationarray.="'".$reservationDate."', ";
					
					} //end if
					
				} //end foreach

?>
			
		<script type="text/javascript" language="javascript">

		  //<![CDATA[
			var calendarClass = function( formName, inputName, inputNamee , selected_day ) {
				this.calendarElem = null;
				this.inputElem = null;
				this.inputElemm = null;
				this.selected_day = null;
				this.today = new Date();
				this.theYear = null;
				this.theMonth = null;
				this.previousMonth = null;
				this.nextMonth = null;
				this.firstDay = null;
				this.dayCount = null;
				this.current = true;
				this.monthsArray = new Array("<?php printf ( __('January', 'bordeaux')); ?>","<?php printf ( __('February', 'bordeaux')); ?>","<?php printf ( __('March', 'bordeaux')); ?>","<?php printf ( __('April', 'bordeaux')); ?>","<?php printf ( __('May', 'bordeaux')); ?>","<?php printf ( __('June', 'bordeaux')); ?>","<?php printf ( __('July', 'bordeaux')); ?>","<?php printf ( __('August', 'bordeaux')); ?>","<?php printf ( __('September', 'bordeaux')); ?>","<?php printf ( __('October', 'bordeaux')); ?>","<?php printf ( __('November', 'bordeaux')); ?>","<?php printf ( __('December', 'bordeaux')); ?>");
			   
				this.initCalendar = function() {
					this.calendarElem = document.getElementById('Calendar');
					this.inputElem = document.forms[formName].elements[inputName];
					this.inputElemm = document.forms[formName].elements[inputNamee];
					this.selected_day = document.forms[formName].elements[selected_day];
				  
				  if( this.calendarElem.style.display == 'inline' ) {
					this.getCurrentDate();

				  } else {
					this.setVariables();
					this.calendarElem.style.display = 'inline';
				  }
				}

				this.setVariables = function() {
					this.theMonth = this.today.getMonth();
					this.previousMonth = new Date( this.theYear, this.theMonth, 0 ).getDate();
					this.nextMonth = 1;
					this.theYear = this.getY2KYear();
					this.firstDay = this.getFirstDay();
					this.dayCount = this.getMonthLen() + this.firstDay;
					this.day = this.today.getDate();
					
					this.calendarElem.innerHTML = this.generateHTML();
			   }
			   
			   this.getY2KYear = function() {
					// correct for Y2K anomalies
					var year = this.today.getYear();
					return ( ( year < 1900 ) ? year + 1900 : year );
			   }
			   
			   this.getFirstDay = function() {
					var firstDate = new Date( this.theYear, this.theMonth, 1 );
					return firstDate.getDay() == 0 ? 7 : firstDate.getDay();
			   }
			   
			   this.getMonthLen = function() {
					// Noskaidro cik saja menesi ir dienas
					var oneDay = 1000 * 60 * 60 * 24;
					var thisMonth = new Date( this.theYear, this.theMonth, 1 );
					var nextMonth = new Date( this.theYear, this.theMonth + 1, 1 );
					var len = Math.ceil( ( nextMonth.getTime() - thisMonth.getTime() ) / oneDay );
				  
					return len;
			   }
			   
			   this.getPreviousMonth = function() {
					this.current = false;
					this.today = new Date( this.theYear, this.theMonth - 1, 1 );
					this.setVariables();
			   }
			   
			   this.getPreviousYear = function() {
					this.current = false;
					this.today = new Date( this.theYear - 1, this.theMonth, 1 );
					this.setVariables();
			   }
			   
			   this.getCurrentDate = function() {
					this.current = true;
					this.today = new Date();
					this.setVariables();
			   }
			   
			   this.getNextMonth = function() {
					this.current = false;
					this.today = new Date( this.theYear, this.theMonth + 1, 1 );
					this.setVariables();
			   }
			   
			   this.getNextYear = function() {
				  this.current = false;
				  this.today = new Date( this.theYear + 1, this.theMonth, 1 );
				  this.setVariables();
			   }
			   
			   this.getClickedDate = function( value ) {
				this.current = true;
				  if( value > 0 ) {
					 value = ( value < 10 ? '0' : '' ) + value;
					 var monthVal = ( ( this.theMonth + 1 ) < 10 ? '0' : '' ) + ( this.theMonth + 1 );
					 
					 this.inputElem.value = value + ' / ' + monthVal + ' / ' + this.theYear ; 
					 this.inputElemm.value = this.theYear + '-' + monthVal + '-' + value; 
					 this.selected_day.value = value; 
					 var reservationdate = this.theYear + '-' + monthVal + '-' + value; 
					
					 //this.initCalendar();
				  } else if( value == -1 ) {
					 this.getPreviousMonth();   
				  } else {
					 this.getNextMonth();   
				  }
					selectedDay = value; 
					this.setVariables();
					
			   }
					 
			  this.getActiveDate = function() {
					
					var monthVal = ( ( this.theMonth + 1 ) < 10 ? '0' : '' ) + ( this.theMonth + 1 );
			  		var selected = true;
					var selectedDay = $(".selected_day").val();
					var selectedMonth = monthVal;
					this.selectedMonth = monthVal;
					var selectedYear = this.theYear;
			  
					if( selected == true && ( this.theMonth + 1 ) == selectedMonth && this.theYear == selectedYear && selectedDay!=" ") {
						return selectedDay;
					}
			   }
			   
			   this.generateHTML = function() {
				  // Pedejas korekcijas
				  if( this.firstDay == 1 ) {
					 this.firstDay = 8; 
					  this.dayCount = this.dayCount + 7;
					 this.previousMonth = this.previousMonth - ( this.firstDay - 1 );
				  }else if( this.firstDay == 6 && this.theMonth == 9) {
					 this.firstDay = 6; 
					 this.previousMonth = this.previousMonth - ( this.firstDay -1 );
				  } else {
					 this.previousMonth = this.previousMonth - ( this.firstDay - 1 );   
				  }

	  					
				function countvalues(a) {
					var b = {}, i = a.length, j;
					while( i-- ) {
					j = b[a[i]];
					b[a[i]] = j ? j+1 : 1;
					}
					return b; 
				}
				

				
					var arr=[<?php echo $reservationarray;?>];

					var a = countvalues(arr);
					var msg='';

					for (elem in a){
					msg += '\n' + elem + ' : ' + a[elem];
					
				}
				

				  
				  var fulltime=$(".fulltime").val();
				  var dayCounts = this.dayCount;
				  var firstDay = this.firstDay;
				  var dateValue = null;
				  var content = '<table class="reservations">';
						content += '<tr>';
							content += '<td colspan="7">';
								content += '<table>';
									content += '<tr>';
										content += '<td onclick="calendarElem.getPreviousMonth();"><a class="previous">&nbsp;<\/a><\/td>';
										content += '<td><h4>' + this.monthsArray[this.theMonth] + '<\/h4><\/td>';
										content += '<td onclick="calendarElem.getNextMonth();"><a class="next">&nbsp;<\/a><\/td>';
									content += '<\/tr>';
								content += '<\/table>';
							content += '<\/td>';
						content += '<\/tr>';
						content += '<tr class="weekdays"><td><?php printf ( __('Mo', 'bordeaux')); ?><\/td><td><?php printf ( __('Tu', 'bordeaux')); ?><\/td><td><?php printf ( __('We', 'bordeaux')); ?><\/td><td><?php printf ( __('Th', 'bordeaux')); ?><\/td><td><?php printf ( __('Fr', 'bordeaux')); ?><\/td><td><?php printf ( __('Sa', 'bordeaux')); ?><\/td><td><?php printf ( __('Su', 'bordeaux')); ?><\/td><\/tr>';
						content += '<tr>';

						
						
						  for( var i = 1; i < dayCounts; i++ ) {
						  if(this.theMonth==9) { var ddd=this.dayCount - 1} else { var ddd=this.dayCount}
							if( firstDay==8) {
								var i=7; 
								var firstDay=firstDay+1;
							 } else if( i < this.firstDay ) {
								dateValue = this.previousMonth + i;
								content += '<td class="days other-month" onclick="calendarElem.getClickedDate(-1);"><a >' + dateValue + '<\/a><\/td>';
							 } 
							 else if( i >= ddd ) {
								content += '<td class="days other-month" onclick="calendarElem.getClickedDate(-2);"><a >' + this.nextMonth + '<\/a><\/td>';
								this.nextMonth++;
							 } else if( (i - this.firstDay + 1) == this.getActiveDate() && this.current == true ) {
							 	
								var month=this.theMonth+1;
								var day=i - this.firstDay + 1;
								var resdate = this.theYear+"-"+month+"-"+day;
								
								if(countvalues(arr)[resdate]>=<?php echo $avarage_places;?> && countvalues(arr)[resdate]<<?php echo $max_places;?>) { var day_class="some-available";} else if(countvalues(arr)[resdate]>=<?php echo $max_places;?>) { var day_class="none-available";} else { var day_class=" ";} ;
								
								dateValue = i - this.firstDay + 1;
								if(countvalues(arr)[resdate]>=<?php echo $max_places;?>) {
									content += '<td class="days selected '+ day_class +'" ><a >' + dateValue + '<\/a><\/td>'; 
								} 
								else { content += '<td class="days selected '+ day_class +'" onclick="calendarElem.getClickedDate(' + dateValue + ');"><a >' + dateValue + '<\/a><\/td>';  }
							
							}  else {
								var d = new Date();
							 	var month=this.theMonth+1;

								
							
								var day=i - this.firstDay + 1;
								var resdate = this.theYear+"-"+month+"-"+day;
								if(countvalues(arr)[resdate]>=<?php echo $avarage_places;?> && countvalues(arr)[resdate]<<?php echo $max_places;?>) { var day_class="some-available";} else if(countvalues(arr)[resdate]>=<?php echo $max_places;?>) { var day_class="none-available";} else { var day_class=" ";} ;
								dateValue = i - this.firstDay + 1;
								if(countvalues(arr)[resdate]>=<?php echo $max_places;?> || ((i - this.firstDay + 1) < (d.getDate()) && month <= (d.getMonth() +1) && this.theYear <= (d.getFullYear())) || ( (month < (d.getMonth() +1)) && (this.theYear < (d.getFullYear()))) || (this.theYear < (d.getFullYear()))) {
									content += '<td class="days '+ day_class +'" onclick="warn();" ><a >' + dateValue + '<\/a><\/td>'; 
								} else if (dateValue<32) { content += '<td class="days '+ day_class +'" onclick="calendarElem.getClickedDate(' + dateValue + ');"><a >' + dateValue + '<\/a><\/td>';  }
							 }
								if(dateValue==32) { var tdayCount=this.dayCount - 2}
								
							 if ( i % 7 == 0 &&  i != tdayCount ) {
								content += '<\/tr>';
							 } else if (i == dayCounts-1  && i % 7 != 0) { dayCounts++ }
							 
							 
						  }

				  
				  content += '<tr class="legend">'
					content += '<td colspan="7">'
					content += '<p class="available"><?php printf ( __('Free reservation space', 'bordeaux')); ?><\/p>'
					content += '<p class="some-available"><?php printf ( __('Some reservations available', 'bordeaux')); ?><\/p>'
					content += '<p class="none-available"><?php printf ( __('Reservations not available', 'bordeaux')); ?><\/p>'
				content += '<\/td>'
				content += '<\/tr>'
			content += '<\/table>';

				  return content;
				
			   }
			}
		  
			var calendarElem = new calendarClass( 'AddressForm', 'reservationdate', 'fulltime', 'selected_day' );
		  //]]>

		  	function warn() {
				alert("<?php printf ( __('This day is not available!', 'bordeaux')); ?>");
			}
		  addLoadEvent(calendarElem.initCalendar());
			
			
		</script>
