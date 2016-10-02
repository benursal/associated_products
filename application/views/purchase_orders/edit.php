<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo site_url('purchase_orders'); ?>">&laquo; Back to Purchase Order List</a>
			</div>
		</div>
		
		<div class="x_panel margin-top-10 padding-40 padding-top-10">
			<div class="row">
				<div class="col-md-6">
					<h1 class="text-large"><?php echo $page_title; ?></h1>
				</div>
				<div class="col-md-5 text-right">
					<div class="btn-group margin-top-10">
						<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-cog" aria-hidden="true"></i> Options <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo site_url('purchase_orders/print_view/' . $row->po_id); ?>">
									<i class="fa fa-print" aria-hidden="true"></i> Printable View
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" onclick="delete_po('<?php echo $row->transNum; ?>', <?=$row->po_id;?>, this, 'self');">
									<i class="fa fa-trash" aria-hidden="true"></i> Delete
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<hr />
			<form class="form-horizontal form-label-left input_mask margin-top-20" id="formNew" method="post">
				<div class="row">
					<div class="col-md-2">
						<label class="margin-top-10">Short Description:</label>
					</div>
					<div class="col-md-5">
						<input type="text" name="transaction_description" required="required" class="form-control col-md-8 col-xs-12" placeholder="Enter a short description for this Quotation" value="<?php echo $row->transDescript; ?>">
					</div>
				</div>
				<hr />
				<div class="x_content">
					<div class="row">
						<!-- left side -->
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Supplier
								</label>
								<div class="col-md-7 col-sm-8 col-xs-12">
									
									<select name="supplier" required="required" class="form-control input-sm col-md-8 col-xs-12">
										<option value="">[Select Supplier]</option>
										<?php if( $suppliers->exists() ) : ?>
										<?php foreach( $suppliers as $c ) : ?>
										<?php $selected = ($row->supplier_id == $c->sID) ? ' selected' : ''; ?>
										<option value="<?php echo $c->sID;?>"<?php echo $selected; ?>><?php echo ucwords($c->name);?></option>
										<?php endforeach; ?>
										<?php endif; ?>
									</select>
									
								</div>
								<div class="col-md-1">
									<a href="javascript:void(0)" class="button-add" data-toggle="tooltip" data-placement="top" title="Add new supplier" onclick="modal_add_new_supplier()">
										<i class="fa fa-plus-circle" aria-hidden="true"></i>
									</a>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">
									Address
								</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<textarea type="text" name="supplierAddress" id="supplierAddress" required="required" 
									class="form-control input-sm col-md-7 col-xs-12" rows="3" readonly><?php echo $row->supplier_address; ?></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Attention
								</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text" name="attention" required="required" class="form-control input-sm col-md-7 col-xs-12" 
									value="<?php echo $row->attention; ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Reference No.
								</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text" name="ref_no" required="required" class="form-control input-sm col-md-7 col-xs-12" 
									value="<?php echo $row->refNo; ?>">
								</div>
							</div>
							
						</div>
						
						<!-- right side -->
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Date Created
								</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text" name="date" required="required" class="form-control input-sm col-md-7 col-xs-12" 
									value="<?php echo date_db_to_app($row->date, 'd-M-y'); ?>" readonly />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Quotation #
								</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text" name="quotationNumber" required="required" class="form-control input-sm col-md-7 col-xs-12" 
									value="<?php echo $row->transNum;?>" readonly />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Terms
								</label>
								<div class="col-md-7 col-sm-8 col-xs-12">
									<select name="terms" required="required" class="form-control input-sm col-md-8 col-xs-12">
										<option value="">[Select Payment Terms]</option>
										<?php if( $terms->exists() ) : ?>
										<?php foreach( $terms as $t ) : ?>
										<?php $selected = ( $t->termNum == $row->term_id ) ? ' selected' : ''; ?>
										<option value="<?php echo $t->termNum;?>"<?php echo $selected;?>><?php echo ucwords($t->termName);?></option>
										<?php endforeach; ?>
										<?php endif; ?>
									</select>
								</div>
								<div class="col-md-1">
									<a href="javascript:void(0)" class="button-add" data-toggle="tooltip" data-placement="top" title="Add new Payment Term" onclick="modal_add_new_term()">
										<i class="fa fa-plus-circle" aria-hidden="true"></i>
									</a>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Delivery
								</label>
								<div class="col-md-7 col-sm-8 col-xs-12">
									<select name="delivery" required="required" class="form-control input-sm col-md-8 col-xs-12">
										<option value="">[Select Delivery Terms]</option>
										<?php if( $deliveries->exists() ) : ?>
										<?php foreach( $deliveries as $d ) : ?>
										<?php $selected = ( $d->delNum == $row->delivery_id ) ? ' selected' : ''; ?>
										<option value="<?php echo $d->delNum;?>"<?php echo $selected;?>><?php echo ucwords($d->delName);?></option>
										<?php endforeach; ?>
										<?php endif; ?>
									</select>
								</div>
								<div class="col-md-1">
									<a href="javascript:void(0)" class="button-add" data-toggle="tooltip" data-placement="top" title="Add new Delivery Term" onclick="modal_add_new_delivery()">
										<i class="fa fa-plus-circle" aria-hidden="true"></i>
									</a>
								</div>
							</div>
							
						</div>
						
						<!--<button onclick="removeAtt()">REmove this</button>-->
						
					</div>
					
					<!-- list of items -->
					<div class="row">
						<div class="col-lg-12 margin-top-40 sub-form-headings">
							<table class="table table-bordered margin-bottom-0">
								<thead>
									<tr>
										<th class="text-center col-item-no">Item No</th>
										<th class="text-center col-qty">QTY</th>
										<th class="text-center col-unit">Unit</th>
										<th class="col-description">Description</th>
										<th class="col-unit-price">Unit Price</th>
										<th class="text-center col-amount">Amount</th>
										<th class="text-center col-actions">Actions</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 sub-form">
							<table class="table table-bordered table-striped table-hover">
								<tbody>
									<?php $grand_total = 0; ?>
									<?php $counter = 1; ?>
									<?php if( $orderline->exists() ) : ?>
									<?php foreach( $orderline as $o ) : ?>
									<tr>
										<td class="text-center col-item-no padding-top-10">
											<?php echo $counter; ?>
										</td>
										<td class="text-center col-qty">
											<input type="number" class="form-control qty" name="qty[]" min="1" value="<?php echo $o->qty; ?>" />
											<input type="hidden" name="ol-id[]" value="<?php echo $o->id;?>" />
										</td>
										<td class="text-center col-unit">
											<input type="text" class="form-control unit" name="unit[]" value="<?php echo $o->unit; ?>" />
										</td>
										<td class="col-description">
											<textarea class="form-control description" name="description[]" rows="2"><?php echo $o->descript; ?></textarea>
										</td>
										<td class="col-unit-price">
											<input type="text" class="form-control price" name="price[]" value="<?php echo $o->unitPrice; ?>" />
										</td>
										<td class="text-center col-amount padding-top-10">
											<?php 
												$line_total = $o->qty * $o->unitPrice; 
												$grand_total += $line_total;
											?>
											<strong>P <span class="amount"><?php echo number_format( $line_total, 2); ?></span></strong>
											<input type="hidden" class="line-total" name="line-total[]" value="<?php echo $line_total; ?>" />
										</td>
										<td class="text-center col-actions td-actions">
											<a href="javascript:void(0)" class="button-add add-row">
												<i class="fa fa-plus-circle" aria-hidden="true"></i>
											</a> 
											<a href="javascript:void(0)" class="button-remove remove-row">
												<i class="fa fa-minus-circle" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
									<?php $counter++; ?>
									<?php endforeach; ?>
									<?php endif; ?>
								</tbody>
								
							</table>
						</div>
					</div>
					
					<div id="results"></div>
					
					<div class="row margin-top-20">
						<div class="col-md-4 col-md-offset-6 text-right">
							<p class="text-18">Price is 12% VAT Included: </p>
						</div>
						<div class="col-md-2">
							<strong class="text-20">P <span id="grandTotal"><?php echo number_format($grand_total,2); ?></span></strong>
							<input type="hidden" name="grandTotal" value="<?php echo $grand_total; ?>" />
						</div>
					</div>
					
					<div class="row margin-top-40">
						<div class="col-lg-6 col-lg-offset-3">
							<div class="row">
								<div class="col-sm-6">
									<a href="<?php echo site_url('purchase_orders'); ?>" class="btn btn-default btn-block">Discard Changes</a>
								</div>
								<div class="col-sm-6">
									<button type="submit" id="btnSave" class="btn btn-success btn-block">Update Purchase Order</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
var transaction_id = <?php echo $row->po_id;?>;
var suppliers = <?php echo $suppliers->all_to_json(array('sID', 'address'), TRUE); ?>;
</script>