$(document).ready(function(){
	$('#supplierID').focus();
	
	// save new supplier
	$('#formNewSupplier').submit(function(){
		$.post( base_url + "suppliers/save_supplier",
		{
			sID: $('#supplierID').val(),
			name: $('#supplierName').val(),
			address: $('#supplierAddress').val()
		},
		function(data, status){
			if( status == 'success' && data != 'ERROR' )
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
				$('#supplierID').focus();
			}
			else // error
			{
				$.jGrowl(
					'An error has occured while adding a new supplier.', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-danger'
					}
				);
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