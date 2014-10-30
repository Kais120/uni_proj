<link href="<?php echo base_url(); ?>/css/staff.css" type="text/css" rel="stylesheet"/>
<div id="content">
	<div class="row">
		<div class="container col-lg-4 col-lg-offset-1">		
			<form action="<?php echo base_url() ?>site/save_profile" method="POST" id="staff_action">
				<ul id="staff_details">
					<li><label for="fname">First name</label><input type="text" class="form-control" name="fname" value="<?php echo $details->staff_fname ?>" required /></li>
					<li><label for="mname">Middle name</label><input type="text" class="form-control" name="mname" value="<?php echo $details->staff_mname ?>" /></li>
					<li><label for="lname">Last name</label><input type="text" class="form-control" name="lname" value="<?php echo $details->staff_lname ?>" required /></li>
					<li><label for="hnumber">Home number</label><input type="text" class="form-control" name="hnumber" value="<?php echo $details->home_number ?>" /></li>
					<li><label for="mnumber">Mobile number</label><input type="text" class="form-control" name="mnumber" value="<?php echo $details->mobile_number ?>" /></li>
					<li><label for="emgname">Emergency contact name</label><input type="text" class="form-control" name="emgname" value="<?php echo $details->emg_contact_name ?>" /></li>
					<li><label for="emgnumber">Emergency contact number</label><input type="text" class="form-control" name="emgnumber" value="<?php echo $details->emg_contact_number ?>" /></li>
					<li><label for="email">Email</label><input type="email" class="form-control" name="email" value="<?php echo $details->staff_email ?>" /></li>
					<li><label for="username">Username</label><input type="text" class="form-control" name="username" value="<?php echo $details->username ?>" readonly></li>
					<li><label for="password">Password</label><input type="password" class="form-control" name="password" /></li>	
					<li><label for="question">Secret question</label><input type="text" class="form-control" name="question" value="<?php echo $details->question ?>" required/></li>	
					<li><label for="answer">Answer</label><input type="text" class="form-control" name="answer" value="<?php echo $details->answer ?>" required/></li>	
					<li><span></span><button type="submit" class="btn btn-primary pull-right" id="save_staff">Save</button></li>
				</ul>				
			</form>
		</div>
	</div>
</div>