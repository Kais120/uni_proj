var sportId = 1;

function getCurrentDate() {
	$.post(js_base_url('get_current_date()'),
		function (data) {
		return data;
	});
}

function tabClick() {
	$(".tabs").on('click', '.tab-link', function () {
		$(this).addClass('current').siblings().removeClass('current');
		if ($(this).is('#tennis')) {
			sportId = 1;
			var events = {
				url : js_base_url('get_schedule'),
				type : 'POST',
				data : {
					sport : sportId
				}
			}
			$('#calendar').fullCalendar('removeEventSource', events);
			$('#calendar').fullCalendar('addEventSource', events);
			$('#calendar').fullCalendar('refetchEvents');
		}
		if ($(this).is('#swimming')) {
			sportId = 2;
			var events = {
				url : js_base_url('get_schedule'),
				type : 'POST',
				data : {
					sport : sportId
				}
			}
			$('#calendar').fullCalendar('removeEventSource', events);
			$('#calendar').fullCalendar('addEventSource', events);
			$('#calendar').fullCalendar('refetchEvents');
		}
	});
}

function loadEvents() {
	$('#calendar').fullCalendar({
		height : 500,
		width : 400,
		header : {
			left : 'prev,next today',
			center : 'title',
			right : 'month,agendaWeek'
		},
		now : getCurrentDate(),		
		eventLimit : true, // allow "more" link when too many events
		timezone: 'Australia/Melbourne',
		events : {
			url : js_base_url('get_schedule'),
			type : 'POST',
			data : {
				sport : sportId
			},
			error : function () {
				alert('there was an error while fetching events!');
			},
		},

		loading : function (bool) {
			$('#loading').toggle(bool);
		},
		
		eventClick : function (event) {
			window.location = js_base_url('groups?group_id=' + event.group_id);
		}		
	});
}

function saveEvent(id, date, start, end) {
	$.post(js_base_url('save_event'), {
		'id' : id,
		'date' : date,
		'start' : start,
		'end' : end
	});
}

var main = function () {
	loadEvents(sportId);
	tabClick();
}

$(document).ready(main);
