<link href="<?php echo base_url(); ?>/css/members.css" type="text/css" rel="stylesheet"/>
<div id="content">
	<div class="row">
		<div class="container col-lg-6 col-lg-offset-1">
			<h3 id="member"> Select a registration or create a new one </h3>
			<hr class="divider"></hr>
			<label for="search">Filter by name</label><input type="search" name="search" id="parent_search" class="form-control" placeholder="Parent name" />			
		</div>
	</div>	
	<hr class="divider"></hr>
	<div class="row">
		<div class="container col-lg-10 col-lg-offset-1">
			<ul class="tabs">
				<li class="tab-link current" id="member_details"><span class="glyphicon glyphicon-user"></span>Details</li>			
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
			<button class="btn btn-primary pull-left" id="new_parent_details">New registration</button>
			<button class="btn btn-primary pull-right disabled" id="delete_parent">Delete</button>
		</div>	
		<div class="container col-lg-4 biodata hidden">
			<ul class="fields">
				<li><label>First Name*</label><input type="text" class="form-control" id="firstName"/></li>
				<li><label>Middle Name</label><input type="text" class="form-control" id="middleName"/></li>
				<li><label>Last Name*</label><input type="text" class="form-control" id="lastName"/></li>
				<li><label>Address Line 1</label><input type="text" class="form-control" id="addrLine1"/></li>
				<li><label>Address Line 2</label><input type="text" class="form-control" id="addrLine2"/></li>
				<li><label>Suburb*</label><input type="text" class="form-control" id="suburb"/></li>
				<li><label>Postcode*</label><input type="number" class="form-control" id="postcode"/></li>
				<li><label>Email</label><input type="text" class="form-control" id="email"/></li>
				<li><label>Home Number</label><input type="text" class="form-control" id="homeNumber"/></li>
				<li><label>Mobile Number*</label><input type="text" class="form-control" id="mobileNumber"/></li>
				<li><label>Office Number</label><input type="text" class="form-control" id="officeNumber"/></li>		
				<li><button class="btn btn-primary pull-right disabled" id="save_parent_details">Save changes</button></li>
			</ul>
			* - required fields
		</div>			
	</div>	
	<div class="tab-content child-content">
		<div class="row">
			<div class="container col-lg-5 col-lg-offset-1 child-info">
				<ul class='fields'>
					<li><label>First Name*</label><input type="text" class="form-control" id="childFirstName"/></li>								
					<li><label>Middle Name</label><input type="text" class="form-control" id="childMiddleName"/></li>								
					<li><label>Last Name*</label><input type="text" class="form-control" id="childLastName"/></li>	
					<li><label>Date of birth*</label><input type="date" class="form-control" id="childDOB"/></li>	
				</ul>
				* - required fields
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
				<button class="btn btn-primary pull-left" id="save_child_details">Save changes</button>	
				<button class="btn btn-primary pull-right disabled" id="delete_child">Delete</button>
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
		<hr class="divider"></hr>
		<div class="row">
			<div class="container col-lg-4 col-lg-offset-1">
				<h3>Payments</h3>
			</div>
		</div>
		<div class="row">
			<div class="container col-lg-6 col-lg-offset-1">				
				<table class="table member_list" id="payment_list">					
					<thead>
						<tr>
							<th>ID</th>
							<th>Child</th>
							<th>Year</th>
							<th>Term</th>
							<th>Sport</th>
							<th>Level</th>
							<th>Group</th>
							<th>Paid/Due, $</th>							
						<tr>
					</thead>
					<tbody>						
					</tbody>
				</table>
			</div>		
			<div class="container col-lg-3 hidden" id="edit">
				<ul class="fields" id="payment_details">
					<li><label for="num_lessons">Number of lessons</label><input type="number" class="form-control" id="num_lessons"></li>
					<li><label for="total">Amount due, $</label><input type="number" class="form-control" id="total"></li>					
				</ul>	
				<button class="btn btn-primary pull-right disabled" id="save_payment">Save changes</button>
			</div>	
		</div>
		<div class="hidden" id="transactions">
			<div class="row">
				<hr class="divider"></hr>
				<div class="container col-lg-4 col-lg-offset-1">
					<h3>Transactions</h3>
				</div>
			</div>
			<div class="row">			
				<div class="container col-lg-4 col-lg-offset-1">
					<table class="table member_list" id="transaction_list">					
						<thead>
							<tr>
								<th>ID</th>
								<th>Date</th>
								<th>Type</th>
								<th>Amount, $</th>														
							<tr>
						</thead>
						<tbody>						
						</tbody>
					</table>
					<button class="btn btn-primary" id="new_transaction">Add new</button>
				</div>	
				<div class="container col-lg-3" id="trans_details">
					<ul class="fields">
						<li><label>Type</label>
							<select class="form-control" id="type">
								<option value="cash">Cash</option>
								<option value="credit">Credit</option>
								<option value="eftpos">EFTPOS</option>
							</select>
						</li>
						<li><label>Amount, $</label><input type="number" class="form-control" id="amount"></li>
						<li><button class="btn btn-primary disabled" id="save_transaction">Save</button></li>					
					</ul>
				</div>
			</div>		
		</div>		
	</div>	
</div>
<script src="<?php echo base_url(); ?>js/members.js"></script>