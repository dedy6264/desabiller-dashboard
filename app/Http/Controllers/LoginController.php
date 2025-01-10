<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;



class LoginController extends Controller
{

    public function logout(){
        session()->regenerate();
        session()->invalidate();
        return redirect()->route('login');
    }
    public function index()
    {
        if (session()->has('user')){
             return redirect()->route('home');
        }
       return view('dashboard.biller.login.content');
    }

    public function login(Request $request)
    {
        // dd($request->all());
        // $response=$this->loginBackend($request->username, $request->password);
        $payload=[
            "merchantOutletUsername"=>$request->username,//"taucikuenak",
            "merchantOutletPassword"=>$request->password,//"ad6264ul",
        ];
        $response = Http::withHeaders([
            'Authorization'=>'Bearer '.env('TOKEN'),
            'Content-Type' => 'application/json' 
            ])
        ->post('http://localhost:10010/login/', $payload)->json();

        if($response['statusCode']!=="00"){
            // dd($response,$payload);
            // Log::error('API Error: ' . $response['statusMessage']);
            // return response()->json(['error' => 'Invalid API response format or data type'], 500);
            return redirect()->route('login')->withErrors([
                'password' => $response['statusMessage'],
            ]);
        }
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $response = (object)$response['result'];
        // dd($response->id);
        $userData = [
            'id' => $response->id,
            'merchantOutletName' => $response->merchantOutletName,
            'merchantOutletUsername' => $response->merchantOutletUsername,
            'merchantName' => $response->merchantName,
            'token' => $response->token,
        ];
        session(['user' => $userData]);
        session()->regenerate() ;
        // Login pengguna menggunakan guard
        // Auth::loginUsingId($userData['id']);
        // dump("SUKSESS");
        // dd(session()->all());
        // dump("klklk");
        return redirect()->route("home");
    }

    // public function loginBackend($username, $password){
    //     $payload=[
    //         "merchantOutletUsername"=>$username,//"taucikuenak",
    //         "merchantOutletPassword"=>$password,//"ad6264ul",
    //     ];
    //     $response = Http::withHeaders([
    //         'Authorization'=>'Bearer '.env('TOKEN'),
    //         'Content-Type' => 'application/json' 
    //         ])
    //     ->post('http://localhost:10010/login/', $payload)->json();
        
    //     if($response['statusCode']!=="00"){
    //         // dd($response,$payload);
    //         // Log::error('API Error: ' . $response['statusMessage']);
    //         return response()->json(['error' => 'Invalid API response format or data type'], 500);
    //         // return redirect()->route('login')->withErrors([
    //         //     'password' => $response['statusMessage'],
    //         // ]);
    //     }
    //     if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
    //         return response()->json(['error' => 'Invalid API response format or data type'], 500);
    //     }
    //     $response = $response['result'];
    //     // dump($response);
    //     return (object)$response;
    // }
}
