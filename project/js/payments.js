var arrayPayments = {};
var status=0;

function yearClick() {
	$("select.year").change(function () {
		$('input#critical').prop('checked',false);
		var year = $(this).val();
		if (year !== 'empty')
			$("input#search_parent").prop('disabled', false);
		else
			$("input#search_parent").prop('disabled', true);

		$("#payment_list tbody tr").remove();

		$("select.term option").not(".default").remove();

		if (year !== 'all' && year !== 'empty') {
			$("li#term_select").removeClass("hidden");
		} else {
			$("li#term_select").addClass("hidden");
		}

		if (year !== 'all') {
			$('input#critical').removeClass('disabled');
			$("select.term").val("empty");
			$("input#search_parent").prop('disabled', true);
			$.ajax({
				type : "POST",
				cache : false,
				url : js_base_url("site/get_terms"),
				data : {
					'year' : year
				},
				dataType : 'html',
				success : function (data) {
					$("select.term").append(data);
				}
			});
		} else {
			getPayments('all', 'all');
		}

	});
}

function termClick() {
	$("select.term").change(function () {
		$('input#critical').prop('checked',false);
		if ($("select.term option:selected").val() !== '') {
			$("input#search_parent").prop('disabled', false);
			$("#payment_list tbody tr").not('.theader').remove();
			getPayments($("select.term").val(), $("select.year").val());
		}
	});
}

function getPayments(term, year) {
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("site/getPayments"),
		data : {
			'term' : term,
			'year' : year
		},
		dataType : 'html',
		success : function (data) {
			$('input#critical').removeClass('disabled');
			$("table#payment_list tbody tr").remove()
			$("table#payment_list tbody").append(data);
		}
	});
}

function paymentClick() {
	$("table#payment_list tbody").delegate("tr", "click", function () {
		$(this).addClass("active").siblings().removeClass('active');
		$("div.edit").removeClass("hidden");
		getPaymentDetails($(this).children("td.payment_id").html());
		getTransactions($(this).children("td.payment_id").html());
		$('div#transactions').removeClass('hidden');
		$('div#trans_details').addClass('hidden')
	});
}

function getPaymentDetails(paymentId) {
	$.ajax({
		type : "POST",
		cache : false,
		url : js_base_url("site/get_payment_details"),
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
	$.post(js_base_url("site/get_transactions"), {
		'payment_id' : paymentId
	},
		function (data) {
		$("table#transaction_list tbody tr").remove()
		$("table#transaction_list tbody").append(data);
	}, 'html');
}

function clickSave() {
	$("button#save_payment").click(function () {
		$.ajax({
			type : "POST",
			cache : false,
			url : js_base_url("site/save_payment"),
			data : {
				'payment_id' : $("table#payment_list tbody tr.active td.payment_id").html(),
				'num_lessons' : $('input#num_lessons').val(),
				'total' : $('input#total').val()
			},
			success : function () {
				alert('saved');
				$("div.edit").addClass("hidden");
				$('button#save_payment').addClass('disabled');
			}
		});
		getPayments($("select.term option:selected").val(), $("select.year").val());
	});
}

function formChange() {
	$("ul.payment_details li input").bind('keyup change', function () {
		$("button#save_payment").removeClass('disabled');
	});
	
	$("input#amount, select#type").bind('keyup change', function(){
		$("button#save_transaction").removeClass('disabled');
	});
}

function filterCriticalPayments(){
	$('input#critical').click(function(){		
		if($(this).prop('checked')){			
			$('table#payment_list tbody tr').not('.critical').addClass('hidden');
		}
		else{
			$('table#payment_list tbody tr').not('.critical').removeClass('hidden');
		}
	});
}

function transactionClick(){
	$('table#transaction_list tbody').delegate('tr','click',function(){
		$(this).addClass("active").siblings().removeClass('active');
		$('input#amount').val($(this).children('td.amount').html());
		$('select#type').val($(this).children('td.payment_type').html());		
		$('div#trans_details').removeClass('hidden');
		$('button#save_transaction').addClass('disabled');
		status=0;
	});
}

function onClickNewTransaction(){
	$('button#new_transaction').click(function(){
		$('table#transaction_list tbody tr').removeClass('active');
		$('input#amount').val('');
		$('select#type').val('cash');
		$('div#trans_details').removeClass('hidden');
		status = 1;
	});
}

function onClickSaveTransaction(){
	$('button#save_transaction').click(function(){
		$('div#trans_details').addClass('hidden');
		$('div#transactions').addClass('hidden');
		if (status==0)
			saveTransaction();
		if (status==1)
			addTransaction();
			
	});
}

function addTransaction(){
	$.post(js_base_url('site/add_transaction'),
		{
			'payment_id' : $("table#payment_list tbody tr.active td.payment_id").html(),
			'amount' : $('input#amount').val(),
			'type' : $('select#type').val()
		},function(){
			$('button#save_transaction').addClass('disabled');
			getPayments($("select.term").val(), $("select.year").val());						
		}
	);
};

function saveTransaction(){
	$.post(js_base_url('site/save_transaction'),
		{
			'transaction_id' : $("table#transaction_list tbody tr.active td.transaction_id").html(),
			'amount' : $('input#amount').val(),
			'type' : $('select#type').val()
		},function(){
			$('button#save_transaction').addClass('disabled');
			getPayments($("select.term").val(), $("select.year").val());	
					
		}
	);
}

function searchParent() {
	$('input#search_parent').keyup(function () {
		$('table#payment_list tbody tr').addClass('hidden');
		$('ul#payment_details').addClass('hidden');
		$('div#transactions').addClass('hidden');
		var input = $(this).val();
		if (!input) {
			if ($('input#critical').prop('checked'))
				$('table#payment_list tbody tr.critical').removeClass('hidden');
			else
				$('table#payment_list tbody tr').removeClass('hidden');
		} else {
			if ($('input#critical').prop('checked'))
				$('table#payment_list tbody tr.critical').each(function () {
					if ($(this).html().indexOf(input) > -1)
						$(this).removeClass('hidden');
				})
			else
				$('table#payment_list tbody tr').each(function () {
					if ($(this).html().indexOf(input) > -1)
						$(this).removeClass('hidden');
				})
		}
	});
}


var main = function () {
	$("input#search_parent").prop('disabled', true);	
	paymentClick();
	yearClick();
	termClick();
	formChange();
	clickSave();
	searchParent();
	filterCriticalPayments();
	transactionClick();
	onClickNewTransaction();
	onClickSaveTransaction();
}

$(document).ready(main);
