<div id="breadcrumbContainer">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="<?php echo site_url(); ?>">Patients</a></li>
					<li><a href="<?php echo site_url('patients/complaints/' . $patient->code); ?>">Patient Complaints</a></li>
					<li class="active">Patient Complaints</li>
				</ul>
			</div>
		</div>
	</div>
</div>
	
<div class="container">
	<div class="row" id="mainContent">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-10">
					<ul class="nav nav-pills">
						<li><a href="<?php echo site_url('patients/details/' . $patient->code);?>">Patient Details</a></li>
						<li><a href="<?php echo site_url('patients/history/' . $patient->code);?>">History</a></li>
						<li class="active"><a href="#">Complaints</a></li>
					</ul>
				</div>
			</div>

			<div class="page-header">
				<h1><strong>Add</strong> New Complaint <br /><small><?php echo $patient->name; ?></small></h1>
			</div>
			<!-- records now -->
			<div class="row">
				<div class="col-lg-10 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 body-content">
					<form class="form-horizontal form-data-entry" method="POST" action="<?php echo site_url('patients/save_complaint'); ?>">
						<!-- patient code here -->
						<input type="hidden" id="patient_code" name="patient_code" value="<?php echo $patient->code; ?>" />
						
						<fieldset>							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Complaints / Illness</label>
								<div class="col-lg-9">
									<textarea rows="3" class="form-control" name="the_complaints" placeholder="Complaints / Illness" autofocus required></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Diagnosis / Management</label>
								<div class="col-lg-9">
									<textarea rows="3" class="form-control" name="the_diagnosis" placeholder="Diagnosis / Management" required></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Date</label>
								<div class="col-lg-9">
									<input type="date" class="form-control" name="complaint_date" value="<?php echo date('Y-m-d');?>" required />
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-lg-12 text-right">
									<a href="<?php echo site_url('patients/complaints/' . $patient->code); ?>" class="btn btn-link btn-lg">
										<span class="glyphicon glyphicon-arrow-left"></span> Back to Complaints
									</a>
									<button type="submit" class="btn btn-success btn-lg">Save Complaint</button>
								</div>
							</div>
							
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>