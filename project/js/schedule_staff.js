$(document).ready(function() {
	
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '<?php echo date('Y-m-d'); ?>',
			editable: true,
			events: {
				url: js_base_url('site/getSchedule')				
			},
			loading: function(bool) {
				$('#loading').toggle(bool);
			}
		});
		
	});