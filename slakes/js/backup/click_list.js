var array = {};
var child_id;
var main = function(){		
	get_json();	
	$("#parent_list tbody").delegate("tr","click",function(){		
		//remove_tabs();
		$(this).addClass("active");
		$("#parent_list tbody tr").not(this).removeClass('active');
		retrieve_data($(this).attr('id'));
		retrieve_children($(this).attr('id'));
	});
}

function get_json(){
	$.ajax({
		type: "POST",		
		url: js_base_url("site/get_member_info"),	
		contentType: "application/json; charset=utf-8",
		dataType: 'json',
		success: function(data){  			
			$.each(data, function(key, value){				
				$("#parent_list tbody").append("<tr id="+value.registration_id+"><td>"+value.parent_fname+"</td><td> "+value.parent_lname+"</td><tr>");
				array[value.registration_id]=value;
			});				
			
        }
	});				
}

function retrieve_data(i){
	$("#firstName").val(array[i].parent_fname);
	$("#middleName").val(array[i].parent_mname);
	$("#lastName").val(array[i].parent_lname);
	$("#addrLine1").val(array[i].address1);
	$("#addrLine2").val(array[i].address2);
	$("#Suburb").val(array[i].suburb);
	$("#postcode").val(array[i].post_code);
	$("#email").val(array[i].email);
	$("#homeNumber").val(array[i].home_number);
	$("#mobileNumber").val(array[i].mobile_number);
	$("#officeNumber").val(array[i].office_number);
	if (array[i].sl_resident==true)
		$("#slr").prop('checked', true);
	else
		$("#slr").prop('checked', false);
}

function retrieve_children(i){
	$.ajax({
		url: js_base_url("site/get_child_info"),	
		cache: false,
		type: 'POST',
		data: {'key':i},
		dataType: 'json',
		success: function(data){  			
			for (var i=1; i<=data.length; i++)				
				$("ul#tabs").append('<li class="member_child"><a href="#child'+i+'" data-toggle="tab">Child '+i+'</a></li>');				
        }
	});
}

function remove_tabs(){
	$("li.member_child").remove();	
}

$(document).ready(main);	