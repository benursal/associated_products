$(document).ready(function(){
	$('#customerName').focus();
	
	// save new customer
	$('#formNewCustomer').submit(function(){
		
		show_loader();
		
		$.post( base_url + "customers/save_customer",
		$( '#formNewCustomer' ).serialize(),
		function(data, status){
			
			var name = $('#customerName').val().trim();
			var address = $('#customerAddress').val().trim();
			
			hide_loader();
			
			if( data == 'ERROR' )
			{
				// error message
				$.jGrowl(
					'An error has occured while adding a new customer.', 
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
					'Customer <strong class="text-capitalize">' + name + '</strong> already exists', 
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
					'You have successfully added a new customer.', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-success'
					}
				);
				
				// reset form
				reset_form('#formNewCustomer');
				
				// focus on sID
				$('#customerName').focus();
			}
		});
		
		return false;
	});
	
	// update customer
	$('#formEditCustomer').submit(function(){
		
		show_loader();
		
		$.post( base_url + "customers/update_customer",
		{
			id: $('#theID').val(),
			name: $('#customerName').val(),
			address: $('#customerAddress').val()
		},
		function(data, status){
			
			hide_loader();
			
			var name = $('#customerName').val().trim();
			
			if( data == 'ERROR' )
			{
				// error message
				$.jGrowl(
					'An error has occured while updating customer record.', 
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
					'Customer <strong class="text-capitalize">' + name + '</strong> already exists', 
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
					'You have successfully updated customer record', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-success'
					}
				);
				
				// update title
				$('#pageTitle').text('Edit Customer "' + $('#customerName').val() + '"');
			}
			
		});
		
		return false;
	});
});

function delete_customer(object, id, name)
{
	if( confirm('Are you sure you want to delete customer "' + name + '"?') )
	{
		var obj = $(object).parent().parent();
		
		//alert( base_url + 'customers/remove/' + id);
		
		// show the loader
		show_loader();
		// do the ajax
		$.ajax({url: base_url + "customers/remove/" + id, success: function(result){
			
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