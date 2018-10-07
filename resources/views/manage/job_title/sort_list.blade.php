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
	use App\Http\Controllers\JobTitleController;
@endphp

<ul style="margin: 10px 0" id="sortlist">

@foreach($data['categories'] as $row)

	

	<li class="sort" id="{{ $row->id }}">
		<i class="fa fa-sort fa-fw fa-lg"></i>&nbsp;
		
		{{  $row->title }}
		



	
		
		<a href="{{ route('job_title.edit', $row->id) }}">
			<i class="fa fa-edit fa-fw"></i>
		</a>

	</li>

@endforeach

</ul>