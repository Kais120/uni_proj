var array = {};
var arrayChild = {};
var arrayMedical = [];
var status = 0;
var statusPayment = 0;

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
	arrayMedical = [];
	if ($("input#asthma").prop('checked'))
		arrayMedical.push(1);
	if ($("input#diabetes").prop('checked'))
		arrayMedical.push(2);
	if ($("input#respiratory").prop('checked'))
		arrayMedical.push(3);
	if ($("input#epilepsy").prop('checked'))
		arrayMedical.push(4);
	if ($("input#blood").prop('checked'))
		arrayMedical.push(5);
	if ($("input#heart").prop('checked'))
		arrayMedical.push(6);
	if ($("input#special").prop('checked'))
		arrayMedical.push(7);
}

function parentDataPopulate() {
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("get_member_info"),
		contentType : "application/json; charset=utf-8",
		dataType : 'json',
		success : function (data) {
			$.each(data, function (key, value) {
				$("#parent_list tbody").append("<tr><td class='ID'>" + value.registration_id + "</td><td class='fname'>" + value.parent_fname + "</td><td class='lname'> " + value.parent_lname + "</td></tr>");
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
		url : js_base_url("getChildInfo"),
		cache : false,
		type : 'POST',
		data : {
			'key' : i
		},
		dataType : 'json',
		success : function (data) {
			$.each(data, function (key, value) {
				$('<li class="tab-link child-tab" data-value="' + value.member_id + '">' + value.member_fname + '</li>').insertBefore("#add_child");
				arrayChild[value.member_id] = value;
			});
		}
	});

}

function retrieveChildData(i) {
	$('ul#medical_condition input').prop('checked', false);
	$("#childFirstName").val(arrayChild[i].member_fname);
	$("#childMiddleName").val(arrayChild[i].member_mname);
	$("#childLastName").val(arrayChild[i].member_lname);
	$("#childDOB").val(arrayChild[i].member_dob);
	$("#medical_notes").val(arrayChild[i].medical_notes);
	loadMemberSkills();
	$.ajax({
		url : js_base_url("getChildMedical"),
		cache : false,
		type : 'POST',
		data : {
			'key' : arrayChild[i].member_id
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
		$("button#delete_parent").addClass("disabled");
		$("button#delete_child").addClass("disabled");
		checkParent($("table#parent_list tr.active td.ID").html());
	});
}

function checkParent($id) {
	$.post(js_base_url('check_parent'), {
		"parent" : $id
	},
		function (data) {
		if (data == 0)
			$("button#delete_parent").removeClass("disabled");
	});
}

function cleanParentFields() {
	$(".biodata :input").val('');
}

function onClickSave() {
	$('#save_parent_details').click(function () {
		if ($("input#firstName").val().trim() == '' || $("input#lastName").val().trim() == ''
			 || $("input#suburb").val().trim() == '' || $("input#mobileNumber").val().trim() == ''
			 || $("input#mobileNumber").val().trim() == '') {
			alert("Please fill all required fields");
			return;
		}

		if (!$("input#firstName").val().match('^[a-zA-Z ]*$') || !$("input#middleName").val().match('^[a-zA-Z ]*$')
			 || !$("input#lastName").val().match('^[a-zA-Z ]*$')) {
			alert("Incorrect name(s)");
			return;
		}

		if (!$("input#suburb").val().match('^[a-zA-Z ]*$')) {
			alert("Incorrect suburb name");
			return;
		}

		if (!$("input#postcode").val().match('^[1-9][0-9]{3}$')) {
			alert("Incorrect postcode");
			return;
		}

		if (!$("input#email").val().match('^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$') && !$("input#email").val().trim() == '') {
			alert("Incorrect email");
			return;
		}

		if ((!$("input#homeNumber").val().match('^0[1-9]{9}$') && !$("input#homeNumber").val().trim() == '') ||
			!$("input#mobileNumber").val().match('^0[1-9]{9}$') ||
			(!$("input#officeNumber").val().match('^0[1-9]{9}$') && !$("input#officeNumber").val().trim() == '')) {
			alert("Incorrect phone number(s)");
			return;
		}

		if (status == 1) {
			updateParent();
		} else if (status == 2) {
			registerParent();
		}
	});
}

function onClickSaveChild() {
	$('#save_child_details').click(function () {
		if ($("input#childFirstName").val().trim() == '' || $("input#childLastName").val().trim() == '' ||
			$("input#childDOB").val().trim() == '') {
			alert("Please fill all required fields");
			return;
		}

		if (!$("input#childFirstName").val().match('^[a-zA-Z ]*$') || !$("input#childMiddleName").val().match('^[a-zA-Z ]*$')
			 || !$("input#childLastName").val().match('^[a-zA-Z ]*$')) {
			alert("Incorrect name(s)");
			return;
		}

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
		url : js_base_url("add_child"),
		type : 'POST',
		data : {
			'parentKey' : key,
			'childFirstName' : $("#childFirstName").val(),
			'childMiddleName' : $("#childMiddleName").val(),
			'childLastName' : $("#childLastName").val(),
			'childDOB' : $("#childDOB").val(),
			'medical' : arrayMedical,
			'notes' : $('textarea#medical_notes').val(),
			'tennis_skill' : $('select#skill_tennis').val(),
			'tennis_number' : $('input#tennis_number').val(),
			'swimming_skill' : $('select#skill_swimming').val(),
			'swimming_number' : $('input#swimming_number').val()
		},
		success : function (data) {
			alert('The member has been added');
			location.reload();
		}
	});

}

function updateChild() {
	var key = $("li.tab-link.child-tab.current").attr('data-value');
	$.ajax({
		url : js_base_url("updateChildInfo"),
		type : 'POST',
		data : {
			'key' : key,
			'childFirstName' : $("#childFirstName").val(),
			'childMiddleName' : $("#childMiddleName").val(),
			'childLastName' : $("#childLastName").val(),
			'childDOB' : $("#childDOB").val(),
			"notes" : $('textarea#medical_notes').val(),
			'medical' : arrayMedical,
			'tennis_skill' : $('select#skill_tennis').val(),
			'tennis_number' : $('input#tennis_number').val(),
			'swimming_skill' : $('select#skill_swimming').val(),
			'swimming_number' : $('input#swimming_number').val()
		},
		dataType : 'json',
		success : function (data) {
			alert("Changes saved");
			arrayChild[key] = data[0];
			$("li.tab-link.child-tab.current").html(data[0].member_fname);
			$("#save_child_details").addClass("disabled");
			retrieveChildData(key);
		}
	});

}

function updateParent() {
	var key = $("tr.active td.ID").html();
	$.ajax({
		url : js_base_url("updateParentInfo"),
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
			$("#member").text(array[key].parent_fname + " " + array[key].parent_lname);
			alert("Changes saved");
			$("#save_parent_details").addClass("disabled");
		}
	});
}

function registerParent() {
	$.ajax({
		url : js_base_url("addParent"),
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
			alert("The registration has been added");
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
			arrayMedical = 'null';
			$('div#progress').addClass('hidden');
			$(".child-content").addClass('current').siblings().removeClass('current');
			$("#save_child_details").addClass("disabled");
			$('input#tennis_number').attr('readonly', true);
			$('input#swimming_number').attr('readonly', true);
			cleanChildFields();
			$("button#delete_child").addClass("disabled");
		} else if ($(this).is('.child-tab')) {
			status = 3;
			$("button#delete_child").addClass("disabled");
			$(".child-content").addClass('current').siblings().removeClass('current');
			$("#save_child_details").addClass("disabled");
			$("select#progress_term").val('null');
			$("table#progress_list tbody tr").remove();
			$("div#tasks_list").empty();
			retrieveChildData(parseInt($(this).attr('data-value')));
			loadProgressTerms();
			checkChild($(this).attr('data-value'));
		} else if ($(this).is('#payment_tab')) {
			$(".payment-content").addClass('current').siblings().removeClass('current');
			loadPaymentTerms();
		} else {
			$(".member-details").addClass('current').siblings().removeClass('current');
		}
	});
}

