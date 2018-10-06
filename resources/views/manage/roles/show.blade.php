@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary pull-right"><i class="fa fa-edit"></i>&nbsp; Edit Role</a>

                <h1>Show Role <small>ID: {{ $role->id }}</small></h1>
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
                  <i class="fa fa-permission"></i>

                  <h3 class="box-title">Role Details</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <dl>
                    <dt>Name:</dt>
                    <dd>{{$role->display_name}}</dd>

                    <dt>Slug:</dt>
                    <dd>{{$role->name}}</dd>

                    <dt>Description:</dt>
                    <dd>{{$role->description}}</dd>
                  </dl>
                </div>
                <!-- /.box-body -->
          </div>

            <div class="box box-primary col-md-8">
                <div class="box-header with-border">
                  <i class="fa fa-permission"></i>

                  <h3 class="box-title">Permissions</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul>
                        @foreach($role->permissions as $r)
                        <li><h3>{{ $r->display_name }} <small><em>{{ $r->name }}</em></small></h3></li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.box-body -->
          </div>

        </div>
    </div>
@endsection