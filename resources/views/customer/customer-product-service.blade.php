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
<script type="text/javascript">
	function categoryProductCheck(id) {

		$.ajax({												
			dataType:'json',
			type:'POST',
			url:'/check-category-product',	
			data:{
				'id':id,
			},
			success:function(result)
			{			
				console.log(result);
				//return false;
				if(result.length!=0)
				{
					var x = confirm("When category will delete those product "+JSON.stringify(result)+" will be deleted. Are you sure you want to delete?");
					console.log(x);
					return false;
					if (x)
						return true;
					else
						return false;
				}
			},
			error: function( req, status, err ) 
			{
				console.log( 'wrong->', status, err );
				alert(err);
			}
		});
	}

	function showCustomerInfo() {
		$("#customer-info").html($("#customer").val());
	}
</script>
<div class="container">
	<div class="row">
		<div class="container col-md-12">
			<h3 >Customer Product and Service Add</h3>
				@if (count($errors) > 0)
					<div class="alert alert-danger">
					<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
					</ul>
					</div>
				@endif

			<div class="col-md-6">
				<div class="col-md-12" >
					  <div class="form-group col-md-12">
					    <label class="col-md-4" for="name">Customer</label>
					    <div class="col-md-8">
					    	<select class="form-control col-md-8" name="customer" id="customer" onchange="showCustomerInfo();">
						    	<option value="" >Select Customer</option>
						    	@foreach($customer   as $key => $customerData)
							    	<option value="Name: {{$customerData->name}} ID: {{$customerData->customer_id}}" >{{$customerData->name}}</option>
							    @endforeach
						    </select>
					    </div>
					  </div>
					  <div class="form-group col-md-12">
					  	<label class="col-md-4" for="name"></label>
					    <label class="col-md-8" id="customer-info"></label>
					  </div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="col-md-12">
					 <div class="form-group col-md-12">
					    <label class="col-md-4" for="name">Category</label>
					    <div class="col-md-8">
					    	<select class="form-control col-md-8" name="Category" id="Category" >
						    	<option value="" >Select Customer</option>
						    	@foreach($customer   as $key => $customerData)
							    	<option value="Name: {{$customerData->name}} ID: {{$customerData->customer_id}}" >{{$customerData->name}}</option>
							    @endforeach
						    </select>
					    </div>
					  </div>
				</div>
				@foreach($category   as $key => $categoryData)
					<div class="col-md-12">

					   <form class="col-md-12" method="POST" action="/category/{{$categoryData->id}}" onsubmit = "return categoryProductCheck('{{$categoryData->id}}')">
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
					            <input type="submit" class="btn btn-danger delete-user" value="Delete Category">
					        </div>
					    </form>
					</div>
				@endforeach
			</div>
			 <div class="col-md-12 centerItem">
					  	<button type="submit" class="btn btn-info">Create</button>
					  </div>
		</div>
	</div>
</div>
@endsection