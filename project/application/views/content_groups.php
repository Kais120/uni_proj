<link href="<?php echo base_url(); ?>/css/groups.css" type="text/css" rel="stylesheet"/>
<div id="content">
	<div class="row">
		<div class="container col-lg-10 col-lg-offset-1">
			<ul class="tabs" id="mytab">
				<?php
					if (isset($groupSport) && $groupSport==2){						
						print('
							<li class="tab-link" id="tennis">Tennis</li>			
							<li class="tab-link current" id="swimming">Swimming</li>
						');
					}else{						
						print('
							<li class="tab-link current" id="tennis">Tennis</li>			
							<li class="tab-link" id="swimming">Swimming</li>
						');							
					}				
				?>
							
			</ul>
		</div>	
	</div>	
	<hr class="divider"></hr>
	<div class="row">
		<div class="container col-lg-4 col-lg-offset-1" id="select_menu">
			<ul class="details">
				<li>
					<label for="year">Year</label>
					<select class="form-control" id="year">							
						<?php 
							if (isset($groupYear)){
								print ($groupYear);
							}
						?>
					</select>
				</li>
				<li>
					<label for="term" id="term">Term</label>
					<select class="form-control hidden" id="term">						
						<option value="null" class="null">Select term</option>
						<?php 
							if (isset($groupTerm)){
								print ($groupTerm);
							}
						?>
					</select>
				</li>
				<li>
					<label for="skill" class="hidden" id="skill">Skill level</label>
					<select class="form-control hidden" id="skill">
						<option value="null" class="null">Select skill</option>
						<?php 
							if (isset($groupSkill)){
								print ($groupSkill);
							}
						?>
					</select>
				</li>
				<li>
					<label for="skill" class="hidden" id="group">Group</label>
					<select class="form-control hidden" id="group">
						<option value="null" class="null">Select a group or create new</option>
						<?php 
							if (isset($groupName)){
								print ($groupName);
							}
						?>
					</select>
				</li>
			</ul>
			<button class="btn btn-default hidden" id="add_group">Add group</button>
		</div>	
	</div>			
	<div class="row hidden" id="main_content">
		<hr class="divider"></hr>
		<div class="container col-lg-2 col-lg-offset-1">			
			<ul class="details" id="group_details">
				<li>
					<label for="lesson">Group type</label>
					<select class="form-control" id="lesson">						
					</select>
				</li>
				<li><label for="group_name">Name</label><input type="text" class="form-control" name="group_name" id="group_name"></li>
				<li><label for="number_members">Number of participants</label><input type="number" class="form-control" name="number_members" id="number_members"></li>
				<li><label for="day">Day of the week</label></li>
				<li><input type="radio" name="day" value="1" selected>Monday</li>
				<li><input type="radio" name="day" value="2">Tuesday</li>
				<li><input type="radio" name="day" value="3">Wednesday</li>
				<li><input type="radio" name="day" value="4">Thursday</li>
				<li><input type="radio" name="day" value="5">Friday</li>
				<li><input type="radio" name="day" value="6">Saturday</li>
				<li><input type="radio" name="day" value="0">Sunday</li>
				<li><label for="start_time">Start time</label><input type="time" class="form-control" name="start_time" id="start_time"/></li>
				<li><label for="end_time">End time</label><input type="time" class="form-control" name="end_time" id="end_time"/></li>
				<li>
					<label for="staff">Staff</label>
					<select class="form-control" id="staff">						
					</select>
				</li>
				<li><button class="btn btn-default disabled" id="save_changes">Save changes</button></li>				
			</ul>			
		</div>		
		<div class="container col-lg-3 col-lg-offset-1">
			<table class="table table_details" id="members">
				<thead>
					<th>ID</th><th>First Name</th><th>Last name</th><th>Is member</th>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		<div class="container col-lg-3 col-lg-offset-1" id="personal_data">
			<ul class="details" id="progress">
				<li>
					<label>Date</label>
					<select class="form-control" id="training_day">
						<option value='null' class='null'>Select day</option>
					</select>
				</li>
				<li><label>Attended</label><input type="checkbox" name="attended" value="true"/></li>
			</ul>
			<table class="table table_details" id="tasks">
				<thead>
					<th>Task</th><th>Accomplished</th>
				</thead>
				<tbody>
				</tbody>
			</table>
			<label for="start_time">Notes</label><textarea type="text" class="form-control" name="notes" id="notes"></textarea>
			<button class="btn btn-default disabled" id="save_progress">Save</button>
		</div>
	</div>		
</div>
<script src="<?php echo base_url(); ?>js/groups.js"></script>
