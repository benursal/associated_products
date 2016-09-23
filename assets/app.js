/* app */
function show_loader()
{
	$('.ajax-loader').show();
}

function hide_loader()
{
	$('.ajax-loader').hide();
}

function reset_form( form_id )
{
	$(form_id + ' .form-control').each(function(index){
		$(this).val('');
	});
}

function form_in_default_values()
{
	var return_value = true;
	
	$('.form-control').each(function(index){
		
		if( $.trim( $(this).val() ) != '' ) // check if there are changes made
		{
			//console.log('not default');
			return_value = false;
		}
		else // if there are no changes
		{
			$(this).val(''); // clear whitespaces
		}
		//console.log( $(this).val() );
	});
	
	return return_value;
}