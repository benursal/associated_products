			</div>
        </div>
        <!-- /page content -->
		
		<!-- modals -->
		
		<!-- supplier -->
		<div class="modal fade" id="modalNewSupplier" role="dialog">
			<form id="formNewSupplier">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-bold">Add New Supplier</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									
									<div class="form-group">
										<label>Company Name</label>
										<input type="text" class="form-control" id="txtSupplierName" name="supplier_name" 
										placeholder="Name..." required />
									</div>
									<div class="form-group">
										<label>Address</label>
										<textarea class="form-control" id="txtSupplierAddress" name="supplier_address" 
										placeholder="Address..." rows="3" required></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer row">
							<div class="col-md-4 col-md-offset-2">
								<button type="button" class="btn btn-default btn-block btn-close" data-dismiss="modal">Close</button> 
							</div>
							<div class="col-md-4">
								<button type="submit" class="btn btn-success btn-block">Add Supplier</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		
		<!-- customers -->
		<div class="modal fade" id="modalNewCustomer" role="dialog">
			<form id="formNewCustomer">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-bold">Add New Customer</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<div class="form-group">
										<label>Company Name</label>
										<input type="text" class="form-control" id="txtCustomerName" name="customer_name" 
										placeholder="Name..." required />
									</div>
									<div class="form-group">
										<label>Address</label>
										<textarea class="form-control" id="txtCustomerAddress" name="customer_address" placeholder="Address..." rows="3" required></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer row">
							<div class="col-md-4 col-md-offset-2">
								<button type="button" class="btn btn-default btn-block btn-close" data-dismiss="modal">Close</button> 
							</div>
							<div class="col-md-4">
								<button type="submit" class="btn btn-success btn-block">Add Customer</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		
		<!-- Terms -->
		<div class="modal fade" id="modalNewTerm" role="dialog">
			<form id="formNewTerm">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-bold">Add New Term</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<div class="form-group">
										<label>Term Description</label>
										<input type="text" class="form-control" id="txtTermName" name="term_name" placeholder="Description..." required />
									</div>								
								</div>
							</div>
						</div>
						<div class="modal-footer row">
							<div class="col-md-4 col-md-offset-2">
								<button type="button" class="btn btn-default btn-block btn-close" data-dismiss="modal">Close</button> 
							</div>
							<div class="col-md-4">
								<button type="submit" class="btn btn-success btn-block">Add Term</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>


		<!-- Delivery -->
		<div class="modal fade" id="modalNewDelivery" role="dialog">
			<form id="formNewDelivery">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-bold">Add New Delivery</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<div class="form-group">
										<label>Delivery Description</label>
										<input type="text" class="form-control" id="txtDeliveryName" name="delivery_name" placeholder="Description..." required />
									</div>								
								</div>
							</div>
						</div>
						<div class="modal-footer row">
							<div class="col-md-4 col-md-offset-2">
								<button type="button" class="btn btn-default btn-block btn-close" data-dismiss="modal">Close</button> 
							</div>
							<div class="col-md-4">
								<button type="submit" class="btn btn-success btn-block">Add Delivery</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		
		<!-- Validity -->
		<div class="modal fade" id="modalNewValidity" role="dialog">
			<form id="formNewValidity">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-bold">Add New Validity</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<div class="form-group">
										<label>Validity Description</label>
										<input type="text" class="form-control" id="txtValidityName" name="validity_name" placeholder="Description..." required />
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer row">
							<div class="col-md-4 col-md-offset-2">
								<button type="button" class="btn btn-default btn-block btn-close" data-dismiss="modal">Close</button> 
							</div>
							<div class="col-md-4">
								<button type="submit" class="btn btn-success btn-block">Add Validity</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		
		<!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo site_url();?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo site_url();?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo site_url();?>assets/build/js/custom.min.js"></script>
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.js"></script>
	
	<!-- custom js -->
    <script src="<?php echo site_url();?>assets/app.js"></script>
    
	
	<?php 
	// Load additional external javascripts
	
	if( isset( $js_assets ) && is_array( $js_assets ) && count( $js_assets ) > 0 )
	{
		foreach( $js_assets as $js )
		{
			echo '<script src="'. $js . '"></script>';
		}
	}
	?>
	
	<script>
		var base_url = '<?php echo site_url(); ?>';
		var current_date = '<?php echo date('d-M-y'); ?>';
	</script>
	
  </body>
</html>