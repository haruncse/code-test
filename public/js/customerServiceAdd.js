var app=angular.module("customerInfoApp",[]);
app.controller('customerInfoController',function($scope,$http){

        $scope.customerItemList = [];
        var serviceItem=[];

        $scope.addCustomerTemp=function(){
        	console.log($("#customer").val());
        	var customerID=$("#customer").val();

        	if(customerID.length!=0){
	        	var addFlag=1;
	            var dataIndex=0;
	            for(r in serviceItem){
	                if(serviceItem[r].customer_id==customerID){
	                    addFlag=0;
	                    dataIndex=r;
	                }
	            }
        		console.log("Add Flag",addFlag);
        		if(addFlag){
	                var itemTemp={};
	                itemTemp.customer_id=$("#customer").val();
	                itemTemp.productInfo=0;
	                itemTemp.productID=1;
	                itemTemp.qty=1;
	                itemTemp.price=1;
	                itemTemp.discount=1;
	                itemTemp.amount=1;

	                serviceItem.push(itemTemp);
	  
		            $scope.customerItemList = serviceItem;

		            setTimeout(function(){ 
		                $scope.$apply();
		            });
		        }
	        }else{
	        	$("#customer").focus();
	        }
        }

        $scope.addProductTemp=function(item){
        	console.log(item);
        	var stringData=$("#product-item-"+item.customer_id).val().split('-');
        	item.price=stringData[1];
        	console.log(stringData);

            var addFlag=1;
            var dataIndex=0;
            for(r in serviceItem){
                if(serviceItem[r].customer_id==item.customer_id){
                    addFlag=0;
                    dataIndex=r;
                }
            }

            if(addFlag){
                //var itemTemp={};
                //serviceItem.push(itemTemp);
            }else{
            	serviceItem[dataIndex].productID=stringData[0];
                serviceItem[dataIndex].price=item.price;
                serviceItem[dataIndex].qty=item.qty;
                serviceItem[dataIndex].amount=item.price*item.qty-item.discount;
            }
            $scope.customerItemList = serviceItem;
            setTimeout(function(){ 
                $scope.$apply();
            });
            console.log()
        }

        $scope.updatePriceTemp=function(item){
        	//updatePriceTemp
        	console.log(item);
        	setTimeout(function(){ 
                $scope.$apply();
                /*setDiscountValue();
                setDeliveryCharge();*/
            });
        }

        $scope.sum = function(list) {
            var total=0;
            angular.forEach(serviceItem , function(newsaletemp){
                total+= parseFloat(newsaletemp.qty*newsaletemp.price-newsaletemp.discount);
            });

            return total;
		}

});