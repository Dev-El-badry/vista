@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <h1>Manage Roles</h1>
            </div>

            <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Create New Role</a>

            <hr class="hr-seprator">

            {{-- Show Message Success --}}
            @if (Session::has('item'))
                <div class="alert alert-success">
                    {{ session('item') }}
                </div>
            @endif

 
            <div class="row">
                
                @foreach($roles as $role) 
                <div class="col-md-3">
                    <!-- TABLE: Permission -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                        <h3 class="box-title">{{ $role->display_name }} <small><em>{{ $role->name }}</em></small></h3>

                        
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                       
                            <h4>{{ $role->description }}</h4>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-default">Show</a>
                        </div>

                    </div>
                    <!-- /.box -->
                </div>
                @endforeach
            </div>


           


          
        </div>
    </div>
@endsection