<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Temperature;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    public function getTemperature()
    {
        $data = Temperature::all();

        if ($data->isEmpty()) {
            return response()->json([
                "message" => "Tidak ada data temperature ditemukan"
            ], 404);
        }

        return response()->json([
            "message" => "Data Temperature Berhasil Diperoleh", 
            "data"    => $data
        ], 200);
    }

    public function insertTemperature(Request $request)
    {
        // Validasi input
        $request->validate([
            'temperature' => 'required|numeric' // Pastikan input berupa angka
        ]);

        // Simpan data suhu baru
        $value = $request->temperature;
        $temperature = Temperature::create(['value' => $value]);

        // Berikan respons yang sesuai
        return response()->json([
            "message" => "Data Temperature Berhasil Dimasukkan", 
            "data"    => $temperature
        ], 201);
    }
}
