<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;

class AlternatifController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['alternatif'] = Alternatif::get();
        return view('admin.alternatif.index',$data);
    }

    public function validator (Request $request)
    {
        return Validator::make($request->all(),[
        'nama_alternatif' => 'required|string',
        'NIM' => 'required|string',
   
        ]);
    }   
    public function store (Request $request)
    {
        // $this->validate($request->all(),[
        //     'nama_kriteria' => 'required|string',
        //     'atribut' => 'required|string',
        //     'bobot' => 'required|number'
        // ]);

        try{
            $alternatif = new Alternatif();
            $alternatif->nama_alternatif = $request->nama_alternatif; 
            $alternatif->NIM = $request->NIM; 
            $alternatif->save();
            return back()->with(['message','Berhasil menambahkan data']);
        } catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:". $e->getMessage());
            die("Gagal");
        }
    }

    public function edit($id)
    {
        $data['alternatif'] = Alternatif::findorFail($id);
        return view ('admin.alternatif.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama_alternatif' => 'required|string',
            'NIM' => 'required|string',
  
        ]);

        try{
           $alternatif = Alternatif::findorFail($id);
           $alternatif->update([
                'nama_alternatif' => $request->nama_alternatif,
                'NIM' => $request->NIM,
           ]);
           return back()->with(['message','Berhasil merubah data']);
        } catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:". $e->getMessage());
            die("Gagal");
        }
    }

    
    public function destroy($id)
    {
     
        try{
            $alternatif = Alternatif::findOrFail($id);
            $alternatif->delete();
            return back()->with('msg','Berhasil Menghapus Data');
        }catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:". $e->getMessage());
            die("Gagal");
        }
  
    }
}
