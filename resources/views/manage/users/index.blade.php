@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <h1>Manage Users</h1>
            </div>

            <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Create New User</a>

            <hr class="hr-seprator">

            <!-- Paginations -->
            {{ $users->links() }}

            <!-- TABLE: Users -->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Users</h3>

                
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                    <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{route('users.show', $user->id)}}" class="btn btn-default">
                                <i class="fa fa-eye fa-fw"></i>
                                 View </a>
                                <a href="{{route('users.edit', $user->id)}}" class="btn btn-default">
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
            {{ $users->links() }}
        </div>
    </div>
@endsection