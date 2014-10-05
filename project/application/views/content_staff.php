<link href="<?php echo base_url(); ?>/css/staff.css" type="text/css" rel="stylesheet"/>
<div id="content">
	<div class="row">
		<div class="container col-lg-4 col-lg-offset-1">
			<form action="" method="POST">
				<ul>
					<label>Show inactive staff</label>
					<input type="checkbox" name="inactive" value="true"/>
					<button type="submit" name="show_inactive" class="btn btn-default">Submit</button>
				</ul>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="container col-lg-4 col-lg-offset-1">
			<?php 
				if (!isset($_POST['inactive'])){
					print('<p style="color: red">Inactive staff is not displayed</p>');
				}
			?>
			<table class="table" id="staff_list">
				<thead>
					<th>First name</th>
					<th>Last name</th>
				</thead>
				<tbody>
					<?php
						if (isset($_POST['show_inactive']) && isset($_POST['inactive'])){
							foreach ($staff as $value){									
								print ('<tr data-value="'.$value->staff_id.'"><td>'.$value->staff_fname.'</td><td>'.$value->staff_lname.'</td></tr>');
							}
						}else{
							foreach ($staff as $value){
								if ($value->active==1)
									print ('<tr data-value="'.$value->staff_id.'"><td>'.$value->staff_fname.'</td><td>'.$value->staff_lname.'</td></tr>');							
							}						
						}
					?>
				</tbody>
			</table>
			<button class="btn btn-default pull-left" id="new_staff">Add new</button>
		</div>
		<div class="container col-lg-4">
			<form action="" method="POST" id="staff_action" class="hidden">
				<ul id="staff_details">
					<li><label for="staff_id">ID</label><input type="text" class="form-control" name="staff_id" readonly></li>
					<li><label for="fname">First name</label><input type="text" class="form-control" name="fname" required></li>
					<li><label for="mname">Middle name</label><input type="text" class="form-control" name="mname"></li>
					<li><label for="lname">Last name</label><input type="text" class="form-control" name="lname" required></li>
					<li><label for="hnumber">Home number</label><input type="text" class="form-control" name="hnumber"></li>
					<li><label for="mnumber">Mobile number</label><input type="text" class="form-control" name="mnumber"></li>
					<li><label for="emgname">Emergency contact name</label><input type="text" class="form-control" name="emgname"></li>
					<li><label for="emgnumber">Emergency contact number</label><input type="text" class="form-control" name="emgnumber"></li>
					<li><label for="email">Email</label><input type="email" class="form-control" name="email"></li>
					<li><label for="username">Username</label><input type="text" class="form-control" name="username" readonly></li>
					<li><label for="password">Password</label><input type="password" class="form-control" name="password"></li>	
					<li><label for="type">Account type</label>
						<select class="form-control" name="type">
							<option value="administrator">Administrator</option>
							<option value="staff" selected>Staff</option>
						</select>
					</li>
					<li><label for="type">Active</label><input type="checkbox" name="active" value="1"></li>					
					<li><span></span><button type="submit" class="btn btn-default pull-right disabled" id="save_staff">Save</button></li>
				</ul>				
			</form>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>js/staff.js"></script>