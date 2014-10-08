var array = {};
var array_child = {};
var array_medical = 'null';
var status = 0;

function onParentFormChange() {
	$(".biodata :input").keydown(function () {
		$("#save_parent_details").removeClass("disabled");
	});
}

function onChildFormChange() {
	$('div.child-content').find('input, textarea').bind('keydown change', function () {
		$("#save_child_details").removeClass("disabled");
		readMedicalCondition();
	});
}

function readMedicalCondition() {
	array_medical = {};
	if ($("input#asthma").prop('checked'))
		array_medical['1'] = true;
	if ($("input#diabetes").prop('checked'))
		array_medical['2'] = true;
	if ($("input#respiratory").prop('checked'))
		array_medical['3'] = true;
	if ($("input#epilepsy").prop('checked'))
		array_medical['4'] = true;
	if ($("input#blood").prop('checked'))
		array_medical['5'] = true;
	if ($("input#heart").prop('checked'))
		array_medical['6'] = true;
	if ($("input#special").prop('checked'))
		array_medical['7'] = true;
}

function parentDataPopulate() {
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("site/getMemberInfo"),
		contentType : "application/json; charset=utf-8",
		dataType : 'json',
		success : function (data) {
			$.each(data, function (key, value) {
				$("#parent_list tbody").append("<tr><td class='ID'>" + value.registration_id + "</td><td class='fname'>" + value.parent_fname + "</td><td class='lname'> " + value.parent_lname + "</td><tr>");
				array[value.registration_id] = value;
			});

		}
	});
}

function retrieveData(i) {
	$("#firstName").val(array[i].parent_fname);
	$("#middleName").val(array[i].parent_mname);
	$("#lastName").val(array[i].parent_lname);
	$("#addrLine1").val(array[i].address1);
	$("#addrLine2").val(array[i].address2);
	$("#suburb").val(array[i].suburb);
	$("#postcode").val(array[i].post_code);
	$("#email").val(array[i].email);
	$("#homeNumber").val(array[i].home_number);
	$("#mobileNumber").val(array[i].mobile_number);
	$("#officeNumber").val(array[i].office_number);
	$("#member").text(array[i].parent_fname + " " + array[i].parent_lname);
}

function removeTabs() {
	$(".child-tab").remove();
	$("#payment_tab").remove();
	$("#add_child").remove();
}

function retrieve_children(i) {
	$.ajax({
		url : js_base_url("site/getChildInfo"),
		cache : false,
		type : 'POST',
		data : {
			'key' : i
		},
		dataType : 'json',
		success : function (data) {
			$.each(data, function (key, value) {
				$('<li class="tab-link child-tab" data-value="' + value.member_id + '">' + value.member_fname + '</li>').insertBefore("#add_child");
				array_child[value.member_id] = value;
			});
		}
	});

}

function retrieveChildData(i) {
	$('ul#medical_condition input').prop('checked', false);
	$("#childFirstName").val(array_child[i].member_fname);
	$("#childMiddleName").val(array_child[i].member_mname);
	$("#childLastName").val(array_child[i].member_lname);
	$("#childDOB").val(array_child[i].member_dob);
	$("#medical_notes").val(array_child[i].medical_notes);
	loadMemberSkills();
	$.ajax({
		url : js_base_url("site/getChildMedical"),
		cache : false,
		type : 'POST',
		data : {
			'key' : array_child[i].member_id
		},
		dataType : 'json',
		success : function (data) {
			$.each(data, function (key, value) {
				switch (value.medical_condition_id) {
				case '1':
					$('input#asthma').prop('checked', true);
					break;
				case '2':
					$('input#diabetes').prop('checked', true);
					break;
				case '3':
					$('input#respiratory').prop('checked', true);
					break;
				case '4':
					$('input#epilepsy').prop('checked', true);
					break;
				case '5':
					$('input#blood').prop('checked', true);
					break;
				case '6':
					$('input#heart').prop('checked', true);
					break;
				case '7':
					$('input#special').prop('checked', true);
					break;
				}
			});
		}
	});
}

function onRegisterClick() {
	$("#new_parent_details").click(function () {
		status = 2;
		cleanParentFields();
		removeTabs();
		$('tr.active').removeClass('active');
		$("#member").text("New member");
		$(".biodata").removeClass('hidden');
	});
}

