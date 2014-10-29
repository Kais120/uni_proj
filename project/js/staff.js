var status=false;

function staffClick(){
	$("table#staff_list tbody").delegate('tr','click',function(){
		status = false;		
		$("form#staff_action").removeClass("hidden");
		$(this).addClass("active").siblings().removeClass("active");
		$("form#staff_action").attr("action", js_base_url("saveStaff"));		
		$("ul#staff_details li input[name='username']").attr('readonly', true);
		$("ul#staff_details li input[name='password']").attr('required', false);
		loadDetails();
	});
}

function loadDetails(){
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("getStaffDetails"),					
		data: {'key' : $("table#staff_list tbody tr.active").attr('data-value')},	
		dataType : 'json',
		success : function (data){
			$.each(data, function(key,value){
				$("input[name='staff_id']").val(value.staff_id);
				$("input[name='fname']").val(value.staff_fname);
				$("input[name='mname']").val(value.staff_mname);
				$("input[name='lname']").val(value.staff_lname);
				$("input[name='home_number']").val(value.home_number);
				$("input[name='mobile_number']").val(value.mobile_number);
				$("input[name='emg_contact_name']").val(value.emg_contact_name);
				$("input[name='emg_contact_number']").val(value.emg_contact_number);
				$("input[name='staff_email']").val(value.staff_email);
				$("input[name='username']").val(value.username);
				if(value.type=="administrator")
					$("select[name='type']").val("administrator");
				else
					$("select[name='type']").val("staff");
				if(value.active=='1')
					$("input[name='active']").prop("checked",true);
				else
					$("input[name='active']").prop("checked",false);
			});
		}			
	});
}

function onFormChange(){
	$("ul#staff_details li input").keydown(function(){
		$("button#save_staff").removeClass("disabled");		
	});
	
	$("ul#staff_details li select").change(function(){
		$("button#save_staff").removeClass("disabled");		
	});
	
	$("ul#staff_details li input[name='active']").change(function(){
		$("button#save_staff").removeClass("disabled");		
	});
}

function onSubmit(){
	$("form#staff_action").submit(function(e){
		if(status==true){
			var username = $("input[name='username']").val();	
			var result;
			$.post(js_base_url("checkUsername"), {'username' : username}, function(data){
				result = data;
			});	
			if (result='true'){
				alert('The username is already exists');
				e.preventDefault();
			}	
		}
	});		
}

function clickNewStaff(){
	$("button#new_staff").click(function(){
		status = true;
		console.log(status);
		$("table#staff_list tbody tr").removeClass("active");
		$("form#staff_action").removeClass("hidden");
		$("ul#staff_details li input").not("[name='active']").val('');
		$("ul#staff_details li input[name='active']").prop("checked",false);
		$("ul#staff_details li select[name='type']").val('staff');
		$("ul#staff_details li input[name='username']").attr('readonly', false);
		$("ul#staff_details li input[name='password']").attr('required', true);
		$("form#staff_action").attr("action", js_base_url("addStaff"));		
	});
}

var main = function(){
	clickNewStaff();
	staffClick();
	onFormChange();
	onSubmit();
}

$(document).ready(main);
