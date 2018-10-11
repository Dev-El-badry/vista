@extends('layouts.manage')



@section('content')

<h1 class="manage_title">
<i class="fa fa-gear"></i>
Show User <small>ID: {{ $user->id }}</small>
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
			
			<a href="{{ route("public_users.delete_config", $user->id) }}" class="btn btn-danger">
				<i class="fa fa-trash"></i>&nbsp;
				Delete User
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
          <h3 class="box-title" style="color: #f00">Update Status</h3>
			
        </div>
        <!-- /.box-header -->

        <form action="{{ route('public_users.update_status', $user->id) }}" method="POST">
        	{{ csrf_field() }}
        
        <div class="box-body table-responsive ">
			
			<!-- Start Table -->
				
			<div class="form-group" style="margin-bottom: 60px;">
				<label  class="col-md-2">Status Option:</label>
				<div class="col-md-10">
					@php
						$status = array(
							
							'1'=> 'Approve',
							'0'=> 'Not Verified'
						);
					@endphp
					{!! Form::select('is_verified', $status, $user->is_verified, $attr=array('class'=> 'form-control update_status')) !!}
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
			
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
			
			<!-- Start Table -->
				
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
						    <th>{{ $user->id }}</th>

						</tr>
						<tr>
							<th>Name</th>
						    <th>{{ $user->name }}</th>

						</tr>
						<tr>
							<th>Email</th>
						    <th>{{ $user->email }}</th>

						</tr>

						<tr>
							<th>Sex</th>
						    <th>{{ $user->sex }}</th>

						</tr>
						<tr>
							<th>Country & State</th>
						    <th>{{ $user->country == '' ? '-' : $user->country }} {{ $user->state != '' ? ', '.$user->state : '' }}</th>

						</tr>

						<tr>
							<th>Address</th>
						    <th>{{ $user->address1 == '' ? '-' : $user->address1 }} {{ $user->address2 != '' ? ', '.$user->address2 : '' }}</th>

						</tr>

						<tr>
							<th>Telephone Number</th>
						    <th>{{ $user->telnum == '' ? '-' : $user->telnum }} </th>

						</tr>

						<tr>
							<th>Telephone Number</th>
						    <th>{{ $user->telnum == '' ? '-' : $user->telnum }} </th>

						</tr>

						<tr>
							<th>Are You Login By Social Account?</th>
						    <th>{{ $user->login_social == 0 ? 'No' : 'Yes By ' . $user->social_account_title }} </th>

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
@if($user->picture != null)
<div class="row">
	<div class="col-xs-8">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">UserPicture</h3>
			
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
			
			<!-- Start Table -->
				
			<img src="{{ asset('manage/img/user_pics/'.$user->picture) }}" alt="" class="img-responsive img-thumbnail">


			<!-- End Table -->

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>
@endif
@if(count($user->user_job) >0)

<div class="row">
	<div class="col-xs-8">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">Job Related With User</h3>
			
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
			
			<!-- Start Table -->
				
			

				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
						    <th>Title</th>

						</tr>

					
					</thead>

					<tbody>
						@foreach($user->user_job as $row)
						@php
							$title = \DB::table("job_titles")->where('id', '=', $row->job_id)->first()->title;
						@endphp
						<tr>
							<td>{{ $row->job_id }}</td>
							<td>{{ $title }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>

			<!-- End Table -->

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>
@endif


@endsection