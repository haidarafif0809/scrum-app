<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Sprint;
use Session;

class SprintsController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
	{
		if ($request->ajax()) {
			$sprints = Sprint::select(['id','kode_sprint', 'nama_sprint']);
	            return Datatables::of($sprints)
                ->addColumn('action', function($sprint) {
                    return view('datatable._action', [
                        'model' => $sprint,
                        'backlog' => route('backlog.index'),
                        'form_url' => route('sprints.destroy', $sprint->id),
                        'edit_url'=>route('sprints.edit', $sprint->id),
                        'confirm_message' => 'Yakin anda ingin menghapus' . $sprint->nama_sprint . '?' 
                    ]);
                }) 

                ->addColumn('backlog', function($sprint) {
                    return view('datatable._backlog', [
                        'backlog' => route('backlog.show',$sprint->id),
                        
                    ]);
                })->make(true);
		}
		$html = $htmlBuilder
			->addColumn(['data' => 'kode_sprint', 'name' =>  'kode_sprint', 'title' =>  'Kode Sprint'])
            ->addColumn(['data' => 'nama_sprint', 'name' =>'nama_sprint', 'title'   =>'Nama Sprint'])
			->addColumn(['data' => 'backlog',      'name' =>  'backlog', 'title'      => 'Backlog', 'orderable' => false, 'searchable' => false])
            ->addColumn(['data' => 'action', 'name'      =>  'action', 'title'      => 'Aksi', 'orderable' => false, 'searchable' => false]);
		
		return view('sprints.index')->with(compact('html'));
	}
    public function create()
    {
        return view('sprints.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        	'kode_sprint'=>'required|unique:sprints' ,
    		'nama_sprint'=>'required|unique:sprints'
    	]);
    	$sprint = Sprint::create($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan Sprint ".$sprint->kode_sprint." & ".$sprint->nama_sprint.""]);
    	return redirect()->route('sprints.index');

    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $sprint = Sprint::find($id);
        return view('sprints.edit')->with(compact('sprint'));
    }
    public function update(Request $request, $id)
    {
            $this->validate($request, [
            'kode_sprint' => 'required|unique:sprints,kode_sprint',
            'nama_sprint' => 'required|unique:sprints,nama_sprint,'
            . $id]);
            $sprint = Sprint::find($id);
            $sprint->update($request->only('kode_sprint', 'nama_sprint'));
            
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan ".$sprint->kode_sprint." & ".$sprint->nama_sprint.""
            ]);
            
            return redirect()->route('sprints.index');
    }
    public function destroy($id)
    {
        Sprint::destroy($id);

        Session::flash("flash_notification", [
            "level"     => "success",
            "message"   => "Data berhasil di hapus"
        ]);

        return redirect()->route('sprints.index');
    }

}


