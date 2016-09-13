<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?php echo $page_title; ?></title>

	<!-- Bootstrap -->
	<link href="<?php echo site_url();?>assets/css/bootstrap.css" rel="stylesheet">
	<!-- custom styles -->
	<link href="<?php echo site_url();?>assets/css/style.css" rel="stylesheet">
	<!-- media queries -->
	<link href="<?php echo site_url();?>assets/css/media-queries.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<div id="menuHeader">
		<div class="container">
			<div class="row">
				<nav class="navbar navbar-default">
				  <div class="container-fluid">
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand" href="<?php echo site_url(); ?>">Monte De Ramos Clinic</a>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					  <ul class="nav navbar-nav navbar-right">
						<li class="">
							<a href="<?php echo site_url(); ?>" class="button">
								<span class="glyphicon glyphicon-th-list"></span> Browse Patients <span class="sr-only">(current)</span>
							</a>
						</li>
						<li>
							<a href="<?php echo site_url(); ?>patients/add_new" class="button">
								<span class="glyphicon glyphicon-plus-sign"></span> Add New Patient
							</a>
						</li>
						<li>
							<a href="<?php echo site_url('settings/backup_db'); ?>" class="button">
								<span class="glyphicon glyphicon-upload"></span> Backup Database
							</a>
						</li>
					  </ul>
					</div>
				  </div>
				</nav>
			</div>
		</div>
   </div>