@extends('layouts.manage')


@section('content')

<h1 class="manage_title">
<i class="fa fa-plus"></i>
Add New Request Option
</h1>

{{-- Show Message Success --}}
@if (Session::has('item'))
    <div class="alert alert-success">
        {{ session('item') }}
    </div>
@endif

<div class="row">
  <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">Options</h3>
      
        </div>
       
        <div class="box-body">

          <a href="{{ route('request_options.delete_config', $request_option->id) }}" class="btn btn-danger">
            <i class="fa fa-trash"></i>&nbsp;
            Delete Request Option</a>

      </div>
      <!-- /.box -->
    </div>
</div>
</div>
<div class="clearfix"></div>


<div class="row">
  <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">Edit Request Option</h3>
      
        </div>
        @if($errors->any())
          <div class="error-msg">
            @foreach($errors->all() as $error)
              <p style="color: red">{{ $error }}</p>
            @endforeach
          </div>
        @endif
        
        {{-- Start Form --}}
        <form action="{{ route('request_options.update', $request_option->id) }}" method="POST" role="form" class="form-horizontal">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
       

        <!-- /.box-header -->
        <div class="box-body">

         <div class="row">
          <div class="col-md-6 col-md-offset-2">
        <div class="form-group">
          <label for="title" class="col-sm-2">title :</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title"  value="{{ $request_option->title }}">
          </div>
        </div>

     </div>
   </div>
     
        
        </div>
        <!-- /.box-body -->

        {{-- Start Box Footer --}}
        
        <div class="box-footer text-center">
          <button type="submit" class="btn btn-lg btn-primary" name="submit" value="Submit">
          Submit</button>
          <button type="submit" class="btn btn-lg btn-danger" name="submit" value="Cancel">Cancel</button>
        </div>

      </form>
      {{-- End Form --}}  

      </div>
      <!-- /.box -->
    </div>
</div>


@endsection

