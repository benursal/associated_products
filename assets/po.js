$(document).ready(function(){
	$('select[name="supplier"]').focus();
	
	// capture quantity
	$(document).on('keyup', '.qty, .price', function(e){
		calculate_line_total(this);
		calculate_grand_total();
	});
	
	// remove row
	$(document).on('click', '.remove-row', function(e){
		
		var obj = $(this).parent().parent();
		
		if( $('.sub-form table tr').length == 1 )
		{
			
			$.jGrowl(
				'<strong>You cannot delete this row</strong> because you need at least one row in a purchase order.', 
				{ 
					life: 5000,
					position: 'center', 
					theme: 'alert alert-danger'
				}
			);
			
			return false;
		}
		
		
		if( !row_is_default( obj ) )
		{
			if( confirm( 'Are you sure you want to delete this row?' ) )
			{
				obj.fadeOut('fast', function(){
					$(this).remove();
					calculate_grand_total();
					refresh_item_no();
				});
			}
		}
		else
		{
			obj.fadeOut('slow', function(){
				$(this).remove();
				calculate_grand_total();
				refresh_item_no();
			});
		}
		
	});
	
	// add new row
	$(document).on('click', '.add-row', function(){
		var row = $(this).parent().parent();
		
		row.after( get_new_row_html() ); // add the new row
		refresh_item_no(); // refresh numbers
		
		// focus on the "quantity" field of the newly-added row
		row.next('tr').find('.qty').focus();
	});
	
	$('#btnSave').click(function(){
		validate_rows();
	});
	
	// submit add new purchase order form
	$('#formNew').submit(function(){
		
		show_loader();
		
		$(this).serialize();
		$.post( base_url + 'purchase_orders/save', $( this ).serialize(), function( data ) {
			
			hide_loader();
			
			if( data != 'ERROR' )
			{
				$.jGrowl(
					'<strong>Purchase Order successfully created!', 
					{ 
						life: 5000,
						position: 'center', 
						theme: 'alert alert-success'
					}
				);
				
				reset_form('#formNew');
				// focus
				$('select[name="supplier"]').focus();
				// new po number
				$('input[name="po_number"]').val( data );
				$('input[name="date"]').val( current_date ); // e
			}
		});
		
		
		return false;
	});
	
	$('select[name="supplier"]').change(function(){
		
		$('#supplierAddress').val('');
		
		$.each(suppliers, function (index, value) {
			
			var supplier = jQuery.parseJSON(value);
			
			// check by name
			if( supplier.sID == $('select[name="supplier"]').val() )
			{
				$('#supplierAddress').val( supplier.address );
			}
			
			
		});
	});
	
	// discount checkbox
	$('input[name="cb_add_discount"]').click(function(){
		
		if( $(this).prop('checked') ) // if checked
		{
			$('#input_discount').css('visibility', 'visible'); // 
			$('input[name="discount_rate"]').removeAttr('disabled');
			$('input[name="discount_rate"]').focus();
		}
		else
		{
			$('#input_discount').css('visibility', 'hidden');
			$('input[name="discount_rate"]').attr('disabled','');
		}
	});
	
});

function removeAtt()
{
	$('input[name="attention"]').removeAttr('required');
}

function validate_rows()
{
	var has_row_with_value = false;
	
	$('.sub-form table tr').each(function(index){
		
		// if row is in default mode
		if( row_is_default( $(this) ) )
		{
			$(this).find('.form-control').removeAttr('required');
			
			//console.log( (index + 1) + " default");
		}
		else
		{
			$(this).find('.form-control').attr('required', 'required');
			has_row_with_value = true;
			
			//console.log( (index + 1) + " not default");
		}
		
	});
	
	if( !has_row_with_value ) //  if there is not at least ONE row
	{
		$('.sub-form table tr:eq(0)').find('.form-control').attr('required', 'required'); // add vaidation
	}
}

function modal_add_new_supplier()
{
	alert('add new supplier');
}

function refresh_item_no()
{
	$('td.col-item-no').each(function(index){
		$(this).text(index + 1);
	});
}

// calculations

function calculate_line_total( obj )
{
	// get the containing row
	var row = $(obj).parent().parent();
	var line_total = 0;
	
	var qty = parseFloat( row.find('.qty').val() );
	var price = parseFloat( row.find('.price').val() );
	
	// calculate total
	line_total = qty * price;
	// make sure it is no NaN
	line_total = ( !isNaN(line_total) ) ? line_total.toFixed(2) : '0.00';
	// show total
	row.find('.line-total').val( line_total ); // in hidden file
	row.find('.amount').text( format_currency(line_total) ); // in span
}

function calculate_grand_total()
{
	var grand_total = 0;
	
	$('.line-total').each(function(index){
		
		if( jQuery.trim( $(this).val() ) != '' )
		{
			grand_total += parseFloat($(this).val());
		}
		
	});
	
	//console.log( grand_total );
	
	grand_total = ( !isNaN(grand_total) ) ? grand_total.toFixed(2) : '0.00';
	
	$('#grandTotal').text( format_currency( grand_total ) );
	$('input[name="grandTotal"]').val( grand_total );
}

function get_new_row_html()
{
	return '<tr>' + 
				'<td class="text-center col-item-no padding-top-10"></td>' + 
				'<td class="text-center col-qty"><input type="number" class="form-control qty" name="qty[]" min="1" /></td>' + 
				'<td class="text-center col-unit"><input type="text" class="form-control unit" name="unit[]" /></td>' + 
				'<td class="col-description"><textarea class="form-control description" name="description[]" rows="2"></textarea></td>' + 
				'<td class="col-unit-price"><input type="text" class="form-control price" name="price[]" /></td>' + 
				'<td class="text-center col-amount padding-top-10">' + 
					'<strong>P <span class="amount">0.00</span></strong>' + 
					'<input type="hidden" class="line-total" name="line-total[]" value="" />' + 
				'</td>' + 
				'<td class="text-center col-actions td-actions">' + 
					'<a href="javascript:void(0)" class="button-add add-row">' + 
						'<i class="fa fa-plus-circle" aria-hidden="true"></i>' + 
					'</a> ' + 
					'<a href="javascript:void(0)" class="button-remove remove-row">' + 
						'<i class="fa fa-minus-circle" aria-hidden="true"></i>' + 
					'</a>' + 
				'</td>' + 
			'</tr>';
}