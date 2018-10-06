$(function() {

	'use strict';

	var $resource = $('#name').val();
	var $value_permission = $('.permission-radio').val();

	if($value_permission == 'crud') {
		fullTable($resource, $('#crud_checked').val());
	}

	$('.permission-radio').on('change', function() {
		var $value = $(this).val();
		
		if($value == 'crud') {
			$('.basic-permissions').css('display', 'none');
			$('.crud-permissions').css('display', 'block');

		} else {
			$('.basic-permissions').css('display', 'block');
			$('.crud-permissions').css('display', 'none');
		}
	});

	$('#name').on('keyup', function() {
		var $val = $(this).val();
		fullTable($val, $('#crud_checked').val());
	});

	//collect the checkbox when load screen
	$('.chk-crud').each(function() {

		collectCheckedBox( $(this).val() );
	});
	//End

	//collect the checked box
	$(".chk-crud").on('change', function() {
		$('#crud_checked').val('');
		
		$('.chk-crud').each(function() {
			var $val = $(this).val();
			
			if( $(this).is(':checked') ) {
				collectCheckedBox( $val );
			}
		});

		fullTable( $('#name').val(), $('#crud_checked').val() );

	});

});


function fullTable($resource, $array) {
	var $str = '';
	var $arr = $array.split(',');
	if(($resource.length >3 )&& ($arr.length > 0)) {

		for (var i = 0; i < $arr.length; i++) {
			$str += ' <tr> '+
	                    '<td>'+$arr[i].substr(0,1).toUpperCase() + $arr[i].substr(1) + " " + $resource.substr(0,1).toUpperCase() + $resource.substr(1)+'</td>'+
	                    '<td>'+$arr[i].toLowerCase() + "-" +$resource.toLowerCase()+'</td>'+
	                    '<td>'+getDescriptionPermission($arr[i], $resource)+'</td>'+
	                  '</tr>';
		}

		$('#crud-body').html($str);
	}
}

function getDescriptionPermission($crud, $val) {
	return 'Allow User To '+$crud.toLowerCase() +" a "+ $val.substr(0,1) + $val.substr(1);
}

function collectCheckedBox($val) {
	var $source = $('#crud_checked').val();	

	if($source == '') 
        var new_val = $val;
    else
        var new_val = $("#crud_checked").val() + ',' + $val;
        
    $('#crud_checked').val(new_val);


}

