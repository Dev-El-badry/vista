@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <h1>Edit Permission <small>ID: {{ $permission->id }}</small></h1>
            </div>


            <hr class="hr-seprator">

            

            <!-- TABLE: Permissions -->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Edit Permission <small>ID: {{ $permission->id }}</small></h3>

                
                </div>

                @if($errors->any())
			        <div class="error-msg">
			          @foreach($errors->all() as $error)
			            <p style="color: red">{{ $error }}</p>
			          @endforeach
			        </div>
		        @endif
                <!-- /.box-header -->
               		<form class="form-horizontal" action="{{ route('permissions.update', $permission->id) }}" method="POST">
               			{{ csrf_field() }}
               			{{ method_field('PUT') }}
		            <div class="box-body ">


		            	<div class="permissions">
		            		<div class="basic-permissions col-md-6" >
		            			<div class="form-group">
				                  <label for="name" class="col-sm-2 ">Name</label>

				                  <div class="col-sm-10">
				                    <input type="text" class="form-control" name="display_name" value="{{ $permission->display_name }}"  placeholder="Name">
				                  </div>
				                </div>


				                <div class="form-group">
				                  <label for="display_name" class="col-sm-2 ">Slug</label>

				                  <div class="col-sm-10">
				                    <input type="text" class="form-control" name="name" id="name" value="{{ $permission->name }}" placeholder="Slug.." disabled>
				                  </div>
				                </div>

				                <div class="form-group">
				                  <label for="password" class="col-sm-2 ">Description</label>

				                  <div class="col-sm-10">
				                    <input type="text" class="form-control" name="description" value="{{ $permission->description }}" id="description" placeholder="Description..">
				                  </div>
				                </div>
		            		</div>

		            	</div>

		            </div>

		              <div class="clearfix"></div>

		              <!-- /.box-body -->
		              <div class="box-footer">
		              	<button type="submit" name="submit" value="Submit" class="btn btn-info">Update Permission</button>
		                <button type="submit" name="submit" value="Cancel" class="btn btn-default">Cancel</button>
		                
		             </div>
		              <!-- /.box-footer -->
		            </form>

            </div>
          <!-- /.box -->

     
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('manage/js/permissions.js') }}"></script>
@endsection