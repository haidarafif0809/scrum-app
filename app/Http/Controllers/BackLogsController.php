<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Backlog;
use Session;

class BackLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('backlog.index');
    // }

    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $backlog = Backlog::all();
            return Datatables::of($backlog)->addColumn('action', function($backlog) {
                return view('datatable._action', [
                    'model' => $backlog,
                    'form_url' => route('backlog.destroy', $backlog->id),
                    'edit_url' => route('backlog.edit', $backlog->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $backlog->nama . '?'
                ]);
            // })->addColumn('no_urut', function($backlog) {
                // return view('datatable._noUrut', [
                //     'angka' => $backlog->getKolomAttribute()
                // ]);
                // return $backlog->getKolomAttribute();
          
            })->make(true);
        }
        $html = $htmlBuilder
            // ->addColumn(['data' => 'no_urut', 'name' => 'no_urut', 'title' => 'No.'])
            ->addColumn(['data' => 'aplikasi', 'name' => 'aplikasi', 'title' => 'Aplikasi'])
            ->addColumn(['data' => 'nama', 'name' => 'nama', 'title' => 'Nama'])
            ->addColumn(['data' => 'demo', 'name' => 'demo', 'title' => 'Demo'])
            ->addColumn(['data' => 'catatan', 'name' => 'catatan', 'title' => 'Catatan'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => false]);;
        return view('backlog.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backlog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'aplikasi' => 'required|unique:backlogs,aplikasi',
            'nama' => 'required',
            'demo' => 'required',
            'catatan' => ''
        ]);
        $backlog = Backlog::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success", 
            "message"=>"Berhasil menyimpan $backlog->nama"
        ]);
        return redirect()->route('backlog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $backlog = Backlog::find($id);
        return view('backlog.edit')->with(compact('backlog'));
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
        $this->validate($request, [
            'aplikasi' => 'required|unique:backlogs,aplikasi,' . $id,
            'nama' => 'required',
            'demo' => 'required',
            'catatan' => ''
        ]);
        $backlog = Backlog::find($id);
        $backlog->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan $backlog->nama"
        ]);
        return redirect()->route('backlog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $backlog = Backlog::find($id);
        $backlog->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Buku berhasil dihapus"
        ]);
        return redirect()->route('backlog.index');
    }
}
