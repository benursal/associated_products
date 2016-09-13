<?php include 'header.php'; ?>
<div id="breadcrumbContainer">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="index.php">Patients</a></li>
					<li class="active">Patient Details</li>
				</ul>
			</div>
		</div>
	</div>
</div>
	
<div class="container">
	<div class="row" id="mainContent">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<ul class="nav nav-pills">
						<li class="active"><a href="#">Patient Details</a></li>
						<li><a href="history.php">History</a></li>
						<li><a href="complaints.php">Complaints</a></li>
					</ul>
				</div>
			</div>

			<div class="page-header">
				<h1><strong>Patient Details</strong> <br /><small>Ursal, Edward Benedict</small></h1>
			</div>
			<!-- records now -->
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 body-content">
					<form class="form-horizontal form-data-entry">
						<fieldset>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 col-sm-5 control-label">Name</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value">Edward Benedict Ursal</span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 col-sm-5 control-label">Age</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value">61</span>
								</div>
							</div>
				
							<div class="form-group">
								<label for="select" class="col-lg-3 col-sm-5 control-label">Gender</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value">Male</span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="select" class="col-lg-3 col-sm-5 control-label">Civil Status</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value">Married</span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 col-sm-5 control-label">Nationality</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value">Pinoy na Pinoy</span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 col-sm-5 control-label">Occupation</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value">Entrepreneur</span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 col-sm-5 control-label">Place of Birth</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value">Cebu City</span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 col-sm-5 control-label">Present Address</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value">Eroreco Subd., Bacolod City</span>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-lg-12 text-right">
									<a type="button" class="btn btn-link btn-lg" href="index.php">
										<span class="glyphicon glyphicon-arrow-left"></span> Browse Patients
									</a>
									<button type="submit" class="btn btn-info btn-lg">Edit Patient</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>			
<?php include 'footer.php'; ?>