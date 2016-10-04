$(document).ready(function(){
	$('#supplierName').focus();
	
	// save new supplier
	$('#formNewSupplier').submit(function(){
		
		show_loader();
		
		$.post( base_url + "suppliers/save_supplier",
		$( '#formNewSupplier' ).serialize(),
		function(data, status){
			
			var name = $('#supplierName').val().trim();
			var address = $('#supplierAddress').val().trim();
			
			hide_loader();
			
			if( data == 'ERROR' )
			{
				// error message
				$.jGrowl(
					'An error has occured while adding a new supplier.', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-danger'
					}
				);
			}
			else if( data == 'EXISTS' )
			{
				$.jGrowl(
					'Supplier <strong class="text-capitalize">' + name + '</strong> already exists', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-danger'
					}
				);
			}
			else // error
			{
				// show success message
				$.jGrowl(
					'You have successfully added a new supplier.', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-success'
					}
				);
				
				// reset form
				reset_form('#formNewSupplier');
				
				// focus on sID
				$('#supplierName').focus();
			}
		});
		
		return false;
	});
	
	// update supplier
	$('#formEditSupplier').submit(function(){
		
		show_loader();
		
		$.post( base_url + "suppliers/update_supplier",
		{
			id: $('#theID').val(),
			name: $('#supplierName').val(),
			address: $('#supplierAddress').val()
		},
		function(data, status){
			
			hide_loader();
			
			var name = $('#supplierName').val().trim();
			
			if( data == 'ERROR' )
			{
				// error message
				$.jGrowl(
					'An error has occured while updating supplier record.', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-danger'
					}
				);
			}
			else if( data == 'EXISTS' )
			{
				$.jGrowl(
					'Supplier <strong class="text-capitalize">' + name + '</strong> already exists', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-danger'
					}
				);
			}
			else
			{
				// show success message
				$.jGrowl(
					'You have successfully updated supplier record', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-success'
					}
				);
				
				// update title
				$('#pageTitle').text('Edit Supplier "' + $('#supplierName').val() + '"');
			}
			
		});
		
		return false;
	});
});

function delete_supplier(object, id, name)
{
	if( confirm('Are you sure you want to delete supplier "' + name + '"?') )
	{
		var obj = $(object).parent().parent();
		
		//alert( base_url + 'suppliers/remove/' + id);
		
		// show the loader
		show_loader();
		// do the ajax
		$.ajax({url: base_url + "suppliers/remove/" + id, success: function(result){
			
			//alert( result );
			
			if( result == '1' )
			{
				$.jGrowl(
					'You have successfully deleted <strong>' + name + '</strong>', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-success'
					}
				);
				
				obj.fadeOut('slow', function(){
					$(this).remove();
				});
			}
			else
			{
				$.jGrowl(
					'An error has occured while deleting record.', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-danger'
					}
				);
			}
			
			hide_loader();
			
		}});
		
	}
}