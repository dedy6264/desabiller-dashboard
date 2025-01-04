<?php

namespace App\Http\Controllers\MerchantOutletActivity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MainBillerController extends Controller
{

    public function index(){
        $response = Http::withBasicAuth('joe','secret')->post('http://localhost:10010/category/gets', [
        // $response = Http::withBasicAuth('joe','secret')->post('202.10.41.137:10010/category/gets', [
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
        return view("dashboard.biller.content",compact('dataRes'));
    }
    public function showProducts(){
        return view("dashboard.biller.showProduct.content");

    }
    public function showProductKhusus(Request $request){
        $nomorTujuan = $request->input('nomorTujuan');
        {
            $response = Http::withBasicAuth('joe','secret')->post('http://localhost:10010/helper/getReference', [
                'subscriberId' => $nomorTujuan,
            ])->json();
            if ($response['statusCode']!=="00"){
                return response()->json(['error' => 'operator not found'], 400);
            }
            if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
                return response()->json(['error' => 'Invalid API response format or data type'], 500);
            }
            $response = $response['result'];
            $dataRes = $response['data'] ?? [];
            // dd($dataRes['productReferenceCode']);
        }
        {
            $response = Http::withBasicAuth('joe','secret')->post('http://localhost:10010/product/gets', [
                "productReferenceCode"=>$dataRes['productReferenceCode'],
            ])->json();
            if ($response['statusCode']!=="00"){
                return response()->json(['error' => 'operator not found'], 400);
            }
            if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
                return response()->json(['error' => 'Invalid API response format or data type'], 500);
            }
            $response = $response['result'];
            $dataRes = $response['data'] ?? [];
            // dd($dataRes);
        }
        // Validasi nomor
        if (strlen($nomorTujuan) < 4) {
            return response()->json(['error' => 'Nomor tidak valid'], 400);
        }
    
        // Simulasi data berdasarkan nomor
        // $layanan = [
        //     ['namaLayanan' => 'Three 5.000', 'harga' => '6.705'],
        //     ['namaLayanan' => 'Three 10.000', 'harga' => '11.740'],
        //     ['namaLayanan' => 'Three 15.000', 'harga' => '16.315'],
        // ];
        $layanan=$dataRes;
        return response()->json($layanan);
    }
    public function inquiry(Request $request){
        // dd($request->all());

        if ($request->subscriberNumber=="" || $request->subscriberNumber==0){
            // dd($request->all());
            return back()->with('fail','customer id cannot be null');
        }
        $additional=[
            'subscriberNumber'=>$request->subscriberNumber,
        ];
        $payload=[
            'productCode'=>$request->productCode,
            'additionalField'=>$additional,
        ];
        // dump($payload);
        $response = Http::withHeaders([
            'Authorization'=>'Bearer '.env('TOKEN'),
            'Content-Type' => 'application/json' 
            ])
        ->post('http://localhost:10010/biller/inquiry', $payload)->json();
        // ->post('202.10.41.137:10010/biller/inquiry', $payload)->json();
        // dd($response);
        if ($response['statusCode']!=="10"){
            if($response['message']=="invalid or expired jwt"){
                return response()->json(['error' => 'invalid or expired jwt'], 400);
            }
            return response()->json(['error' => 'operator not found'], 400);
        }
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $response = $response['result'];
        // dump($response);
        $dataInq = $response['data'] ?? [];
        // dump($dataInq);

        return response()->json($response);

    }
    public function payment(Request $request){
        // dump($request->all());
        $payload=[
            'referenceNumber'=>$request->referenceNumber,
        ];
        $response = Http::withHeaders([
            'Authorization'=>'Bearer '.env('DB_CONNECTION', 'mysql'),
            'Content-Type' => 'application/json' 
            ])
        ->post('http://localhost:10010/biller/payment', $payload)->json();
        // ->post('202.10.41.137:10010/biller/inquiry', $payload)->json();
        // dump($response);
        // if ($response['statusCode']!=="00" || $response['statusCode']!=="05"){
        //     dump($response['statusCode']);
        //     return response()->json(['error' => 'operator not found'], 400);
        // }
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $response = $response['result'];
        $dataInq = $response['data'] ?? [];
        // return response()->json(['error' => 'operator not found'], 200);
        return response()->json($response);
    }
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
    public function trxReport(Request $request){
        // dump($request->all());
        return view('dashboard.biller.showProduct.trxReport');
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
