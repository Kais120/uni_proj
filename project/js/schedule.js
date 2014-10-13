var sportId = 1;

function getCurrentDate(){
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();
		if(dd<10) {
			dd='0'+dd
		} 
		if(mm<10) {
			mm='0'+mm
		} 
		today = mm+'/'+dd+'/'+yyyy;		
		return today;
}
	

function tabClick() {
	$(".tabs").on('click', '.tab-link', function () {		
		$(this).addClass('current').siblings().removeClass('current');
		if ($(this).is('#tennis')){	
			sportId = 1;	
			var events = {
              url: js_base_url('site/get_schedule'),
              type: 'POST',
              data: {
				sport: sportId
				}
			}
			$('#calendar').fullCalendar('removeEventSource', events);
            $('#calendar').fullCalendar('addEventSource', events);
            $('#calendar').fullCalendar('refetchEvents');
		}
		if ($(this).is('#swimming')){	
			sportId = 2;
			var events = {
              url: js_base_url('site/get_schedule'),
              type: 'POST',
              data: {
				sport: sportId
				}
			}
			$('#calendar').fullCalendar('removeEventSource', events);
            $('#calendar').fullCalendar('addEventSource', events);
            $('#calendar').fullCalendar('refetchEvents');
		}
	});
}

function loadEvents(){	
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek'
		},
		now: getCurrentDate().toString(),
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		
		events:   
        {
            url: js_base_url('site/get_schedule'),
            type: 'POST',
            data: {
                sport: sportId
            },
            error: function() {
                alert('there was an error while fetching events!');
            },           
        },		
		
		loading: function(bool) {
			$('#loading').toggle(bool);
		},
		eventDrop: function(event) {
			var start = JSON.stringify(event.start).split('T')[1].split('.')[0];			
			var end = JSON.stringify(event.end).split('T')[1].split('.')[0];
			var date = JSON.stringify(event.start).split('T')[0].split('"')[1];				
			saveEvent(event.id, date, start, end);
		},
		eventResize: function(event) {
			var start = JSON.stringify(event.start).split('T')[1].split('.')[0];			
			var end = JSON.stringify(event.end).split('T')[1].split('.')[0];
			var date = JSON.stringify(event.start).split('T')[0].split('"')[1];				
			saveEvent(event.id, date, start, end);
		},
		eventClick: function(event){
			 window.location = js_base_url('site/groups?group_id='+event.group_id);
		}
	});
}

function saveEvent(id, date, start, end){
	$.post(js_base_url('site/save_event'),
		{
			'id' : id,
			'date' : date,
			'start' : start,
			'end' : end
		}
	);
}
	


var main = function(){	
	loadEvents(sportId);	
	tabClick();
}

$(document).ready(main);