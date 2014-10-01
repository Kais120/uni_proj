<link href="<?php echo base_url(); ?>/css/members.css" type="text/css" rel="stylesheet"/>
<div id="content">
	<div class="row">
		<div class="container col-lg-6 col-lg-offset-1">
			<h1 id="member"> Select a member or create a new one </h1>
			<hr class="divider"></hr>
			<label for="search">Search by name</label><input type="search" name="search" class="form-control" placeholder="Parent name" />			
		</div>
	</div>	
	<hr class="divider"></hr>
	<div class="row">
		<div class="container col-lg-10 col-lg-offset-1">
			<ul class="tabs">
				<li class="tab-link current" id="member_details"><span class="glyphicon glyphicon-user"></span> Member details</li>			
			</ul>
		</div>	
	</div>		
	<div class="row tab-content member-details current">
		<div class="container col-lg-5 col-lg-offset-1">
			<table id="parent_list">	
				<thead>
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>	
					</tr>
				</thead>
				<tbody>							
				</tbody>	
			</table>
			<button class="btn btn-default pull-left" id="new_parent_details">Register new member</button>
		</div>	
		<div class="container col-lg-4 biodata hidden">
			<ul class="fields">
				<li><label>First Name</label><input type="text" class="form-control" id="firstName"></li>
				<li><label>Middle Name</label><input type="text" class="form-control" id="middleName"></li>
				<li><label>Last Name</label><input type="text" class="form-control" id="lastName"></li>
				<li><label>Address Line 1</label><input type="text" class="form-control" id="addrLine1"></li>
				<li><label>Address Line 2</label><input type="text" class="form-control" id="addrLine2"></li>
				<li><label>Suburb</label><input type="text" class="form-control" id="suburb"></li>
				<li><label>Postcode</label><input type="text" class="form-control" id="postcode"></li>
				<li><label>Email</label><input type="text" class="form-control" id="email"></li>
				<li><label>Home Number</label><input type="text" class="form-control" id="homeNumber"></li>
				<li><label>Mobile Number</label><input type="text" class="form-control" id="mobileNumber"></li>
				<li><label>Office Number</label><input type="text" class="form-control" id="officeNumber"></li>					
			</ul>
			<button class="btn btn-default pull-right" id="save_parent_details">Save changes</button>
		</div>			
	</div>	
	<div class="row tab-content child-content">
		<div class="container col-lg-5 col-lg-offset-1 child-info">
			<label>First Name</label><input type="text" class="form-control" id="childFirstName">								
			<label>Middle Name</label><input type="text" class="form-control" id="childMiddleName">								
			<label>Last Name</label><input type="text" class="form-control" id="childLastName">
			<label>Date of birth</label><input type="date" class="form-control" id="childDOB">
			<label>Skills levels</label>
			<ul class="medical">
				<li>
					<label>Swimming level</label>					
					<select>
						<option value="none">none</option>					
					</select> 
				</li>
				<li>
					<label>Tennis level</label>					
					<select>
						<option value="none">none</option>	
					</select>
				</li>						
			</ul>
			<button class="btn btn-default pull-left" id="save_child_details">Save changes</button>	
		</div>
		<div class="container col-lg-5">
			<label>Medical conditions</label>
			<ul class="medical">
				<li><label>Asthma</label><input type="checkbox" id="asthma"></li>
				<li><label>Diabetes</label><input type="checkbox" id="diabetes"></li>
				<li><label>Respiratory disorders</label><input type="checkbox" id="respiratory"></li>
				<li><label>Epilepsy</label><input type="checkbox" id="epilepsy"></li>
				<li><label>High/Low blood pressure</label><input type="checkbox" id="blood"></li>
				<li><label>Heart conditions</label><input type="checkbox" id="heart"></li>
				<li><label>Special needs</label><input type="checkbox" id="special"></li>			
			</ul>
		</div>
	</div>	
	
	
	<div class="row tab-content payment-content">
		<div class="container col-lg-5 col-lg-offset-1">
			<label>Term </label>
			<select>
				<option value="none">none</option>					
			</select> 
		</div>
	</div>
	
</div>

<script src="<?php echo base_url(); ?>js/click_list.js"></script>






