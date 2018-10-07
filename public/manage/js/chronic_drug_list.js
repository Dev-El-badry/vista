$(function() {

	'use strict';

	var $token = $('meta[name=csrf-token]').attr("content");

	chk_list( $('requests-list') );

	$('.active_request').on('click', function(event) {
		event.preventDefault();
		var app = $(this);
		var $id = app.data('value');
		var $target_url = '/manage/chronic_drug_list/active_request';

		var $obj = {
			'id': $id,
			'_token': $token
		};
		$.post(
			$target_url,
			$obj,
			function(data) {
				if(data == 1){
					app.parent().parent().remove();
					chk_list( $('requests-list') );
				}
				else{
					alert('Error Occure');
				}
			}
		)

	});

	$('.delete_request').on('click', function(event) {
		event.preventDefault();
		var app = $(this);
		if(confirm('Are Your Sure From Delete Request?')) {

			var $id = app.data('value');
			var $target_url = '/manage/chronic_drug_list/delete_request';

			var $obj = {
				'id': $id,
				'_token': $token
			};
			$.post(
				$target_url,
				$obj,
				function(data) {
					if(data == 1){
						app.parent().parent().remove();
						chk_list( $('requests-list') );
					}
					else{
						alert('Error Occure');
					}
				}
			)

		}
	});

});


function chk_list($list) {
	
	if($list.length < 1) {
		$list.parent().append('<p>No There requests database.</p>');
		$list.remove();
	}
}