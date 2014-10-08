	<link href="<?php echo base_url(); ?>/css/payments.css" type="text/css" rel="stylesheet"/>
	<div class="content">
		<div class="row">
			<div class="container col-lg-3 col-lg-offset-1">
				<ul class="payment_menu">
					<li>
						<label for="year">Year</label>
						<select name="year" class="form-control year">							
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
						<select name="term" class="form-control term">							
							<option class="default" value="empty" selected></option>
							<option class="default">All</option>								
						</select>
					</li>
				</ul>
				<input type="checkbox" name="owing" />Show unpaid only
			</div>
			<div class="container col-lg-3">
				<label for="search">Search</label><input type="search" name="search" class="form-control pull-left" id="search_parent"/>
			</div>
		</div>
		<hr class="divider"></hr>
		<div class="row">
			<div class="container col-lg-4 col-lg-offset-1">
				<table class="table" id="payment_list">					
					<thead>
						<tr class="theader"><th>ID</th><th>First Name</th><th>Last Name</th><th>Payment date</th><th>Amount paid</th><tr>
					</thead>
					<tbody>						
					</tbody>
				</table>
			</div>		
			<div class="container col-lg-3 edit hidden">
				<ul class="payment_details">
					<li><label for="paid_date">Payment date</label><input type="date" class="form-control" id="paid_date"></li>
					<li><label for="amount">Amount paid</label><input type="number" class="form-control" id="amount"></li>
					<li><label for="type">Type</label>
						<select name="type" class="type form-control">
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