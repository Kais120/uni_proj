var status=0;

function yearSelection() {
	$(".year").change(function(){
		selectNone();
		var year = $(this).val();
		$("#term_list tbody").children('tr').remove();
		$.ajax({
			type : "POST",
			cache : false,
			url : js_base_url("site/get_terms_details"),					
			data: {'year' : $(this).val()},	
			dataType : 'json',
			success : function (data) {	
				$.each(data, function (key, value) {
					$("#term_list tbody").append("<tr><td class='term_id'>"+value.term_id+"</td><td class='description'>"+value.term_description
						+"</td><td class='start_date'>"+value.start_date+"</td><td class='end_date'>"+value.end_date+"</td></tr>");				
				});				
			}			
		});
	});
}

function clickTerm(){	
	$("#term_list tbody").delegate("tr", "click", function () {	
		status=1;
		$("button#save_term").addClass('disabled');
		$("button#save_term").removeClass('hidden');
		$("div.fields").removeClass('hidden');
		$(this).addClass("active").siblings().removeClass('active');		
		$("ul.term_dates li input#description").val($(this).children(".description").html());
		$("ul.term_dates li input#start_date").val($(this).children(".start_date").html());
		$("ul.term_dates li input#end_date").val($(this).children(".end_date").html());
	});
}

function clickButton(){
	$("button#save_term").click(function(){
		if (status == 1)
			updateTerm();
		if (status == 2){
			addTerm();
		}
			
	});
}

function clickNew(){
	$("button#new_term").click(function(){
		status=2;
		$("button#save_term").addClass('disabled');
		$("button#save_term").removeClass('hidden');
		$("div.fields").removeClass('hidden');
		$("#term_list tbody tr.active").removeClass("active");
		cleanFields();
	});
}

function cleanFields(){
	$(".term_dates :input").val('');
}

function addTerm(){
	$.ajax({
		url : js_base_url("site/addTerm"),
		type : "POST",			
		data : {
			'description' : $("input#description").val(),
			'start_date' : $("input#start_date").val(),
			'end_date' : $("input#end_date").val()
		},		
		success : function (data) {			
			alert("New term added");
			location.reload();
		}
	});
}

function updateTerm(){	
	$.ajax({
		url : js_base_url("site/updateTerm"),
		type : "POST",			
		data : {
			'key' : $("#term_list tbody tr.active td.term_id").html(),
			'description' : $("input#description").val(),
			'start_date' : $("input#start_date").val(),
			'end_date' : $("input#end_date").val()
		},		
		success : function (data) {			
			alert("Term updated");
			location.reload();
		}
	});
}

function onInputChange(){
	$("ul.term_dates li input").keydown(function(){
		$("button#save_term").removeClass('disabled');
	});	
	$("ul.term_dates li input").change(function(){
		$("button#save_term").removeClass('disabled');
	});
}

function selectNone(){
	if ($(".year").val()==''){
		$("button#save_term").addClass('hidden');
		$("div.fields").addClass('hidden');
	}		
}

var main = function(){	
	$("button#save_term").addClass('disabled');
	yearSelection();
	clickTerm();
	clickNew();
	clickButton();
	onInputChange();
}

$(document).ready(main);