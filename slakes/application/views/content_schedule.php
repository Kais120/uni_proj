<link href='<?php echo base_url(); ?>css/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url(); ?>css/fullcalendar.print.css' rel='stylesheet' media='print' />
<link href="<?php echo base_url(); ?>/css/schedule.css" type="text/css" rel="stylesheet"/>
<script src='<?php echo base_url(); ?>js/lib/moment.min.js'></script>
<script src='<?php echo base_url(); ?>js/lib/jquery.min.js'></script>
<script src='<?php echo base_url(); ?>js/fullcalendar.min.js'></script>
<script src='<?php echo base_url(); ?>js/schedule.js'></script>
<div id="content">
	<div class="row">
		<div class="container col-lg-10 col-lg-offset-2">
			<h1><?php echo $title;?></h1>
			<ul class="tabs" id="mytab">
				<li class="tab-link current" id="tennis">Tennis</li>			
				<li class="tab-link" id="swimming">Swimming</li>			
			</ul>			
		</div>	
	</div>	
	<hr class="divider"></hr>
	<div id='loading'>loading...</div>	
	<div id='calendar'>
		<div id="calendarTrash" class="calendar-trash"><img height="4%" width="4%" src='<?php echo base_url(); ?>img/trashcan.png'></img></div>
	</div>	
</div>

