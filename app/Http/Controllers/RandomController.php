<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RandomController extends Controller
{
    public function index(Request $request){

        if($request->method() === "POST"){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://trielumen.test/index?something=".$request->counts);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $api_response = curl_exec($ch);
            $responseInfo = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if($responseInfo === 200){
                return json_encode(['status'=>true, 'responseInfo' => $request->all(), 'something' => $api_response]);
            }else{
                return json_encode(['status'=>true, 'responseInfo' => $request->all(), 'something' => $api_response]);
            }
        }else{

            return view('welcome');
        }
    }
}
