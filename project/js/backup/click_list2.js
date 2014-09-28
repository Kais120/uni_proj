var array = {};
var array_child = {};


function on_parent_form_change() {
	$(".biodata :input").keydown(function () {
		$("#save_parent_details").removeClass("disabled");
	});
}

function on_child_form_change() {
	$(".child-content :input").keydown(function () {
		$("#save_child_details").removeClass("disabled");
	});
	$(".medical :input:checkbox").click(function () {
		$("#save_child_details").removeClass("disabled");
	});
}

function parent_data_populate() {
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("site/get_member_info"),
		contentType : "application/json; charset=utf-8",
		dataType : 'json',
		success : function (data) {
			$.each(data, function (key, value) {
				$("#parent_list tbody").append("<tr id=" + value.registration_id + "><td>" + value.parent_fname + "</td><td> " + value.parent_lname + "</td><tr>");
				array[value.registration_id] = value;
			});

		}
	});
}

function retrieve_data(i) {
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

function remove_tabs() {
	$(".child-tab").remove();
	$("#payment_tab").remove();
	$("#add_child").remove();
}

function retrieve_children(i) {
	$.ajax({
		url : js_base_url("site/get_child_info"),
		cache : false,
		type : 'POST',
		data : {
			'key' : i
		},
		dataType : 'json',
		success : function (data) {
			$.each(data, function (key, value) {
				$('<li class="tab-link child-tab" id="' + value.member_id + '">' + value.member_fname + '</li>').insertAfter("#payment_tab");
				array_child[value.member_id] = value;
			});
		}
	});
}

function retrieve_child_data(i) {
	$("#childFirstName").val(array_child[i].member_fname);
	$("#childMiddleName").val(array_child[i].member_mname);
	$("#childLastName").val(array_child[i].member_lname);
	$("#childDOB").val(array_child[i].member_dob);

}

function click_register_parent() {
	$("#new_parent_details").click(function () {
		clean_parent_fields();
		remove_tabs();
		$('tr.active').removeClass('active');
		$("#member").text("New member");
		$(".biodata").removeClass('hidden');
		on_parent_form_change();
		register_member();
	});
}

function click_parent() {
	$("#parent_list tbody").delegate("tr", "click", function () {
		remove_tabs();
		$(".biodata").removeClass('hidden');
		$("ul.tabs").append('<li class="tab-link" id="payment_tab"><span class="glyphicon glyphicon-usd"></span> Payments</li>');
		$("ul.tabs").append('<li class="tab-link" id="add_child"><span class="glyphicon glyphicon-plus"></span> Add a child</li>');
		$('.tab-link#member-details').addClass('current');
		$(this).addClass("active").siblings().removeClass('active');
		retrieve_data($(this).attr('id'));
		retrieve_children($(this).attr('id'));
		on_parent_form_change();
	});
}

function clean_parent_fields() {
	$(".biodata :input").val('');
}

function update_parent_info() {
	if ($("#parent_list tbody").children().hasClass("active")){
	$('#save_parent_details').click(function () {
		//var checked;
		var key = $("#parent_list tbody tr.active").attr('id');

		$.ajax({
			url : js_base_url("site/update_parent_info"),
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
				$('#parent_list tbody tr#' + key + ' td:eq(0)').html(array[key].parent_fname);
				$('#parent_list tbody tr#' + key + ' td:eq(1)').html(array[key].parent_lname);
				alert("Changes saved");
				$("#save_parent_details").addClass("disabled");
			}
		});

	});
	}

}

function update_child_info() {
	$('#save_child_details').click(function () {
		var key = $("li.tab-link.child-tab.current").attr('id');

		$.ajax({
			url : js_base_url("site/update_child_info"),
			type : 'POST',
			data : {
				'key' : key,
				'childFirstName' : $("#childFirstName").val(),
				'childMiddleName' : $("#childMiddleName").val(),
				'childLastName' : $("#childLastName").val(),
				'childDOB' : $("#childDOB").val()
			},
			success : function (data) {
				array_child[key] = data[0];
				$("#" + key + ".tab-link").html(data[0].member_fname);
				retrieve_child_data(key)
				$("#save_child_details").addClass("disabled");
				alert($("#" + key + ".tab-link").html());
			}
		});

	});
}

function register_member() {
	if (!$("#parent_list tbody").children().hasClass("active")) {
		$('#save_parent_details').click(function () {
			$.ajax({
				url : js_base_url("site/add_parent"),
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
					clean_parent_fields();
					parent_data_populate();
				}
			});
		});
	}
}

function clean_child_fields() {
	$(".child-content :input").val('');
	$(".child-content :input:checkbox").prop('checked', false);
}

function tab_click() {
	$(".tabs").on('click', '.tab-link', function () {
		$(this).siblings().removeClass('current');
		$(this).addClass('current');
		if ($(this).attr('id').indexOf('add_child') !== -1) {
			$(".child-content").addClass('current').siblings().removeClass('current');
			$("#save_child_details").addClass("disabled");
			clean_child_fields();
		} else if ($(this).attr('class').indexOf('child-tab') !== -1) {
			$(".child-content").addClass('current').siblings().removeClass('current');
			$("#save_child_details").addClass("disabled");
			retrieve_child_data($(this).attr('id'));
		} else if ($(this).attr('id').indexOf('payment_tab') !== -1) {
			$(".payment-content").addClass('current').siblings().removeClass('current');
		} else {
			$(".member-details").addClass('current').siblings().removeClass('current');
		}
	});
}
var main = function () {
	$("#save_parent_details").addClass("disabled");
	parent_data_populate();
	click_parent();
	click_register_parent();
	update_parent_info();
	update_child_info();
	tab_click();
	on_child_form_change();
}

$(document).ready(main);
