<body>
	<div class="row navbar navbar-default navbar-static-top" role="navigation">
	 <div class="container col-lg-10 col-lg-offset-1">
		<div class="navbar-header">
			<div class="navbar-brand">Sanctuary Lakes</div>
		</div>	
		<div>
			<ul class="nav navbar-nav navbar-left">
				<li><a href="<?php echo base_url(); ?>site_staff/members">Registrations</a></li>
				<li><a href="<?php echo base_url(); ?>site_staff/schedule">Schedule</a></li>				
				<li><a href="<?php echo base_url(); ?>site_staff/groups">Groups</a></li>				
				<li><a href="<?php echo base_url(); ?>site_staff/payments">Payments</a></li>				
				<li><a href="<?php echo base_url(); ?>site_staff/assignments">Assignments</a></li>	
			</ul>			
		</div>			
	 </div>
	</div>
	<div class="row">
		<div class="container col-lg-3 col-lg-offset-8">
			<ul class="pull-right" style="display: table">
				<li style="display: table-row">
					<label style="display: table-cell; vertical-align: middle">You logged in as <a href="<?php echo base_url();?>site_staff/profile"><?php echo $this->session->userdata('logged_in')['username']; ?></a></label>				
					&nbsp;<a style="display: table-cell; vertical-align: middle;" href="<?php echo base_url();?>site_staff/logout"><span class="glyphicon glyphicon-log-out"></span></a>
				</li>
			</ul>
		</div>
	</div>