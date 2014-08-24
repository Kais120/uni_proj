<link href="<?php echo base_url(); ?>/css/list.css" type="text/css" rel="stylesheet"/>
<style>
 tbody {
 width: auto;
 height: 50%;
 overflow: auto;
}
</style>
<div id="content">
	<div class="container"><h1 id="member"> &nbsp </h1></div>
    <div class="row">		
	<div class="container col-md-10 col-md-offset-1">
	<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#member_detail" data-toggle="tab">Member details</a></li>        
    </ul>	
    <div id="my-tab-content" class="tab-content" style="margin-top: 1%">
        <div class="tab-pane active" id="member_detail">
            
			<div class="row">
				<div class="container col-md-5">

					<table id="parent_list" class="table" style="overflow: auto">
						<thead>
							<tr>				
								<th>First Name</th>
								<th>Last Name</th>				
							</tr>
						</thead>
						
						<tbody>	
																		
						</tbody>	
					</table>
					<button class="btn btn-default pull-left" id="new_child_details">Register new child</button>
				</div>


			<div class="container col-md-5">

				<label>First Name</label><input type="text" class="form-control" id="firstName">
				<label>Middle Name</label><input type="text" class="form-control" id="middleName">
				<label>Last Name</label><input type="text" class="form-control" id="lastName">
				<label>Address Line 1</label><input type="text" class="form-control" id="addrLine1">
				<label>Address Line 2</label><input type="text" class="form-control" id="addrLine2">
				<label>Suburb</label><input type="text" class="form-control" id="Suburb">
				<label>Postcode</label><input type="text" class="form-control" id="postcode">
				<label>Email</label><input type="text" class="form-control" id="email">
				<label>Home Number</label><input type="text" class="form-control" id="homeNumber">
				<label>Mobile Number</label><input type="text" class="form-control" id="mobileNumber">
				<label>Office Number</label><input type="text" class="form-control" id="officeNumber">
				<label>Sanctuary Lake Resident</label> <input type="checkbox" id="slr"><br>
				<button class="btn btn-default pull-left" id="new_parent_details">Register new member</button>
				<button class="btn btn-default pull-right" id="save_parent_details">Save changes</button>
				
			</div>

			</div>			
       
    </div>
</div>
</div>
</div>
 
 
<script type="text/javascript">
    $(document).ready(function ($) {
        $('#tabs').tab();
    });
</script>
<script src="<?php echo base_url(); ?>js/click_list.js"></script>







