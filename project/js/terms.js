var main = function(){
	get_json();	
}

function get_json(){
	$.ajax({
		url: js_base_url("site/get_child_info"),	
		type: 'POST',
		data: {'key':1},
		dataType: 'json',
		success: function(data){  			
			$.each(data, function(key, value){
				$.each(value, function(index, info){
					$("#content").append("<p>"+index+": "+info+"</p>");
				});					
			});
        }
	});				
}

$(document).ready(main);