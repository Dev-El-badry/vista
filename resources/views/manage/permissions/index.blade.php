@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <h1>Manage Permissions</h1>
            </div>

            <a href="{{ route('permissions.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Create New Permission</a>

            <hr class="hr-seprator">

            {{-- Show Message Success --}}
            @if (Session::has('item'))
                <div class="alert alert-success">
                    {{ session('item') }}
                </div>
            @endif

            <!-- Paginations -->
            {{ $permissions->links() }}

            <!-- TABLE: Permission -->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Permission</h3>

                
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                    <thead>
                    <tr>
                        <th>Permission ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>{{ $r->display_name }}</td>
                            <td>{{ $r->name }}</td>
                            <td>
                                <a href="{{route('permissions.show', $r->id)}}" class="btn btn-default">
                                <i class="fa fa-eye fa-fw"></i>
                                 View </a>
                                <a href="{{route('permissions.edit', $r->id)}}" class="btn btn-default">
                                     <i class="fa fa-edit fa-fw"></i>
                                 Edit </a>
                            </td>
                        </tr>
                        @endforeach
                    
                    </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->

            </div>
          <!-- /.box -->

            <!-- Paginations -->
            {{ $permissions->links() }}
        </div>
    </div>
@endsection