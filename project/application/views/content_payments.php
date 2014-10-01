	<link href="<?php echo base_url(); ?>/css/payments.css" type="text/css" rel="stylesheet"/>
	<div class="content">
		<div class="row">
			<div class="container col-lg-3 col-lg-offset-1">
				<ul class="payment_menu">
					<li>
						<label for="year">Year</label>
						<select name="year" class="year">							
							<option selected></option>
							<option>All</option>
							<?php						
								foreach($year as $value){
									print('<option>'.$value->year.'</option>');
								}
							?>					
						</select>
					</li>
					<li id="term_select" class="hidden">
						<label for="term">Term</label>
						<select name="term" class="term">							
							<option class="default" value="empty" selected></option>
							<option class="default">All</option>								
						</select>
					</li>
				</ul>
			</div>
			<div class="container col-lg-3">
				<label for="search">Search by name</label><input type="search" name="search" class="form-control pull-left" id="search_parent" placeholder="Parent name"/>
			</div>
		</div>
		<div class="row">
			<div class="container col-lg-4 col-lg-offset-1">
				<table id="payment_list">
					<thead>
						<th>ID</th><th>First Name</th><th>Last Name</th><th>Payment date</th><th>Amount paid</th>
					</thead>
					<tbody>					
					</tbody>
				</table>
			</div>		
			<div class="container col-lg-3 edit hidden">
				<ul class="payment_details">
					<li><label for="paid_date">Payment date</label><input type="date" class="form-control" id="paid_date"></li>
					<li><label for="amount">Amount paid</label><input type="text" class="form-control" id="amount"></li>
					<li><label for="type">Type</label>
						<select name="type" class="type">
							<option value="cash">Cash</option>
							<option value="credit">Credit</option>
							<option value="eftpos">EFTPOS</option>
						</select>
					</li>
				</ul>	
				<button class="btn btn-default pull-right" id="save_payment">Save changes</button>
			</div>	
		</div>
		
	</div>
	<script src="<?php echo base_url(); ?>js/payments.js"></script>