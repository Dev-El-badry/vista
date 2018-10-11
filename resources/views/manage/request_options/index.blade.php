@extends('layouts.manage')

@section('content')

<h1 class="manage_title">
<i class="fa fa-gear"></i>
Manage Request Options
</h1>



<a class="btn btn-primary add-item"  href="{{ route('request_options.create') }}">
	<i class="fa fa-plus"></i>
	Add New Request Option
</a>

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
          <h3 class="box-title" style="color: #f00">Manage Request Options</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
			
			<!-- Start Table -->
				
				<table class="table">
					<thead>
						<tr>
						    <th>ID</th>
							<th>title</th>
							
							<th>&nbsp;</th>
						</tr>
					</thead>

					<tbody>

						@forelse($request_options as $row)
							<tr>
							<td>{{ $row->id }}</td>
								<td>
									 {{ $row->title }}
								</td>
								
								
								
								
								
								<td class="pull-right">
							
									<a href="{{ route('request_options.edit', $row->id) }}" class="btn btn-default">
									<i class="fa fa-edit fa-fw"></i> &nbsp;
									Edit</a>
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