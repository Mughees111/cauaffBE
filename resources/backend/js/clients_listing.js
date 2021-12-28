$(function(){
	'use strict';
	$('#example23').DataTable({
		dom: 'Bfrtip',
		"ordering": false,
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