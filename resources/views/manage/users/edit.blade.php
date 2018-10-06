@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <h1>Edit User <small>ID: {{ $user->id }}</small></h1>
            </div>


            <hr class="hr-seprator">
<form class="form-horizontal" action="{{ route('users.update', $user->id) }}" method="POST">
               			{{ csrf_field() }}
               			{{ method_field('PUT') }}
               			<input type="hidden" name="cruds_checked" id="cruds_checked">
               			  <div class="row">
             	
             	<div class="col-md-6">
            

            <!-- TABLE: Users -->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Edit User <small>ID: {{ $user->id }}</small></h3>

                
                </div>

                @if($errors->any())
			        <div class="error-msg">
			          @foreach($errors->all() as $error)
			            <p style="color: red">{{ $error }}</p>
			          @endforeach
			        </div>
		        @endif
                <!-- /.box-header -->
               		
		              <div class="box-body col-md-6">
		                <div class="form-group">
		                  <label for="name" class="col-sm-2 ">Name</label>

		                  <div class="col-sm-10">
		                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $user->name }}">
		                  </div>
		                </div>


		                <div class="form-group">
		                  <label for="email" class="col-sm-2 ">Email Address</label>

		                  <div class="col-sm-10">
		                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ $user->email }}">
		                  </div>
		                </div>

		                <div class="form-group" id="password-container">
		                  <label for="password" class="col-sm-2 ">Password</label>

		                  <div class="col-sm-10 password-field">
		                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">

		                    <i class="fa fa-eye show-pword" title="show password"></i>
		                  </div>
		                </div>


		                <div class="form-group">
		                  <div class="col-sm-offset-2 col-sm-10">

		                  	 <div class="checkbox" >
		                      <label>
		                        <input type="checkbox" name="keep" id="keep"> Don't Change Password
		                      </label>
		                    </div>

		                    <div class="checkbox" id="auto-field">
		                      <label>
		                        <input type="checkbox" name="auto" id="auto"> Generate Auto New  Password
		                      </label>
		                    </div>

		                   


		                  </div>
		                </div>


		              </div>

		              <div class="clearfix"></div>

		              <!-- /.box-body -->
		          
		            

            </div>
          <!-- /.box -->

      	</div>
             	
     	<div class="col-md-6">
			<div class="box box-primary">
		                <div class="box-header with-border">
		                <h3 class="box-title">Roles</h3>

		                
		                </div>


			            <div class="box-body ">
	            			<div class="form-group group-permission">
	            				@foreach($roles as $row)

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


			<hr class="hr-seprator">
          <div class="actions">
          	<button type="submit" name="submit" value="Submit" class="btn btn-info">Add New User</button>
            <button type="submit" name="submit" value="Cancel" class="btn btn-default">Cancel</button>
            
          </div>
          <!-- /.box-footer -->

	</form>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('manage/js/users.js') }}"></script>
@endsection