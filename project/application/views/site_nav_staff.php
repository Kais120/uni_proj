<body>
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
			<div class="navbar-brand"><img style="max-width:80px; margin-top: -14px"  src='<?php echo base_url(); ?>img/logo1.png'></img></div>
		</div>	
		<div>
			<ul class="nav navbar-nav navbar-left">
				<li <?php if (base_url()."site_staff/members"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site_staff/members">Registrations</a></li>
				<li <?php if (base_url()."site_staff/schedule"==current_url() || base_url()."site_staff"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site_staff/schedule">Schedule</a></li>				
				<li <?php if (base_url()."site_staff/groups"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site_staff/groups">Groups</a></li>				
				<li <?php if (base_url()."site_staff/payments"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site_staff/payments">Payments</a></li>				
				<li <?php if (base_url()."site_staff/assignments"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site_staff/assignments">Assignments</a></li>	
			</ul>			
		</div>
		</div>
	</nav>
	<div class="row">
		<div class="container col-lg-4 col-lg-offset-7">			
			<ul class="pull-right" style="display: table">
				<li style="display: table-row">
					<label style="display: table-cell; vertical-align: middle">You logged in as <?php echo $this->session->userdata('logged_in')['username']; ?></label>
					&nbsp;<a href="<?php echo base_url();?>site_staff/profile">Profile</a>&#47;<a style="display: table-cell; vertical-align: middle;" href="<?php echo base_url();?>site_staff/logout">Log out</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="container col-lg-offset-1">
			<?php if($title!='Schedule') echo "<h1>".$title."</h1>";?>
		</div>	
		<br/>
	 </div>