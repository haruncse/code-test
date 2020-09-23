@extends('layout.app')
@section('homeContent')

<div class="container">
	<div class="row">
		<div class="container col-md-6">
			<div class="col-md-12" >
				<h3 >Customer</h3>
				@if (count($errors) > 0)
					<div class="alert alert-danger">
					<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
					</ul>
					</div>
				@endif
				
				<form action="/customer" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <div class="form-group">
				    <label for="name">Name</label>
				    <input type="text" required="required" class="form-control" name="name" id="name">
				  </div>

				   <div class="form-group">
				    <label for="email">Email</label>
				    <input type="email" required="required" class="form-control" name="email" id="email">
				  </div>

				   <div class="form-group">
				    <label for="mobile">Mobile</label>
				    <input type="text" required="required" max="11" min="11" class="form-control" name="mobile" id="mobile">
				  </div>
				   <div class="form-group">
				    <label for="image">Image</label>
				    <input type="file" required="required" class="btn btn-primary" name="image" id="image">
				  </div>
				  <button type="submit" class="btn btn-info">Add Customer</button>
				</form>

			    <table class="table responsive">
		        	<tr><th>Name</th><th>Email</th><th>Mobile</th><th>Image</th><th>Action</th></tr>
		        	@foreach($customer   as $key => $customerData)

		        	 <form method="POST" action="/customer/{{$customerData->id}}">
				        {{ csrf_field() }}
				        {{ method_field('DELETE') }}
			        	<tr><td>{{$customerData->name}}</td><td>{{$customerData->email}}</td><td>{{$customerData->mobile}}</td><td><img src="{{$customerData->image}}"></td>
			            <td><input type="submit" class="btn btn-danger" value="Delete Customer">
			            </td>	
			            </tr>
			    	</form>

					@endforeach
		        </table>
			</div>
		</div>
	</div>
</div>
@endsection