<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $page_title; ?> | APP Quotations & PO System</title>

    <!-- Bootstrap -->
    <link href="<?php echo site_url();?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo site_url();?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
	
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.css" />
	
    <!-- Custom Theme Style -->
    <link href="<?php echo site_url();?>assets/build/css/custom.min.css" rel="stylesheet">
	
    <link href="<?php echo site_url();?>assets/custom-styles.css" rel="stylesheet">
  </head>

  <body class="nav-md">
	
	<div class="ajax-loader">
		<img src="<?php echo site_url('assets/images/loading.gif'); ?>" />
	</div>
  
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo site_url(); ?>" class="site_title"> <i class="fa fa-buysellads" aria-hidden="true"></i> <span>APP System</span></a>
            </div>

            <div class="clearfix"></div>           

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
				<div class="menu_section">
					
					<ul class="nav side-menu">
						<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> Dashboard </a></li>
						<li><a><i class="fa fa-list-ol"></i> Quotations <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu">
								<li><a href="<?php echo site_url('quotations');?>">List Quotations</a></li>
								<li><a href="<?php echo site_url('quotations/add_new');?>">Add New Quotation</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-table"></i> Purchase Orders <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu">
								<li><a href="<?php echo site_url('purchase_orders');?>">List Purchase Orders</a></li>
								<li><a href="<?php echo site_url('purchase_orders/add_new');?>">Add New Purchase Order</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-users"></i> Customers <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu">
								<li><a href="<?php echo site_url('customers');?>">List Customers</a></li>
								<li><a href="<?php echo site_url('customers/add_new');?>">Add New Customer</a></li>
							</ul>
						</li>
						<li><a><i class="fa fa-truck"></i> Suppliers <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu">
								<li><a href="<?php echo site_url('suppliers');?>">List Suppliers</a></li>
								<li><a href="<?php echo site_url('suppliers/add_new');?>">Add New Supplier</a></li>
							</ul>
						</li>
					</ul>
				</div>
            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user" aria-hidden="true"></i> <?php echo ucwords($user->fname . ' ' . $user->lname); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo site_url('dashboard/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
		
		
		<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>
            <!-- place ccontent here -->