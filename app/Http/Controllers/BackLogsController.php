<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Backlog;

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
            $backlog = Backlog::select(['aplikasi', 'nama', 'demo', 'catatan'])->get();
            return Datatables::of($backlog)->make(true);
        }
        $html = $htmlBuilder
            ->addColumn(['data' => 'aplikasi', 'name' => 'aplikasi', 'title' => 'Aplikasi'])
            ->addColumn(['data' => 'nama', 'name' => 'nama', 'title' => 'Nama'])
            ->addColumn(['data' => 'demo', 'name' => 'demo', 'title' => 'Demo'])
            ->addColumn(['data' => 'catatan', 'name' => 'catatan', 'title' => 'Catatan']);
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
        //
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
