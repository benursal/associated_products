<div id="breadcrumbContainer">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="<?php echo site_url(); ?>">Patients</a></li>
					<li class="active">Patient History</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- patient code here -->
<input type="hidden" id="patient_code" name="patient_code" value="<?php echo $patient->code; ?>" />

<div class="container">
	<div class="row" id="mainContent">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-10">
					<ul class="nav nav-pills">
						<li><a href="<?php echo site_url('patients/details/' . $patient->code);?>">Patient Details</a></li>
						<li class="active"><a href="#">History</a></li>
						<li><a href="<?php echo site_url('patients/complaints/' . $patient->code);?>">Complaints</a></li>
					</ul>
				</div>
			</div>

			<div class="page-header">
				<h1><strong>Patient History</strong> <br /><small><?php echo $patient->name; ?></small></h1>
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
				
				
				<?php foreach( $history_types as $type ) : ?>
					<h3><?php echo $type->description; ?></h3>
					<?php
						$type->patient->where('id', $patient->id);
						$ph = $type->patient->include_join_fields()->get();
					?>
					<div class="history-list">
						<div class="row-history">
							<!-- Hidden, ID of History Type -->
							<input type="hidden" class="history-type-id" value="<?php echo $type->id; ?>" />
							
							<?php if( $ph->exists() ) : ?>
							
								<div class="div-normal">
									<p class="history-text"><?php echo $ph->join_description; ?></p>
									<p><button type="button" class="btn btn-info btn-xs btn-edit-history">Edit History</button></p>
								</div>
								
								<div class="div-edit tago">
									<p>
										<textarea class="form-control history-input" rows="3" placeholder="Type <?php echo $type->description;?> here ..."></textarea>
									</p>
									<p>
										<button type="button" class="btn btn-default btn-xs btn-cancel">Cancel</button>
										<button type="button" class="btn btn-success btn-xs btn-save-history">Save history</button>
									</p>
								</div>
							
							<?php else : ?>
								
								<div class="div-normal tago">
									<p class="history-text"></p>
									<p><button type="button" class="btn btn-info btn-xs btn-edit-history">Edit history</button></p>
								</div>
								
								<div class="div-edit">
									<p>
										<textarea class="form-control history-input" rows="3" placeholder="Type <?php echo $type->description;?> here ..."></textarea>
									</p>
									<p>
										<button type="button" class="btn btn-default btn-xs btn-cancel tago">Cancel</button>
										<button type="button" class="btn btn-success btn-xs btn-save-history">Save history</button>
									</p>
								</div>
								
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>