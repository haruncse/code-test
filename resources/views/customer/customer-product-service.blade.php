@extends('layout.app')
@section('homeContent')
<link href="{{ asset('/css/jquery.datetimepicker.css') }}" rel="stylesheet">
<script type="text/javascript" src="js/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="js/angular.min.js"></script>
<script type="text/javascript" src="js/customerServiceAdd.js"></script>
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
	.rightItem{
		text-align: right;
		margin-bottom: 5px;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		 $('#issueDate').datetimepicker({format:'d-m-Y', value:'d-m-Y', defaultDate:new Date(),closeOnDateSelect:true, timepicker:false});
	});

	function addProductService() {
		var scope = angular.element($("#CustomerItemCtrl")).scope();
    	var items=scope.customerItemList;
		console.log(items);
		$.ajax({												
			dataType:'json',
			type:'POST',
			url:'/customer-product-service',	
			data:{
				'data':items,
			},
			success:function(result)
			{			
				console.log(result);
				//return false;
				if(result.length!=0)
				{
					alert("Data Saved Success Fully");
					window.location.reload();
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

	function addCustomerItem() {
		console.log("Customer Item");
	}

	function isIntegerKey(evt){

	  var charCode = (evt.which) ? evt.which : event.keyCode
	  if (charCode > 31 && (charCode < 48 || charCode > 57)){
	  //if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57))){

	      return false;
	  }else{
	    //setDueAmount();
	    return true;
	  }  
	}
</script>
<div class="container-fluid">
	<div class="row">
		<div class="container-fluid col-md-12" id="CustomerItemCtrl" ng-app="customerInfoApp" ng-controller="customerInfoController">
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
							    	<option value="{{$customerData->customer_id}}" >{{$customerData->name}}</option>
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
				<div class="row">
					<div class="col-md-6">
						 <div class="form-group col-md-12">
						    <label class="col-md-12" >Issue Date</label>
						    <div class="col-md-12">
						    	<input type="text" class="form-control" id="issueDate" name="">
						    </div>
						  </div>
					</div>
					<div class="col-md-6">
						 <div class="form-group col-md-12">
						    <label class="col-md-12">Category</label>
						    <div class="col-md-12">
						    	<select class="form-control col-md-12" name="Category" id="Category" >
							    	<option value="" >Select Category</option>
							    	@foreach($category   as $key => $categoryItem)
								    	<option value="{{$categoryItem->id}}" >{{$categoryItem->name}}</option>
								    @endforeach
							    </select>
						    </div>
						  </div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						 <div class="form-group col-md-12">
						    <label class="col-md-12" >Proposal Number</label>
						    <div class="col-md-12">
						    	<input type="text" class="form-control" name="">
						    </div>
						  </div>
					</div>
					<div class="col-md-6">
						 <div class="form-group col-md-12">
						   <input type="checkbox" name="discount" id="discount" class="form-control col-md-3" style="margin: 0px;">
						    <div class="col-md-9">
						    	<label class="col-md-12" for="discount" na style="padding: 0;padding-top: 6px;">Discount Apply</label>
						    </div>
						  </div>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="col-md-6">
					<label style="">PRODUCT & SERVICES</label>
				</div>
				<div class="col-md-6 rightItem">
			  		<button ng-click="addCustomerTemp()"  class="btn btn-info">Add Item</button>
			  	</div>
		  	</div>

		  	<div class="col-md-12">
		  		<table class="table responsive">
		  			<tr>
		  				<td>Customer</td><td>Item</td><td>Qty</td><td>Price</td><td>Discount</td><td>Amount</td>
		  			</tr>
		  			<tr ng-repeat="newItem in customerItemList" >
		  				<td>@{{newItem.customer_id}}</td>
		  				<td>
		  					<select class="form-control col-md-12" name="product-item-@{{newItem.customer_id}}" id="product-item-@{{newItem.customer_id}}" ng-change="addProductTemp(@{{newItem}})" ng-model="newItem.productInfo">
						    	<option value="0" selected="selected" >Select Item</option>
						    	@foreach($product   as $key => $productItem)
							    	<option value="{{$productItem->id}}-{{$productItem->price}}" >{{$productItem->name}}</option>
							    @endforeach
						    </select>
						</td>

		  				<td><input type="text" value="@{{newItem.qty}}" ng-model="newItem.qty" onkeypress="return isIntegerKey(event);" ng-change="updatePriceTemp(newItem)" name="qty"></td>
		  				<td><input type="text" value="@{{newItem.price}}" ng-model="newItem.price" readonly="readonly" name="price"></td>
		  				<td><input type="text" value="@{{newItem.discount}}" ng-model="newItem.discount" onkeypress="return isIntegerKey(event);"  name="discount"></td>
		  				<td><input type="text" readonly="readonly" value="@{{newItem.price * newItem.qty - newItem.discount}}"></td>
		  			</tr>
		  			
		  		</table>
		  		<div class="col-md-12">
		  			<div class="col-md-8"></div>
		  			<div class="col-md-4">
		  				<div class="row">
		  					<div class="row">
		  						<label class="col-md-6">Sub Total</label>
		  						<label class="col-md-6">@{{sum(customerItemList)}}</label>
	  						</div>
	  						<div class="row">
		  						<label class="col-md-6">Discount</label>
		  						<label class="col-md-6"></label>
		  					</div>
		  					<div class="row">
		  						<label class="col-md-6">Total Amount</label>
		  						<label class="col-md-6">@{{sum(customerItemList)}}</label>
		  					</div>
		  				</div>
		  			</div>
		  		</div>
		  	</div>
		  	<div class="col-md-12 rightItem">
		  		<button class="btn btn-info" onclick="addProductService();">create</button>
		  	</div>
		</div>
	</div>
</div>
@endsection