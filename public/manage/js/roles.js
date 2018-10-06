$(function() {

	'use strict';

	$('.chk-crud').each(function() {
		var $val = $(this).val();
		
		if( $(this).is(':checked') ) {
			collectCheckedBox( $val );
		}
	});

	//collect the checked box
	$(".chk-crud").on('change', function() {
		$('#cruds_checked').val('');
		
		$('.chk-crud').each(function() {
			var $val = $(this).val();
			
			if( $(this).is(':checked') ) {
				collectCheckedBox( $val );
			}
		});

	});
});


function collectCheckedBox($val) {
	var $source = $('#cruds_checked').val();	

	if($source == '') 
        var new_val = $val;
    else
        var new_val = $("#cruds_checked").val() + ',' + $val;
        
    $('#cruds_checked').val(new_val);


}

