<div id="breadcrumbContainer">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="<?php echo site_url(); ?>">Patients</a></li>
					<li><a href="<?php echo site_url('patients/details/' . $patient->code);?>">Patient Details</a></li>
					<li class="active">Edit Patient</li>
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
				<h1><strong>Edit</strong> Patient<br /><small><?php echo $patient->name; ?></small></h1>
			</div>
			<!-- records now -->
			<div class="row">
				<div class="col-lg-9 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 body-content">
					<form class="form-horizontal form-data-entry" method="POST" action="<?php echo site_url('patients/update_patient');?>">
						
						<!-- hidden -->
						<input type="hidden" id="patient_code" name="patient_code" value="<?php echo $patient->code; ?>" />
						
						<fieldset>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Name</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $patient->name; ?>" required autofocus />
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Age</label>
								<div class="col-lg-9">
									<input type="number" class="form-control" name="age" placeholder="Age" value="<?php echo $patient->age; ?>">
								</div>
							</div>
				
							<div class="form-group">
								<label for="select" class="col-lg-3 control-label">Gender</label>
								<div class="col-lg-9">
								<?php $genders = array('f' => 'Female', 'm' => 'Male');?>
									<select class="form-control" name="gender">
									<?php foreach( $genders as $key => $text ) : ?>
									<?php if( $key == $patient->gender ) : ?>
										<option value="<?php echo $key; ?>" selected><?php echo $text; ?></option>
									<?php else : ?>
										<option value="<?php echo $key; ?>"><?php echo $text; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label for="select" class="col-lg-3 control-label">Civil Status</label>
								<div class="col-lg-9">
								<?php $civil_status = array('s' => 'Single', 'm' => 'Married', 'd' => 'Divorced');?>
									<select class="form-control" name="civil_status">
									<?php foreach( $civil_status as $key => $text ) : ?>
									<?php if( $key == $patient->civil_status ) : ?>
										<option value="<?php echo $key; ?>" selected><?php echo $text; ?></option>
									<?php else : ?>
										<option value="<?php echo $key; ?>"><?php echo $text; ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Contact Numbers</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="contact_number" placeholder="Contact Numbers" 
									value="<?php echo $patient->contact_number; ?>" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Nationality</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="nationality" placeholder="Nationality" 
									value="<?php echo $patient->nationality; ?>" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Occupation</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="occupation" placeholder="Occupation" 
									value="<?php echo $patient->occupation; ?>" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Place of Birth</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="birth_place" placeholder="Place of Birth" 
									value="<?php echo $patient->birth_place; ?>" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Present Address</label>
								<div class="col-lg-9">
									<textarea rows="2" class="form-control" name="address" placeholder="Present Address"><?php echo $patient->address; ?></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-lg-12 text-right">
									<a href="<?php echo site_url('patients/details/' . $patient->code);?>" class="btn btn-default btn-lg">Cancel</a>
									<button type="submit" class="btn btn-success btn-lg">Save Patient</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>