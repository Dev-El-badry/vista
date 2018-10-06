@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <h1>Add New Role</h1>
            </div>


            <hr class="hr-seprator">

            <form class="form-horizontal" action="{{ route('roles.store') }}" method="POST">

            <div class="row">
            	<div class="col-md-6">
            		 <!-- TABLE: Permissions -->
		            <div class="box box-info">
		                <div class="box-header with-border">
		                <h3 class="box-title">Add New Role</h3>

		                
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
				            <div class="box-body ">

				            		<input type="hidden" name="cruds_checked" id="cruds_checked">
				            	 
			            	
			            			<div class="form-group">
					                  <label for="name" class="col-sm-2 ">Name</label>

					                  <div class="col-sm-10">
					                    <input type="text" class="form-control" name="display_name"   placeholder="Name">
					                  </div>
					                </div>


					                <div class="form-group">
					                  <label for="display_name" class="col-sm-2 ">Slug</label>

					                  <div class="col-sm-10">
					                    <input type="text" class="form-control" name="name" id="name"  placeholder="Slug.." >
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="password" class="col-sm-2 ">Description</label>

					                  <div class="col-sm-10">
					                    <input type="text" class="form-control" name="description"  id="description" placeholder="Description..">
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
				                  <input type="checkbox" class="minimal chk-crud" value="{{ $row->id }}">
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
            	<button type="submit" name="submit" value="Submit" class="btn btn-info">Add New Role</button>
				<button type="submit" name="submit" value="Cancel" class="btn btn-default">Cancel</button>
            </div>
      </form>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('manage/js/roles.js') }}"></script>
@endsection