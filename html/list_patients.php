<?php include 'header.php'; ?>
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
					<div class="form-group search-box">
						<input class="form-control" id="focusedInput" type="text" placeholder="Type the name of the patient to Search..." autofocus />
					</div>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Age</th>
								<th>Gender</th>
							</tr>
						</thead>
						<tbody>
						<?php for( $x = 0; $x < 20; $x++ ) : ?>
							<tr onclick="location = 'patient-details.php'">
								<td>
									Ursal, Edward Benedict P.
								</td>
								<td>43</td>
								<td>M</td>
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