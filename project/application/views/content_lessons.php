	<link href="<?php echo base_url(); ?>/css/lessons.css" type="text/css" rel="stylesheet"/>
	<div class="content">		
		<div class="row">
			<div class="container col-lg-4 col-lg-offset-1">
				<select class="form-control" id="sport">
					<option value='null'>Choose a sport type</option>
					<?php 
						foreach ($sport as $value){
							print ('<option value="'.$value->sport_id.'">'.$value->sport_description.'</option>');
						}
					?>
				</select>
			</div>
		</div>
		<hr class="divider"></hr>
		<div class="row">
			<div class="container col-lg-4 col-lg-offset-1">
				<table class="table" id="lessons_info">
					<thead>
						<th>Lesson</th>
						<th>Cost</th>						
					</thead>
					<tbody>
					</tbody>
				</table>
				<button class="btn btn-default pull-left" id="new_lesson">Add</button>
			</div>
			<div class="container col-lg-4" id>
				<form action="" method="POST" id="lesson_update" class="hidden">
					<ul id="lesson_details">
						<li><label>Sport</label><input type="text" class="form-control" name="sport_type" readonly></li>
						<li><label>ID</label><input type="text" class="form-control" name="lesson_id" readonly></li>
						<li><label>Lesson</label><input type="text" class="form-control" name="lesson_name" required></li>
						<li><label>Cost</label><input type="number" class="form-control" name="lesson_cost" required></li>	
						<li><button class="btn btn-default pull-right disabled" type="submit" id="save_lesson">Save</button></li>
					</ul>					
				</form>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>js/lessons.js"></script>