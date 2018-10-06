@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary pull-right"><i class="fa fa-edit"></i>&nbsp; Edit User</a>

                <h1>Show User <small>ID: {{ $user->id }}</small></h1>
            </div>

            

            <hr class="hr-seprator">

            {{-- Show Message Success --}}
            @if (Session::has('item'))
                <div class="alert alert-success">
                    {{ session('item') }}
                </div>
            @endif

            <div class="box box-solid col-md-8">
                <div class="box-header with-border">
                  <i class="fa fa-user"></i>

                  <h3 class="box-title">User Details</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <dl>
                    <dt>Name:</dt>
                    <dd>{{$user->name}}</dd>

                    <dt>Email:</dt>
                    <dd>{{$user->email}}</dd>
                  </dl>
                </div>
                <!-- /.box-body -->
          </div>

              <div class="box box-primary col-md-8">
                <div class="box-header with-border">
                  <i class="fa fa-permission"></i>

                  <h3 class="box-title">Roles</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul>
                        @foreach($user->roles as $r)
                        <li><h3>{{ $r->display_name }} <small><em>{{ $r->name }}</em></small></h3></li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.box-body -->
          </div>
        </div>
    </div>
@endsection