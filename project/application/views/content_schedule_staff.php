<link href='<?php echo base_url(); ?>css/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url(); ?>css/fullcalendar.print.css' rel='stylesheet' media='print' />
<link href="<?php echo base_url(); ?>/css/schedule.css" type="text/css" rel="stylesheet"/>
<script src='<?php echo base_url(); ?>js/lib/moment.min.js'></script>
<script src='<?php echo base_url(); ?>js/lib/jquery.min.js'></script>
<script src='<?php echo base_url(); ?>js/fullcalendar.min.js'></script>
<script src='<?php echo base_url(); ?>js/schedule.js'></script>
<div id="content">
	<div class="row">
		<div class="container col-lg-10 col-lg-offset-1">
			<ul class="tabs" id="mytab">
				<li class="tab-link current" id="tennis">Tennis</li>			
				<li class="tab-link" id="swimming">Swimming</li>			
			</ul>			
		</div>	
	</div>			
	<div id='loading'>loading...</div>	
	<div id='calendar'></div>	
</div>

