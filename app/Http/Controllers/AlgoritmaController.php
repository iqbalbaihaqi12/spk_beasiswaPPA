<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;

class AlgoritmaController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }


    public function index()
    {
        $alternatif = Alternatif::with('penilaian.crips')->get();
        $kriteria = Kriteria::with('crips')->get();
        $penilaian = Penilaian::with('crips','alternatif')->get();

        if (count($penilaian) == 0 ){
            return redirect(route('penilaian.index'));
        }
        // dd($kriteria);

        //mencari nilai MinMax
        foreach ($kriteria as $key => $value){
            foreach ($penilaian as $key_1 => $value_1){
                if ($value->id == $value_1->crips->kriteria_id){
                    if($value->atribut == 'Benefit'){
                        $minMax[$value->id][]= $value_1->crips->bobot;
                    }elseif($value->atribut == 'Cost'){
                        $minMax[$value->id][]= $value_1->crips->bobot;
                    }
                }
            }
        }
        //Normalisasi 
        foreach ($penilaian as $key_1 => $value_1){
            foreach ($kriteria as $key => $value){
                if ($value->id == $value_1->crips->kriteria_id){
                    if ($value->atribut == 'Benefit'){
                        $normalisasi[$value_1->alternatif->nama_alternatif][$value->id][] = $value_1->crips->bobot / max($minMax[$value->id]);
                    }elseif($value->atribut == 'Cost'){
                        $normalisasi[$value_1->alternatif->nama_alternatif][$value->id][] = min($minMax[$value->id]) / $value_1->crips->bobot;
                    }
                }
            }
        }
        // dd($normalisasi
        //Perangkingan
        foreach ($normalisasi as $key => $value){
            foreach ($kriteria as $key_1 => $value_1){
                $rank[$key][] = $value[$value_1->id][0] * $value_1->bobot;
            }
        }
        // dd($rank);
        $rangking = $normalisasi;
        foreach ($normalisasi as $key => $value){
            $rangking[$key][] = array_sum($rank[$key]);
        }
        arsort($rangking);
        // dd($rangking);
        return view('admin.perangkingan.index',compact('alternatif','kriteria','normalisasi','rangking'));
    }
}

