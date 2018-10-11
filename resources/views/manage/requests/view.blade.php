@extends('layouts.manage')

@section('styles')
<style>
	.update_status option:first-child {
		display: none
	}
</style>
@endsection

@section('content')

<h1 class="manage_title">
<i class="fa fa-gear"></i>
Show Request <small>ID: {{ $request->id }}</small>
</h1>


{{-- Show Message Success --}}
@if (Session::has('item'))
    <div class="alert alert-success" style="margin-top: 10px">
        {{ session('item') }}
    </div>
@endif
{{-- Show Message Success --}}
@if (Session::has('item_del'))
    <div class="alert alert-danger" style="margin-top: 10px">
        {{ session('item_del') }}
    </div>
@endif
<hr class="hr-seprator">

<div class="row">
	<div class="col-xs-8">
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">
		<i class="fa fa-gear"></i>&nbsp;
          Options</h3>
			
        </div>
        <!-- /.box-header -->

        
        
        <div class="box-body ">
			
			<a href="{{ route('requests.delete_config', $request->id) }}" class="btn btn-danger">
				<i class="fa fa-trash"></i>&nbsp;
				Delete Request
			</a>

        </div>
        <!-- /.box-body -->
		

		

      </div>
      <!-- /.box -->
    </div>
</div>

<div class="row">
	<div class="col-xs-8">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">Update Request Status</h3>
			
        </div>
        <!-- /.box-header -->

        <form action="{{ route('requests.update_status', $request->id) }}" method="POST">
        	{{ csrf_field() }}
        
        <div class="box-body table-responsive ">
			
			<!-- Start Table -->
				
			<div class="form-group" style="margin-bottom: 60px;">
				<label  class="col-md-2">Request Option:</label>
				<div class="col-md-10">
					@php
						$status = array(
							'0'=> 'Submitted',
							'1'=> 'Approve',
							'2'=> 'Refused'
						);
					@endphp
					{!! Form::select('confirm', $status, $request->confirm, $attr=array('class'=> 'form-control update_status')) !!}
				</div>
			</div>


			<!-- End Table -->

        </div>
        <!-- /.box-body -->
		
        <div class="box-footer text-center">
        	<button class="btn btn-primary">Submit</button>
        </div>
		</form>

      </div>
      <!-- /.box -->
    </div>
</div>


<div class="row">
	<div class="col-xs-8">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">Update Request Options</h3>
			
        </div>
        <!-- /.box-header -->

        <form action="{{ route('requests.update_option', $request->id) }}" method="POST">
        	{{ csrf_field() }}
        
        <div class="box-body table-responsive no-padding">
			
			<!-- Start Table -->
				
			<div class="form-group" style="margin-bottom: 60px;">
				<label  class="col-md-2">Request Option:</label>
				<div class="col-md-10">
					{!! Form::select('option_id', $options, $request->option_id, $attr=array('class'=> 'form-control')) !!}
				</div>
			</div>


			<!-- End Table -->

        </div>
        <!-- /.box-body -->
		
        <div class="box-footer text-center">
        	<button class="btn btn-primary">Submit</button>
        </div>
		</form>

      </div>
      <!-- /.box -->
    </div>
</div>


<div class="row">
	<div class="col-xs-8">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">User Detials</h3>
			<a href="{{ route('public_users.view', $request->user->id) }}" class="pull-right btn btn-primary">View User</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
			
			<!-- Start Table -->
				
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
						    <th>{{ $request->user->id }}</th>

						</tr>
						<tr>
							<th>Name</th>
						    <th>{{ $request->user->name }}</th>

						</tr>
						<tr>
							<th>Email</th>
						    <th>{{ $request->user->email }}</th>

						</tr>

						<tr>
							<th>Sex</th>
						    <th>{{ $request->user->sex }}</th>

						</tr>
						<tr>
							<th>Country</th>
						    <th>{{ $request->user->country }} {{ $request->user->state != '' ? ', '.$request->user->state : '' }}</th>

						</tr>
					
					</thead>

				
				</table>


			<!-- End Table -->

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>


<div class="row">
	<div class="col-xs-8">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">Job Detials</h3>
			<a href="{{ route('job_title.edit', $request->job->id) }}" class="pull-right btn btn-primary">View Job</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
			
			<!-- Start Table -->
				
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
						    <th>{{ $request->job->id }}</th>

						</tr>
						<tr>
							<th>Title</th>
						    <th>{{ $request->job->title }}</th>

						</tr>


					
					</thead>

				
				</table>


			<!-- End Table -->

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>

<div class="row">
	<div class="col-xs-8">
      <div class="box box-warning">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">Files (Documents)</h3>
			
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
			
			<!-- Start Table -->
				
				<table class="table">
					<thead>
						@php
							$files = explode(',', $request->files);
						@endphp
						@for ($i = 0; $i < count($files); $i++)
							
						
						<tr>
							
						    <th>
						    	<img src="{{ asset('manage/img/identity_pics/'.$files[$i]) }}" alt="">
						    </th>

						</tr>
					@endfor


					
					</thead>

				
				</table>


			<!-- End Table -->

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>



@endsection