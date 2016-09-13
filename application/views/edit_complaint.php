<div id="breadcrumbContainer">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="<?php echo site_url(); ?>">Patients</a></li>
					<li><a href="<?php echo site_url('patients/complaints/' . $patient->code); ?>">Patient Complaints</a></li>
					<li class="active">Edit Complaint</li>
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
						<li><a href="<?php echo site_url('patients/details/' . $patient->code);?>">Patient Details</a></li>
						<li><a href="<?php echo site_url('patients/history/' . $patient->code);?>">History</a></li>
						<li class="active"><a href="#">Complaints</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-3 text-right visible-lg visible-md" style="margin-top:15px;">
					<button type="button" class="btn btn-danger btn-sm" onclick="delete_complaint('<?php echo $patient->code;?>', '<?php echo $complaint->id;?>');">
						<span class="glyphicon glyphicon-remove-sign"></span> Delete Complaint
					</button>
				</div>
			</div>

			<div class="page-header">
				<h1><strong>Edit</strong> Complaint <br /><small><?php echo $patient->name; ?></small></h1>
			</div>
			<!-- records now -->
			<div class="row">
				<div class="col-lg-10 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 body-content">
					<form class="form-horizontal form-data-entry" method="POST" action="<?php echo site_url('patients/save_complaint/update'); ?>">
						
						<!-- patient code here -->
						<input type="hidden" id="patient_code" name="patient_code" value="<?php echo $patient->code; ?>" />
						<!-- complaint ID here -->
						<input type="hidden" id="complaint_id" name="complaint_id" value="<?php echo $complaint->id; ?>" />
						
						<fieldset>							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Complaints / Illness</label>
								<div class="col-lg-9">
									<textarea rows="3" class="form-control" name="the_complaints" placeholder="Complaints / Illness" autofocus><?php echo $complaint->details;?></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Diagnosis / Management</label>
								<div class="col-lg-9">
									<textarea rows="3" class="form-control" name="the_diagnosis" placeholder="Diagnosis / Management"><?php echo $complaint->diagnosis;?></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Date</label>
								<div class="col-lg-9">
									<input type="date" class="form-control" name="complaint_date" value="<?php echo $complaint->date;?>" required />
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-lg-12 text-right">
									<a href="<?php echo site_url('patients/complaints/' . $patient->code); ?>" class="btn btn-link btn-lg">
										<span class="glyphicon glyphicon-arrow-left"></span> Back to Complaints
									</a>
									<button type="submit" class="btn btn-success btn-lg">Update Complaint</button>
								</div>
							</div>
							
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>