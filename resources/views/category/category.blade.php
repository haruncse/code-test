@extends('layout.app')
@section('homeContent')

<div class="container">
	<div class="row">
		<div class="container col-md-6">
			<div class="col-md-12" >
				<h3 >Create Category</h3>
				<form action="/category" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <div class="form-group">
				    <label for="name">Category Name</label>
				    <input type="text" class="form-control" name="name" id="name">
				  </div>
				  <div class="form-group">
				    <label for="status">Status</label>
				    <select class="form-control" name="status" id="status">
				    	<option value="1" >Pending</option>
				    	<option value="2" >Active</option>
				    </select>
				  </div>
				  <button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection