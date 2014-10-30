	<link href="<?php echo base_url(); ?>/css/assignments.css" type="text/css" rel="stylesheet"/>
	<div id="content">	
		<div class="row">
			<div class="container col-lg-3 col-lg-offset-1">
				<ul class="assignment_menu">
					<li>
						<label for="year">Year</label>
						<select name="year" class="form-control year">							
							<option class="default" value="empty">Select year</option>							
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
						</select>
					</li>
				</ul>				
			</div>			
		</div>
		<hr class="divider"></hr>
		<div class="row">
			<div class="container col-lg-6 col-lg-offset-1">
				<table class="table">
					<thead>
						<tr>
							<th>Instructor</th>
							<th>Sport</th>
							<th>Level</th>
							<th>Group</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>js/assignments.js"></script>
	
	