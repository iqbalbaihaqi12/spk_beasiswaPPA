<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;

class PenilaianController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::with('penilaian.crips')->get();
        $kriteria = Kriteria::get();
        return view('admin.penilaian.index',compact('alternatif','kriteria'));
    }

    public function store(Request $request)
    {
        // return response()->json($request);
        try{
            
            foreach ($request->crips_id as $key => $value)
           {
                foreach($value as $key_1 => $value_1)
                {
                    Penilaian::create([
                        'alternatif_id' => $key,
                            'crips_id' =>  $value_1
                        ]);
                }
           }

           return back()->with('msg','Data Berhasil Disimpan');
        }catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:". $e->getMessage());
            die("Gagal");
        }
    }

}   