function onClickParent() {
	$("#parent_list tbody").delegate("tr", "click", function () {
		status = 1;
		removeTabs();
		$(".biodata").removeClass('hidden');
		$("ul.tabs").append('<li class="tab-link" id="payment_tab"><span class="glyphicon glyphicon-usd"></span> Payments</li>');
		$("ul.tabs").append('<li class="tab-link" id="add_child"><span class="glyphicon glyphicon-plus"></span> Add a child</li>');
		$('.tab-link#member-details').addClass('current');
		$(this).addClass("active").siblings().removeClass('active');
		retrieveData(parseInt($("tr.active td.ID").html()));
		retrieve_children(parseInt($("tr.active td.ID").html()));
	});
}

function cleanParentFields() {
	$(".biodata :input").val('');
}

function onClickSave() {
	$('#save_parent_details').click(function () {
		if (status == 1) {
			updateParent();
		} else if (status == 2) {
			registerParent();
		}
	});
}

function onClickSaveChild() {
	$('#save_child_details').click(function () {
		if (status == 3) {
			updateChild();
		} else if (status == 4) {
			addChild();
		}
	});
}

function addChild() {
	var key = $("tr.active td.ID").html();

	$.ajax({
		url : js_base_url("site/addChild"),
		type : 'POST',
		data : {
			'parentKey' : key,
			'childFirstName' : $("#childFirstName").val(),
			'childMiddleName' : $("#childMiddleName").val(),
			'childLastName' : $("#childLastName").val(),
			'childDOB' : $("#childDOB").val(),
			'medical' : array_medical,
			'notes' : $('textarea#medical_notes').val(),
			'tennis_skill' : $('select#skill_tennis').val(),
			'tennis_number' : $('input#tennis_number').val(),
			'swimming_skill' : $('select#skill_swimming').val(),
			'swimming_number' : $('input#swimming_number').val()
		},
		success : function (data) {
			alert('A child has been added');
			location.reload();
		}
	});

}

function updateChild() {
	var key = $("li.tab-link.child-tab.current").attr('data-value');

	$.ajax({
		url : js_base_url("site/updateChildInfo"),
		type : 'POST',
		data : {
			'key' : key,
			'childFirstName' : $("#childFirstName").val(),
			'childMiddleName' : $("#childMiddleName").val(),
			'childLastName' : $("#childLastName").val(),
			'childDOB' : $("#childDOB").val(),
			"notes" : $('textarea#medical_notes').val(),
			'medical' : array_medical,
			'tennis_skill' : $('select#skill_tennis').val(),
			'tennis_number' : $('input#tennis_number').val(),
			'swimming_skill' : $('select#skill_swimming').val(),
			'swimming_number' : $('input#swimming_number').val()
		},
		dataType : 'json',
		success : function (data) {
			alert("Changes saved");
			array_child[key] = data[0];
			$("li.tab-link.child-tab.current").html(data[0].member_fname);
			$("#save_child_details").addClass("disabled");
			retrieveChildData(key);
		}
	});

}

function updateParent() {
	var key = $("tr.active td.ID").html();
	$.ajax({
		url : js_base_url("site/updateParentInfo"),
		type : 'POST',
		dataType : 'json',
		data : {
			'key' : key,
			'firstName' : $("#firstName").val(),
			'middleName' : $("#middleName").val(),
			'lastName' : $("#lastName").val(),
			'addrLine1' : $("#addrLine1").val(),
			'addrLine2' : $("#addrLine2").val(),
			'suburb' : $("#suburb").val(),
			'postcode' : $("#postcode").val(),
			'email' : $("#email").val(),
			'homeNumber' : $("#homeNumber").val(),
			'mobileNumber' : $("#mobileNumber").val(),
			'officeNumber' : $("#officeNumber").val()
		},
		success : function (data) {
			array[key] = data[0];
			$('tr.active td.fname').html(array[key].parent_fname);
			$('tr.active td.lname').html(array[key].parent_lname);
			alert("Changes saved");
			$("#save_parent_details").addClass("disabled");
		}
	});
}

function registerParent() {
	$.ajax({
		url : js_base_url("site/addParent"),
		type : 'POST',
		data : {
			'firstName' : $("#firstName").val(),
			'middleName' : $("#middleName").val(),
			'lastName' : $("#lastName").val(),
			'addrLine1' : $("#addrLine1").val(),
			'addrLine2' : $("#addrLine2").val(),
			'suburb' : $("#suburb").val(),
			'postcode' : $("#postcode").val(),
			'email' : $("#email").val(),
			'homeNumber' : $("#homeNumber").val(),
			'mobileNumber' : $("#mobileNumber").val(),
			'officeNumber' : $("#officeNumber").val()
		},
		success : function () {
			alert("A member added");
			$("#save_parent_details").addClass("disabled");
			$("#parent_list tbody tr").remove();
			cleanParentFields();
			parentDataPopulate();
		}
	});
}

