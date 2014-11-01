<body>
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
		<div class="navbar-header">
			<div class="navbar-brand"><img style="max-width:80px; margin-top: -14px"  src='<?php echo base_url(); ?>img/logo1.png'></img></div>
		</div>	
		<div>
			<ul class="nav navbar-nav navbar-left">
				<li <?php if (base_url()."site/members"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site/members">Registrations</a></li>
				<li <?php if (base_url()."site/terms"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site/terms">Terms</a></li>
				<li <?php if (base_url()."site/schedule"==current_url() || base_url()."site"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site/schedule">Schedule</a></li>				
				<li <?php if (base_url()."site/sports"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site/sports">Skills</a></li>
				<li <?php if (base_url()."site/groups"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site/groups">Groups</a></li>				
				<li <?php if (base_url()."site/payments"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site/payments">Payments</a></li>
				<li <?php if (base_url()."site/staff"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site/staff">Staff</a></li>
				<li <?php if (base_url()."site/lessons"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site/lessons">Lessons</a></li>
				<li <?php if (base_url()."site/assignments"==current_url()) echo "class='active'"; ?>><a href="<?php echo base_url(); ?>site/assignments">Assignments</a></li>
			</ul>			
		</div>
		</div>
	</nav>
	
	<div class="row">
		<div class="container col-lg-4 col-lg-offset-7">
			<ul class="pull-right" style="display: table">
				<li style="display: table-row">
					<label style="display: table-cell; vertical-align: middle">You logged in as <?php echo $this->session->userdata('logged_in')['username']; ?></label>&nbsp;
					<a href="<?php echo base_url();?>site/profile">Profile</a>&#47;<a style="display: table-cell; vertical-align: middle;" href="<?php echo base_url();?>site/logout">Log out</a>
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