<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Temperature;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    function getData(){
        $data = Temperature::all();
        return response()->json([
            "message" => "Data Temperature Berhasil Diperoleh", 
            "data"    => $data
        ], 200);
    }

    function insertTemperature(Request $request){
        $value = $request->temperature;
        $temperature = Temperature::create(['value' => $value]);
        return response()->json([
            "message" => "Data Temperature Berhasil Dimasukkan", 
            "data"    => $temperature
        ], 201);
    }

}
