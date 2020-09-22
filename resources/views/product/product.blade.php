@extends('layout.app')
@section('homeContent')

<div class="container">
	<div class="row">
		<div class="container col-md-6">
			<div class="col-md-12" >
				<h3 >Product</h3>
				<form action="/product" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <div class="form-group">
				    <label for="name">Name</label>
				    <input type="text" class="form-control" name="name" id="name">
				  </div>
				  <div class="form-group">
				    <label for="category_id">Category</label>
				    <select class="form-control" name="category_id" id="category_id">
				    	@foreach($category   as $key => $catItem)
				    	<option value="{{$catItem->id}}" >{{$catItem->name}}</option>
				    	@endforeach
				    </select>
				  </div>

				   <div class="form-group">
				    <label for="qty">Qty</label>
				    <input type="number"min='1' class="form-control" name="qty" id="qty">
				  </div>

				   <div class="form-group">
				    <label for="price">Price</label>
				    <input type="number"min='1' class="form-control" name="price" id="price">
				  </div>
				  <button type="submit" class="btn btn-default">Submit</button>
				</form>
				
			</div>
			   
	        <table class="table responsive">
	        	<tr><th>Name</th><th>Qty</th><th>Price</th><th>Category</th><th>Action</th></tr>
	        	@foreach($product   as $key => $productItem)
	        	<form method="POST" action="/product/{{$productItem->id}}">
			        {{ csrf_field() }}
			        {{ method_field('DELETE') }}
		        	<tr><td>{{$productItem->name}}</td><td>{{$productItem->qty}}</td><td>{{$productItem->peice}}</td><td>{{$productItem->category_id}}</td>
		            <td><input type="submit" class="btn btn-danger" value="Delete Product">
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