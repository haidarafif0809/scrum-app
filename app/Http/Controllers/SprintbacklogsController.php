<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use App\Sprintbacklog; 
use Yajra\Datatables\Html\Builder; 
use Yajra\Datatables\Datatables; 
use Session; 
 
class SprintbacklogsController extends Controller 
{ 
    /** 
     * Display a listing of the resource. 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function index(Request $request, Builder $htmlBuilder) 
    { 
        if ($request->ajax()) { 
            $sprintbacklogs = Sprintbacklog::select(['id','backlog_id', 'isi_kepentingan', 'perkiraan_waktu']); 
            return Datatables::of($sprintbacklogs) 
                ->addColumn('action', function($sprintbacklog){ 
             
            return view('datatable._action', [ 
                'model' => $sprintbacklog, 
                'form_url'=> route('sprintbacklogs.destroy', $sprintbacklog->id), 
                'edit_url' => route('sprintbacklogs.edit', $sprintbacklog->id), 
                'confirm_message' => 'Yakin mau menghapus ' . $sprintbacklog->backlog . '?' 
            ]); 
        })->make(true); 
        } 
 
        $html = $htmlBuilder 
            ->addColumn(['data' => 'backlog_id', 'name'=>'backlog_id', 'title'=>'Backlog']) 
            ->addColumn(['data' => 'isi_kepentingan', 'name'=>'isi_kepentingan', 'title'=>'Isi Kepentingan']) 
            ->addColumn(['data' => 'perkiraan_waktu', 'name'=>'perkiraan_waktu', 'title'=>'Perkiraan Waktu']) 
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Aksi', 'orderable'=>false, 'searchable'=>false]); 
 
        return view('Sprintbacklogs.index')->with(compact('html')); 
    } 
 
    /** 
     * Show the form for creating a new resource. 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function create() 
    { 
        return view('Sprintbacklogs.create'); 
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
            'backlog' => 'required|unique:sprintbacklogs', 
            'isi_kepentingan' => 'required|unique:sprintbacklogs', 
            'perkiraan_waktu' => 'required|unique:sprintbacklogs']); 
        $sprintbacklog = Sprintbacklog::create($request->all()); 
        Session::flash("flash_notification", [ 
            "level" => "success", 
            "message" =>" Berhasil menyimpan $sprintbacklog->backlog" 
]); 
        return redirect()->route('sprintbacklogs.index'); 
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
        $sprintbacklog = Sprintbacklog::find($id); 
        return view('sprintbacklogs.edit')->with(compact('sprintbacklog')); 
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
        $sprintbacklog = Sprintbacklog::find($id); 
        $sprintbacklog->update($request->only('backlog', 'isi_kepentingan', 'perkiraan_waktu')); 
        Session::flash("flash_notification", [ 
            "level"=>"success", 
            "message"=>"Berhasil menyimpan $sprintbacklog->backlog" 
        ]); 
         
        return redirect()->route('sprintbacklogs.index'); 
    } 
 
 
    public function destroy($id) 
    { 
        Sprintbacklog::destroy($id); 
 
        Session::flash("flash_notification", [ 
            "level" => "success", 
            "message" => "Data Berhasil Di Hapus" 
            ]); 
        return redirect()->route('sprintbacklogs.index'); 
    } 
}