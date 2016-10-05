<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel margin-top-10 padding-40 padding-top-10">
			<div class="row">
				<div class="col-md-4">
					<h1 class="text-large"><?php echo $page_title; ?></h1>
				</div>
				<div class="col-md-3 margin-top-10">
					<a href="<?php echo site_url('customers/add_new');?>" class="btn btn-success btn-sm">
						<i class="fa fa-plus-circle"></i> Add New
					</a>
				</div>
			</div>
			<div class="x_content margin-top-20">
				<div class="row margin-top-20">
					<div class="col-lg-6 col-lg-offset-6 text-center">
						<form action="<?php echo site_url('customers/search'); ?>">
							<div class="input-group">
								<input type="text" name="keyword" class="form-control" placeholder="Search for quotations" value="<?php echo @$_GET['keyword'];?>" autofocus>
								<span class="input-group-btn">
									<button class="btn btn-inverse" type="submit">SEARCH</button>
								</span>
							</div>
						</form>
					</div>
				</div>
				<div class="row margin-top-20">
					<div class="col-md-12">
						<table class="table table-striped table-hover text-14">
							<thead>
								<tr>
									<th>Name</th>
									<th>Address</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach( $rows as $row ) : ?>
								<tr>
									<td class="col-md-4">
										<a href="<?php echo site_url('customers/edit/' . $row->id);?>" class="text-link">
											<?php echo ucwords($row->custName); ?>
										</a>
									</td>
									<td class="col-md-6">
										<?php echo ucwords($row->address); ?>
									</td>
									<td class="text-center col-md-2">
										<a href="<?php echo site_url('customers/edit/' . $row->id);?>" class="btn btn-info btn-sm">
											<i class="fa fa-pencil-square-o"></i> Edit
										</a>
										<button class="btn btn-danger btn-sm" onclick="delete_customer(this, '<?=$row->custID;?>', '<?=addslashes($row->custName);?>')">
											<i class="fa fa-trash"></i> Delete
										</button>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						
						<?php echo $pagination; ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>