<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel margin-top-10 padding-40 padding-top-10">
			<div class="row">
				<div class="col-md-4">
					<h1 class="text-large"><?php echo $page_title; ?></h1>
				</div>
				<div class="col-md-3 margin-top-10">
					<a href="<?php echo site_url('quotations/add_new');?>" class="btn btn-success btn-sm">
						<i class="fa fa-plus-circle"></i> Add New
					</a>
				</div>
			</div>
			<div class="x_content margin-top-20">
				<div class="row margin-top-20">
					<div class="col-lg-6 col-lg-offset-6 text-center">
						<form action="<?php echo site_url('quotations/search'); ?>">
							<div class="input-group">
								<input type="text" name="keyword" class="form-control" placeholder="Search for..." value="<?php echo @$_GET['keyword'];?>">
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
									<th class="col-lg-2">Quotation #</th>
									<th class="col-lg-4">Description</th>
									<th class="col-lg-2">Date</th>
									<th class="col-lg-3">Customer</th>
									<th class="text-center col-lg-1">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach( $rows as $row ) : ?>
								<tr>
									<td>
										<a href="<?php echo site_url('quotations/view/' . $row->id);?>" class="text-link">
											<?php echo $row->transNum; ?>
										</a>
									</td>
									<td>
										<a href="<?php echo site_url('quotations/view/' . $row->id);?>">
											<?php echo $row->transDescript; ?>
										</a>
									</td>
									<td><?php echo date_db_to_app($row->date); ?></td>
									<td>
										<a href="<?php echo site_url('customers/edit/'.$row->customer_id); ?>" class="text-link">
											<?php echo ucwords($row->customer_custName); ?>
										</a>
									</td>
									<td class="text-center">
										<div class="btn-group">
											<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
												<i class="fa fa-cog" aria-hidden="true"></i> <span class="caret"></span>
											</button>
											<ul class="dropdown-menu pull-right" role="menu">
												<li>
													<a href="<?php echo site_url('quotations/view/' . $row->id); ?>">
														<i class="fa fa-eye" aria-hidden="true"></i> View Details
													</a>
												</li>
												<li>
													<a href="<?php echo site_url('quotations/edit/' . $row->id); ?>">
														<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
													</a>
												</li>
												<li>
													<a href="<?php echo site_url('quotations/print_view/' . $row->id); ?>">
														<i class="fa fa-print" aria-hidden="true"></i> Printable View
													</a>
												</li>
												
												<li>
													<a href="<?php echo site_url('purchase_orders/add_new/' . $row->id); ?>">
														<i class="fa fa-list-alt" aria-hidden="true"></i> Create PO
													</a>
												</li>
												
												<li class="divider"></li>

												<li>
													<a href="javascript:void(0)" onclick="delete_quotation('<?php echo $row->transNum; ?>', this);">
														<i class="fa fa-trash" aria-hidden="true"></i> Delete
													</a>
												</li>
												
											</ul>
										</div>
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