function checkChild(id) {
	$.post(js_base_url('check_child'), {
		"child" : id
	},
		function (data) {
		if (data > 0)
			$("button#delete_child").removeClass("disabled");
	});
}

function loadMemberSkills() {
	$('select#skill_tennis').val('null');
	$('select#skill_swimming').val('null');
	$('input#tennis_number').attr('readonly', true);
	$('input#tennis_number').val('');
	$('input#swimming_number').attr('readonly', true);
	$('input#swimming_number').val('');
	$.post(js_base_url("getChildLevels"), {
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
	$.post(js_base_url("getSkillsList"),
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

function onProgressYearChange() {
	$('select#progress_year').change(function () {
		$("div#tasks_list").empty();
		$('table#progress_list tbody tr').remove();
		if ($(this).val() !== 'null') {
			loadProgressTerms();
		} else {
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
	$.post(js_base_url("getMemberProgressList"), {
		'child' : $("li.tab-link.child-tab.current").attr('data-value'),
		'term' : $('select#progress_term').val()
	}, function (data) {
		$('table#progress_list tbody tr').remove();
		$('table#progress_list tbody').append(data);
	}, 'html');
}

function onProgressClick() {
	$('table#progress_list tbody').delegate('tr', 'click', function () {
		$(this).addClass('active').siblings().removeClass('active');
		loadDetails();
	});
}

function loadDetails() {
	$.post(js_base_url("getPerformedTasks"), {
		'progress' : $('table#progress_list tbody tr.active').attr('data-value')
	}, function (data) {
		$("div#tasks_list").empty();
		$("div#tasks_list").append(data);
	}, 'html');
}

function searchByName() {
	$("input#parent_search").keyup(function () {
		var input = $("input#parent_search").val();
		$('table#parent_list tbody tr').addClass('hidden');
		$('div.biodata').addClass('hidden');
		removeTabs();
		if (!input) {
			$('table#parent_list tbody tr').removeClass('hidden');
		} else {
			$('table#parent_list tbody tr').each(function () {
				if ($(this).children('.fname').html().toLowerCase().indexOf(input.toLowerCase()) > -1 || $(this).children('.lname').html().toLowerCase().indexOf(input.toLowerCase()) > -1)
					$(this).removeClass('hidden');
			});
		}
	});
}

function loadYears() {
	$.post(js_base_url('get_year_select'),
		function (data) {
		$('select.year').append(data);
	}, 'html');
}

function onYearClick() {
	$('select#payment_year').change(function () {
		loadPaymentTerms();
	});
}

function loadPaymentTerms() {
	$.post(js_base_url('get_term_select'), {
		'year' : $('select#payment_year').val()
	},
		function (data) {
		$('select#payment_term option').not('[value="null"]').remove();
		$('select#payment_term').append(data);
	}, 'html');
}

function onPaymentTermClick() {
	$('select#payment_term').change(function () {
		$.post(js_base_url('get_parent_payments'), {
			'term' : $('select#payment_term').val(),
			'parent' : $('table#parent_list tbody tr.active td.ID').html()
		}, function (data) {
			$('table#payment_list tbody tr').remove();
			$('table#payment_list tbody').append(data);
		}, 'html');
	});
};

function onPaymentClick() {
	$('table#payment_list tbody').delegate('tr', 'click', function () {
		$(this).addClass("active").siblings().removeClass('active');
		$("div#edit").removeClass("hidden");
		getPaymentDetails($(this).children("td.payment_id").html());
		getTransactions($(this).children("td.payment_id").html());
		$('div#transactions').removeClass('hidden');
		$('div#trans_details').addClass('hidden');
	});
}

function getPaymentDetails(paymentId) {
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("get_payment_details"),
		data : {
			'payment_id' : paymentId
		},
		dataType : 'json',
		success : function (data) {
			$('input#num_lessons').val(data.numlessons);
			$('input#total').val(data.total);
		}
	});
}

function getTransactions(paymentId) {
	$.post(js_base_url("get_transactions"), {
		'payment_id' : paymentId
	},
		function (data) {
		$("table#transaction_list tbody tr").remove()
		$("table#transaction_list tbody").append(data);
	}, 'html');
}

function transactionClick() {
	$('table#transaction_list tbody').delegate('tr', 'click', function () {
		$(this).addClass("active").siblings().removeClass('active');
		$('input#amount').val($(this).children('td.amount').html());
		$('select#type').val($(this).children('td.payment_type').html());
		$('div#trans_details').removeClass('hidden');
		$('button#save_transaction').addClass('disabled');
		statusPayment = 0;
	});
}

function onClickNewTransaction() {
	$('button#new_transaction').click(function () {
		$('table#transaction_list tbody tr').removeClass('active');
		$('input#amount').val('');
		$('select#type').val('cash');
		$('div#trans_details').removeClass('hidden');
		statusPayment = 1;
	});
}

function onClickSaveTransaction() {
	$('button#save_transaction').click(function () {
		$('div#trans_details').addClass('hidden');
		$('div#transactions').addClass('hidden');
		if (statusPayment == 0)
			saveTransaction();
		if (statusPayment == 1)
			addTransaction();

	});
}

function addTransaction() {
	$.post(js_base_url('add_transaction'), {
		'payment_id' : $("table#payment_list tbody tr.active td.payment_id").html(),
		'amount' : $('input#amount').val(),
		'type' : $('select#type').val()
	}, function () {
		$('button#save_transaction').addClass('disabled');
		getPayments($("select.term").val(), $("select.year").val());
	});
};

function saveTransaction() {
	$.post(js_base_url('save_transaction'), {
		'transaction_id' : $("table#transaction_list tbody tr.active td.transaction_id").html(),
		'amount' : $('input#amount').val(),
		'type' : $('select#type').val()
	}, function () {
		$('button#save_transaction').addClass('disabled');
		getPayments($("select.term").val(), $("select.year").val());

	});
}

function formChange() {
	$("input#num_lessons, input#total").bind('keyup change', function () {
		$("button#save_payment").removeClass('disabled');
	});

	$("input#amount, select#type").bind('keyup change', function () {
		$("button#save_transaction").removeClass('disabled');
	});
}

function onClickSavePayment() {
	$("button#save_payment").click(function () {
		$.ajax({
			type : "POST",
			cache : false,
			url : js_base_url("save_payment"),
			data : {
				'payment_id' : $("table#payment_list tbody tr.active td.payment_id").html(),
				'num_lessons' : $('input#num_lessons').val(),
				'total' : $('input#total').val()
			},
			success : function () {
				alert('saved');
				$("div#edit").addClass("hidden");
				$('button#save_payment').addClass('disabled');
			}
		});
		getPayments();
	});
}

function getPayments() {
	$.post(js_base_url('get_parent_payments'), {
		'term' : $('select#payment_term').val(),
		'parent' : $('table#parent_list tbody tr.active td.ID').html()
	}, function (data) {
		$('table#payment_list tbody tr').remove();
		$('table#payment_list tbody').append(data);
	}, 'html');
}

function loadProgressTerms() {
	$.post(js_base_url('get_term_select'), {
		'year' : $('select#progress_year').val()
	},
		function (data) {
		$('select#progress_term option').not('[value="null"]').remove();
		$('select#progress_term').append(data);
	}, 'html');
}

function clickDeleteParent() {
	$('button#delete_parent').click(function () {
		$.post(js_base_url('delete_parent'), {
			'parent' : $("table#parent_list tr.active td.ID").html()
		},
			function () {
			alert("The registration has been deleted");
			location.reload();
		});
	});
}

function clickDeleteChild() {
	$('button#delete_child').click(function () {
		$.post(js_base_url('delete_child'), {
			'child' : $("li.tab-link.child-tab.current").attr('data-value')
		},
			function () {
			alert("The member has been deleted");
			location.reload();
		});
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
	onSkillSelectChange();
	onProgressTermChange();
	onProgressClick();
	onProgressYearChange();
	searchByName();
	loadYears();
	onYearClick();
	onPaymentTermClick();
	onPaymentClick();
	transactionClick();
	onClickNewTransaction();
	onClickSaveTransaction();
	formChange();
	onClickSavePayment();
	clickDeleteParent();
	clickDeleteChild();
}

$(document).ready(main);
