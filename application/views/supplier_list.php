<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel margin-top-10 padding-40 padding-top-10">
			<div class="row">
				<div class="col-md-3">
					<h1 class="text-large"><?php echo $page_title; ?></h1>
				</div>
				<div class="col-md-3 margin-top-10">
					<a href="<?php echo site_url('supplier/add_new');?>" class="btn btn-success btn-sm">
						<i class="fa fa-plus-circle"></i> Add New
					</a>
				</div>
			</div>
			<div class="x_content margin-top-20">
				<div class="row">
					<div class="col-md-10">
						<table class="table table-striped table-hover text-16">
							<thead>
								<tr>
									<th>Supplier ID</th>
									<th>Name</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach( $rows as $row ) : ?>
								<tr>
									<td><a href="<?php echo site_url('supplier/edit/' . $row->sID);?>"><?php echo $row->sID; ?></a></td>
									<td><a href="<?php echo site_url('supplier/edit/' . $row->sID);?>"><?php echo $row->name; ?></a></td>
									<td class="text-center">
										<a href="<?php echo site_url('supplier/edit/' . $row->sID);?>" class="btn btn-primary btn-sm">
											<i class="fa fa-pencil-square-o"></i> Edit
										</a>
										<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>