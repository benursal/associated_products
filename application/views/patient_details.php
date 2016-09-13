<div id="breadcrumbContainer">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="<?php echo site_url(); ?>">Patients</a></li>
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
				<div class="col-lg-9 col-md-9">
					<ul class="nav nav-pills">
						<li class="active"><a href="#">Patient Details</a></li>
						<li><a href="<?php echo site_url('patients/history/' . $patient->code);?>">History</a></li>
						<li><a href="<?php echo site_url('patients/complaints/' . $patient->code);?>">Complaints</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-3 text-right visible-lg visible-md" style="margin-top:15px;">
					<button type="button" class="btn btn-danger btn-sm" onclick="delete_patient('<?php echo $patient->code;?>');">
						<span class="glyphicon glyphicon-remove-sign"></span> Delete Patient
					</button>
				</div>
			</div>

			<div class="page-header">
				<h1><strong>Patient Details</strong> <br /><small><?php echo $patient->name; ?></small></h1>
			</div>
			<!-- records now -->
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 body-content">
					
					<?php if( $this->session->userdata('success_message') ) : ?>
					<div class="alert alert-info">
						<h2><span class="glyphicon glyphicon-ok-sign"></span> <?php echo $this->session->userdata('success_message'); ?></h2>
					</div>
					<?php $this->session->unset_userdata('success_message'); ?>
					<?php endif; ?>
				
					<form class="form-horizontal form-data-entry">
						<fieldset>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 col-sm-5 control-label">Name</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value"><?php echo $patient->name; ?></span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 col-sm-5 control-label">Age</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value"><?php echo $patient->age; ?></span>
								</div>
							</div>
				
							<div class="form-group">
								<label for="select" class="col-lg-3 col-sm-5 control-label">Gender</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value">
										<?php echo ( $patient->name == 'm' ) ? 'Male' : 'Female'; ?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="select" class="col-lg-3 col-sm-5 control-label">Civil Status</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value">
										<?php $civil_status = array('s' => 'Single', 'm' => 'Married', 'd' => 'Divorced');?>
										<?php echo $civil_status[$patient->civil_status]; ?>
									</span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 col-sm-5 control-label">Nationality</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value"><?php echo $patient->nationality; ?></span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 col-sm-5 control-label">Occupation</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value"><?php echo $patient->occupation; ?></span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 col-sm-5 control-label">Place of Birth</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value"><?php echo $patient->birth_place; ?></span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 col-sm-5 control-label">Present Address</label>
								<div class="col-lg-8 col-lg-offset-1 col-sm-7">
									<span class="text-value"><?php echo $patient->address; ?></span>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-lg-12 text-right">
									<a type="button" class="btn btn-link btn-lg" href="<?php echo site_url(); ?>">
										<span class="glyphicon glyphicon-arrow-left"></span> Browse Patients
									</a>
									<a href="<?php echo site_url('patients/edit/' . $patient->code);?>" class="btn btn-info btn-lg">
										Edit Patient Details
									</a>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>