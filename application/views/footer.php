
			</div>
        </div>
        <!-- /page content -->
		
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
	
	if( is_array( $js_assets ) && count( $js_assets ) > 0 )
	{
		foreach( $js_assets as $js )
		{
			echo '<script src="'. site_url('assets/' . $js) . '"></script>';
		}
	}
	?>
	
	<script>
		var base_url = '<?php echo site_url(); ?>';
	</script>
	
  </body>
</html>