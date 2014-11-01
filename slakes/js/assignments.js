function yearClick() {
	$("select.year").change(function () {
		var year = $(this).val();
		$("select.term option").not(".default").remove();
		$("select.term").val("empty");
		if (year == 'empty')
			$('li#term_select').addClass('hidden');
		else
			$.ajax({
				type : "POST",
				cache : false,
				url : js_base_url("get_terms"),
				data : {
					'year' : year
				},
				dataType : 'html',
				success : function (data) {
					$('li#term_select').removeClass('hidden');
					$("select.term").append(data);
				}
			});
	});
}

function termClick() {
	$("select.term").change(function () {
		var term = $(this).val();
		if (term == 'empty')
			$('table tbody tr').remove();
		else
			$.post(js_base_url('get_assignments'), {
				'term' : term
			},
				function (data) {
				$('table tbody tr').remove();
				$('table tbody').append(data);
			}, 'html');
	});
}

var main = function () {
	yearClick();
	termClick();
}

$(document).ready(main);
