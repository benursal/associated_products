$(document).ready(function(){
	
});

function add_complaint()
{
	var str = '<tr>';
	str +=  '<td><input type="date" class="form-control text-date" value="' + today + '" /></td>' + 
			'<td><textarea class="form-control text-complaints" rows="3"></textarea></td>' + 
			'<td><textarea class="form-control text-diagnosis" rows="3"></textarea></td>';
	str += '</tr><tr><td colspan="3" class="text-right">' + 
		   '<button type="button" class="btn btn-default btn-xs">Cancel</button> ' + 
		   ' <button type="button" class="btn btn-success btn-xs">Save Complaint</button>' + 
		   '</td></tr>';
	
	$('#tableComplaints tbody').prepend(str + '');
}