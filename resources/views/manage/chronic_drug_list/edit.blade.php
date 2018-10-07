@extends('layouts.manage')

@section('styles')
<style>
	.options {
		padding: 5px 10px;
    	width: 450px;
    	margin-left: 9px;
    	
	}

	#select-options
	{
		margin-bottom: 70px;
	}

	a.btn
	{
		margin-left: 5px;
		margin-right: 5px;
	}

</style>
@endsection

@section('content')
<h1><i class="fa fa-edit"></i> &nbsp;Edit Chronic Drug  Title <small><em>ID: {{ $cdc->id }}</em></small></h3></h1>
    @if (Session::has('item'))
	    <div class="alert alert-success">
	        {{ session('item') }}
	    </div>
	@endif

{{-- Start Section Options --}}
{{-- Start Section Options --}}
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-gear"></i> &nbsp;Options</h3>
  </div><!-- /.box-header -->
 
  
    <div class="box-body">

  	<a href="{{ route('chronic_drug_list.index') }}" class="btn btn-default">
   
   &nbsp;Pervious Page</a>

   	<a href="{{ route('chronic_drug_list.cdc_del_config', $cdc->id) }}" 
   class="btn btn-danger del_cat">
   <i class="fa fa-trash fa-fw"></i>
   &nbsp;Deletet Chronic Drug  Title</a>




    </div><!-- /.box-body -->

</div>

{{-- End Section Options --}}

{{-- Start Section Add Title --}}
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-gear"></i> &nbsp;Edit Chronic Drug  Title <small><em>ID: {{ $cdc->id }}</em></small></h3>




  </div><!-- /.box-header -->
 	
 	@if($errors->any())
    <div class="error-msg">
      @foreach($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>
      @endforeach
    </div>
    @endif




  	<form action="{{ route('chronic_drug_list.update', $cdc->id) }}" method="POST">
  	{{ csrf_field() }}
  	{{ method_field('PUT') }}
    <div class="box-body">



	<div class="col-md-6 col-sm-12">
		<div class="form-group">
			<label for="title" class="col-sm-4">Chronic Drug  Title</label>
			<div class="col-md-8">
				<input type="text" class="form-control" id="title" name="title" dir="auto" value="{{ $cdc->title }}">
			</div>
		</div>
	</div>

    </div><!-- /.box-body -->

    <div class="box-footer text-center">
        <button type="submit" class="btn btn-primary" name="submit" value="Submit">Edit Chronic Drug  Title</button>

      <button type="submit" class="btn btn-bg btn-danger" name="submit" value="Cancel">Cancel</button>
    </div>
    </form>

</div>



@endsection

