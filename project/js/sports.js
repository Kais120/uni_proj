var select = 1;
var statusSkill=0;
var statusTask=0;

function tabClick() {
	$(".tabs").on('click', '.tab-link', function(){
		$("div#tasks").addClass("hidden");
		$(this).addClass('current').siblings().removeClass('current');
		$("ul#skill_details").addClass("hidden");
		cleanSkillDetails();
		if ($(this).html()=='Tennis'){
			select = 1;
		}else{
			select = 2;
		}
		loadSkills();
	});
}

function loadSkills(){
	if (select==1){
		getSkills(1);
	}else{
		getSkills(2);
	}
}

function getSkills(i){
	$("table#skills_list tbody tr").remove();
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("getSkills"),					
		data: {'key' : i},	
		dataType : 'json',
		success : function (data){
			$.each(data, function(key,value){
				$("table#skills_list tbody").append("<tr><td class='skill_id'>"+value.skill_id+"</td><td class='skill_band'>"+
					value.skill_band+"<td><td class='skill_description'>"+value.skill_band_description+"</td></tr>");
			});
		}			
	});
}

function skillClick(){
	$("table.skill_table#skills_list tbody").delegate("tr",'click',function(){		
		$(this).addClass('active').siblings().removeClass('active');
		statusSkill = 1;
		$("div#tasks").removeClass("hidden");
		$("ul#skill_details").removeClass("hidden");
		$("button#save_skill").removeClass("hidden");
		$("ul#task_details").addClass("hidden");
		$("button#save_task").addClass("hidden");
		loadTasks($(this).children("td.skill_id").html());
		$("ul#skill_details li input#band").val($(this).children(".skill_band").html());
		$("ul#skill_details li input#skill_description").val($(this).children(".skill_description").html());
	});
}

function taskClick(){
	$("table.skill_table#tasks_list tbody").delegate("tr",'click',function(){
		statusTask=1;		
		$(this).addClass('active').siblings().removeClass('active');
		$("ul#task_details").removeClass("hidden");
		$("button#save_task").removeClass("hidden");
		$("ul#task_details li input#task").val($(this).children(".task_name").html());
		$("ul#task_details li textarea#task_description").val($(this).children(".task_description").html());
	});
}

function loadTasks(i){
	$("table#tasks_list tbody tr").remove();
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("getTasks"),					
		data: {'key' : i},	
		dataType : 'json',
		success : function (data){
			$.each(data, function(key,value){
				$("table#tasks_list tbody").append("<tr><td class='task_id'>"+value.task_id+"</td><td class='task_name'>"+
					value.task+"<td><td class='task_description'>"+value.task_description+"</td></tr>");
			});
		}			
	});
}

function updateSkill(i){
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("updateSkill"),					
		data: {
			'key' : i,
			'skill_band' : $("ul#skill_details li input#band").val(),
			'skill_description' : $("ul#skill_details li input#skill_description").val()
		},	
		dataType : 'json',
		success : function (data){
			alert("Changes saved");	
			$.each(data, function(key,value){
				$("table.skill_table#skills_list tbody tr.active td.skill_band").html(value.skill_band);
				$("table.skill_table#skills_list tbody tr.active td.skill_description").html(value.skill_band_description);
			});
		}				
	});	
}

function updateTask(i){	
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("updateTask"),					
		data: {
			'key' : i,
			'task_name' : $("ul#task_details li input#task").val(),
			'task_description' : $("ul#task_details li textarea#task_description").val()
		},	
		dataType : 'json',
		success : function (data){
			alert("Changes saved");	
			$.each(data, function(key, value){
				$("table.skill_table#tasks_list tbody tr.active td.task_name").html(value.task);
				$("table.skill_table#tasks_list tbody tr.active td.task_description").html(value.task_description);
			});
		}				
	});	
}

function clickSaveSkill(){
	$("button#save_skill").click(function(){	
		if ($("input#band").val().trim()=='' || $("input#skill_description").val().trim()==''){
			alert("Please fill all fields");
			return;
		}
	
		if (statusSkill==1){
			updateSkill($("table.skill_table#skills_list tbody tr.active td.skill_id").html());
		}
		if (statusSkill==2){		
			addSkill();
		}	
	});
}

function clickSaveTask(){
	$("button#save_task").click(function(){		
		if ($("input#task").val().trim()=='' || $("textarea#task_description").val().trim()==''){
			alert("Please fill all fields");
			return;
		}
	
		if (statusTask==1){
			updateTask($("table.skill_table#tasks_list tbody tr.active td.task_id").html());
		}
		if (statusTask==2){		
			addTask();			
		}	
	});	
}

function clickAddSkill(){
	$("button#new_skill").click(function(){
		statusSkill=2;
		$("table.skill_table#skills_list tbody tr").removeClass('active');
		$("ul#skill_details li input").val('');	
		$("ul#skill_details").removeClass("hidden");
		$("div#tasks").addClass("hidden");		
		$("button#save_skill").removeClass("hidden");
	});
}

function clickAddTask(){
	$("button#new_task").click(function(){
		statusTask=2;
		$("table.skill_table#tasks_list tbody tr").removeClass('active');
		$("ul#task_details li input").val('');	
		$("ul#task_details li textarea").val('');
		$("ul#task_details").removeClass("hidden");
		$("button#save_task").removeClass("hidden");
	});	
}

function onFormChange(){
	$("ul#task_details li input").keydown(function(){
		$("button#save_task").removeClass("disabled");
	});	
	$("ul#task_details li textarea").keydown(function(){
		$("button#save_task").removeClass("disabled");
	});	
	$("ul#skill_details li input").keydown(function(){
		$("button#save_skill").removeClass("disabled");
	});	
}

function addSkill(){
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("addSkill"),					
		data: {
			'sport' : select,
			'skill_band' : $("ul#skill_details li input#band").val(),
			'skill_description' : $("ul#skill_details li input#skill_description").val()
		},		
		success : function (){
			alert("Skill added");				
			location.reload();
		}				
	});
}

function addTask(){
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("addTask"),					
		data: {
			'skill_id' : $("table.skill_table#skills_list tbody tr.active td.skill_id").html(),
			'task' : $("ul#task_details li input#task").val(),
			'task_description' : $("ul#task_details li textarea#task_description").val()
		},		
		success : function (){
			alert("Task added");				
			location.reload();
		}				
	});
}

function cleanSkillDetails(){
	$("ul#task_details li input").val('');	
	$("ul#task_details li textarea").val('');
}

var main = function(){
	tabClick();
	loadSkills();
	skillClick();
	taskClick();
	clickAddSkill();
	clickAddTask();
	onFormChange();
	clickSaveSkill();
	clickSaveTask();
}

$(document).ready(main);