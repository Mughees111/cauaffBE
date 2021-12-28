$(function(){
	'use strict';
	$('#example23').DataTable({
		dom: 'Bfrtip',
		
		buttons: [
			{
				extend: 'copyHtml5'
			
			},
			{
				extend: 'csvHtml5'
			
			},
			{
				extend: 'excelHtml5'
			
			},
			{
				extend: 'pdfHtml5'
			
			},
			{
				extend: 'print'
			
			},
		],
		
	});
});

function redirectToFilter(id)
{
	window.location = base_url + "admin/employee-report?employee_id="+id;
}