var status = 0;
var tasks = [];
function tabClick() {
	$(".tabs").on('click', '.tab-link', function () {
		$(this).addClass('current').siblings().removeClass('current');
		$("select#skill").addClass('hidden');
		$("select#group").addClass('hidden');
		$("label#skill").addClass('hidden');
		$("label#group").addClass('hidden');
		$('div#main_content').addClass('hidden');
		$('select#term').val('null');
		loadYears();
	});
}

function onYearClick() {
	$("select#year").change(function () {
		$('button#add_group').addClass('hidden');
		$('div#main_content').addClass('hidden');
		$('div#select_menu select#term option').not(".null").remove();
		$("select#skill").addClass('hidden');
		$("select#group").addClass('hidden');
		$("label#skill").addClass('hidden');
		$("label#group").addClass('hidden');

		$.ajax({
			type : 'post',
			url : js_base_url("get_term_select"),
			data : {
				'year' : $("select#year").val()
			},
			dataType : 'html',
			success : function (data) {
				$("label#term").removeClass('hidden');
				$("select#term").removeClass('hidden');
				$("select#term").append(data);
			}
		});
	});
}

function onTermClick() {
	$("select#term").change(function () {
		$('button#add_group').addClass('hidden');
		$('div#main_content').addClass('hidden');
		$("select#skill").addClass('hidden');
		$("select#group").addClass('hidden');
		$("label#skill").addClass('hidden');
		$("label#group").addClass('hidden');
		$('div#select_menu select#skill option').not(".null").remove();
		if ($("select#term").val() !== 'null') {
			$.ajax({
				type : 'post',
				url : js_base_url("getSkillsSelect"),
				data : {
					'sport' : $("li.tab-link.current").attr("id")
				},
				dataType : 'html',
				success : function (data) {
					$("label#skill").removeClass('hidden');
					$("select#skill").removeClass('hidden');
					$("select#skill").append(data);
				}
			});
		}
	});
}

function onSkillClick() {
	$("select#skill").change(function () {
		$('div#main_content').addClass('hidden');
		$('div#select_menu select#group option').not(".null").remove();
		$('button#add_group').removeClass('hidden');
		if ($("select#skill").val() !== 'null') {
			$.ajax({
				type : 'post',
				url : js_base_url("getGroupsSelect"),
				data : {
					'skill' : $("select#skill").val(),
					'term' : $("select#term").val()
				},
				dataType : 'html',
				success : function (data) {
					$("label#group").removeClass('hidden');
					$("select#group").removeClass('hidden');
					$("select#group").append(data);
				}
			});
		} else
			$("select#group").addClass('hidden');
	});
}

function loadYears() {		
	if ($("select#year").val() == null){		
		$("select#year option").remove();
		$('select#term option').not(".null").remove();
		$.ajax({
			type : 'Post',
			url : js_base_url("get_year_select"),
			dataType : 'html',
			success : function (data) {
				$("select#year").append(data);
			}
		});
		$.ajax({
			type : 'post',
			url : js_base_url("get_term_select"),
			data : {
				'year' : new Date().getFullYear()
			},
			dataType : 'html',
			success : function (data) {
				$("label#term").removeClass('hidden');
				$("select#term").removeClass('hidden');
				$("select#term").append(data);
			}
		});
	}
}

function onGroupClick() {
	$("select#group").change(function () {
		if ($(this).val() == 'null') {
			$('div#main_content').addClass('hidden');
			return;
		}
		$('div#main_content').removeClass('hidden');
		$('button#save_changes').addClass('disabled');
		getListOfStaff();
		pullLessons();
		getDayOfWeek();
		getNumParticipants();
		getTimes();
		getChildren();
		getDays();
		getGroupTasks();
		showFullInfo();
	});
}

function pullLessons() {
	if ($("select#group").val() !== 'null') {
		$.ajax({
			type : 'post',
			url : js_base_url("getLessonsSelect"),
			data : {
				'sport' : $("li.tab-link.current").attr("id"),
				'group' : $("select#group").val()
			},
			dataType : 'html',
			success : function (data) {
				$("select#lesson option").remove();
				$("select#lesson").append(data);
				$("input#group_name").val($("select#group option:selected").html());
			}
		});
	}
}

function getDayOfWeek() {
	$.post(js_base_url("getGroupDay"), {
		'group' : $("select#group").val()
	}, function (data) {
		$("input:radio[name='day'][value='" + data + "']").prop('checked', true);
	});
}

function getNumParticipants() {
	$.post(js_base_url("getNumPeople"), {
		'group' : $("select#group").val()
	}, function (data) {
		$("input#number_members").val(data);
	});
}

