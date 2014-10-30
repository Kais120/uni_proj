<link href="<?php echo base_url(); ?>/css/sports.css" type="text/css" rel="stylesheet"/>
	<div id="content">
		<div class="row">
			<div class="container col-lg-4 col-lg-offset-1">
				<ul class="tabs">
					<li class="tab-link current" id="tennis">Tennis</li>			
					<li class="tab-link" id="swimming">Swimming</li>
				</ul>
			</div>
		</div>
		<hr class="divider"></hr>
		<div class="row">
			<div class="container col-lg-4 col-lg-offset-1">
				<table class="skill_table table" id="skills_list">
					<thead>
						<th>ID</th><th>Band</th><th>Description</th>
					</thead>
					<tbody>					
					</tbody>
				</table>
			</div>
			<div class="container col-lg-4">
				<ul class="details hidden" id="skill_details">
					<li><label for="band">Band</label><input type="text" class="form-control" id="band"></li>
					<li><label for="skill_description">Description</label><input type="text" class="form-control" id="skill_description"></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="container col-lg-4 col-lg-offset-1">
				<button class="btn btn-primary pull-left" id="new_skill">Add new</button>
			</div>
			<div class="container col-lg-3">
				<button class="btn btn-primary pull-right disabled hidden" id="save_skill">Save</button>
			</div>
		</div>
		<br/>
		<div id="tasks" class="hidden">
		<div class="row">
			<div class="container col-lg-4 col-lg-offset-1">
				<table class="skill_table table" id="tasks_list">
					<thead>
						<th>ID</th><th>Task</th><th>Description</th>
					</thead>
					<tbody>					
					</tbody>
				</table>
			</div>
			<div class="container col-lg-4">
				<ul class="details hidden" id="task_details">
					<li><label for="task">Task</label><input type="text" class="form-control" id="task"></li>
					<li>
						<label for="task_description">Description</label>
						<textarea class="form-control" id="task_description"></textarea>
					</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="container col-lg-4 col-lg-offset-1">
				<button class="btn btn-primary pull-left" id="new_task">Add new</button>
			</div>
			<div class="container col-lg-3">
				<button class="btn btn-primary pull-right disabled hidden" id="save_task">Save</button>
			</div>
		</div>
		</div>
	</div>
<script src="<?php echo base_url(); ?>js/sports.js"></script>