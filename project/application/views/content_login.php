<div class="container raw">
	<div class="col-md-4  col-md-offset-4">
    <?php echo validation_errors(); ?>
	<?php echo form_open('verify_login'); ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <input type="password" class="form-control" placeholder="Password" name="password" required>        
        <button class="btn btn-lg btn-default btn-block" type="submit">Sign in</button>
    </form>
	</div>
</div>