<?php 

namespace App\Http\Controllers; 

use Session; 
use App\Team; 
use App\Sprint; 
use App\Backlog; 
use App\Sprintbacklog;
use Illuminate\Http\Request; 
use Yajra\DataTables\Html\Builder; 
use Yajra\DataTables\Datatables; 

class SprintsController extends Controller 
{
    public function index(Request $request, Builder $htmlBuilder) 
    { 
        if ($request->ajax()) { 
            $sprints = Sprint::with('team')->get();
            return Datatables::of($sprints)
            ->escapeColumns([])
            ->addColumn('detail', function($sprint) { 
                return view('datatable._detail_sd', [ 
                    'detail' => route('sprints.detail_sd', $sprint->id) 
                ]); 
            })
            ->addColumn('action', function($sprint) { 
                return view('datatable._action_sprint', [ 
                    'model' => $sprint, 
                    'form_url' => route('sprints.destroy', $sprint->id), 
                    'edit_url'=>route('sprints.edit', $sprint->id), 
                    'confirm_message' => 'Yakin anda ingin menghapus' . $sprint->nama_sprint . '?'  
                ]); 
            })
            ->addColumn('backlog', function($sprint) { 
                return view('datatable._backlog', [ 
                    'backlog' => route('sprintbacklogs.show', $sprint->id) 
                ]); 
            })->make(true); 
        } 
        
        $html = $htmlBuilder 
        // ->addColumn(['data' => 'durasi', 'name' =>  'durasi', 'title' =>  'Durasi']) 
        // ->addColumn(['data' => 'waktu_mulai', 'name' =>  'waktu_mulai', 'title' =>  'Waktu Mulai']) 
        // ->addColumn(['data' => 'nilai_sp', 'name' =>'nilai_sp', 'title'   =>'Nilai SP']) 
        ->addColumn(['data' => 'tanggal_mulai', 'name' =>  'tanggal_mulai', 'title' =>  'Tanggal Mulai'])
        ->addColumn(['data' => 'team.nama_team', 'name' => 'team.nama_team', 'title' => 'Teamku'])
        ->addColumn(['data' => 'nama_sprint', 'name' =>'nama_sprint', 'title'   =>'Nama Sprint']) 
        ->addColumn(['data' => 'goal', 'name' =>'goal', 'title'   =>'Goal']) 
        ->addColumn(['data' => 'backlog',      'name' =>  'backlog', 'title'      => 'Sprint Backlog', 'orderable' => false, 'searchable' => false])
        ->addColumn(['data' => 'action', 'name'      =>  'action', 'title'      => 'Aksi', 'orderable' => false, 'searchable' => false])
        ->addColumn(['data' => 'detail',      'name' =>  'detail', 'title'      => '
            Detail', 'orderable' => false, 'searchable' => false]); 
        
        
        return view('sprints.index')->with(compact('html')); 
    } 
    public function create() 
    { 
        return view('sprints.create'); 
    } 
    
    public function store(Request $request, Sprint $sfrint) 
    { 
        $this->validate($request, [ 
            'tanggal_mulai' => 'required', 
            'durasi' => 'required',
            'waktu_mulai' => 'required' , 
            'team_id' => 'required|exists:teams,id', 
            'kode_sprint' => 'required|unique:sprints' , 
            'nama_sprint' => 'required|unique:sprints',
            'nilai_sp' => 'required',
            'goal' => 'required'

        ]); 

        // $tanggalMulai = $request->tanggal_mulai;
        // $tanggalMulai = explode("-", $tanggalMulai);
        // $tanggalMulai = $tanggalMulai[2] .'-'. $tanggalMulai[1] .'-'. $tanggalMulai[0];

        $sprint = Sprint::create([
            'tanggal_mulai' => $request->tanggal_mulai,
            'durasi' => $request->durasi,
            'waktu_mulai' => $request->waktu_mulai,
            'team_id' => $request->team_id,
            'kode_sprint' => $request->kode_sprint,
            'nama_sprint' => $request->nama_sprint,
            'nilai_sp' => $request->nilai_sp,
            'goal' => $request->goal
        ]); 
        Session::flash("flash_notification", [ 
            "level" => "success", 
            "message" => "Berhasil menyimpan Sprint "
        ]);

        return redirect()->route('sprints.index'); 

    }     public function stores(Request $request, Sprint $sfrint) 
    { 
        $this->validate($request, [ 
            'tanggal_mulai' => 'required', 
            'durasi' => 'required',
            'waktu_mulai' => 'required' , 
            'team_id' => 'required|exists:teams,id', 
            'kode_sprint' => 'required|unique:sprints' , 
            'nama_sprint' => 'required|unique:sprints',
            'nilai_sp' => 'required',
            'goal' => 'required'

        ]); 

        // $tanggalMulai = $request->tanggal_mulai;
        // $tanggalMulai = explode("-", $tanggalMulai);
        // $tanggalMulai = $tanggalMulai[2] .'-'. $tanggalMulai[1] .'-'. $tanggalMulai[0];

        $sprint = Sprint::create([
            'tanggal_mulai' => $request->tanggal_mulai,
            'durasi' => $request->durasi,
            'waktu_mulai' => $request->waktu_mulai,
            'team_id' => $request->team_id,
            'kode_sprint' => $request->kode_sprint,
            'nama_sprint' => $request->nama_sprint,
            'nilai_sp' => $request->nilai_sp,
            'goal' => $request->goal
        ]); 
        Session::flash("flash_notification", [ 
            "level" => "success", 
            "message" => "Berhasil menyimpan Sprint "
        ]);

        return redirect()->route('sprints.index'); 

    } 
    public function show($id) 
    { 

    } 
    public function edit($id) 
    { 
        $sprint = Sprint::find($id); 
        return view('sprints.edit')->with(compact('sprint')); 
        // $tanggalMulai = $sprint->tanggal_mulai;
        // $tanggalMulai = explode("-", $tanggalMulai);
        // $tanggalMulai = $tanggalMulai[2] .'-'. $tanggalMulai[1] .'-'. $tanggalMulai[0];

        // return view('sprints.edit')->with(compact('sprint')); 
    } 
    public function update(Request $request, $id)
    { 
        $this->validate($request, [ 
            'tanggal_mulai' => 'required', 
            'durasi' => 'required', 
            'waktu_mulai' => 'required', 
            'nilai_sp' => 'required', 
            'goal' => 'required', 
            'team_id' => 'required', 
            'kode_sprint' => 'required|unique:sprints,kode_sprint,'. $id,
            'nama_sprint' => 'required|unique:sprints,nama_sprint,'. $id
        ]); 
        
        $sprint = Sprint::find($id); 
            // $tanggalMulai = $request->tanggal_mulai;
            // $tanggalMulai = explode("-", $tanggalMulai);
            // $tanggalMulai = $tanggalMulai[2] .'-'. $tanggalMulai[1] .'-'. $tanggalMulai[0];

        $sprint->update($request->all());

            // $sprint->update([
            //     'tanggal_mulai' => $request->tanggal_mulai,                
            //     'durasi' => $request->durasi,
            //     'waktu_mulai' => $request->waktu_mulai,
            //     'team' => $request->team,
            //     'kode_sprint' => $request->kode_sprint,
            //     'nama_sprint' => $request->nama_sprint

            // ]); 
        
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
    public function detailSd(){
        //jumlah assign
        $jumlah_not_checkout = Sprintbacklog::where('assign',0)->count();
        $jumlah_checkout = Sprintbacklog::where([
            ['assign', '=', 1],
            ['finish', '=', 0]
        ])->count();
        $jumlah_finish = Sprintbacklog::where('finish',1)->count();

        //list not checkout
        $dataNotCheckOut = Sprintbacklog::select('id_backlog')->where('assign', 0)->get();
        $arr = [];
        foreach ($dataNotCheckOut as $dataNC) {
            array_push($arr, $dataNC->id_backlog);
        }
        $namaBacklogNC = Backlog::whereIn('id_backlog', $arr)->get();
        
        //list checkout
        $dataCheckOut = Sprintbacklog::select('id_backlog')->where([
            ['assign', '=', 1],
            ['finish', '=', 0]
        ])->get();
        $arr = [];
        foreach ($dataCheckOut as $dataC) {
            array_push($arr, $dataC->id_backlog);
        }
        $namaBacklogC = Backlog::whereIn('id_backlog', $arr)->get();

        //list finish
        $dataFinish = Sprintbacklog::select('id_backlog')->where('finish', 1)->get();
        $arr = [];
        foreach ($dataFinish as $dataF) {
            array_push($arr, $dataF->id_backlog);
        }
        $namaBacklogF = Backlog::whereIn('id_backlog', $arr)->get();

        return view('sprints.detail_sd',compact('jumlah_not_checkout','jumlah_checkout','jumlah_finish', 'namaBacklogNC','namaBacklogC','namaBacklogF','dataNotCheckOut','dataCheckOut','dataFinish'));
    }
}