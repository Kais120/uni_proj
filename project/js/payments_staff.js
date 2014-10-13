var arrayPayments = {};

function yearClick(){
	$("select.year").change(function(){
		
		var year = $(this).val();	
		if(year!=='')
			$("input#search_parent").prop('disabled', false);
		else	
			$("input#search_parent").prop('disabled', true);	
			
		$("#payment_list tbody tr").not('.theader').remove();		
		
		$("select.term option").not(".default").remove();
		
		
		if (year!=='All' && year!==''){			
			$("li#term_select").removeClass("hidden");
		}else{
			$("li#term_select").addClass("hidden");
		}		
		
		if (year!=='All'){
			$("select.term").val("empty");
			$("input#search_parent").prop('disabled', true);
			$.ajax({
				type : "POST",
				cache : false,
				url : js_base_url("site_staff/getTerms"),					
				data: {'year' : year},	
				dataType : 'json',
				success : function (data) {	
					$.each(data, function (key, value) {
						$("select.term").append("<option value="+value.term_id+">"+value.term_description+"</option>");							
					});				
				}			
			});
		}else{
			getPayments('All', 'All');
		}		
		
		
	});
}

function termClick(){
	$("select.term").change(function(){		
		if($("select.term option:selected").val()!==''){
			$("input#search_parent").prop('disabled', false);
			$("#payment_list tbody tr").not('.theader').remove();
			getPayments($("select.term option:selected").val(), $("select.year").val());			
		}
	});
}

function getPayments(term, year){
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("site_staff/getPayments"),					
		data: {
			'term' : term,
			'year' : year
		},	
		dataType : 'json',
		success : function (data) {	
			$.each(data, function (key, value) {
				$("table#payment_list tbody").append('<tr><td class="transaction_id">'+value.transaction_id+'</td><td>'+value.parent_fname
				+'</td><td>'+value.parent_lname+'</td><td>'+value.payment_date+'</td><td>'+value.amount_paid +'</td></tr>');				
			});				
		}			
	});
}

function paymentClick(){
	$("table#payment_list tbody").delegate("tr:not(.theader)", "click", function () {
		$(this).addClass("active").siblings().removeClass('active');
		$("div.edit").removeClass("hidden");
		getPaymentDetails($(this).children("td.transaction_id").html());
	});
}

function getPaymentDetails(transactionId){
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("site_staff/getPaymentDetails"),					
		data: {
			'transaction_id' : transactionId			
		},	
		dataType : 'json',
		success : function (data) {	
			$.each(data, function (key, value) {				
				$("ul.payment_details input#paid_date").val(value.payment_date);
				$("ul.payment_details input#amount").val(value.amount_paid);
				switch (value.payment_type.toLowerCase()){
					case 'cash':
						$("select.type").val('cash');
						break;
					case 'credit':
						$("select.type").val('credit');
						break;
					case 'eftpos':
						$("select.type").val('eftpos');
						break;
				}
			});				
		}			
	});	
}

function clickSave(){
	$("button#save_payment").click(function(){ 
		$.ajax({
			type : "POST",
			cache : false,
			url : js_base_url("site_staff/savePayment"),					
			data: {
				'transaction_id' : $("table#payment_list tbody tr.active td.transaction_id").html(),
				'paid_date' : $("input#paid_date").val(),
				'amount' : $("input#amount").val(),
				'type' : $("select.type").val()
			},	
			dataType : 'json',
			success : function (data) {
				alert("Changes saved");
				$.each(data, function (key, value) {
					$("table#payment_list tbody tr.active td").remove();
					$("table#payment_list tbody tr.active").append('<td class="transaction_id">'+value.transaction_id+'</td><td>'+value.parent_fname
				+'</td><td>'+value.parent_lname+'</td><td>'+value.payment_date+'</td><td>'+value.amount_paid +'</td>');
				});
			}
		});
	});
}

function formChange(){
	$("ul.payment_details li input").change(function(){
		$("button#save_payment").removeClass('disabled');
	});
	
	$("ul.payment_details li select").change(function(){
		$("button#save_payment").removeClass('disabled');
	});
}

function searchParent(){
	$('input#search_parent').keyup(function(){	
		$('table#payment_list tbody tr').addClass('hidden');
		$('ul#payment_details').addClass('hidden');
		var input = $(this).val();		
		if (!input){			
			$('table#payment_list tbody tr').removeClass('hidden');			
		}else{
			$('table#payment_list tbody tr').each(function(){
				if ($(this).html().indexOf(input)>-1)
					$(this).removeClass('hidden');
			})
		}
	});
}

var main = function(){
	$("input#search_parent").prop('disabled', true);	
	$("button#save_payment").addClass('disabled');
	paymentClick();
	yearClick();
	termClick();
	formChange();
	clickSave();
	searchParent();
}

$(document).ready(main);