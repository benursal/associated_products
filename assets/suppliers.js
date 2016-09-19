$(document).ready(function(){
	
});

function delete_supplier(object, id, name)
{
	if( confirm('Are you sure you want to delete supplier "' + name + '"?') )
	{
		var obj = $(object).parent().parent();
		
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
}