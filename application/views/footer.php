			</div>
        </div>
        <!-- /page content -->
		
		<!-- modals -->
		
		<!-- supplier -->
		<div class="modal fade" id="modalNewSupplier" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-bold">Add New Supplier</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<form>
									<div class="form-group">
										<label>Company Name</label>
										<input type="text" class="form-control" id="txtSupplierName" placeholder="Name...">
									</div>
									<div class="form-group">
										<label>Address</label>
										<textarea class="form-control" id="txtCustomerAddress" placeholder="Address..." rows="3"></textarea>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer row">
						<div class="col-md-4 col-md-offset-2">
							<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button> 
						</div>
						<div class="col-md-4">
							<button type="submit" class="btn btn-success btn-block">Add Supplier</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- customers -->
		<div class="modal fade" id="modalNewCustomer" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-bold">Add New Customer</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<form>
									<div class="form-group">
										<label>Company Name</label>
										<input type="text" class="form-control" id="txtCustomerName" placeholder="Name...">
									</div>
									<div class="form-group">
										<label>Address</label>
										<textarea class="form-control" id="txtCustomerAddress" placeholder="Address..." rows="3"></textarea>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer row">
						<div class="col-md-4 col-md-offset-2">
							<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button> 
						</div>
						<div class="col-md-4">
							<button type="submit" class="btn btn-success btn-block">Add Customer</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Terms -->
		<div class="modal fade" id="modalNewTerm" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-bold">Add New Term</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<form id="formNewTerm">
									<div class="form-group">
										<label>Term Description</label>
										<input type="text" class="form-control" id="txtTermName" placeholder="Description...">
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer row">
						<div class="col-md-4 col-md-offset-2">
							<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button> 
						</div>
						<div class="col-md-4">
							<button type="submit" class="btn btn-success btn-block">Add Term</button>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Delivery -->
		<div class="modal fade" id="modalNewDelivery" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-bold">Add New Delivery</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<form id="formNewDelivery">
									<div class="form-group">
										<label>Delivery Description</label>
										<input type="text" class="form-control" id="txtDeliveryName" placeholder="Description...">
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer row">
						<div class="col-md-4 col-md-offset-2">
							<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button> 
						</div>
						<div class="col-md-4">
							<button type="submit" class="btn btn-success btn-block">Add Delivery</button>
						</div>
					</div>
				</div>
			</div>
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
    
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo site_url();?>assets/js/moment/moment.min.js"></script>
    <script src="<?php echo site_url();?>assets/js/datepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo site_url();?>assets/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?php echo site_url();?>assets/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="<?php echo site_url();?>assets/vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="<?php echo site_url();?>assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- jQuery autocomplete -->
    <script src="<?php echo site_url();?>assets/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
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