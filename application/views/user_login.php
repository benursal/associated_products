<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User Login | APP Quotations & PO System</title>

    <!-- Bootstrap -->
    <link href="<?php echo site_url();?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo site_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.css" />
	
    <link href="<?php echo site_url();?>assets/custom-styles.css" rel="stylesheet">
	</head>

	<body>
	
		<div class="ajax-loader">
			<img src="<?php echo site_url('assets/images/loading.gif'); ?>" />
		</div>
		
		<div class="container">
			<div class="row margin-top-40">
				<div class="col-md-6 col-md-offset-3">
					
					<form class="form-signin mg-btm" method="POST" action="<?php echo site_url('users/process_login');?>">
						<h3 class="heading-desc text-center">Login to your account</h3>
						<hr />
						<?php if( isset( $error_message ) ) : ?>
							<div class="text-red text-bold text-center margin-top-20"><?php echo $error_message; ?></div>
						<?php endif; ?>
						
						<div class="main">	

							<input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo @$username;?>" autofocus>
							<input type="password" class="form-control" name="password" placeholder="Password">
							 
							<div class="row">
								<div class="col-md-6">
									<label class="text-light">
										<input type="checkbox" value="1" name="remember_me" /> Remember Me
									</label>
								</div>
								<!--<div class="col-md-6 text-right">
									<a href="<?php echo site_url('users/forgot_password');?>">Forget password?</a>
								</div>-->
							</div>
							
							<span class="clearfix"></span>	
							
						</div>
						<div class="login-footer">
							<div class="row">
								
								<div class="col-xs-10 col-xs-offset-1">
									<button type="submit" class="btn btn-lg btn-danger btn-block">Login</button>
								</div>
							</div>

						</div>
					</form>
					
					
				</div>
			</div>
		</div>
	
		<!-- jQuery -->
		<script src="<?php echo site_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
		<!-- Custom Theme Scripts -->
		<script src="<?php echo site_url();?>assets/build/js/custom.min.js"></script>
		
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.js"></script>
		
		<!-- custom js -->
		<script src="<?php echo site_url();?>assets/app.js"></script>
    
	</body>
</html>
    