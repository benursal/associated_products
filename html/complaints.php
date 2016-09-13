<?php include 'header.php'; ?>
<div id="breadcrumbContainer">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="index.php">Patients</a></li>
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
				<div class="col-lg-10 col-lg-offset-1">
					<ul class="nav nav-pills">
						<li><a href="patient-details.php">Patient Details</a></li>
						
						<li><a href="history.php">History</a></li>
						<li class="active"><a href="complaints.php">Complaints</a></li>
					</ul>
				</div>
			</div>

			<div class="page-header">
				<h1><strong>Patient Complaints</strong> <br /><small>Ursal, Edward Benedict</small></h1>
			</div>
			<!-- records now -->
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 body-content">
					<p class="text-right">
						<a href="new-complaint.php" class="btn btn-primary btn-sm">
							<span class="glyphicon glyphicon-plus"></span> Add Complaint
						</a>
					</p>
					<table id="tableComplaints" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th class="col-lg-1">Date</th>
								<th class="col-lg-5">Complaints/Illness</th>
								<th class="col-lg-5">Diagnosis/Management</th>
								<th class="col-lg-1">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						<?php for( $x = 0; $x < 20; $x++ ) : ?>
							<tr>
								<td>
									10/25/2015
								</td>
								<td>
									Lorem ipsum dolor, sit amet baho ka igit, Lorem ipsum dolor, sit amet baho ka igit, 
								</td>
								<td>
									Lorem ipsum dolor, sit amet baho ka igit, Lorem ipsum dolor, sit amet baho ka igit, Lorem ipsum dolor, sit amet baho ka igit
								</td>
								<td>
									<a href="edit-complaint.php" class="btn btn-warning btn-xs">Edit</a>
								</td>
							</tr>
						<?php endfor; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>			
<?php include 'footer.php'; ?>