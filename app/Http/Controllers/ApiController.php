<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function sendResponse($result,$message){
        $response=[
            'success'=> true,
            'data' => $result,
            'message'=>$message
        ];
        return response()->json($response,200);
    }

    public function sendError($error,$code=404,$errorMessages=[]){
        $response=[
            'success'=> false,
            'error' => $error,
            'errorMessages'=>$errorMessages
        ];
        return response()->json($response,$code);
    }
    
}
