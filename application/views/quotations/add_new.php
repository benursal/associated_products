<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo site_url('quotations'); ?>">&laquo; Back to Quotation List</a>
			</div>
		</div>
		
		<div class="x_panel margin-top-10 padding-40 padding-top-10">
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-large"><?php echo $page_title; ?></h1>
				</div>
			</div>
			<div class="x_content margin-top-20">
				<div class="row">
						
					<form class="form-horizontal form-label-left input_mask margin-top-20" id="formNewQuotation">
						<!-- left side -->
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Customer
								</label>
								<div class="col-md-7 col-sm-8 col-xs-12">
									
									<select name="customer" required="required" class="form-control input-sm col-md-8 col-xs-12">
										<option value="">[Select Customer]</option>
										<?php if( $customers->exists() ) : ?>
										<?php foreach( $customers as $c ) : ?>
										<option value="<?php echo $c->custID;?>"><?php echo ucwords($c->custName);?></option>
										<?php endforeach; ?>
										<?php endif; ?>
									</select>
									
								</div>
								<div class="col-md-1">
									<a href="javascript:void(0)" class="button-add" data-toggle="tooltip" data-placement="top" title="Add new customer" onclick="modal_add_new_customer()">
										<i class="fa fa-plus-circle" aria-hidden="true"></i>
									</a>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Address
								</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<textarea type="text" name="customerAddress" id="customerAddress" required="required" 
									class="form-control input-sm col-md-7 col-xs-12" rows="3"></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Attention
								</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text" name="attention" required="required" class="form-control input-sm col-md-7 col-xs-12">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Subject
								</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text" name="subject" required="required" class="form-control input-sm col-md-7 col-xs-12">
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
									<input type="text" name="date" required="required" class="form-control input-sm col-md-7 col-xs-12" value="<?php echo date('d-M-y');?>" readonly />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Quotation #
								</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text" name="quotationNumber" required="required" class="form-control input-sm col-md-7 col-xs-12" value="<?php echo $quotation_number;?>" readonly />
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
										<option value="<?php echo $t->termNum;?>"><?php echo ucwords($t->termName);?></option>
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
										<option value="<?php echo $d->delNum;?>"><?php echo ucwords($d->delName);?></option>
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
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Validity
								</label>
								<div class="col-md-7 col-sm-8 col-xs-12">
									<select name="validity" required="required" class="form-control input-sm col-md-8 col-xs-12">
										<option value="">[Select Validity]</option>
										<?php if( $validities->exists() ) : ?>
										<?php foreach( $validities as $v ) : ?>
										<option value="<?php echo $v->valNum;?>"><?php echo ucwords($v->valName);?></option>
										<?php endforeach; ?>
										<?php endif; ?>
									</select>
								</div>
								<div class="col-md-1">
									<a href="javascript:void(0)" class="button-add" data-toggle="tooltip" data-placement="top" title="Add new Validity" onclick="modal_add_new_validity()">
										<i class="fa fa-plus-circle" aria-hidden="true"></i>
									</a>
								</div>
							</div>
						</div>
						
					</form>
						
					
				</div>
			</div>
		</div>
	</div>
</div>

<script>

</script>