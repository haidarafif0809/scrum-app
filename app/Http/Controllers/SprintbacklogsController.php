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

    public function create() 
    { 
        
        return view('sprintbacklogs.create'); 
    } 


    public function create_sprintbacklog($id) 
    { 
        $sprint = $id;
        return view('sprintbacklogs.create',['sprint'=>$sprint]); 
    } 

    public function store(Request $request) 
    { 

        $this->validate($request, [
            'id_backlog' => 'required|exists:backlogs,id_backlog', 
            'isi_kepentingan' => 'required', 
            'perkiraan_waktu' => 'required'
        ]);  
        
        $angka = $request->perkiraan_waktu;
        $sliceAngka = explode(',', trim($angka));
        $array_angka = [];
        foreach ($sliceAngka as $num) {
            array_push($array_angka, $num);
        }
        $hasil = array_sum($array_angka);
        $hasil = $hasil / count($sliceAngka);
        $sprintbacklogs = Sprintbacklog::create([
            'id_sprint' => $request->id_sprint,
            'id_backlog' => $request->id_backlog,
            'asign' => $request->asign,
            'isi_kepentingan' => $request->isi_kepentingan,
            'perkiraan_waktu' => $hasil
    ]);
    
        Session::flash("flash_notification", [ 
            "level" => "success", 
            "message" =>" Berhasil menyimpan data" 
    ]); 
        return redirect()->route('sprintbacklogs.show',$request->id_sprint); 
    } 
 
    public function Show(Request $request, Builder $htmlBuilder, $id) 
    { 
        if ($request->ajax()) { 
        $sprintbacklogs = Sprintbacklog::with('backlog')->where('id_sprint', $id);
            return Datatables::of($sprintbacklogs)
            ->addColumn('action', function($sprintbacklog){ 
                return view('datatable._actionSprintBacklog', [ 
                    'model' => $sprintbacklog, 
                    'form_url'=> route('sprintbacklogs.destroy', $sprintbacklog->id), 
                    'edit_url' => route('sprintbacklogs.edit', $sprintbacklog->id), 
                    'confirm_message' => 'Apakah anda yakin ingin menghapus ?' 
                ]);   
                })
                ->addColumn('detail', function($backlog) {
                return '<a title="Detail Backlog" href="'.route('backlog.show', $backlog->id_backlog).'">'.$backlog->nama_backlog.'</a>';      
            })->make(true);
        } 
 
        $html = $htmlBuilder 
            // ->addColumn(['data' => 'aplikasi_id', 'name'=>'aplikasi_id', 'title'=>'Aplikasi']) 
            ->addColumn(['data' => 'backlog.nama_backlog', 'name'=>'backlog.nama_backlog', 'title'=>'Nama Backlog']) 
            ->addColumn(['data' => 'isi_kepentingan', 'name'=>'isi_kepentingan', 'title'=>'Isi Kepentingan']) 
            ->addColumn(['data' => 'perkiraan_waktu', 'name'=>'perkiraan_waktu', 'title'=>'Perkiraan Waktu']) 
            ->addColumn(['data' => 'detail', 'name'=>'detail', 'title'=>'Detail']) 
            ->addColumn(['data' => 'asign', 'name'=>'asign', 'title'=>'Asign']) 
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Aksi', 'orderable'=>false, 'searchable'=>false]); 
 
        return view('Sprintbacklogs.show',['sprint'=>$id])->with(compact('html')); 
    } 

    public function edit($id) 
    { 
        $sprintbacklog = Sprintbacklog::find($id); 
        return view('sprintbacklogs.edit')->with(compact('sprintbacklog')); 
    } 
 
    public function update(Request $request, $id) 
    { 
        $this->validate($request, [
            'id_backlog' => 'required|exists:backlogs,id_backlog',
            'isi_kepentingan' => 'required',
            'perkiraan_waktu' => 'required'
        ]);
        $sprintbacklog = Sprintbacklog::find($id); 
        $sprintbacklog->update($request->all());
        Session::flash("flash_notification", [ 
            "level"=>"success", 
            "message"=>"Berhasil menyimpan data" 
        ]); 
         
        return redirect()->route('sprintbacklogs.show',['sprint'=>$request->id_sprint])->with(compact('sprints')); 
    }
 
    public function destroy(Request $request, $id) 
    { 
        $sprintbacklogs = Sprintbacklog::select('id_sprint')->where('id', $id)->first();
        Sprintbacklog::destroy($id); 
        Session::flash("flash_notification", [ 
            "level" => "success", 
            "message" => "Data Berhasil Di Hapus" 
            ]); 
        return redirect()->route('sprintbacklogs.show',['sprint'=>$sprintbacklogs->id_sprint]); 
    } 
}