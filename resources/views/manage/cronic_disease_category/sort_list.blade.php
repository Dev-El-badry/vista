@section('styles')
<style>
	.sort {
	    border: 1px solid #ccc;
	    list-style: none;
	    padding: 10px;
	    margin-top: 5px;
	    width: 600px
    }
</style>
@endsection

@php
	use App\Http\Controllers\ChronicDiseaseCategoryController;
@endphp

<ul style="margin: 10px 0" id="sortlist">

@foreach($data['categories'] as $row)

	@if($row->cat_parent_id == 0)
		@php
			$cat_parent_title = '-';
		@endphp
	@else
		@php
			$cat_parent_title = $row->cd_title;
		@endphp
	@endif
	
	@php
		$get_count_categories = ChronicDiseaseCategoryController::get_count_categories($row->id);
	@endphp
	<li class="sort" id="{{ $row->id }}">
		<i class="fa fa-sort fa-fw fa-lg"></i>&nbsp;
		
		{{  $row->cd_title }}
		

		@if($get_count_categories ==0)
			
		@else
			@if($get_count_categories == 1)
				@php
					$entity = 'Category';
				@endphp
			@else
				@php
					$entity = 'Categories';
				@endphp
			@endif

			<a href="{{ route('cronic_disease_category.index') }}?id={{ $row->id }}" style="background-color: #ccc" class="badge">
				{{ $get_count_categories }}  Sub-{{ $entity }}
			</a>
		@endif
		
		<a href="{{ route('cronic_disease_category.edit', $row->id) }}">
			<i class="fa fa-edit fa-fw"></i>
		</a>

	</li>

@endforeach

</ul>