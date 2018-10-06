@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary pull-right"><i class="fa fa-edit"></i>&nbsp; Edit Permission</a>

                <h1>Show Permission <small>ID: {{ $permission->id }}</small></h1>
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

                  <h3 class="box-title">Permission Details</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <dl>
                    <dt>Name:</dt>
                    <dd>{{$permission->display_name}}</dd>

                    <dt>Slug:</dt>
                    <dd>{{$permission->name}}</dd>

                    <dt>Description:</dt>
                    <dd>{{$permission->description}}</dd>
                  </dl>
                </div>
                <!-- /.box-body -->
          </div>
        </div>
    </div>
@endsection