<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;

use App\Backlog;
use App\Sprintbacklog;
use App\Aplication;
use Session;

class BackLogsController extends Controller
{

    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $backlogs = Backlog::with('aplikasi')->get();
            return Datatables::of($backlogs)
            ->escapeColumns([])
            ->addColumn('action', function($backlog) {
                return view('datatable._action', [
                    'model' => $backlog,
                    'form_url' => route('backlog.destroy', $backlog->id_backlog),
                    'edit_url' => route('backlog.edit', $backlog->id_backlog),
                    'confirm_message' => 'Yakin mau menghapus ' . $backlog->nama_backlog . '?'
                ]);
            })
            ->addColumn('nama_backlog', function($backlog) {
                return '<a title="Detail Backlog" href="'.route('backlog.show', $backlog->id_backlog).'">'.$backlog->nama_backlog.'</a>';

            // })->addColumn('no_urut', function($backlog) {
                // return view('datatable._noUrut', [
                //     'angka' => $backlog->getKolomAttribute()
                // ]);
                // return $backlog->getKolomAttribute();
                
            })->make(true);
        }
        $html = $htmlBuilder
            // ->addColumn(['data' => 'no_urut', 'name' => 'no_urut', 'title' => 'No.'])
        ->addColumn(['data' => 'aplikasi.nama', 'name' => 'aplikasi.nama', 'title' => 'Aplikasi'])
        ->addColumn(['data' => 'nama_backlog', 'name' => 'nama_backlog', 'title' => 'Nama Backlog'])
            // ->addColumn(['data' => 'demo', 'name' => 'demo', 'title' => 'Demo'])
            // ->addColumn(['data' => 'catatan', 'name' => 'catatan', 'title' => 'Catatan'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => false]);
        return view('backlog.index')->with(compact('html'));
    }

    public function create()
    {
        return view('backlog.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'aplikasi_id' => 'required|exists:aplications,id',
            'nama_backlog' => 'required',
            'demo' => 'required',
            'catatan' => ''
        ]);
        $backlog = Backlog::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success", 
            "message"=>'Berhasil menyimpan "' . $backlog->nama_backlog . '" !'
        ]);
        return redirect()->route('backlog.index');
    }

    public function show($id)
    {
        $backlog = Backlog::find($id);
        return view('backlog.show', compact('backlog'));
    }

    public function edit($id)
    {
        $backlog = Backlog::find($id);
        return view('backlog.edit')->with(compact('backlog'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'aplikasi_id' => 'required|exists:aplications,id',
            'nama_backlog' => 'required',
            'demo' => 'required',
            'catatan' => ''
        ]);
        $backlog = Backlog::find($id);
        $backlog->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => 'Berhasil menyimpan "'. $backlog->nama_backlog .'"'
        ]);
        return redirect()->route('backlog.index');
    }

    public function destroy($id)
    {

        // Mengecek apakah backlog sedang digunakan
        $sprintBacklog = Sprintbacklog::where('id_backlog', $id)->count();
        if ($sprintBacklog > 0) {

            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Backlog Tidak Bisa Dihapus. Karena Sudah Terpakai."
            ]);

            return redirect()->route('backlog.index');
        }
        else {

            $backlog = Backlog::find($id);
            $backlog->delete();
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => 'Backlog "'. $backlog->nama_backlog .'" berhasil dihapus'
            ]);

            return redirect()->route('backlog.index');
            
        }

    }

}
