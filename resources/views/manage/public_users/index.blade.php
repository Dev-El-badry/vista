@extends('layouts.manage')

@section('content')

<h1 class="manage_title">
<i class="fa fa-gear"></i>
Manage Users
</h1>



{{-- Show Message Success --}}
@if (Session::has('item_del'))
    <div class="alert alert-danger" style="margin-top: 10px">
        {{ session('item_del') }}
    </div>
@endif
<hr class="hr-seprator">


<div class="row">
	<div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title" style="color: #f00">Manage Users</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
			
			<!-- Start Table -->
				
				<table class="table">
					<thead>
						<tr>
							
						    <th>ID</th>
							<th>Username</th>
							<th>Email</th>
							<th>sex</th>
							<th>Telephone Number</th>
							<th>is verified</th>
							<th>&nbsp;</th>
						</tr>
					</thead>

					<tbody>

						@forelse($pu as $row)
							<tr>
							<td>{{ $row->id }}</td>
							<td>{{ $row->name }}</td>
							<td>{{ $row->email }}</td>
							<td>{{ $row->sex }}</td>
							<td>{{ $row->telnum }}</td>

								<td>
									@php
									if($row->is_verified == 0){
										$status = 'Not Yet';
										$style = 'warning';
									}
									elseif($row->is_verified == 1){
										$status = 'Verified';
										$style = 'success';
									}
									
									@endphp
									<span class="label label-{{ $style }}">{{ $status }}</span>
								</td>
								
								<td class="pull-right">
							
									<a href="{{ route('public_users.view', $row->id) }}" class="btn btn-default">
									<i class="fa fa-eye fa-fw"></i> &nbsp;
									View</a>
								</td>
							</tr>

						@empty
						<tr>
							<td>
							<p style="color: red;">You Not users In Wesite Yet!</p>
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