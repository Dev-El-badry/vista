@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="manage_title">
                <h1>Create New Permission</h1>
            </div>


            <hr class="hr-seprator">

            

            <!-- TABLE: Permissions -->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Create New Permission</h3>

                
                </div>

                @if($errors->any())
			        <div class="error-msg">
			          @foreach($errors->all() as $error)
			            <p style="color: red">{{ $error }}</p>
			          @endforeach
			        </div>
		        @endif
                <!-- /.box-header -->
               		<form class="form-horizontal" action="{{ route('permissions.store') }}" method="POST">
               			{{ csrf_field() }}
		            <div class="box-body ">

		            	<div class="form-group group-radio">
		            		<label class="radio-permission">
			                  <input type="radio" name="r3" class="flat-red permission-radio" value="basic" checked>
			                  Basic Permissions
			                </label>

			                <label class="radio-permission">
			                  <input type="radio" name="r3" class="flat-red permission-radio" value="crud">
			                  Crud Permissions
			                </label>
		            	</div>	

		            	<div class="permissions">
		            		<div class="basic-permissions col-md-6" >
		            			<div class="form-group">
				                  <label for="display_name" class="col-sm-2 ">Name</label>

				                  <div class="col-sm-10">
				                    <input type="text" class="form-control" name="display_name"  placeholder="Name">
				                  </div>
				                </div>


				                <div class="form-group">
				                  <label for="name" class="col-sm-2 ">Slug</label>

				                  <div class="col-sm-10">
				                    <input type="text" class="form-control" name="name" id="name" placeholder="Slug..">
				                  </div>
				                </div>

				                <div class="form-group">
				                  <label for="password" class="col-sm-2 ">Description</label>

				                  <div class="col-sm-10">
				                    <input type="text" class="form-control" name="description" id="description" placeholder="Description..">
				                  </div>
				                </div>
		            		</div>

							<div class="crud-permissions" style="display: none">
								<div class="row">
									<input type="hidden" name="crud_checked" id="crud_checked">
									<div class="col-md-4">
										<div class="form-group">
						                  <label for="name" class="col-sm-2 ">Name</label>

						                  <div class="col-sm-10">
						                    <input type="text" class="form-control" name="display_name" id="name" placeholder="Name">
						                  </div>
						                </div>

						                <div class="form-group group-permission">
						                	<label class="label-permission">
							                  <input type="checkbox" name="crud" class="minimal chk-crud" value="create" checked>
							                  Create
							                </label>

							                <label class="label-permission">
							                  <input type="checkbox" name="crud" class="minimal chk-crud" value="read" checked>
							                  Read
							                </label>

							                <label class="label-permission">
							                  <input type="checkbox" name="crud" class="minimal chk-crud" value="update" checked>
							                  Update
							                </label>

							                <label class="label-permission">
							                  <input type="checkbox" name="crud" class="minimal chk-crud" value="delete" checked>
							                  Delete
							                </label>
						                </div>	
									</div>	

									<div class="col-md-8">
										<div class="table-responsive">
							                <table class="table no-margin">
							                  <thead>
							                  <tr>
							                    <th>Name</th>
							                    <th>Slug</th>
							                    <th>Description</th>
							                  </tr>
							                  </thead>
							                  <tbody id="crud-body">
							                 

							                  </tbody>
							                </table>
							              </div>
									</div>	
								</div>


		            		</div>

		            	</div>

		            </div>

		              <div class="clearfix"></div>

		              <!-- /.box-body -->
		              <div class="box-footer">
		              	<button type="submit" name="submit" value="Submit" class="btn btn-info">Add New Permission</button>
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