	<link href="<?php echo base_url(); ?>/css/terms.css" type="text/css" rel="stylesheet"/>
	<div class="content">	
		<div class="row">
			<div class="container col-lg-3 col-lg-offset-1">
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
			</div>
		</div>
		<hr class="divider"></hr>
		<div class="row">
			<div class="container col-lg-4 col-lg-offset-1">				
				<table class="table" id="term_list">
					<thead>
					<th>ID</th><th>Description</th><th>Start date</th><th>End date</th>
					</thead>
					<tbody>					
					</tbody>
				</table>				
			</div>
			<div class="container col-lg-3 fields hidden">
				<ul class="term_dates">
					<li><label for="startDate">Description</label><input type="text" class="form-control" id="description"></li>
					<li><label for="startDate">Start Date</label><input type="date" class="form-control" id="start_date"></li>
					<li><label for="endDate">End Date</label><input type="date" class="form-control" id="end_date"></li>
				</ul>				
			</div>			
			
		</div>
		<div class="row">
			<div class="container col-lg-4 col-lg-offset-1">
				<button class="btn btn-primary pull-left" id="new_term">Add new</button>
			</div>
			<div class="container col-lg-3">
				<button class="btn btn-primary pull-right hidden" id="save_term">Save changes</button>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>js/terms.js"></script>