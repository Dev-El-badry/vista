@extends('layouts.manage')

@section('content')

{{-- Start Section Upload Image --}}

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-gear"></i> &nbsp;Delete Lab Title</h3>
  </div><!-- /.box-header -->
 	@if($errors->any())
    <div class="error-msg">
      @foreach($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>
      @endforeach
    </div>
    @endif
  	{!! Form::open(['route'=> ['lab_title.destroy', $update_id] ] ) !!}
  	{{ csrf_field() }}
  	{{ method_field('DELETE') }}
    <div class="box-body">

     <p style="color: red; font-size: 16px; padding: 5px 5px ">are Your Sure From Delete Title?</p>



    </div><!-- /.box-body -->

    <div class="box-footer">
	    <button type="submit" class="btn btn-danger" name="submit" value="Yes - I want Delete Lab Title">Yes - I want Delete Lab Title</button>
	    <button type="submit" class="btn btn-primary" name="submit" value="Finished">Finished</button>
	 </div>
    {!! Form::close() !!}

</div>





@endsection