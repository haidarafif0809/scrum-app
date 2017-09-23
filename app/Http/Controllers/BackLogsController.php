<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Backlog;

class BackLogsController extends Controller
{

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

    public function create()
    {
        return view('backlog.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
