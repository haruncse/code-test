<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Customer;
use App\Model\Category;
use App\Model\Product;
use App\Model\CustomerProductService;

class CustomerProductServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.customer-product-service')->with('customer',Customer::all())->with('product',Product::all())->with('category',Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $value=$request->all();
        //return $value['data'];
        foreach ($value['data'] as $in) {
            //return $in;
            $dataItem=new CustomerProductService;
            $dataItem->customer_id=$in['customer_id'];
            $dataItem->productID=$in['productID'];
            $dataItem->qty=$in['qty'];
            $dataItem->price=$in['price'];
            $dataItem->discount=$in['discount'];
            $dataItem->amount=(int)($dataItem->price*$dataItem->qty)-$dataItem->discount;
            $dataItem->save();
        }
        
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
