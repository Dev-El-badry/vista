@extends('layouts.manage')

@section('content')

<h1 class="manage_title">
<i class="fa fa-gear"></i>
Manage Requests
</h1>



{{-- Show Message Success --}}
@if (Session::has('item_del'))
    <div class="alert alert-danger" style="margin-top: 10px">
        {{ session('item_del') }}
    </div>
@endif
<hr class="hr-seprator">


<div class="row">
	<div class="col-xs-8">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">Manage Requests</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
			
			<!-- Start Table -->
				
				<table class="table">
					<thead>
						<tr>
							<th>&nbsp;</th>
						    <th>ID</th>
							<th>Username</th>
							<th>Job Title</th>
							<th>Status Option</th>
							<th>Status Request</th>
							
							<th>&nbsp;</th>
						</tr>
					</thead>

					<tbody>

						@forelse($requests as $row)
							<tr>
							<td>
								@if($row->opened == 0)
								<i class="fa fa-envelope fa-fw" style="color: orange"></i>
								@else
								<i class="fa fa-envelope-o fa-fw" ></i>
								@endif
							</td>
							<td>{{ $row->id }}</td>
								<td>
									 {{ $row->user->name }}
								</td>
								
								<td>
									 {{ $row->job->title }}
								</td>
								
								<td>
									@php
									if($row->option_id >0)
										$title = $row->option->title;
									else
										$title = 'Submitted';
									@endphp
									<span class="label label-primary">{{ $title }}</span>
								</td>

								<td>
									@php
									if($row->confirm == 0){
										$status = 'Submitted';
										$style = 'warning';
									}
									elseif($row->confirm == 1){
										$status = 'Approve';
										$style = 'success';
									}
									elseif($row->confirm == 2){
										$status = 'Refused';
										$style = 'danger';
									}
									@endphp
									<span class="label label-{{ $style }}">{{ $status }}</span>
								</td>
								
								<td class="pull-right">
							
									<a href="{{ route('requests.view', $row->id) }}" class="btn btn-default">
									<i class="fa fa-eye fa-fw"></i> &nbsp;
									View</a>
								</td>
							</tr>

						@empty
						<tr>
							<td>
							<p style="color: red;">You Not Request In Wesite Yet!</p>
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>


			<!-- End Table -->

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>


@endsection