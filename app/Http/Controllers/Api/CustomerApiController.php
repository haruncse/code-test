<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Customer;

class CustomerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response()->json(Customer::all());
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
        $this->validate($request, [
          'image'  => 'required|image|mimes:jpg,png,gif|max:120',
          'name'   =>'required|min:3',
          'email'  =>'required|unique:customers',
          'mobile' =>'required|unique:customers|min:11|max:11'
         ]);

        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $path = public_path('images')."/".$new_name;
        $type = pathinfo($path, PATHINFO_EXTENSION);

        
        $data = file_get_contents($path);
        $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($data);
        

        //unlink($path);
        $inputData=$request->all();
        //dd($new_name);
        $randomid = rand(0,999);
        $customerName=$inputData['name'];
        $customerName = preg_replace('/\s+/', '', $customerName);
        $customerName =substr($customerName,0,3);
        $customerID="".$customerName."".$randomid ; 

        $customerUniqeID=[];

        do{
            $customerUniqeID=Customer::select('name')
            ->where('customer_id', $customerID)
            ->orderBy('name', 'desc')
            ->get();
        }

        while (count($customerUniqeID)!=0);
        {
            $randomid = rand(0,999);
            $customerID="".$customerName."".$randomid ; 
            $customerUniqeID=Customer::select('name')
                ->where('customer_id', $customerID)
                ->orderBy('name', 'desc')
                ->get();
        }
        
        //dd($customerID);
        $customerData=new Customer;
        $customerData->name=$inputData['name'];
        $customerData->email=$inputData['email'];
        $customerData->mobile=$inputData['mobile'];
        $customerData->customer_id=$customerID;
        $customerData->image=$base64Image;
        $customerData->save();
        //dd("Customer Inserted");
         unlink($path);
         return Response("Customer Created Successfully",201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Response()->json(Customer::findorfail($id));
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
        $this->validate($request, [
          'image'  => 'required|image|mimes:jpg,png,gif|max:120',
          'name'   =>'required|min:3',
          'email'  =>'required|unique:customers',
          'mobile' =>'required|unique:customers|min:11|max:11'
         ]);

        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $path = public_path('images')."/".$new_name;
        $type = pathinfo($path, PATHINFO_EXTENSION);

        $data = file_get_contents($path);
        $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $inputData=$request->all();

        $randomid = rand(0,999);
        $customerName=$inputData['name'];
        $customerName = preg_replace('/\s+/', '', $customerName);
        $customerName =substr($customerName,0,3);
        $customerID="".$customerName."".$randomid ; 

        $customerUniqeID=[];

        do{
            $customerUniqeID=Customer::select('name')
            ->where('customer_id', $customerID)
            ->orderBy('name', 'desc')
            ->get();
        }

        while (count($customerUniqeID)!=0);
        {
            $randomid = rand(0,999);
            $customerID="".$customerName."".$randomid ; 
            $customerUniqeID=Customer::select('name')
                ->where('customer_id', $customerID)
                ->orderBy('name', 'desc')
                ->get();
        }
        
        //dd($customerID);
        $customerData=Customer::findorfail($id);
        $customerData->name=$inputData['name'];
        $customerData->email=$inputData['email'];
        $customerData->mobile=$inputData['mobile'];
        $customerData->customer_id=$customerID;
        $customerData->image=$base64Image;
        $customerData->save();
        //dd("Customer Inserted");
        unlink($path);
        return Response("Customer updated Successfully",201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Customer::findorfail($id);
        Customer::destroy($id);
        return Response("Customer deleted Successfully");
    }
}
