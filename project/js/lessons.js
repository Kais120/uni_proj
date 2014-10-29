var select = 1;
var status = 0;

function pullLessons(){
	if ($("select#sport").val()!=='null'){
		$.ajax({
			type : 'Post',
			url : js_base_url("getLessons"),
			data: {'sport_id' : $("select#sport").val()},
			dataType : 'json',
			success : function (data){
				$.each(data, function(key, value){
					$("table#lessons_info tbody").append('<tr data-value="'+value.lesson_id+'"><td class="lesson_description">'+value.lesson_description
					+'</td><td class="lesson_cost">'+value.cost+'</td></tr>');
				});
			}
		});
	}	
}

function clickSport(){
	$("select#sport").change(function(){
		$("ul#lesson_details li input").val('');
		$("form#lesson_update").addClass('hidden');
		$("table#lessons_info tbody tr").remove();
		$("ul#lesson_details li input[name='sport_type']").val($("select#sport option:selected").html());
		pullLessons();
		if ($(this).val()!='null')
			$('button#new_lesson').removeClass("hidden");
		else
			$('button#new_lesson').addClass("hidden");
	});
}

function clickLesson(){
	$("table#lessons_info tbody").delegate('tr','click', function(){
		$(this).addClass('active').siblings().removeClass('active');
		$("form#lesson_update").removeClass('hidden');
		$("form#lesson_update").attr('action', js_base_url("updateLesson"));
		pullLessonDetails();
	});
}

function pullLessonDetails(){	
	$("ul#lesson_details li input[name='lesson_id']").val($("table#lessons_info tbody tr.active").attr('data-value'));
	$("ul#lesson_details li input[name='lesson_name']").val($("table#lessons_info tbody tr.active td.lesson_description").html());
	$("ul#lesson_details li input[name='lesson_cost']").val($("table#lessons_info tbody tr.active td.lesson_cost").html());
}

function clickNewLesson(){
	$("button#new_lesson").click(function(){
		$("table#lessons_info tbody tr").removeClass('active');
		$("ul#lesson_details li input").not("[name='sport_type']").val('');
		$("form#lesson_update").removeClass('hidden');
		$("form#lesson_update").attr('action', js_base_url("addLesson"));
	});
}

var main = function(){
	clickSport();
	clickLesson();
	clickNewLesson();
	$("ul#lesson_details li input").keydown(function(){
		$("button#save_lesson").removeClass('disabled');
	});
	
	$("ul#lesson_details li input[name='lesson_cost']").change(function(){
		$("button#save_lesson").removeClass('disabled');
	});
}

$(document).ready(main);