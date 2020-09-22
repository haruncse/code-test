@extends('layout.app')
@section('homeContent')

<div class="container">
	<div class="row">
		<div class="container col-md-6">
			<div class="col-md-12" >
				<h3 >Customer</h3>
				<form action="/customer" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <div class="form-group">
				    <label for="name">Name</label>
				    <input type="text" class="form-control" name="name" id="name">
				  </div>

				   <div class="form-group">
				    <label for="email">Email</label>
				    <input type="email"min='1' class="form-control" name="email" id="email">
				  </div>

				   <div class="form-group">
				    <label for="mobile">Mobile</label>
				    <input type="text"min='1' class="form-control" name="mobile" id="mobile">
				  </div>
				   <div class="form-group">
				    <label for="image">Image</label>
				    <input type="file" class="form-control" name="image" id="image">
				  </div>
				  <button type="submit" class="btn btn-default">Submit</button>
				</form>

				@foreach($customer   as $key => $customerData)
				   <form method="POST" action="/customer/{{$customerData->id}}">
				        {{ csrf_field() }}
				        {{ method_field('DELETE') }}
				        <label for="name">{{$customerData->name}}</label>
				        <div class="form-group">
				            <input type="submit" class="btn btn-danger delete-user" value="Delete user">
				        </div>
				    </form>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection