<div class="row">
	<div class="container col-lg-4 col-lg-offset-1">	
		<?php if (isset($message)) echo $message; ?>	
		<form action="<?php echo base_url() ?>login/find_username" method="POST" >
			<h3 class="form-signin-heading">Your username</h3>
			<input type="text" class="form-control" placeholder="Username" name="username" required />             
			<button class="btn btn-default" type="submit">Find</button>
		</form>
		<br/>
		<a href="<?php echo base_url() ?>login">Home</a>
	</div>
</div>
