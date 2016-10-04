/* app */
$(document).ready(function(){
	$('#formNewValidity').submit(function(){
		
		show_loader();
		
		$.post( base_url + 'misc/save_validity', $( this ).serialize(), function( data ) {
			
			var validity_name = $('#txtValidityName').val().trim();
			
			hide_loader();
			
			if( data == 'EXISTS' )
			{
				$.jGrowl(
					'This validity description already exists', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-danger'
					}
				);
			}
			else if( data == 'ERROR' )
			{
				$.jGrowl(
					'An error has occured. Please try again.', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-danger'
					}
				);
			}
			else
			{
				$.jGrowl(
					'New validity added successfully', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-success'
					}
				);
				
				// hide validity
				$('#modalNewValidity .btn-close').trigger('click');
				// add new validity to Select
				$('select[name="validity"]').append('<option value="' + data + '" selected>' + validity_name + '</option>');
				// clear value 
				$('#txtValidityName').val('');
			}
			
			//$('#results').html( data );
			
		});
		
		
		return false;
	});
	
	
	$('#formNewTerm').submit(function(){
		
		show_loader();
		
		$.post( base_url + 'misc/save_term', $( this ).serialize(), function( data ) {
			
			var term_name = $('#txtTermName').val().trim();
			
			hide_loader();
			
			if( data == 'EXISTS' )
			{
				$.jGrowl(
					'This term description already exists', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-danger'
					}
				);
			}
			else if( data == 'ERROR' )
			{
				$.jGrowl(
					'An error has occured. Please try again.', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-danger'
					}
				);
			}
			else
			{
				$.jGrowl(
					'New term added successfully', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-success'
					}
				);
				
				// hide 
				$('#modalNewTerm .btn-close').trigger('click');
				// add new to Select
				$('select[name="terms"]').append('<option value="' + data + '" selected>' + term_name + '</option>');
				// clear value 
				$('#txtTermName').val('');
			}
			
			
			
		});
		
		return false;
	});
	
	// delivery
	$('#formNewDelivery').submit(function(){
		
		show_loader();
		
		$.post( base_url + 'misc/save_delivery', $( this ).serialize(), function( data ) {
			
			var delivery_name = $('#txtDeliveryName').val().trim();
			
			hide_loader();
			
			if( data == 'EXISTS' )
			{
				$.jGrowl(
					'This delivery description already exists', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-danger'
					}
				);
			}
			else if( data == 'ERROR' )
			{
				$.jGrowl(
					'An error has occured. Please try again.', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-danger'
					}
				);
			}
			else
			{
				$.jGrowl(
					'New delivery added successfully', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-success'
					}
				);
				
				// hide 
				$('#modalNewDelivery .btn-close').trigger('click');
				// add new to Select
				$('select[name="delivery"]').append('<option value="' + data + '" selected>' + delivery_name + '</option>');
				// clear value 
				$('#txtDeliveryName').val('');
			}
			
			$('#results').html(data);
		});
		
		return false;
	});
});

function igit()
{
	$('#modalNewValidity').modal('hide');
	e.stopPropagation(); //This line would take care of it
}

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
			return_value = false;
		}
		else // if there are no changes
		{
			$(this).val(''); // clear whitespaces
		}
		
	});
	
	return return_value;
}

function row_is_default( row_object )
{
	var return_value = true;
	
	row_object.find('.form-control').each(function(index){
		
		if( $.trim( $(this).val() ) != '' ) // check if there are changes made
		{			
			return_value = false;
		}
		else // if there are no changes
		{
			$(this).val(''); // clear whitespaces
		}
		
	});
	
	return return_value;
}

// number formatting
// Number Formatting Functions
function add_comma(number) { // this function is only for adding commas to the number
	number = '' + number;
	if (number.length > 3) {
	var mod = number.length % 3;
	var output = (mod > 0 ? (number.substring(0,mod)) : '');
	for (i=0 ; i < Math.floor(number.length / 3); i++) {
	if ((mod == 0) && (i == 0))
	output += number.substring(mod+ 3 * i, mod + 3 * i + 3);
	else
	output+= ',' + number.substring(mod + 3 * i, mod + 3 * i + 3);
	}
	return (output);
	}
	else return number;
}

function format_currency(num) { // this adds comma and a two digit decimal numbers.  Will be used for Currency numbers
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') + num + '.' + cents);
}

function modal_add_new_term()
{
	// show modal
	$('#modalNewTerm').modal('show');
	// focus
	$('#modalNewTerm').on('shown.bs.modal', function () {
		$('#txtTermName').focus()
	});
}

function modal_add_new_delivery()
{
	// show modal
	$('#modalNewDelivery').modal('show');
	// focus
	$('#modalNewDelivery').on('shown.bs.modal', function () {
		$('#txtDeliveryName').focus()
	});
}

function modal_add_new_validity()
{
	// show modal
	$('#modalNewValidity').modal('show');
	// focus
	$('#modalNewValidity').on('shown.bs.modal', function () {
		$('#txtValidityName').focus()
	});
}
