@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <h1>Requests Chronic Drug </h1>
            </div>

          
            <hr class="hr-seprator">

            <!-- Paginations -->
            {{ $requests->links() }}

            @if(count($requests)>0)

            <!-- TABLE: Users -->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Drugs Allergy List</h3>

                
                </div>








                <!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                    <thead>
                    <tr>
                        <th>Count</th>
                        <th>Chronic Drug </th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $key=>$req)
                        <tr class="requests-list"> 
                            <td>{{ ++$key  }}</td>
                            <td>{{ $req->title }}</td>
                            
                            <td>
                                <a href="#" class="btn btn-primary active_request" data-value="{{ $req->id }}">
                                <i class="fa fa-bell-o fa-fw"></i>
                                 Active </a>

                                 <a href="#" class="btn btn-danger delete_request" data-value="{{ $req->id }}">
                                <i class="fa fa-trash fa-fw"></i>
                                 Delete </a>
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

            @else

            <p style="color: red">No Request In Database.</p>

            @endif

            <!-- Paginations -->
            {{ $requests->links() }}
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('manage/js/chronic_drug_list.js') }}"></script>
@endsection