<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="text-bold">Dashboard</h1>
			</div>
		</div>
		
		<div class="row margin-top-20">
			<div class="col-md-6">
				<div class="x_panel">
					<h3 class="text-18">Latest Purchase Orders</h3>
					<hr />
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th class="col-md-3">PO #</th>
								<th class="col-md-9">Description</th>
							</tr>
						</thead>
						<tbody>
							<?php if( $purchase_orders->exists() ) : ?>
							<?php foreach( $purchase_orders as $row ) : ?>
							<tr>
								<td>
									<a href="<?php echo site_url('purchase_orders/edit/' . $row->id); ?>" class="text-link">
										<?php echo $row->transNum;?>
									</a>
								</td>
								<td>
									<a href="<?php echo site_url('purchase_orders/edit/' . $row->id); ?>" class="text-link">
										<?php echo $row->transDescript;?>
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
					
					<p class="text-left">
						<a href="<?php echo site_url('purchase_orders');?>" class="btn btn-info btn-sm">View All</a> 
						<a href="<?php echo site_url('purchase_orders/add_new');?>" class="btn btn-success btn-sm">Create New</a>
					</p>
					
				</div>
			</div>
			
			
			<div class="col-md-6">
				<div class="x_panel">
					<h3 class="text-18">Latest Quotations</h3>
					<hr />
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th class="col-md-3">Quotation #</th>
								<th class="col-md-9">Description</th>
							</tr>
						</thead>
						<tbody>
							<?php if( $quotations->exists() ) : ?>
							<?php foreach( $quotations as $row ) : ?>
							<tr>
								<td>
									<a href="<?php echo site_url('quotations/edit/' . $row->id); ?>" class="text-link">
										<?php echo $row->transNum;?>
									</a>
								</td>
								<td>
									<a href="<?php echo site_url('quotations/edit/' . $row->id); ?>" class="text-link">
										<?php echo $row->transDescript;?>
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
					
					<p class="text-left">
						<a href="<?php echo site_url('quotations');?>" class="btn btn-info btn-sm">View All</a> 
						<a href="<?php echo site_url('quotations/add_new');?>" class="btn btn-success btn-sm">Create New</a>
					</p>
					
				</div>
			</div>
			
		</div>
		
	</div>
</div>