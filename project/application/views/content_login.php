<center><img style="max-width: 200px" src='<?php echo base_url(); ?>img/SL-logo-club-rgb1.gif'></img></center>
<center><h2>Sanctuary Lakes Management System</h2></center>
<div id="content">
<div class="container raw">
	<div class="col-md-4 col-md-offset-4">	
    <?php echo validation_errors(); ?></p>
	<?php echo form_open('verify_login'); ?>
        <h3 class="form-signin-heading">Please sign in</h3>
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <input type="password" class="form-control" placeholder="Password" name="password" required>        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
	</div>
</div>
</div>