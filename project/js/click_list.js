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
	$(".child-content :input").keydown(function () {
		$("#save_child_details").removeClass("disabled");
	});
	$(".medical :input:checkbox").change(function () {
		$("#save_child_details").removeClass("disabled");
		readMedicalCondition();
	});
}

function readMedicalCondition(){
	array_medical = {};
	if($("ul.medical li input#asthma").prop('checked'))
		array_medical['1']=true;
	if($("ul.medical li input#diabetes").prop('checked'))
		array_medical['2']=true;
	if($("ul.medical li input#respiratory").prop('checked'))
		array_medical['3']=true;
	if($("ul.medical li input#epilepsy").prop('checked'))
		array_medical['4']=true;
	if($("ul.medical li input#blood").prop('checked'))
		array_medical['5']=true;
	if($("ul.medical li input#heart").prop('checked'))
		array_medical['6']=true;
	if($("ul.medical li input#special").prop('checked'))
		array_medical['7']=true;
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
				$('<li class="tab-link child-tab"><span class="child_id">'+ value.member_id +' </span>' + value.member_fname + '</li>').insertBefore("#add_child");
				array_child[value.member_id] = value;
			});
		}
	});
	
	
	
}

function retrieveChildData(i) {
	$('ul.medical li input').prop('checked', false);
	$("#childFirstName").val(array_child[i].member_fname);
	$("#childMiddleName").val(array_child[i].member_mname);
	$("#childLastName").val(array_child[i].member_lname);
	$("#childDOB").val(array_child[i].member_dob);
	
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
				switch(value.medical_condition_id){
					case '1':
						$('ul.medical li input#asthma').prop('checked', true);
						break;
					case '2':
						$('ul.medical li input#diabetes').prop('checked', true);
						break;
					case '3':
						$('ul.medical li input#respiratory').prop('checked', true);
						break;
					case '4':
						$('ul.medical li input#epilepsy').prop('checked', true);						
						break;
					case '5':
						$('ul.medical li input#blood').prop('checked', true);												
						break;
					case '6':
						$('ul.medical li input#heart').prop('checked', true);												
						break;						
					case '7':
						$('ul.medical li input#special').prop('checked', true);												
						break;						
				}					
			});
		}
	});	
}

function registerClick() {
	$("#new_parent_details").click(function () {
		status = 2;
		cleanParentFields();
		removeTabs();
		$('tr.active').removeClass('active');
		$("#member").text("New member");
		$(".biodata").removeClass('hidden');				
	});
}

function clickParent() {
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
		onParentFormChange();
	});
}

function cleanParentFields() {
	$(".biodata :input").val('');
}

function clickSave() {
	$('#save_parent_details').click(function () {
		if (status == 1){			
			updateParent();
		}else if (status == 2){
			registerParent();
		}
	});
}

function clickSaveChild() {
	$('#save_child_details').click(function () {
		if (status == 3){
			updateChild();
		}else if (status == 4){
			addChild();
		}
	});
}

function addChild(){	
	var key = $("tr.active td.ID").html();
	
	$.ajax({
		url : js_base_url("site/addChild"),
		type : 'POST',
		data : {
			'parentKey': key,
			'childFirstName' : $("#childFirstName").val(),
			'childMiddleName' : $("#childMiddleName").val(),
			'childLastName' : $("#childLastName").val(),
			'childDOB' : $("#childDOB").val(),
			'medical' : array_medical
		},		
		success : function (data) {			
			alert('A child has been added');			
			location.reload();
		}		
	});
	
	
}

function updateChild(){
	var key = $("li.tab-link.child-tab.current").children('span.child_id').html();
	
	$.ajax({
		url : js_base_url("site/updateChildInfo"),
		type : 'POST',
		data : {
			'key' : key,
			'childFirstName' : $("#childFirstName").val(),
			'childMiddleName' : $("#childMiddleName").val(),
			'childLastName' : $("#childLastName").val(),
			'childDOB' : $("#childDOB").val(),
			'medical': array_medical
		},
		dataType : 'json',
		success : function (data) {
			alert("Changes saved");
			array_child[key] = data[0];
			$("li.tab-link.child-tab.current").html('<span class="child_id">'+ key +' </span>' + data[0].member_fname + '</li>');				
			$("#save_child_details").addClass("disabled");	
			retrieveChildData(key);	
		}
	});
	
	
	
	
}

function updateParent(){
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

function tabClick() {
	$(".tabs").on('click', '.tab-link', function () {
		$(this).siblings().removeClass('current');
		$(this).addClass('current');
		if ($(this).is('#add_child')) {
			status = 4;
			array_medical = 'null';
			$(".child-content").addClass('current').siblings().removeClass('current');
			$("#save_child_details").addClass("disabled");
			cleanChildFields();
		} else if ($(this).is('.child-tab')) {
			status = 3;
			$(".child-content").addClass('current').siblings().removeClass('current');
			$("#save_child_details").addClass("disabled");
			console.log($(this).children('span.child_id').html());
			retrieveChildData(parseInt($(this).children('span.child_id').html()));
		} else if ($(this).is('#payment_tab')) {
			$(".payment-content").addClass('current').siblings().removeClass('current');
		} else {
			$(".member-details").addClass('current').siblings().removeClass('current');
		}
	});
}
var main = function () {
	$("#save_parent_details").addClass("disabled");
	parentDataPopulate();
	registerClick();
	clickParent();	
	clickSave();	
	clickSaveChild();
	tabClick();
	onChildFormChange();
	onParentFormChange();
}

$(document).ready(main);