function clickDay() {
	$("input:radio[name=day]").change(function () {});
}

function getTimes() {
	$.post(js_base_url("getGroupTimes"), {
		'group' : $("select#group").val()
	}, function (data) {
		$("input#start_time").val(data.start_time);
		$("input#end_time").val(data.end_time);
	}, 'json');
}

function getChildren() {
	$.post(js_base_url("get_children_list"), {
		'group' : $("select#group").val(),
		'skill' : $("select#skill").val(),
		'term' : $("select#term").val()
	},
		function (data) {
		$("table#members tbody tr").remove();
		$("table#members tbody").append(data);
	}, 'html');
}

function getDays() {
	$.post(js_base_url("getTrainingDays"), {
		'group' : $("select#group").val(),
	},
		function (data) {
		$('select#training_day option').not(".null").remove();
		$("select#training_day").append(data);
	}, 'html');
}

function getGroupTasks() {
	$.post(js_base_url("getGroupTasks"), {
		'skill' : $("select#skill").val(),
	},
		function (data) {
		$("table#tasks tbody tr").remove();
		$("table#tasks tbody").append(data);
	}, 'html');
}

function clickMember() {
	$('table#members tbody').delegate('tr', 'click', function () {
		if ($(this).find("input").prop('checked')) {
			$("button#save_progress").addClass('disabled');
			$(this).addClass('active').siblings().removeClass('active');
			emptyProgress();
			getProgress();
		} else {
			emptyProgress();
		}
	});
}

function emptyProgress() {
	$("table#tasks tbody tr td input").prop('checked', false);
	$('input[name="attended"]').prop('checked', false);
	$('textarea#notes').val('');
}

function getProgress() {
	if ($("select#training_day").val() !== 'null') {
		populateProgress();
	}
}

function selectDay() {
	$("select#training_day").change(function () {
		$("button#save_progress").addClass('disabled');
		if ($('table#members tbody tr').hasClass('active') && $(this).val() !== 'null')
			populateProgress();
		else
			emptyProgress();
	});
}

function populateProgress() {
	emptyProgress();
	$.post(js_base_url("getMemberProgress"), {
		'day' : $("select#training_day").val(),
		'member_id' : $("table#members tbody tr.active td.member_id").html(),
	},
		function (data) {
		if (data.attendance == '1')
			$("ul#progress li input[name='attended']").prop('checked', true);
		$.each(data.tasks, function (key, value) {
			$("table#tasks tr[data-value='" + value + "'] td input.accomplished").prop('checked', true);
		});
		$("textarea#notes").val(data.notes);
	}, 'json');
}

function tickChange() {
	$(document).on('change', 'table#members tr td input.in_group', function () {
		$("button#save_progress").removeClass('disabled');
		var num = parseInt($("input#number_members").val());
		var checked = $("table#members tr td input.in_group:checked").length;
		if ($(this).prop('checked')) {
			if (checked > num) {
				alert('you cannot choose more than ' + num + ' members');
				$(this).prop('checked', false);
			} else {
				addMember($(this).parent('td').siblings('.member_id').html());
			}
		} else
			removeMember($(this).parent('td').siblings('.member_id').html());
	});
}

function removeMember(i) {
	$.post(js_base_url("removeMemberGroup"), {
		'member_id' : i,
		'group_id' : $("select#group").val()
	});
}

function addMember(i) {
	$.post(js_base_url("addMemberGroup"), {
		'member_id' : i,
		'group_id' : $("select#group").val()
	});
}

function readTasks() {
	tasks = [];
	$("table#tasks tbody tr").each(function () {
		if ($(this).find('input').prop('checked'))
			tasks.push($(this).attr('data-value'));
	});
}

function clickSaveProgress() {
	$("button#save_progress").click(function () {
		if ($('table#members tbody tr').hasClass('active') && $("select#training_day").val() !== 'null') {
			readTasks();
			$.post(js_base_url("update_member_progress"), {
				'member_id' : $("table#members tbody tr.active td.member_id").html(),
				'day' : $("select#training_day").val(),
				'attendance' : $('input[name="attended"]').prop('checked'),
				'tasks' : tasks,
				'notes' : $("textarea#notes").val()
			}, function () {
				alert('Progress stored');
			});
		}
	});
}

