<link href='<?php echo base_url(); ?>css/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url(); ?>css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo base_url(); ?>js/lib/moment.min.js'></script>
<script src='<?php echo base_url(); ?>js/lib/jquery.min.js'></script>
<script src='<?php echo base_url(); ?>js/fullcalendar.min.js'></script>
<script>
	$(document).ready(function() {
	
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek'
			},
			now: '<?php echo date('Y-m-d'); ?>',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: {
				url: js_base_url('site/getSchedule'),
				error: function() {
					$('#script-warning').show();
				}
			},
			loading: function(bool) {
				$('#loading').toggle(bool);
			},
			eventDragStop: function(event,jsEvent) {
				alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
				if( (300 <= jsEvent.pageX) & (jsEvent.pageX <= 500) & (130 <= jsEvent.pageY) & (jsEvent.pageY <= 170)){
				  alert('delete: '+ event.id);
				  $('#MyCalendar').fullCalendar('removeEvents', event.id);
				}
			}
		});
		
	});
</script>
<style>
	body {
		margin: 0;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#script-warning {
		display: none;
		background: #eee;
		border-bottom: 1px solid #ddd;
		padding: 0 10px;
		line-height: 40px;
		text-align: center;
		font-weight: bold;
		font-size: 12px;
		color: red;
	}

	#loading {
		display: none;
		position: absolute;
		top: 10px;
		right: 10px;
	}

	#calendar {
		width: 900px;
		margin: 40px auto;
	}
</style>
<div id="content">
	
	<div id='loading'>loading...</div>

	<div id='calendar'></div>
</div>

