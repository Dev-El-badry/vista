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

</style>
@endsection

@section('content')
<h1><i class="fa fa-plus"></i> &nbsp;Add New Job Title</h3></h1>
{{-- Start Section Add Title --}}
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-gear"></i> &nbsp;Add New Job Title</h3>
  </div><!-- /.box-header -->
 	
 	@if($errors->any())
    <div class="error-msg">
      @foreach($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>
      @endforeach
    </div>
    @endif

    @if (Session::has('item'))
	    <div class="alert alert-success">
	        {{ session('item') }}
	    </div>
	@endif


  	<form action="{{ route('job_title.store') }}" method="POST">
  	{{ csrf_field() }}
    <div class="box-body">

	<div class="col-md-6">


<div class="row">
	
	<div class="col-md-12 col-sm-12" style="margin: 10px auto">
		<div class="form-group " >
			<label for="title" class="col-sm-4">Job Title</label>
			<div class="col-md-8">
				<input type="text" class="form-control" id="title" name="title" dir="auto" 
				value="{{ old('title') }}">
			</div>
		</div>
	</div>
</div>
    </div><!-- /.box-body -->
    <div class="clearfix"></div>
    <div class="box-footer text-center">
        <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>

      <button type="submit" class="btn btn-bg btn-danger" name="submit" value="Cancel">Cancel</button>
    </div>
</div>
    </form>

</div>

@endsection

