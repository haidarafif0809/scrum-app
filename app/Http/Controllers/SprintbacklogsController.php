<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Sprintbacklog; 
use App\Sprint; 
use Session; 
 
class SprintbacklogsController extends Controller 
{ 
    public function index(Request $request, Builder $htmlBuilder) 
    { 
        if ($request->ajax()) { 
            $sprintbacklogs = Sprintbacklog::select(['id', 'id_sprint', 'isi_kepentingan', 'perkiraan_waktu', 'id_backlog']); 
            return Datatables::of($sprintbacklogs) 
                ->addColumn('action', function($sprintbacklog){ 
                return view('datatable._action', [ 
                    'model' => $sprintbacklog, 
                    'form_url'=> route('sprintbacklogs.destroy', $sprintbacklog->id), 
                    'edit_url' => route('sprintbacklogs.edit', $sprintbacklog->id), 
                    'confirm_message' => 'Yakin mau menghapus ' . $sprintbacklog->nama_backlog . '?' 
                ]);             
            })->make(true); 
        } 
 
        $html = $htmlBuilder 
            // ->addColumn(['data' => 'aplikasi_id', 'name'=>'aplikasi_id', 'title'=>'Aplikasi']) 
            ->addColumn(['data' => 'id_backlog', 'name'=>'id_backlog', 'title'=>'Nama Backlog']) 
            ->addColumn(['data' => 'isi_kepentingan', 'name'=>'isi_kepentingan', 'title'=>'Isi Kepentingan']) 
            ->addColumn(['data' => 'perkiraan_waktu', 'name'=>'perkiraan_waktu', 'title'=>'Perkiraan Waktu']) 
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Aksi', 'orderable'=>false, 'searchable'=>false]); 
 
        return view('Sprintbacklogs.show')->with(compact('html')); 
    } 
 
    /** 
     * Show the form for creating a new resource. 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    // public function create() 
    // {

    //     return view('Sprintbacklogs.create'); 
    // } 
    public function create() 
    { 
        
        return view('sprintbacklogs.create'); 
    } 


    public function create_sprintbacklog($id) 
    { 
        $sprint = $id;
        return view('sprintbacklogs.create',['sprint'=>$sprint]); 
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
            'id_backlog' => 'required', 
            'id_sprint' => 'required', 
            'isi_kepentingan' => 'required', 
            'perkiraan_waktu' => 'required']); 
    
        $sprintbacklogs = Sprintbacklog::create([
            'id_sprint' => $request->id_sprint,
            'id_backlog' => $request->id_backlog,
            'isi_kepentingan' => $request->isi_kepentingan,
            'perkiraan_waktu' => $request->perkiraan_waktu,
    ]);
    
        Session::flash("flash_notification", [ 
            "level" => "success", 
            "message" =>" Berhasil menyimpan data" 
    ]); 
        return redirect()->route('sprintbacklogs.show',$request->id_sprint); 
    } 
 
    /** 
     * Display the specified resource. 
     * 
     * @param  int  $id 
     * @return \Illuminate\Http\Response 
     */ 
    public function Show(Request $request, Builder $htmlBuilder, $id) 
    { 
        if ($request->ajax()) { 
        $sprintbacklogs = Sprintbacklog::with('backlog')->where('id_sprint',$id);
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
            // ->addColumn(['data' => 'aplikasi_id', 'name'=>'aplikasi_id', 'title'=>'Aplikasi']) 
            ->addColumn(['data' => 'backlog.nama_backlog', 'name'=>'backlog.nama_backlog', 'title'=>'Nama Backlog']) 
            ->addColumn(['data' => 'isi_kepentingan', 'name'=>'isi_kepentingan', 'title'=>'Isi Kepentingan']) 
            ->addColumn(['data' => 'perkiraan_waktu', 'name'=>'perkiraan_waktu', 'title'=>'Perkiraan Waktu']) 
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Aksi', 'orderable'=>false, 'searchable'=>false]); 
 
        return view('Sprintbacklogs.show',['sprint'=>$id])->with(compact('html')); 
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
        $sprintbacklog->update($request->only( 'id_backlog', 'isi_kepentingan', 'perkiraan_waktu')); 
        Session::flash("flash_notification", [ 
            "level"=>"success", 
            "message"=>"Berhasil menyimpan $sprintbacklog->backlog" 
        ]); 
         
        return redirect()->route('sprintbacklogs.show'); 
    } 
 
 
    public function destroy($id) 
    { 
        Sprintbacklog::destroy($id); 
 
        Session::flash("flash_notification", [ 
            "level" => "success", 
            "message" => "Data Berhasil Di Hapus" 
            ]); 
        return redirect()->route('sprintbacklogs.show'); 
    } 
}