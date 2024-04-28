<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Crips;
use App\Models\Kriteria;


class CripsController extends Controller
{
    public function validator (Request $request)
    {
        return Validator::make($request->all(),[
            'kriteria_id'=> 'required',
            'nama_crips' => 'required|string',
            'bobot'      => 'required|numeric'
        ]);
    }   
    public function store (Request $request)
    {
        $this->validate($request,[
            'kriteria_id'=> 'required',
            'nama_crips' => 'required|string',
            'bobot'      => 'required|numeric'
        ]);

        try {
            $crips = new Crips();
            $crips->kriteria_id = $request->kriteria_id;
            $crips->nama_crips = $request->nama_crips;
            $crips->bobot = $request->bobot;
            $crips->save(); 
            return back()->with('msg','Berhasil Menambahkan Data');
        } catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:". $e->getMessage());
            die("Gagal");
        }
    }

    public function edit($id)
    {
         $data['crips'] = Crips::findorFail($id);
       

         return view('admin.crips.edit',$data);
    }

    public function update(Request $request,$id)
    {
        try{
            $crips = Crips::findOrFail($id);
            $crips->update([
                'nama_crips'  => $request->nama_crips,
                'bobot'       => $request->bobot
            ]);
            return back()->with('msg','Berhasil Merubah Data');
        }catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:". $e->getMessage());
            die("Gagal");
        }
    }

    public function destroy($id)
    {
        try{
            $crips = Crips::findOrFail($id);
            $crips->delete();
            return back()->with('msg','Berhasil Menghapus Data');
        }catch (Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:". $e->getMessage());
            die("Gagal");
        }
    }
}
