	<link href="<?php echo base_url(); ?>/css/payments.css" type="text/css" rel="stylesheet"/>
	<div class="content">
		<div class="row">
			<div class="container col-lg-3 col-lg-offset-1">
				<ul class="payment_menu">
					<li>
						<label for="year">Year</label>
						<select name="year" class="form-control year">							
							<option class="default" value="empty">Select year</option>
							<option class="default" value="all">All</option>
							<?php						
								foreach($year as $value){
									print('<option>'.$value->year.'</option>');
								}
							?>					
						</select>
					</li>					
					<li id="term_select" class="hidden">
						<label for="term">Term</label>
						<select name="term" class="form-control term">							
							<option class="default" value="empty">Select term</option>
							<option class="default" value="all">All</option>								
						</select>
					</li>
				</ul>
				<input type="checkbox" class='disabled' id="critical" />Show unpaid only
			</div>
			<div class="container col-lg-3">
				<label for="search">Filter</label><input type="search" name="search" class="form-control pull-left" id="search_parent"/>
			</div>
		</div>
		<hr class="divider"></hr>
		<div class="row">
			<div class="container col-lg-6 col-lg-offset-1">
				<h3>Payments</h3>
				<table class="table" id="payment_list">					
					<thead>
						<tr class="theader">
							<th>ID</th>
							<th>Parent</th>
							<th>Child</th>
							<th>Year</th>
							<th>Term</th>
							<th>Sport</th>
							<th>Level</th>
							<th>Group</th>
							<th>Paid/Due</th>							
						<tr>
					</thead>
					<tbody>						
					</tbody>
				</table>
			</div>		
			<div class="container col-lg-3 edit hidden">
				<ul class="payment_details">
					<li><label for="num_lessons">Number of lessons</label><input type="number" class="form-control" id="num_lessons"></li>
					<li><label for="total">Amount due</label><input type="number" class="form-control" id="total"></li>					
				</ul>	
				<button class="btn btn-default pull-right" id="save_payment">Save changes</button>
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
					<table class="table" id="transaction_list">					
						<thead>
							<tr class="theader">
								<th>ID</th>
								<th>Date</th>
								<th>Type</th>
								<th>Amount</th>														
							<tr>
						</thead>
						<tbody>						
						</tbody>
					</table>
					<button class="btn btn-default" id="new_transaction">Add new</button>
				</div>	
				<div class="container col-lg-3 hidden" id="trans_details">
					<ul class="payment_details">
						<li><label>Type</label>
							<select class="form-control" id="type">
								<option value="cash">Cash</option>
								<option value="credit">Credit</option>
								<option value="eftpos">EFTPOS</option>
							</select>
						</li>
						<li><label>Amount</label><input type="number" class="form-control" id="amount"></li>
						<li><button class="btn btn-default disabled" id="save_transaction">Save</button></li>					
					</ul>
				</div>
			</div>		
		</div>
	</div>
	<script src="<?php echo base_url(); ?>js/payments.js"></script>