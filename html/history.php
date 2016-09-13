<?php include 'header.php'; ?>
<div id="breadcrumbContainer">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="index.php">Patients</a></li>
					<li class="active">Patient History</li>
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
						<li class="active"><a href="#">History</a></li>
						<li><a href="complaints.php">Complaints</a></li>
					</ul>
				</div>
			</div>

			<div class="page-header">
				<h1><strong>Patient History</strong> <br /><small>Ursal, Edward Benedict</small></h1>
			</div>
			<!-- records now -->
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 body-content">
					<h3>History of Birth and Immunizations</h3>
					<div class="history-list">
						<p>Rabbies, dog vaccine, baho igit immunization, bakuna sa buli</p>
						<p><button type="button" class="btn btn-info btn-xs btn-edit-history">Click to Edit</button></p>
					</div>
					
					<h3>Past Illness</h3>
					<div class="history-list">
						<p>Baho tubol, dengue, hepatitis, tonsilitis, pharyngitis, igititis</p>
						<p><button type="button" class="btn btn-info btn-xs btn-edit-history">Click to Edit</button></p>
					</div>
					
					<h3>Personal and Social History</h3>
					<div class="history-list">
						<p>Split personality, obsessive compulsive, Split personality, obsessive compulsive</p>
						<p><button type="button" class="btn btn-info btn-xs btn-edit-history">Click to Edit</button></p>
					</div>
					
					<h3>Family History</h3>
					<div class="history-list">
						<p>Rabbies, dog vaccine, baho igit immunization, bakuna sa buli</p>
						<p><button type="button" class="btn btn-info btn-xs btn-edit-history">Click to Edit</button></p>
					</div>
					
					<h3>Menstrual History</h3>
					<div class="history-list">
						<p>Rabbies, dog vaccine, baho igit immunization, bakuna sa buli</p>
						<p><button type="button" class="btn btn-info btn-xs btn-edit-history">Click to Edit</button></p>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>			
<?php include 'footer.php'; ?>