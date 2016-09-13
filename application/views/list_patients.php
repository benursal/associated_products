<div class="container">
	<div class="row" id="mainContent">
		<div class="col-lg-12">
			<div class="page-header">
				<h1><strong>Browse</strong> for Patients</h1>
				<p>Your can search for the patients easily by typing the name on the textbox below.</p>
			</div>
			<!-- records now -->
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 body-content">
					
					<?php if( $this->session->userdata('success_message') ) : ?>
					<div class="alert alert-info alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2><span class="glyphicon glyphicon-ok-sign"></span> <?php echo $this->session->userdata('success_message'); ?></h2>
					</div>
					<?php $this->session->unset_userdata('success_message'); ?>
					<?php endif; ?>
					
					<form method="GET">
						<div class="form-group search-box">
							<input class="form-control" id="searchPatient" name="keyword" type="text" placeholder="Type the name of the patient to Search..." value="<?php echo $keyword; ?>" autofocus />
						</div>
						<input type="submit" style="display:none" />
					</form>
					
					<div id="patientList">
						<?php include 'list_patients_subview.php'; ?>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>
</div>