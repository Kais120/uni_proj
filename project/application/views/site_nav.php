<body>
	<div class="row navbar navbar-default navbar-static-top" role="navigation">
	 <div class="container col-lg-10 col-lg-offset-1">
		<div class="navbar-header">
			<div class="navbar-brand">Sanctuary Lakes</div>
		</div>	
		<div>
			<ul class="nav navbar-nav navbar-left">
				<li><a href="<?php echo base_url(); ?>site/members">Members</a></li>
				<li><a href="<?php echo base_url(); ?>site/terms">Terms</a></li>
				<li><a href="<?php echo base_url(); ?>site/schedule">Schedule</a></li>				
				<li><a href="<?php echo base_url(); ?>site/sports">Skills</a></li>
				<li><a href="<?php echo base_url(); ?>site/groups">Groups</a></li>				
				<li><a href="<?php echo base_url(); ?>site/payments">Payments</a></li>
				<li><a href="<?php echo base_url(); ?>site/staff">Staff</a></li>
				<li><a href="<?php echo base_url(); ?>site/lessons">Lessons</a></li>
				<li><a href="<?php echo base_url(); ?>site/assignments">Assignments</a></li>
			</ul>			
		</div>			
	 </div>
	</div>
	<div class="row">
		<div class="container col-lg-3 col-lg-offset-8">
			<ul class="pull-right" style="display: table">
				<li style="display: table-row">
					<label style="display: table-cell; vertical-align: middle">You logged in as <a href="<?php echo base_url();?>site/profile"><?php echo $this->session->userdata('logged_in')['username']; ?></a></label>				
					<a style="display: table-cell; vertical-align: middle;" href="<?php echo base_url();?>site/logout"><span class="glyphicon glyphicon-log-out"></span></a>
				</li>
			</ul>
		</div>
	</div>