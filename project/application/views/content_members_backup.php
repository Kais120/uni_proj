<link href="<?php echo base_url(); ?>/css/list.css" type="text/css" rel="stylesheet"/>
<style>
 tbody {
 width: auto;
 height: 50%;
 overflow: auto;
}
		table.medical{
			background-color: #ededed;
		}

		table.medical tr td{
			padding: 5px;
		}
		
		ul.tabs{
			margin: 0px;
			padding: 0px;
			list-style: none;
		}
		ul.tabs li{
			background: none;
			color: #222;
			display: inline-block;
			padding: 10px 15px;
			
			cursor: pointer;
		}

		ul.tabs li.current{
			background: #ededed;
			color: #222;
			border: solid 1px;
			border-color: #7A9999;
			border-bottom-style: none;
		}

		.tab-content{
			display: none;			
			padding: 15px;
		}

		.tab-content.current{
			display: inherit;
		}
</style>
<div id="content">
	<div class="container"><h1 id="member"> Select a member or create a new one </h1></div>
	<div class="container">

	<ul class="tabs">
		<li class="tab-link current" id="member_details"><span class="glyphicon glyphicon-user"></span> Member details</li>			
	</ul>

	<div class="tab-content member-details current">		
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
						<?php
							
						?>
					</tbody>	
				</table>
				<button class="btn btn-default pull-left" id="new_parent_details">Register new member</button>
			</div>	
			<div class="container col-md-5 biodata hidden">
				<label>First Name</label><input type="text" class="form-control" id="firstName">
				<label>Middle Name</label><input type="text" class="form-control" id="middleName">
				<label>Last Name</label><input type="text" class="form-control" id="lastName">
				<label>Address Line 1</label><input type="text" class="form-control" id="addrLine1">
				<label>Address Line 2</label><input type="text" class="form-control" id="addrLine2">
				<label>Suburb</label><input type="text" class="form-control" id="suburb">
				<label>Postcode</label><input type="text" class="form-control" id="postcode">
				<label>Email</label><input type="text" class="form-control" id="email">
				<label>Home Number</label><input type="text" class="form-control" id="homeNumber">
				<label>Mobile Number</label><input type="text" class="form-control" id="mobileNumber">
				<label>Office Number</label><input type="text" class="form-control" id="officeNumber">
				<label>Sanctuary Lake Resident</label> <input type="checkbox" id="slr"><br>								
				<button class="btn btn-default pull-right" id="save_parent_details">Save changes</button>				
			</div>	
		</div>
	</div>

	<div class="tab-content child-content">
		<div class="row">
			<div class="container col-md-5">
				<label>First Name</label><input type="text" class="form-control" id="childFirstName">								
				<label>Middle Name</label><input type="text" class="form-control" id="childMiddleName">								
				<label>Last Name</label><input type="text" class="form-control" id="childLastName">
				<label>Date of birth</label><input type="text" class="form-control" id="childDOB">
				<label>Skills levels</label>
				<table class="medical">
					<tr><td>
						<label>Swimming level</label>
					</td><td>
						<select>
							<option value="none">none</option>					
						</select> 
					</td></tr>
					<tr><td>
						<label>Tennis level</label>
					</td><td>
						<select>
							<option value="none">none</option>	
						</select>
					</td></tr>
				</table>
			</div>
			<div class="container col-md-5">
				<label>Medical conditions</label>
				<table class="medical">
					<tr><td><label>Asthma</label></td><td><input type="checkbox" id="asthma"></td></tr>
					<tr><td><label>Diabetes</label></td><td><input type="checkbox" id="diabetes"></td></tr>
					<tr><td><label>Respiratory disorders</label></td><td><input type="checkbox" id="respiratory"></td></tr>
					<tr><td><label>Epilepsy</label></td><td><input type="checkbox" id="Epilepsy"></td></tr>
					<tr><td><label>High/Low blood pressure</label></td><td><input type="checkbox" id="blood"></td></tr>
					<tr><td><label>Heart conditions</label></td><td><input type="checkbox" id="heart"></td></tr>
					<tr><td><label>Special needs</label></td><td><input type="checkbox" id="special"></td></tr>			
				</table>
			</div>
		</div>
	</div>
	
	<div class="tab-content payment-content">
		<div class="row">
			<div class="container col-md-5">
				<label>Term </label>
				<select>
					<option value="none">none</option>					
				</select> 
			</div>
		</div>
	</div>
	
	
	</div>

</div>

<script src="<?php echo base_url(); ?>js/click_list.js"></script>






