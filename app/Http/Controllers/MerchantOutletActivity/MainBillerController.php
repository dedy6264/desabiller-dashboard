<?php

namespace App\Http\Controllers\MerchantOutletActivity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MainBillerController extends Controller
{

    public function index()
    {
        $response = Http::withBasicAuth('joe','secret')->post('202.10.41.137:10010/category/gets', [
            'id' => 0,
            'clientName' => "",
            'limit' => 0,
            'offset' => 0,
            'orderBy' => "",
            'startDate' => "",
            'endDate' => "",
            'username' => "",
        ])->json();
        // dd($response);

         if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $response = $response['result'];
        $dataRes = $response['data'] ?? [];
        // dd($dataRes);
        // dd("welcome to merchantActivity");
        return view("dashboard.content",compact('dataRes'));
    }
    // function getPrefix($idCustomer){

    // }
    public function getProducts(Request $request){
        $validate=$request->validate([
            'idCustomer'=>'required',
        ]);
        if ($request->categoryId){
            //get prefix
            //get produk by prefix
            $response = Http::withBasicAuth('joe','secret')->post('202.10.41.137:10010/product/gets', [
                'productCategoryId'=>(int)$request->categoryId,
                ])->json();
                // dump($response);
        }else{
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $response = $response['result'];
        $dataProducts = $response['data'] ?? [];
        if(count($dataProducts)==0){
            return back()->with('fail','Product kosong, hubungi administrator');
        }
        $idCustomer=$request->idCustomer;

        return view("dashboard.biller.showProduct.content",compact('dataProducts','idCustomer'));
    }
    public function inquiry(Request $request){
       
        if ($request->idCustomer=="" || $request->idCustomer==0){
            dd($request->all());
            return back()->with('fail','customer id cannot be null');
        }
        $additional=[
            'subscriberNumber'=>$request->idCustomer,
        ];
        $payload=[
            'productCode'=>$request->productCode,
            'additionalField'=>$additional,
        ];
        dump($payload);
        $response = Http::withHeaders([
            'Authorization'=>'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3MzIyODM1MjYsIm1lcmNoYW50SWQiOjEsIm91dGxldElkIjoyLCJvdXRsZXRVc2VybmFtZSI6InRhdWNpa3VlbmFrIn0.RhqwJwD8FhIeofjhQwuZWnL6ihhUaRfaQcvCyewqEj8',
            'Content-Type' => 'application/json' 
            ])
        ->post('202.10.41.137:10010/biller/inquiry', $payload)->json();
            dump($response);
    }
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
        //
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
