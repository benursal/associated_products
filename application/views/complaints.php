<div id="breadcrumbContainer">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="<?php echo site_url(); ?>">Patients</a></li>
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
				<h1><strong>Patient Complaints</strong> <br /><small><?php echo $patient->name; ?></small></h1>
			</div>
			<!-- records now -->
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 body-content">
					<p class="text-right">
						<a href="<?php echo site_url('patients/add_new_complaint/' . $patient->code);?>" class="btn btn-primary btn-sm">
							<span class="glyphicon glyphicon-plus"></span> Add Complaint
						</a>
					</p>
					
					<?php if( $this->session->userdata('success_message') ) : ?>
					<div class="alert alert-info">
						<h2><span class="glyphicon glyphicon-ok-sign"></span> <?php echo $this->session->userdata('success_message'); ?></h2>
					</div>
					<?php $this->session->unset_userdata('success_message'); ?>
					<?php endif; ?>
					
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
						<?php if( $complaints->exists() ) : ?>
						<?php foreach( $complaints as $row ) : ?>
							<tr>
								<td>
									<?php echo date_db_to_app( $row->date, 'm/d/Y' ); ?>
								</td>
								<td>
									<?php echo $row->details; ?>
								</td>
								<td>
									<?php echo $row->diagnosis; ?>
								</td>
								<td>
									<a href="<?php echo site_url('patients/edit_complaint/' . $patient->code . '/' . $row->id);?>" class="btn btn-warning btn-xs">
										Edit
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
						<?php else : ?>
							<tr>
								<td colspan="4" class="text-center">No complaints yet. 
									<a href="<?php echo site_url('patients/add_new_complaint/' . $patient->code);?>" class="btn btn-success btn-xs">
										Start adding complaints
									</a>
								</td>
							</tr>
						<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>