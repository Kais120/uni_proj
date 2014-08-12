
	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '2014-06-12',
			editable: true,
			events: [
				{
					title: 'Tennis',
					start: '2014-06-01'
				},
				{
					title: 'Swimming',
					start: '2014-06-07',
					end: '2014-06-10'
				},
				{
					id: 999,
					title: 'Tennis',
					start: '2014-06-09T16:00:00'
				},
				{
					id: 999,
					title: 'Swimming',
					start: '2014-06-16T16:00:00'
				},
				{
					title: 'Training',
					start: '2014-06-12T10:30:00',
					end: '2014-06-12T12:30:00'
				},
				{
					title: 'Tennis',
					start: '2014-06-12T12:00:00'
				},
				{
					title: 'Swimming',
					start: '2014-06-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2014-06-28'
				}
			]
		});
		
	});