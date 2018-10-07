@extends('layouts.manage')



@section('content')
    <div class="row">
        <div class="col-md-12">
<div class="manage_title">
	<h1>
	<i class="fa fa-gear"></i>
	Manage Drug Allergy  Titles
	</h1>
</div>


<a class="btn btn-primary"  href="{{ route('drug_allergy_list.create') }}">
	<i class="fa fa-plus"></i>
	Add New Drug Allergy  Title
</a>
<hr class="hr-seprator">
<div class="row">
	<div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">Manage Drug Allergy Titles</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

			<?php
			use App\Http\Controllers\DrugAllergyListController;
			echo DrugAllergyListController::get_sortable_list($data['status']); 
			?>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>

</div>
</div>
@endsection

@php
	// $first_bit = Request::segment(1);
	$third_bit = Request::segment(2);
	$first_bit = 'drug_allergy_list';

	$full_url = url('manage').'/' . $first_bit . '/sort';


	if($third_bit != '')
	{
		$start_of_target_url = '../../';
	} else {
		$start_of_target_url = '../';
	}

@endphp

@section('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $( "#sortlist" ).sortable({
            stop: function(event, ui) {saveChanges();}
        });
        $( "#sortlist" ).disableSelection();
		
		function saveChanges() {
		//length of elments
			var num = $('#sortlist > li').length;
			console.log('number'+num);
			var arr = [];
			for (var i = 1; i <= num; i++) {
				var catID = $('#sortlist li:nth-child('+i+')').attr('id');
				arr.push(catID)
			}

			console.log(arr);
			console.log(arr.join());
			var arrJoin = arr.join();
			var obj = { "num": num, "order": arrJoin, "_token": '{{ csrf_token() }}' };
		
			$.post(
				'{{ $full_url }}',
				obj,
				function(data) {
					console.log('well done')
				}
			);
		}

		
	
	}); 

	function saveChanges() {
		//length of elments
			var num = $('#sortlist > li').length;
			console.log('number'+num);
			var arr = [];
			for (var i = 1; i <= num; i++) {
				var catID = $('#sortlist li:nth-child('+i+')').attr('id');
				arr.push(catID)
			}

			console.log(arr);
		}
</script>
@endsection