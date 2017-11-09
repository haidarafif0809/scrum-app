<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aplication;
use App\Backlog;
use Excel;
use Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use Session;

class AplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
           $aplications = Aplication::select(['id', 'kode', 'nama']);
           return Datatables::of($aplications)
           ->escapeColumns([])
           ->addColumn('nama', function($aplication) {
            return '<a href="'.route('aplikasi.show', $aplication->id).'">'.$aplication->nama.'</a>';
        })
           ->addColumn('action', function($aplications){
            return view('datatable._action_aplikasi', [
                'model'    => $aplications,
                'id_aplikasi' => $aplications->id,
                'form_url' => route('aplikasi.destroy', $aplications->id),
                'edit_url' => route('aplikasi.edit', $aplications->id),
                'confirm_message' => 'Yakin mau menghapus '."$aplications->nama.?"
            ]);
        })->make(true);
       }
       $html = $htmlBuilder
       ->addColumn(['data' => 'kode', 'name'=>'kode', 'title'=>'Kode Aplikasi'])
       ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Nama Aplikasi'])
       ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Aksi', 'orderable'=>false,'searchable'=>false]);


       return view('aplikasi.index')->with(compact('html'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('aplikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'kode' => 'required|unique:aplications',
            'nama' => 'required|unique:aplications'
        ]);
        $aplikasi = Aplication::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambahkan ".$aplikasi->nama.""
        ]);
        return redirect()->route('aplikasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aplikasi = Aplication::find($id);
        $listBacklog = Backlog::where('aplikasi_id', $id)->get();
        return view('aplikasi.show', compact('aplikasi', 'listBacklog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //membuat proses edit
        $aplication = Aplication::find($id);
        return view('aplikasi.edit')->with(compact('aplication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'kode' => 'required|unique:aplications,kode,' . $id,
            'nama' => 'required|unique:aplications,nama,'. $id 
        ]);
        $aplication = Aplication::find($id);
        $aplication->update($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubah ".$aplication->nama.""
        ]);
        return redirect()->route('aplikasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data_backlog = Backlog::where('aplikasi_id', $id)->count();

         //JIKA APLIKASI SUDAH TERPAKAI
        if ($data_backlog > 0) {

            //PERINGTAN TIDAK BISA DIHAPUS
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Aplikasi Tidak Bisa Dihapus. Karena Sudah Terpakai."
            ]);

            return redirect()->route('aplikasi.index');

        }
        else{

            //membuat proses hapus
            Aplication::destroy($id);
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Aplikasi berhasil dihapus"
            ]);
            return redirect()->route('aplikasi.index');

        }
    }

    public function export (){ return view ('aplikasi.export'); }

    public function exportPost(Request $request) { 
        // validasi
        $this->validate($request, [
            'aplikasi_id'=>'required',
        ], [
            'aplikasi_id.required'=>'Pilih minimal 1 Aplikasi.'
        ]);
        $aplikasi = Aplication::whereIn('id', $request->get('aplikasi_id'))->get();
        Excel::create('Data Aplikasi', function($excel) use ($aplikasi) {
        // Set property
            $excel->setTitle('Data Aplikasi')
            ->setCreator(Auth::user()->name);
            $excel->sheet('Data Aplikasi', function($sheet) use ($aplikasi) {
                $row = 1;
                $sheet->row($row, [
                    'kode',
                    'nama'
                ]);
                foreach ($aplikasi as $app) {
                    $sheet->row(++$row, [
                        $app->kode,
                        $app->nama
                    ]);
                }
            });
        })->export('xls');
    }

    public function exportAll()
    {
        $data = Aplication::select('kode', 'nama')->get()->toArray();
        return Excel::create('Data Aplikasi', function($excel) use ($data) {
            $excel->sheet('Data Aplikasi', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xls');
    }

    public function generateExcelTemplate() {
        Excel::create('Template Import Aplikasi', function($excel) {

            $excel->setTitle('Template Import Aplikasi')
            ->setCreator('Aplikasi Scrum')
            ->setCompany('Aplikasi Scrum')
            ->setDescription('Template import aplikasi untuk Aplikasi Scrum');
            $excel->sheet('Data Aplikasi', function($sheet) {
                $row = 1;
                $sheet->row($row, [
                    'kode',
                    'nama'
                ]);
            });
        })->export('xlsx');
    }
    public function importExcel(Request $request) {
    // validation
        $this->validate($request, [ 'excel' => 'required|mimes:xls,xlsx' ]);
    // get file
        $excel = $request->file('excel');
    // read first sheet
        $excels = Excel::selectSheetsByIndex(0)->load($excel, function($reader) {
    // options
        })->get();
    // row validation
        $rowRules = [
            'kode' => 'required',
            'nama' => 'required'
        ];
    // record id for count successfull app imported 
        $aplikasi_id = [];
    // looping anyline, starting from the second line
        foreach ($excels as $row) {
    // make validation for row and change the line in proses to array
            $validator = Validator::make($row->toArray(), $rowRules);
    // Skip this line if not valid
            if ($validator->fails()) continue;
    // make new app
            $aplikasi = Aplication::create([
                'kode' => $row['kode'],
                'nama' => $row['nama']
            ]);
    // record new app id
            array_push($aplikasi_id, $aplikasi->id);
        }
    // get all app
        $aplikasi = Aplication::whereIn('id', $aplikasi_id)->get();
    // redirect to form if nothing successful app to import
        if ($aplikasi->count() == 0) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Tidak ada aplikasi yang berhasil diimport."
            ]);
            return redirect()->back();
        }
    // set feedback
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengimport " . $aplikasi->count() . " aplikasi."
        ]);
    // back to index
        return redirect()->route('aplikasi.index');
    }

}
