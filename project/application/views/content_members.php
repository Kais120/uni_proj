<link href="<?php echo base_url(); ?>/css/members.css" type="text/css" rel="stylesheet"/>
<div id="content">
	<div class="row">
		<div class="container col-lg-6 col-lg-offset-1">
			<h1 id="member"> Select a member or create a new one </h1>
			<hr class="divider"></hr>
			<label for="search">Search by name</label><input type="search" name="search" id="parent_search" class="form-control" placeholder="Parent name" />			
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
			<table class="table member_list" id="parent_list">	
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
				<li><label>Postcode</label><input type="number" class="form-control" id="postcode"></li>
				<li><label>Email</label><input type="text" class="form-control" id="email"></li>
				<li><label>Home Number</label><input type="text" class="form-control" id="homeNumber"></li>
				<li><label>Mobile Number</label><input type="text" class="form-control" id="mobileNumber"></li>
				<li><label>Office Number</label><input type="text" class="form-control" id="officeNumber"></li>		
				<li><button class="btn btn-default pull-right disabled" id="save_parent_details">Save changes</button></li>
			</ul>			
		</div>			
	</div>	
	<div class="tab-content child-content">
		<div class="row">
			<div class="container col-lg-5 col-lg-offset-1 child-info">
				<ul class='fields'>
					<li><label>First Name</label><input type="text" class="form-control" id="childFirstName"></li>								
					<li><label>Middle Name</label><input type="text" class="form-control" id="childMiddleName"></li>								
					<li><label>Last Name</label><input type="text" class="form-control" id="childLastName"></li>	
					<li><label>Date of birth</label><input type="date" class="form-control" id="childDOB"></li>	
				</ul>
				<hr class="divider"></hr>
				<ul class="fields">
					<li>
						<label>Tennis level</label>					
						<select class="form-control" id="skill_tennis">
							<option value="null">Select level</option>	
						</select>
					</li>
					<li>
						<label>Planned number of lessons</label>
						<input type="number" class="form-control" id="tennis_number">
					</li>
					<hr class="divider"></hr>
					<li>
						<label>Swimming level</label>					
						<select class="form-control" id="skill_swimming">
							<option value="null">Select level</option>					
						</select> 
					</li>
					<li>
						<label>Planned number of lessons</label>
						<input type="number" class="form-control" id="swimming_number">
					</li>										
				</ul>
				<button class="btn btn-default pull-left" id="save_child_details">Save changes</button>	
			</div>
			<div class="container col-lg-5">
				<label>Medical conditions</label>
				<ul class="fields" id="medical_condition">
					<li><label>Asthma</label><input type="checkbox" id="asthma"></li>
					<li><label>Diabetes</label><input type="checkbox" id="diabetes"></li>
					<li><label>Respiratory disorders</label><input type="checkbox" id="respiratory"></li>
					<li><label>Epilepsy</label><input type="checkbox" id="epilepsy"></li>
					<li><label>High/Low blood pressure</label><input type="checkbox" id="blood"></li>
					<li><label>Heart conditions</label><input type="checkbox" id="heart"></li>
					<li><label>Special needs</label><input type="checkbox" id="special"></li>	
					<li><label>Notes</label><textarea class="form-control" id="medical_notes"></textarea></li>
				</ul>				
			</div>
		</div>	
		<div id="progress">
			<div class="row">
				<div class="container col-lg-3 col-lg-offset-1">
					<h3>Progress</h3>
					<label>Year </label>
					<select class="form-control year" id="progress_year">									
					</select> 
					<label>Term </label>
					<select class="form-control term" id="progress_term">
						<option value="null">Select term</option>					
					</select> 
				</div>
			</div>
			<div class="row">
				<div class="container col-lg-4 col-lg-offset-1">
					<table class='table member_list' id='progress_list'>
						<thead>
							<tr><th>Date</th><th>Sport</th><th>Group</th><th>Skill</th><th>Attended</th></tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="container col-lg-3" id="tasks_list">
				</div>
			</div>
		</div>
	</div>
	
	<div class="tab-content payment-content">
		<div class="row">
			<div class="container col-lg-3 col-lg-offset-1">
				<label>Year </label>
				<select class="form-control year" id="payment_year">									
				</select> 
				<label>Term </label>
				<select class="form-control term" id="payment_term">
					<option value="null">Select term</option>					
				</select> 
			</div>
		</div>
		<div class="row">
			<div class="container col-lg-6 col-lg-offset-1">
				<table class="table member_list" id="payments">
					<thead>
						<tr>
							<th>ID</th>
							<th>First name</th>
							<th>Last name</th>
							<th>Group</th>
							<th>Paid</th>
							<th>Method</th>
							<th>Date</th>
							<th>Amount to pay</th>						
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="container col-lg-4">
				<ul class="fields hidden" id="payment_details">
					<li><label>Overall</label><input type="text" class="form-control" id="overall" readonly></li>
					<li><label>Amount</label><input type="number" class="form-control" id="paid"></li>
					<li>
						<label for="type">Method</label>
						<select class="form-control" id="type">
							<option value="cash">Cash</option>
							<option value="credit">Credit</option>
							<option value="eftpos">EFTPOS</option>
						</select>						
					</li>
					<li><label>Date</label><input type="date" class="form-control" id="date"></li>
					<li><button class="btn btn-default pull-right disabled" id="save_payment">Save changes</button></li>
				</ul>				
			</div>
		</div>	
		<hr class="divider"></hr>
		<div class="row hidden" id="group_payment_panel">
			<div div class="container col-lg-4 col-lg-offset-1">
				<ul class="fields">
					<li>
						<label>Child</label>
						<select class="form-control" id="child">
							<option value="null">Select a child</option>
						</select> 
					</li>
					<li>
						<label>Group</label>
						<select class="form-control" id="group">
							<option value="null">Select a group</option>
						</select> 
					</li>
					<li>
						<button class="btn btn-default disabled" id="add_payment_group">Add a new payment</button>
					</li>
				</ul>
			</div>	
			<div div class="container col-lg-4">
				<ul class="fields hidden" id="group_payment_details">
					<li>
						<label>Number of lessons</label>
						<input type="number" class="form-control" id="num_lessons">						
					</li>
					<li>
						<label>Total amount to pay</label>
						<input type="number" class="form-control" id="total_amount">						
					</li>					
					<li>
						<button class="btn btn-default disabled" id="save_payment_group">Save</button>
					</li>
				</ul>
			</div>
		</div>		
		<div class="row">
			<div div class="container col-lg-4 col-lg-offset-1">
				<ul class="fields hidden" id="new_payment_fields">
					<li>
						<label for="type">Method</label>
						<select class="form-control" id="type_new">
							<option value="cash">Cash</option>
							<option value="credit">Credit</option>
							<option value="eftpos">EFTPOS</option>
						</select>	
					</li>
					<li>
						<label>Amount</label><input type="number" class="form-control" id="amount">
					</li>
					<li>
						<button class="btn btn-default disabled" id="save_new_payment">Save</button>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	
</div>

<script src="<?php echo base_url(); ?>js/click_list.js"></script>