function cleanChildFields() {
	$(".child-content :input").val('');
	$(".child-content :input:checkbox").prop('checked', false);
}

function onTabClick() {
	$(".tabs").on('click', '.tab-link', function () {
		$(this).siblings().removeClass('current');
		$(this).addClass('current');
		if ($(this).is('#add_child')) {
			status = 4;
			array_medical = 'null';
			$('div#progress').addClass('hidden');
			$(".child-content").addClass('current').siblings().removeClass('current');
			$("#save_child_details").addClass("disabled");
			$('input#tennis_number').attr('readonly', true);
			$('input#swimming_number').attr('readonly', true);
			cleanChildFields();
		} else if ($(this).is('.child-tab')) {
			status = 3;
			$(".child-content").addClass('current').siblings().removeClass('current');
			$("#save_child_details").addClass("disabled");
			$("select#progress_term").val('null');
			$("table#progress_list tbody tr").remove();
			retrieveChildData(parseInt($(this).attr('data-value')));
		} else if ($(this).is('#payment_tab')) {
			$(".payment-content").addClass('current').siblings().removeClass('current');
			$('select#payment_term').val('null');
			$('table#payments tbody tr').remove();
			$('ul#payment_details').addClass('hidden');
			getChildSelect();
		} else {
			$(".member-details").addClass('current').siblings().removeClass('current');
		}
	});
}

function loadYears() {
	$("select.year option").remove();
	$('select.term option').not("[value='null']").remove();
	$.ajax({
		type : 'post',
		url : js_base_url("site/getYearsSelect"),
		dataType : 'html',
		success : function (data) {
			$("select.year").append(data);
		}
	});
	$.ajax({
		type : 'post',
		url : js_base_url("site/getTermsSelect"),
		data : {
			'year' : new Date().getFullYear()
		},
		dataType : 'html',
		success : function (data) {
			$("select.term").append(data);
		}
	})
}

function loadTerms() {
	$.ajax({
		type : 'post',
		url : js_base_url("site/getTermsSelect"),
		data : {
			'year' : $("select#payment_year").val()
		},
		dataType : 'html',
		success : function (data) {
			$("select#payment_term option").not("[value='null']").remove();
			$("select#payment_term").append(data);
		}
	});
}

function onSelectTermChange() {
	$('select#payment_term').change(function () {
		$('ul#payment_details').addClass('hidden');
		$('select#child').val('null');
		$('select#group').val('null');
		if ($(this).val !== 'null') {
			$('div#group_payment_panel').removeClass('hidden');
			getPayments();
		} else
			$('table#payments tbody tr').remove();
	});
}

function getPayments() {
	$.post(js_base_url("site/getPaymentsList"), {
		'parent' : $('table#parent_list tbody tr.active td.ID').html(),
		'term' : $('select#payment_term').val()
	},
		function (data) {
		$('table#payments tbody tr').remove();
		$('table#payments tbody').append(data);
	}, 'html')
}

function onClickPayment() {
	$('#payments tbody').delegate('tr', 'click', function () {
		$(this).addClass("active").siblings().removeClass('active');
		$('ul#payment_details').removeClass('hidden');
		getPaymentDetails();
	});
}

function getPaymentDetails() {
	$.post(js_base_url("site/getPaymentDetailsParent"), {
		'transaction_id' : $('#payments tbody tr.active td.payment_id').html()
	},
		function (data) {
		$("input#overall").val(data.overall);
		$("input#paid").val(data.paid);
		switch (data.type.toLowerCase()) {
		case 'cash':
			$("select#type").val('cash');
			break;
		case 'credit':
			$("select#type").val('credit');
			break;
		case 'eftpos':
			$("select#type").val('eftpos');
			break;
		}
		$("input#date").val(data.date);
	}, 'json');
}

function getChildSelect() {
	$.post(js_base_url("site/getSelectChild"), {
		'parent' : $('table#parent_list tbody tr.active td.ID').html()
	}, function (data) {
		$('select#child option').not("[value='null']").remove();
		$('select#child').append(data);
	}, 'html');
}

