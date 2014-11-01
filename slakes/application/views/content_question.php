<div id="content">
<div class="row">
	<div class="container col-lg-4 col-lg-offset-1">	
		<h1>Secret question</h1>
		<?php if (isset($message)) echo $message; ?>	
		<?php echo "<h3>".$question."</h3>"; ?>
		<form action="<?php echo base_url() ?>login/get_result" method="POST" >			
			<input type="text" class="form-control" placeholder="Answer" name="answer" required />             
			<button class="btn btn-primary" type="submit">Submit</button>
		</form>
		<br/>
		<a href="<?php echo base_url() ?>login">Home</a>
	</div>
</div>
</div>