function onProgressChange() {
	$('input[name="attended"]').change(function () {
		if ($("select#training_day").val() !== 'null')
			$("button#save_progress").removeClass('disabled');
	});

	$(document).on('change', 'input.accomplished', function () {
		if ($("select#training_day").val() !== 'null')
			$("button#save_progress").removeClass('disabled');
	});

	$("textarea#notes").keydown(function () {
		if ($("select#training_day").val() !== 'null')
			$("button#save_progress").removeClass('disabled');
	});
}

function onGroupDetailsChange() {
	$('select#lesson, select#staff').change(function () {
		$('button#save_changes').removeClass('disabled');
	});
	$('ul#group_details input').bind('keydown change', function () {
		$('button#save_changes').removeClass('disabled');
	});
}

function clickSaveGroup() {
	$('button#save_changes').click(function () {
		if($("input#group_name").val().trim()=='' || $("input#number_members").val().trim()=='' 
			|| $("input#start_time").val().trim()=='' || $("input#end_time").val().trim()==''){
			alert('Please fill all fields');
			return;
		}
		
		if (status == 0) {
			updateGroup();
		} else {
			createGroup();
		}
	});
}

function updateGroup() {
	var grId = $('select#group').val();
	$.post(js_base_url("update_group"), {
		'group' : grId,
		'name' : $('input#group_name').val(),
		'type' : $('select#lesson').val(),
		'skill' : $('select#skill').val(),
		'num' : $('input#number_members').val(),
		'term' : $('select#term').val(),
		'staff' : $('select#staff').val(),
		'day' : $('input:radio[name="day"]:checked').val(),
		'sttime' : $('input#start_time').val(),
		'entime' : $('input#end_time').val(),
	}, function (data) {
		if (data=='fail'){
			alert('Start time has to be less than End time');
			return;
		}
		alert('Group has been updated');
		$('select#group option[value="' + grId + '"]').html($('input#group_name').val());
		getDays();
		$('button#add_group').addClass('disabled');
	});
}

function createGroup() {
	$.post(js_base_url("create_group"), {
		'name' : $('input#group_name').val(),
		'type' : $('select#lesson').val(),
		'skill' : $('select#skill').val(),
		'num' : $('input#number_members').val(),
		'term' : $('select#term').val(),
		'staff' : $('select#staff').val(),
		'day' : $('input:radio[name="day"]:checked').val(),
		'sttime' : $('input#start_time').val(),
		'entime' : $('input#end_time').val(),
	}, function (data) {
		if (data=='fail'){
			alert('Start time has to be less than End time');
			return;
		}
		alert('Group has been added');
		location.reload();
	});
}

function clickAddGroup() {
	$('button#add_group').click(function () {
		status = 1;
		$('select#group').val('null');
		$('select#lesson').val('');
		$('ul#group_details li input').not(':radio[name="day"]').val('');
		$('input:radio[name="day"]').prop('checked', false);
		$.ajax({
			type : 'post',
			url : js_base_url("getLessonsSelect"),
			data : {
				'sport' : $("li.tab-link.current").attr("id"),
				'group' : $("select#group").val()
			},
			dataType : 'html',
			success : function (data) {
				$("select#lesson option").remove();
				$("select#lesson").append(data);
			}
		});

		getListOfStaff();
		showDetailsOnly();
	});
}

function showDetailsOnly() {
	$('div#main_content').removeClass('hidden');
	$('table#members').addClass('hidden');
	$('div#personal_data').addClass('hidden');
}

function showFullInfo() {
	$('table#members').removeClass('hidden');
	$('div#personal_data').removeClass('hidden');
}

function getListOfStaff() {
	$.post(js_base_url("getStaffOptions"), {
		'group' : $('select#group').val()
	}, function (data) {
		$('select#staff').html(data);
	}, 'html');
}

function initialLoad() {
	if ($('select#group').val() !== 'null') {
		$('div#main_content').removeClass('hidden');
		$("label#skill").removeClass('hidden');
		$("label#group").removeClass('hidden')
		$('select#skill').removeClass('hidden');
		$('select#group').removeClass('hidden');
		$("label#term").removeClass('hidden');
		$("select#term").removeClass('hidden');
		getListOfStaff();
		pullLessons();
		getDayOfWeek();
		getNumParticipants();
		getTimes();
		getChildren();
		getDays();
		getGroupTasks();
		showFullInfo();
	}
}

var main = function () {
	tabClick();
	loadYears();
	onYearClick();
	onTermClick();
	onSkillClick();
	onGroupClick();
	clickDay();
	clickMember();
	getProgress();
	tickChange();
	clickSaveProgress();
	selectDay();
	onProgressChange();
	onGroupDetailsChange();
	clickAddGroup();
	clickSaveGroup();
	initialLoad();
}

$(document).ready(main);