function onSelectChildChange() {
	$('select#child').change(function () {
		$('ul#group_payment_details').addClass('hidden');
		$('ul#new_payment_fields').addClass('hidden');
		$('button#add_payment_group').addClass('disabled');
		$('button#save_new_payment').addClass('disabled');
		$('button#save_payment_group').addClass('disabled');
		$('select#group option').not('[value="null"]').remove();
		if ($(this).val() !== 'null') {
			$('ul#group_payment_details').addClass('hidden');
			$('ul#group_payment_details li input').val('');
			getGroupSelect();
		}
	});
}

function getGroupSelect() {
	$.post(js_base_url("site/getGroupChild"), {
		'term' : $('select#payment_term').val(),
		'child' : $('select#child').val()
	},
		function (data) {
		$('select#group').append(data);
		$('select#group option:empty').remove();
	}, 'html');
}

function onSelectGroupChange() {
	$('select#group').change(function () {
		$('button#save_payment_group').addClass('disabled');
		$('button#add_payment_group').addClass('disabled');
		$('button#save_new_payment').addClass('disabled');
		if ($(this).val() !== 'null') {
			$.post(js_base_url("site/getPaymentDetailsGroup"), {
				'group' : $('select#group').val(),
				'child' : $('select#child').val()
			},
				function (data) {
				$('button#add_payment_group').removeClass('disabled');
				$('ul#group_payment_details').removeClass('hidden');
				$('ul#group_payment_details li input').val('');
				$('input#num_lessons').val(data.num);
				$('input#total_amount').val(data.total);
			}, 'json');
		} else {
			$('ul#group_payment_details').addClass('hidden');
		}
	});
}

function onPaymentDetailsChange() {
	$("input#paid, select#type, input#date").bind('keydown change', function () {
		$('button#save_payment').removeClass('disabled');
	})
}

function onSelectYearChange() {
	$('select#payment_year').change(function () {
		$('ul#payment_details').addClass('hidden');
		$('table#payments tbody tr').remove();
		loadTerms();
	});
}

function onClickSavePayment() {
	$('button#save_payment').click(function () {
		$.post(js_base_url("site/updatePayment"), {
			'transaction_id' : $('table#payments tbody tr.active td.payment_id').html(),
			'paid_date' : $('input#date').val(),
			'amount' : $('input#paid').val(),
			'type' : $('select#type').val()
		}, function () {
			alert('Changes saved');
			$('table#payments tbody tr.active td.amount').html($('input#paid').val());
			$('table#payments tbody tr.active td.payment_date').html($('input#date').val());
			$('table#payments tbody tr.active td.payment_type').html($('select#type').val());
			$('button#save_payment').addClass('disabled');
		});
	});
}

function onGroupPaymentDetailsChange() {
	$('ul#group_payment_details li input').bind('keydown change', function () {
		$('button#save_payment_group').removeClass('disabled');
	});
}

function onSavePaymentGroupClick() {
	$('button#save_payment_group').click(function () {
		$.post(js_base_url("site/updatePaymentGroup"), {
			'group' : $('select#group').val(),
			'child' : $('select#child').val(),
			'num_lessons' : $('input#num_lessons').val(),
			'total' : $('input#total_amount').val()
		}, function () {
			$('button#save_payment_group').addClass('disabled');
			$('ul#new_payment_fields').addClass('hidden');
			alert('Changes saved');
			getPayments();
			$("ul#payment_details").addClass('hidden');
		});
	});
}

function onNewPaymentChange() {
	$('select#type_new, input#amount').bind('keydown change', function () {
		$('button#save_new_payment').removeClass('disabled');
	});
}

function onClickSaveNewPayment() {
	$('button#save_new_payment').click(function () {
		$.post(js_base_url("site/addNewPayment"), {
			'group' : $('select#group').val(),
			'child' : $('select#child').val(),
			'type' : $('select#type_new').val(),
			'amount' : $('input#amount').val()
		}, function () {
			$('button#save_new_payment').addClass('disabled');
			alert('Payment added');
			getPayments();
			$("ul#payment_details").addClass('hidden');
			$('ul#new_payment_fields').addClass('hidden');
		});

	});
}

function onAddNewPaymentClick() {
	$('button#add_payment_group').click(function () {
		$('ul#new_payment_fields li input').val('');
		$('ul#new_payment_fields').removeClass('hidden');
	});
}

