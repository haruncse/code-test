@extends('layout.app')
@section('homeContent')
<style type="text/css">
	form{
		margin: 0px;
	}
	h3{
		text-align: center;
	}
	button{
		text-align: center;
	}
	.centerItem{
		text-align: center;
	}
</style>

<div class="container">
	<div class="row">
		<div class="container col-md-12">
			<div class="col-md-6">
				<div class="col-md-12" >
					<h3 >Create Category and Display</h3>
					@if (count($errors) > 0)
						<div class="alert alert-danger">
						<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
						</ul>
						</div>
					@endif
					<form class="col-md-12" action="/category" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					  <div class="form-group col-md-12">
					    <label class="col-md-4" for="name">Category Name</label>
					    <div class="col-md-8">
					    	<input type="text" class="form-control" name="name" id="name">
					    </div>
					  </div>
					  <div class="form-group col-md-12">
					    <label class="col-md-4" for="status">Status</label>
					    <div class="col-md-8">
						    <select class="form-control col-md-8" name="status" id="status">
						    	<option value="1" >Pending</option>
						    	<option value="2" >Active</option>
						    </select>
						</div>
					  </div>
					  <div class="col-md-12 centerItem">
					  	<button type="submit" class="btn btn-info">Create Category</button>
					  </div>
					</form>
				</div>
			</div>
			<div class="col-md-6">
				<div class="col-md-12">
					<div class="col-md-12">
						<label class="col-md-4">Name</label> 
						<label class="col-md-4">Status</label>
						<label class="col-md-4">Action</label>
					</div>
				</div>
				@foreach($category   as $key => $categoryData)
					<div class="col-md-12">

					   <form class="col-md-12" method="POST" action="/category/{{$categoryData->id}}">
					        {{ csrf_field() }}
					        {{ method_field('DELETE') }}
					        <label class="col-md-4" >{{$categoryData->name}}</label>
					        <label class="col-md-4" >
					        	@if($categoryData->status==1)
					        		Pending
					        	@else
					        		Active
					        	@endif
					        </label>
					        <div class="form-group col-md-4">
					            <input type="submit" class="btn btn-danger delete-user" value="Delete user">
					        </div>
					    </form>
					</div>
				@endforeach
			</div>
			
		</div>
	</div>
</div>
@endsection