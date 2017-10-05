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
        $sprints = Sprint::select(['id', 'nama_sprint', 'kode_sprint', 'tanggal_mulai', 'durasi', 'waktu_mulai', 'team']); 
        

              return Datatables::of($sprints)
                // ->addColumn('tanggal_mulai', function($sprint) {
                //     $tanggalMulai = $sprint->tanggal_mulai;
                //     $tanggalMulai = explode("-", $tanggalMulai);
                //     $tanggalMulai = $tanggalMulai[2] .'-'. $tanggalMulai[1] .'-'. $tanggalMulai[0];

                //     return $tanggalMulai;
                // })
                ->addColumn('action', function($sprint) { 
                    return view('datatable._action', [ 
                        'model' => $sprint, 
                        'form_url' => route('sprints.destroy', $sprint->id), 
                        'edit_url'=>route('sprints.edit', $sprint->id), 
                        'confirm_message' => 'Yakin anda ingin menghapus' . $sprint->nama_sprint . '?'  
                    ]); 
                })
 
                ->addColumn('backlog', function($sprint) { 
                    return view('datatable._backlog', [ 
                        'backlog' => route('sprintbacklogs.index', $sprint->id), 
                         
                    ]); 
                })->make(true); 
    } 
    $html = $htmlBuilder 
    ->addColumn(['data' => 'tanggal_mulai', 'name' =>  'tanggal_mulai', 'title' =>  'Tanggal Mulai']) 
    ->addColumn(['data' => 'durasi', 'name' =>  'durasi', 'title' =>  'Durasi']) 
    ->addColumn(['data' => 'waktu_mulai', 'name' =>  'waktu_mulai', 'title' =>  'Waktu Mulai']) 
    ->addColumn(['data' => 'team', 'name' =>  'team', 'title' =>  'Team']) 
    ->addColumn(['data' => 'nama_sprint', 'name' =>'nama_sprint', 'title'   =>'Nama Sprint']) 
    ->addColumn(['data' => 'backlog',      'name' =>  'backlog', 'title'      => 'Backlog', 'orderable' => false, 'searchable' => false]) 
            ->addColumn(['data' => 'action', 'name'      =>  'action', 'title'      => 'Aksi', 'orderable' => false, 'searchable' => false]); 
     
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
            'team' => 'required|exists:teams,id', 
            'kode_sprint' => 'required|unique:sprints' , 
            'nama_sprint' => 'required|unique:sprints'

        ]); 

        // $tanggalMulai = $request->tanggal_mulai;
        // $tanggalMulai = explode("-", $tanggalMulai);
        // $tanggalMulai = $tanggalMulai[2] .'-'. $tanggalMulai[1] .'-'. $tanggalMulai[0];

        $sprint = Sprint::create([
            'tanggal_mulai' => $request->tanggal_mulai,
            'durasi' => $request->durasi,
            'waktu_mulai' => $request->waktu_mulai,
            'team' => $request->team,
            'kode_sprint' => $request->kode_sprint,
            'nama_sprint' => $request->nama_sprint
        ]); 
        Session::flash("flash_notification", [ 
            "level" => "success", 
            "message" => "Berhasil menyimpan Sprint "
        ]);

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
                'team' => 'required', 
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
 
}