var AppModule = (function(){

	var $form = $('#formevent');
	var calendar;

	

	var init = function(){
		calendar = globalCalendar;

		
		_formEvent();
		_datePicker();
	};


	var _datePicker = function(){

		$('.dateme').each(function(){
		    $(this).datepicker({
		    	dateFormat:'yy-mm-dd',
		    });
		});
	};


	var __isEmpty = function (str) {
    	return (!str || 0 === str.length);
	}



	var _formEvent = function(){

		$form.on('submit',function(e){

			e.preventDefault();


			//values
			var event_name = $('[name=event_name]').val();
			var start_date = $('[name=start_date]').val();
			var end_date = $('[name=end_date]').val();

			var errorsarray = [];

			if ( __isEmpty( event_name ) ){
				errorsarray.push('Enter an event.');
			}

			if ( __isEmpty( start_date ) ){
				errorsarray.push('Enter a start date.');
			}

			if ( __isEmpty( end_date ) ){
				errorsarray.push('Enter an end date.');
			}

			if ( !__isEmpty( errorsarray ) ){

				var mess = "";
				errorsarray.forEach( s => {
					mess += s + "\n";
				} );

				alert ( mess );
				return ;
				exit();
			}

			$("#addeventbutton").attr('disabled', 'disabled');


			//array of days
			var atLeastOneIsChecked = $('input[name="days[]"]:checked').length > 0;

			var _t = $(this);
			//var dateStr = prompt('Enter a date in YYYY-MM-DD format');
	        var sdate = new Date(start_date ); // will be in local time
	        var edate = new Date(end_date ); // will be in local time




	        //check for events that will be updated
			var range = getDatesGetTime( sdate, edate );
			var hasEvents = calendar.getEvents().length > 0;
			if ( hasEvents ){

				console.log( 'has EVENTS!' ); 

				var c_events = calendar.getEvents();

				c_events.forEach( e => {

					var a = range.indexOf( e.start.getTime() );
					if ( a != -1 ){
						//item appeared on range
						e.remove();
						console.log ( 'removing' );
					}



				} ) ;//endforeach


			}//end has Events


			if ( atLeastOneIsChecked ){


				var myarrayofdates = [];

				$('input[name="days[]"]:checked').each(function(e){
					var _eval = $(this).val();
					

					var gd = getDaysBetweenDates(sdate, edate, _eval);

					gd.forEach( day => {
						
						var _tempDate = new Date(  day   );
						
						if ( !isNaN(_tempDate.valueOf())  ) { // valid?

				            calendar.addEvent({
				              title: event_name,
				              start: _tempDate,
				              end : _tempDate,
				              allDay : true
				            });



				        } else {
				            alert('Invalid date.');
				        }


					} );  //end forEach


				});//each checked day

			}//at least one is checked end



			//do final verifications

			var finalrangeevents = calendar.getEvents();
			var rearray = [];

			console.log( finalrangeevents );

			function formatDate(date) {
			    var d = new Date(date),
			        month = '' + (d.getMonth() + 1),
			        day = '' + d.getDate(),
			        year = d.getFullYear();

			    if (month.length < 2) 
			        month = '0' + month;
			    if (day.length < 2) 
			        day = '0' + day;

			    return [year, month, day].join('-');
			}//end fxn


			finalrangeevents.forEach( fr => {

				var _tempfr = formatDate(fr['start']);

				rearray.push( 
						{
							title : fr['title'],
							start : _tempfr,
							end : _tempfr
						}
					);

			} );//end foreach

			if ( finalrangeevents.length > 0 ){

				//alert('Great. Now, update your database...');
				$.ajaxSetup({
					headers : {
						'X-CSRF-TOKEN' : $('[name=_token]').val()
					}
				});

				$.ajax({
					url: $('#formevent').attr('action'),
					type: 'POST',
					data: {

						event_name : event_name,
			            request_data : rearray,

			        },
					success: function(data) {
						
						//toastr
						Command: toastr["success"]("Event Saved!")

						toastr.options = {
						  "closeButton": false,
						  "debug": false,
						  "newestOnTop": false,
						  "progressBar": false,
						  "positionClass": "toast-top-right",
						  "preventDuplicates": false,
						  "onclick": null,
						  "showDuration": "300",
						  "hideDuration": "1000",
						  "timeOut": "5000",
						  "extendedTimeOut": "1000",
						  "showEasing": "swing",
						  "hideEasing": "linear",
						  "showMethod": "fadeIn",
						  "hideMethod": "fadeOut"
						}


					},
					error: function(errorThrown){
			            //console.log(errorThrown); // error

			            //$( '.errors' ).html(errorThrown.responseJSON.message);

			        }							
				}).done(function(){


					$("#addeventbutton").removeAttr('disabled');

				});;//end ajax

			}//end if final range

			

		});//end on submit

	};


	var getDaysBetweenDates = function(start, end, dayName){

		var result = [];
  		var days = {sun:0,mon:1,tue:2,wed:3,thu:4,fri:5,sat:6};
  		var day = days[dayName.toLowerCase().substr(0,3)];
  		// Copy start date
	  	var current = new Date( start );
	  	// Shift to next of required days
	  	current.setDate(current.getDate() + (day - current.getDay() + 7) % 7);
	  	// While less than end date, add dates to result array
	  	while (current < end) {
	    	result.push(new Date(+current));
	    	current.setDate(current.getDate() + 7);
	 	 }
	  return result;  


	};



	// Returns an array of dates between the two dates
	var getDates = function(startDate, endDate) {
	  var dates = [],
	      currentDate = startDate,
	      addDays = function(days) {
	        var date = new Date(this.valueOf());
	        date.setDate(date.getDate() + days);
	        return date;
	      };
	  while (currentDate <= endDate) {
	    dates.push(currentDate);
	    currentDate = addDays.call(currentDate, 1);
	  }
	  return dates;
	};



	// Returns an array of dates between the two dates
	var getDatesGetTime = function(startDate, endDate) {
	  var dates = [],
	      currentDate = startDate,
	      addDays = function(days) {
	        var date = new Date(this.valueOf());
	        date.setDate(date.getDate() + days);
	        return date;
	      };
	  while (currentDate <= endDate) {
	    dates.push( currentDate.getTime() );
	    currentDate = addDays.call(currentDate, 1);
	  }
	  return dates;
	};



	return {
		init
	}

})();

$(document).ready(function(){

	AppModule.init();

});