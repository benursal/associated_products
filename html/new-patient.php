<?php include 'header.php'; ?>
<div id="breadcrumbContainer">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="index.php">Patients</a></li>
					<li class="active">Add New Patient</li>
				</ul>
			</div>
		</div>
	</div>
</div>
	
<div class="container">
	<div class="row" id="mainContent">
		<div class="col-lg-12">

			<div class="page-header">
				<h1><strong>Add</strong> New Patient</h1>
			</div>
			<!-- records now -->
			<div class="row">
				<div class="col-lg-9 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 body-content">
					<form class="form-horizontal form-data-entry">
						<fieldset>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Name</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="name" placeholder="Name" required />
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Age</label>
								<div class="col-lg-9">
									<input type="number" class="form-control" name="age" placeholder="Age">
								</div>
							</div>
				
							<div class="form-group">
								<label for="select" class="col-lg-3 control-label">Gender</label>
								<div class="col-lg-9">
									<select class="form-control" name="gender">
										<option value="f">Female</option>
										<option value="m">Male</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label for="select" class="col-lg-3 control-label">Civil Status</label>
								<div class="col-lg-9">
									<select class="form-control" name="civil_status">
										<option value="s">Single</option>
										<option value="m">Married</option>
										<option value="d">Divorced</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Nationality</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="nationality" placeholder="Nationality" value="Filipino" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Occupation</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="occupation" placeholder="Occupation" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Place of Birth</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="birth_place" placeholder="Place of Birth" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Present Address</label>
								<div class="col-lg-9">
									<textarea rows="2" class="form-control" name="present_address" placeholder="Present Address"></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-lg-12 text-right">
									<button type="reset" class="btn btn-default btn-lg">Cancel</button>
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
<?php include 'footer.php'; ?>