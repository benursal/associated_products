$(document).ready(function(){
	
	// BTN save
	$('.btn-save-history').click(function(){
		var row = $(this).parent().parent().parent();
		var type_id = row.find('.history-type-id').val();
		var history_description = jQuery.trim( row.find('.history-input').val() );
		
		if( history_description == '' )
		{
			alert('Please enter value');
			row.find('.history-input').focus();
			return false;
		}
		
		// do the saving
		$.post( base_url + "patients/save_history", 
			{
				description : history_description,
				history_type_id : row.find('.history-type-id').val(),
				patient_code : $('#patient_code').val()
			},
			function( data ) {
				if( data != 'error' )
				{
					// show button
					row.find('.btn-cancel').show();
					// Show normal
					row.find('.div-normal').show();
					// hide edit
					row.find('.div-edit').hide();
					// fill-up history-text
					row.find('.history-text').text( history_description );
					
					row.stop().animate({backgroundColor : 'orange'}, 300);
				}
			}
		);
		
	});
	
	// edit history
	$('.btn-edit-history').click(function(){
		var row = $(this).parent().parent().parent();
		
		// hide normal
		row.find('.div-normal').hide();
		// show edit
		row.find('.div-edit').show();
		// fill-up history-input
		row.find('.history-input').val( row.find('.history-text').text() );
		
	});
	
	// cancel edit history
	$('.btn-cancel').click(function(){
		var row = $(this).parent().parent().parent();
		
		// Show normal
		row.find('.div-normal').show();
		// hide edit
		row.find('.div-edit').hide();
		
	});
	
	$('#searchPatient').keyup(function(e){
		var keyword = this.value;
		
		// do the saving
		$.get( base_url + "patients/search", 
			{
				keyword : keyword,
			},
			function( data ) {
				
				if( data != 'error' )
				{
					// list of patients
					$('#patientList').html( data );
					
					var page_url = base_url + 'patients/search?keyword=' + keyword;
					window.history.pushState({path:page_url},'Seach Patient', page_url);
					
				}
				
			}
		);
		
	});
});

function delete_patient( code )
{
	if( confirm('Are you sure you want to delete this patient\'s record?') )
	{
		document.location = base_url + 'patients/delete_patient/' + code;
	}
}

function delete_complaint( code, id )
{
	if( confirm('Are you sure you want to delete this complaint/diagnosis?') )
	{
		document.location = base_url + 'patients/delete_complaint/' + code + '/' + id;
	}
}