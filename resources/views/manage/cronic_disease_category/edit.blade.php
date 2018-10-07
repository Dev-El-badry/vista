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
<h1><i class="fa fa-edit"></i> &nbsp;Edit Cronic Disease Category <small><em>ID: {{ $cdc->id }}</em></small></h3></h1>
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

  	<a href="{{ route('cronic_disease_category.index') }}" class="btn btn-default">
   
   &nbsp;Pervious Page</a>

   	<a href="{{ route('cdc_del_config', $cdc->id) }}" 
   class="btn btn-danger del_cat">
   <i class="fa fa-trash fa-fw"></i>
   &nbsp;Deletet Cronic Disease Category</a>




    </div><!-- /.box-body -->

</div>

{{-- End Section Options --}}

{{-- Start Section Add Category --}}
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-gear"></i> &nbsp;Edit Cronic Disease Category <small><em>ID: {{ $cdc->id }}</em></small></h3>




  </div><!-- /.box-header -->
 	
 	@if($errors->any())
    <div class="error-msg">
      @foreach($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>
      @endforeach
    </div>
    @endif




  	<form action="{{ route('cronic_disease_category.update', $cdc->id) }}" method="POST">
  	{{ csrf_field() }}
  	{{ method_field('PUT') }}
    <div class="box-body">

	<div class="col-md-12">
	<div class="form-group" id="select-options">
		<label for="cat_parent" class="col-sm-2">Category Parent </label>
	    	{!! Form::select('parent_id', $data['options'], $cdc->parent_id, ['class'=>' col-sm-8 options', 'id'=> 'cat_parent']) !!}
	    </div>
	</div>


	<div class="col-md-6 col-sm-12">
		<div class="form-group">
			<label for="cd_title" class="col-sm-4">Cronic Disease Title</label>
			<div class="col-md-8">
				<input type="text" class="form-control" id="cd_title" name="cd_title" dir="auto" value="{{ $cdc->cd_title }}">
			</div>
		</div>
	</div>

    </div><!-- /.box-body -->

    <div class="box-footer text-center">
        <button type="submit" class="btn btn-primary" name="submit" value="Submit">Edit Cronic Disease Title</button>

      <button type="submit" class="btn btn-bg btn-danger" name="submit" value="Cancel">Cancel</button>
    </div>
    </form>

</div>



@endsection

