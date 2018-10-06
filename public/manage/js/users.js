$(document).ready(function() {
	'use strict';
	var group = $('.radio');

	$('.chk-crud').each(function() {
		var $val = $(this).val();
		
		if( $(this).is(':checked') ) {
			collectCheckedBox( $val );
		}
	});

	$('#auto').on('change', function() {

		if($(this).is(":checked")) {
			var $pword = random_str(10);
			$('#password').val($pword);

		} else {
			$('#password').val('');
		}

	});

	//Show Password
	$('.show-pword').on('click', function() {
			$(this).closest('.password-field').children('#password').prop('type', 'text');
	});

	//Hide Password Field
	$('#keep').on('change', function() {

		if($(this).is(":checked")) {
			$('#password-container').css('display', 'none');
			$('#auto-field').css('display', 'none');
		} else {
			$('#password-container').css('display', 'block');
			$('#auto-field').css('display', 'block');
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
