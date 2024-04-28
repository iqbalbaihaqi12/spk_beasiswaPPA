<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Crips;


class KriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['kriteria'] = Kriteria::orderBy('nama_kriteria','ASC')->get();
        return view('admin.kriteria.index',$data);
    }

    public function validator (Request $request)
    {
        return Validator::make($request->all(),[
        'nama_kriteria' => 'required|string',
        'atribut' => 'required|string',
        'bobot' => 'required|numeric'
        ]);
    }   
    public function store (Request $request)
    {
        $this->validate($request,[
            'nama_kriteria' => 'required|string',
            'atribut' => 'required|string',
            'bobot' => 'required|numeric'
        ]);

        try{
            $kriteria = new Kriteria();
            $kriteria->nama_kriteria = $request->nama_kriteria;
            $kriteria->atribut = $request->atribut;
            $kriteria->bobot = $request->bobot;  
            $kriteria->save();
            return back()->with(['msg','Berhasil menambahkan data']);
        } catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:". $e->getMessage());
            die("Gagal");
        }
    }

    public function edit($id)
    {
        $data['kriteria'] = Kriteria::findorFail($id);
        return view ('admin.kriteria.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama_kriteria' => 'required|string',
            'atribut' => 'required|string',
            'bobot' => 'required|numeric'
        ]);

        try{
           $kriteria = Kriteria::findorFail($id);
           $kriteria->update([
                'nama_kriteria' => $request->nama_kriteria,
                'atribut' => $request->atribut,
                'bobot' => $request->bobot
           ]);
           return back()->with(['msg','Berhasil merubah data']);
        } catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:". $e->getMessage());
            die("Gagal");
        }
    }

    
    public function destroy($id)
    {
     
        try{
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->delete();
            return back()->with('msg','Berhasil Menghapus Data');
        }catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:". $e->getMessage());
            die("Gagal");
        }
    }

    public function show($id)
    {
        $data['crips'] = Crips::where('kriteria_id',$id)->get();
        $data['kriteria'] = Kriteria::findorFail($id);
        return view('admin.kriteria.show',$data);
    }
}
