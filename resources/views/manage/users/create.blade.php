@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <h1>Create New User</h1>
            </div>


            <hr class="hr-seprator">

            <form class="form-horizontal" action="{{ route('users.store') }}" method="POST">
             {{ csrf_field() }}

             <div class="row">
             	
             	<div class="col-md-6">
             		 <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Create New User</h3>

                
                </div>

                @if($errors->any())
			        <div class="error-msg">
			          @foreach($errors->all() as $error)
			            <p style="color: red">{{ $error }}</p>
			          @endforeach
			        </div>
		        @endif
                <!-- /.box-header -->
               		
		            <div class="box-body ">
		            	<input type="hidden" name="cruds_checked" id="cruds_checked">

			                <div class="form-group">
			                  <label for="name" class="col-sm-2 ">Name</label>

			                  <div class="col-sm-10">
			                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
			                  </div>
			                </div>


			                <div class="form-group">
			                  <label for="email" class="col-sm-2 ">Email Address</label>

			                  <div class="col-sm-10">
			                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
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
			                    <div class="checkbox">
			                      <label>
			                        <input type="checkbox" id="auto"> Generate Auto Password
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
				                  <input type="checkbox" class="minimal chk-crud" value="{{ $row->id }}" >
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