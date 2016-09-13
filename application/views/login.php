<?php if( @$message != null ) : ?>
<div class="alert alert-danger">
	<?php echo @$message; ?>
</div>
<?php endif; ?>
<h3><strong>User Login</strong></h3>
<form role="form" action="<?php echo site_url('login/process_login');?>" method="POST">
	<div class="form-group">
		<input type="text" class="form-control input-lg" name="user_login" value="<?php echo @$username;?>" placeholder="Username" required autofocus />
	</div>
	<div class="form-group">
		<input type="password" class="form-control input-lg" name="user_password" placeholder="Password" required />
	</div>
	<div class="row">
		<div class="col-lg-12">
			<button type="submit" class="btn btn-primary btn-lg btn-block">Login</button> 
		</div>
	</div>
</form>