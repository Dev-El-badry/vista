@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <h1>Edit Role <small>ID: {{ $role->id }}</small></h1>
            </div>


            <hr class="hr-seprator">

            <form class="form-horizontal" action="{{ route('roles.update', $role->id) }}" method="POST">

            <div class="row">
            	<div class="col-md-6">
            		 <!-- TABLE: Permissions -->
		            <div class="box box-info">
		                <div class="box-header with-border">
		                <h3 class="box-title">Edit Role <small>ID: {{ $role->id }}</small></h3>

		                
		                </div>

		                @if($errors->any())
					        <div class="error-msg">
					          @foreach($errors->all() as $error)
					            <p style="color: red">{{ $error }}</p>
					          @endforeach
					        </div>
				        @endif
		                <!-- /.box-header -->
		               		
		               			{{ csrf_field() }}
		               			{{ method_field('PUT') }}
				            <div class="box-body ">

				            		<input type="hidden" name="cruds_checked" id="cruds_checked">
				            	 
			            	
			            			<div class="form-group">
					                  <label for="name" class="col-sm-2 ">Name(Human Readable)</label>

					                  <div class="col-sm-10">
					                    <input type="text" class="form-control" name="display_name" value="{{ $role->display_name }}"  placeholder="Name">
					                  </div>
					                </div>


					                <div class="form-group">
					                  <label for="display_name" class="col-sm-2 ">Slug (Can Not Be Edit)</label>

					                  <div class="col-sm-10">
					                    <input type="text" class="form-control" name="name" id="name" value="{{ $role->name }}" placeholder="Slug.." disabled>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="password" class="col-sm-2 ">Description</label>

					                  <div class="col-sm-10">
					                    <input type="text" class="form-control" name="description" value="{{ $role->description }}" id="description" placeholder="Description..">
					                  </div>
					                </div>
			            	
				            	

				            </div>

				              <div class="clearfix"></div>

				              <!-- /.box-body -->
				           

		            </div>
		          <!-- /.box -->
            	</div>
            	<div class="col-md-6">
            		
            		 <!-- TABLE: Permissions -->
		            <div class="box box-primary">
		                <div class="box-header with-border">
		                <h3 class="box-title">Permissions</h3>

		                
		                </div>


			            <div class="box-body ">
	            			<div class="form-group group-permission">
	            				@foreach($permissions as $row)

			                	<label class="label-permission">
				                  <input type="checkbox" class="minimal chk-crud" value="{{ $row->id }}" {{ in_array($row->id, $arrayIds) == true ? 'checked' : '' }}>
				                  {{ $row->display_name }}
				                </label>

				                @endforeach
			                </div>
			            </div>


		            </div>
		          <!-- /.box -->

            	</div> 
            </div>

           
            <div class="clearfix"></div>
            <hr class="hr-seprator">
            <div class="acctions">
            	<button type="submit" name="submit" value="Submit" class="btn btn-info">Update Role</button>
				<button type="submit" name="submit" value="Cancel" class="btn btn-default">Cancel</button>
            </div>
      </form>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('manage/js/roles.js') }}"></script>
@endsection