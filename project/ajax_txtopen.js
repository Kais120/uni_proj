

var readfile = function(){		
	$.ajax({
		//type: "GET",		
		url: "",	
		contentType: "application/json; charset=utf-8",
		dataType: 'json',
		success: function(data){
			$("#content").append("<p>"+data+"</p>");
		}
	});	

}

$(document).ready(readfile);	