function loadMemberSkills() {
	$('select#skill_tennis').val('null');
	$('select#skill_swimming').val('null');
	$('input#tennis_number').attr('readonly', true);
	$('input#tennis_number').val('');
	$('input#swimming_number').attr('readonly', true);
	$('input#swimming_number').val('');
	$.post(js_base_url("site/getChildLevels"), {
		'child' : $("li.tab-link.child-tab.current").attr('data-value'),
	}, function (data) {
		$.each(data, function (key, value) {
			if (value.sport_id == '1') {
				$('select#skill_tennis').val(value.skill_id);
				$('input#tennis_number').attr('readonly', false);
				$('input#tennis_number').val(value.number_lessons);
			}
			if (value.sport_id == '2') {
				$('select#skill_swimming').val(value.skill_id);
				$('input#swimming_number').attr('readonly', false);
				$('input#swimming_number').val(value.number_lessons);
			}
		});
	}, 'json');
}

function getSkillsList() {
	$.post(js_base_url("site/getSkillsList"),
		function (data) {
		$.each(data, function (key, value) {
			if (value.sport_id == '1')
				$('select#skill_tennis').append('<option value="' + value.skill_id + '">' + value.skill_band + '</option>');
			if (value.sport_id == '2')
				$('select#skill_swimming').append('<option value="' + value.skill_id + '">' + value.skill_band + '</option>');
		});
	}, 'json');
}

function onSkillSelectChange() {
	$('select#skill_tennis').change(function () {
		if ($(this).val() !== 'null') {
			$('input#tennis_number').val(0);
			$('input#tennis_number').attr('readonly', false);
			$('button#save_child_details').removeClass('disabled');
		} else {
			$('input#tennis_number').val('');
			$('input#tennis_number').attr('readonly', true);
			$('button#save_child_details').removeClass('disabled');
		}

	});
	$('select#skill_swimming').change(function () {
		if ($(this).val() !== 'null') {
			$('input#swimming_number').val(0);
			$('input#swimming_number').attr('readonly', false);
			$('button#save_child_details').removeClass('disabled');
		} else {
			$('input#swimming_number').val('');
			$('input#swimming_number').attr('readonly', true);
			$('button#save_child_details').removeClass('disabled');
		}

	});
}

function onProgressYearChange(){
	$('select#progress_year').change(function () {
		$("div#tasks_list").empty();
		$('table#progress_list tbody tr').remove();
		if ($(this).val() !== 'null') {
			loadTerms();
		}else {
			$('select#progress_term').not('[value="null"]').remove();
		}
	});
};

function onProgressTermChange() {
	$('select#progress_term').change(function () {
		$("div#tasks_list").empty();
		if ($(this).val() !== 'null') {
			loadProgress();
		} else {
			$('table#progress_list tbody tr').remove();
		}
	});
};

function loadProgress() {
	$.post(js_base_url("site/getMemberProgressList"), {
		'child' : $("li.tab-link.child-tab.current").attr('data-value'),
		'term' : $('select#progress_term').val()
	}, function (data) {
		$('table#progress_list tbody tr').remove();
		$('table#progress_list tbody').append(data);
	}, 'html');
}

function onProgressClick(){
	$('table#progress_list tbody').delegate('tr','click',function(){
		$(this).addClass('active').siblings().removeClass('active');
		loadDetails();
	});
}

function loadDetails(){
	$.post(js_base_url("site/getPerformedTasks"), {
		'progress' : $('table#progress_list tbody tr.active').attr('data-value')
	}, function (data) {
		$("div#tasks_list").empty();
		$("div#tasks_list").append(data);
	}, 'html');
}

function searchByName(){
	$("input#parent_search").keyup(function(){
		var input = $("input#parent_search").val();
		$('table#parent_list tbody tr').addClass('hidden');
		$('div.biodata').addClass('hidden');
		removeTabs();		
		if (!input){
			$('table#parent_list tbody tr').removeClass('hidden');	
		}else{			
			$('table#parent_list tbody tr').each(function(){
				if ($(this).html().indexOf(input)>-1)
					$(this).removeClass('hidden');
			})
		}
	});
}

var main = function () {	
	parentDataPopulate();
	getSkillsList();
	onRegisterClick();
	onClickParent();
	onClickSave();
	onClickSaveChild();
	onTabClick();
	onChildFormChange();
	onParentFormChange();
	loadYears();
	onSelectTermChange();
	onClickPayment();
	onSelectChildChange();
	onSelectGroupChange();
	onPaymentDetailsChange();
	onSelectYearChange();
	onClickSavePayment();
	onGroupPaymentDetailsChange();
	onSavePaymentGroupClick();
	onNewPaymentChange();
	onClickSaveNewPayment();
	onAddNewPaymentClick();
	onSkillSelectChange();
	onProgressTermChange();
	onProgressClick();
	onProgressYearChange();
	searchByName();
}

$(document).ready(main);
