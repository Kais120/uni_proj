<?php 
	var $parents = array(
				"id"=>"1",
				"FName"=>"Kaissar",
				"MName"=>"",
				"LName"=>"Shalabayev",
				"Address-1"=>"Ballarat",
				"Address-2"=>"Canadian",
				"Suburb"=>"Canadian",
				"Postcode"=>"3350",
				"email"=>"kaissar@example.com",
				"HomeNum"=>"431611980",
				"MobileNum"=>"43161980",
				"WorkNum"=>"",
				"SLR"=>true)
				
	header("Content-type: application/json");
	echo json_encode($parents);			
?>