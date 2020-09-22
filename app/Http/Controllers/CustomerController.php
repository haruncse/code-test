<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Customer;
use Illuminate\Support\Facades\Input;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('customer.customer')->with('customer',Customer::all());
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
        //dd($request->all());
        //$file = Input::file('image');
        $inputData=$request->all();
        //$file = $request->file($inputData['image']);
        //dd($file);
        $randomid = rand(0,999);
        $customerName=$inputData['name'];
        //trim($customerName,$inputData['name']);
        $customerID="".substr($customerName, 3)."".$randomid ; 
        //dd($customerID);
        $customerData=new Customer;
        $customerData->name=$inputData['name'];
        $customerData->email=$inputData['email'];
        $customerData->mobile=$inputData['mobile'];
        $customerData->customer_id=$customerID;
        //$customerData->image=
        $customerData->save();
        //dd("Customer Inserted");
        return redirect('/customer');
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
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect('/customer'); 
    }
}
