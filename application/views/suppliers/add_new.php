<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo site_url('suppliers'); ?>">&laquo; Back to Supplier List</a>
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
					<div class="col-md-10">
						
						<form class="form-horizontal form-label-left input_mask margin-top-20" id="formNewSupplier">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Company Name <span class="required">*</span>
								</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text" name="supplier_name" id="supplierName" required="required" 
									class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
									Address <span class="required">*</span>
								</label>
								<div class="col-md-8 col-sm-8 col-xs-12">
									<textarea type="text" name="supplier_address" id="supplierAddress" required="required" 
									class="form-control col-md-7 col-xs-12" rows="5"></textarea>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
									<div class="col-md-5">
										<a href="<?php echo site_url('suppliers'); ?>" class="btn btn-default btn-block">Cancel</a>
									</div>
									<div class="col-md-5">
										<button type="submit" class="btn btn-success btn-block">Save New Supplier</button>
									</div>
								</div>
							</div>
							
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
window.onbeforeunload = function() {
	if( !form_in_default_values() )
	{
		return ""; 
	}
};
</script>