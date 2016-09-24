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
