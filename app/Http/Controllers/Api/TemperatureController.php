<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Temperature;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    function getData()
    {
        try {
            $data = Temperature::all();
            return response()->json([
                "message" => "Data Temperature Berhasil Diperoleh",
                "data"    => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Terjadi kesalahan saat mengambil data temperature",
                "error"   => $e->getMessage()
            ], 500);
        }
    }

    function insertTemperature(Request $request)
    {
        $validatedData = $request->validate([
            'temperature' => 'required|numeric|min:0|max:100'
        ]);

        try {
            $temperature = Temperature::create(['value' => $validatedData['temperature']]);
            return response()->json([
                "message" => "Data Temperature Berhasil Dimasukkan",
                "data"    => $temperature
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Terjadi kesalahan saat menyimpan data temperature",
                "error"   => $e->getMessage()
            ], 500);
        }
    }

    function updateTemperature(Request $request, $id)
    {
        $validatedData = $request->validate([
            'temperature' => 'required|numeric|min:0|max:100'
        ]);

        try {
            $temperature = Temperature::findOrFail($id);
            $temperature->value = $validatedData['temperature'];
            $temperature->save();

            return response()->json([
                "message" => "Data Temperature Berhasil Diperbarui",
                "data"    => $temperature
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Terjadi kesalahan saat memperbarui data temperature",
                "error"   => $e->getMessage()
            ], 500);
        }
    }

    function deleteTemperature($id)
    {
        try {
            $temperature = Temperature::findOrFail($id);
            $temperature->delete();

            return response()->json([
                "message" => "Data Temperature Berhasil Dihapus"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Terjadi kesalahan saat menghapus data temperature",
                "error"   => $e->getMessage()
            ], 500);
        }
    }
}