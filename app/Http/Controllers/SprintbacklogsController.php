<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request; 
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Sprintbacklog; 
use App\Sprint; 
use Session; 
use Excel; 
use Validator;
use DB;

class SprintbacklogsController extends Controller 
{ 
    public function index(Request $request, Builder $htmlBuilder) 
    { 
        if ($request->ajax()) { 
            $sprintbacklogs = Sprintbacklog::select(['id', 'id_sprint', 'isi_kepentingan', 'perkiraan_waktu', 'id_backlog']); 
            return Datatables::of($sprintbacklogs) 
            ->escapeColumns([])
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
        
        return view('sprintbacklogs.show')->with(compact('html')); 
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
            'isi_kepentingan' => $request->isi_kepentingan,
            'perkiraan_waktu' => $hasil
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
             ->escapeColumns([])
            ->addColumn('assign', function($sprint) { 
                return view('datatable._assign', [ 
                    'assign' => route('sprintbacklogs.assign', $sprint->id) 
                ]); 
            })
            ->escapeColumns([])

           ->addColumn('detail', function($backlog) {
                return '<a title="Detail Backlog" href="'.route('backlog.show', $backlog->id_backlog).'">'.$backlog->nama_backlog.'</a>';      
            })->make(true);
        } 
        
        $html = $htmlBuilder 
            // ->addColumn(['data' => 'aplikasi_id', 'name'=>'aplikasi_id', 'title'=>'Aplikasi']) 
        ->addColumn(['data' => 'detail', 'name'=>'backlog.nama_backlog', 'title'=>'Nama Backlog']) 
        ->addColumn(['data' => 'isi_kepentingan', 'name'=>'isi_kepentingan', 'title'=>'Isi Kepentingan']) 
        ->addColumn(['data' => 'perkiraan_waktu', 'name'=>'perkiraan_waktu', 'title'=>'Perkiraan Waktu']) 
        ->addColumn(['data' => 'assign', 'name'=>'assign', 'title'=>'Assign', 'orderable'=>false, 'searchable'=>false])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Aksi', 'orderable'=>false, 'searchable'=>false]);
        
        return view('sprintbacklogs.show',['sprint'=>$id])->with(compact('html')); 
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
        $angka = $request->perkiraan_waktu;
        $sliceAngka = explode(',', trim($angka));
        $array_angka = [];
        foreach ($sliceAngka as $num) {
            array_push($array_angka, $num);
        }
        $hasil = array_sum($array_angka);
        $hasil = $hasil / count($sliceAngka);
        $sprintbacklog = Sprintbacklog::find($id); 
        $sprintbacklog->update([
            'id_sprint' => $request->id_sprint,
            'id_backlog' => $request->id_backlog,
            'isi_kepentingan' => $request->isi_kepentingan,
            'perkiraan_waktu' => $hasil
        ]);
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

     public function assign($id) 
    { 

    } 
    
        public function export($id) {
        return view('sprintbacklogs.export',['sprint'=>$id]);
    }

     public function exportPost(Request $request) { 
        // validasi
        $this->validate($request, [
            'id_backlog'=>'required',
        ], [
            'id_backlog.required'=>'Pilih minimal 1 Aplikasi.'
        ]);
        $Sprintbacklogs = Sprintbacklog::with('backlog')->whereIn('id_backlog', $request->id_backlog)->where('id_sprint', $request->id_sprint)->where('id')->get();
        Excel::create('Data Sprintbacklog', function($excel) use ($Sprintbacklogs) {
        // Set property
            $excel->setTitle('Data Sprintbacklog')
            ->setCreator(Auth::user()->name);
            $excel->sheet('Data Sprintbacklog', function($sheet) use ($Sprintbacklogs) {
                $row = 1;
                $sheet->row($row, [
                    'Nama Backlog',
                    'Isi Kepentingan',
                    'Perkiraan Waktu',
                ]);
                foreach ($Sprintbacklogs as $sprintbacklog) {
                    $sheet->row(++$row, [
                        $sprintbacklog->backlog->nama_backlog,
                        $sprintbacklog->isi_kepentingan,
                        $sprintbacklog->perkiraan_waktu,
                    ]);
                }
            });
        })->export('xls');
    }

    public function exportAllPost($id) {
        // DB::enableQueryLog();
        $Sprintbacklogs = Sprintbacklog::with('backlog')->where('id_sprint', $id)->get();
        // dd(DB::getQueryLog());
        // exit;
        Excel::create('Data Sprintbacklog', function($excel) use ($Sprintbacklogs) {
        // Set property
            $excel->setTitle('Data Sprintbacklog')
            ->setCreator(Auth::user()->name);
            $excel->sheet('Data Sprintbacklog', function($sheet) use ($Sprintbacklogs) {
                $row = 1;
                $sheet->row($row, [
                    'Nama Backlog',
                    'Isi Kepentingan',
                    'Perkiraan Waktu',
                ]);
                foreach ($Sprintbacklogs as $sprintbacklog) {
                    $sheet->row(++$row, [
                        $sprintbacklog->backlog->nama_backlog,
                        $sprintbacklog->isi_kepentingan,
                        $sprintbacklog->perkiraan_waktu,
                    ]);
                }
            });
        })->export('xls');
    }
    public function generateExcelTemplate()
    {
        Excel::create('Template Import Buku', function($excel) {
        // Set the properties
        $excel->setTitle('Template Import Buku')
            ->setCreator('Sprintbacklogs')
            ->setCompany('Sprintbacklogs')
            ->setDescription('Template import buku untuk Sprintbacklogs');
        
        $excel->sheet('Data Sprintbacklogs', function($sheet) {
            $row = 1;
            $sheet->row($row, [
                'Nama Backlog',
                'Isi Kepentingan',
                'Perkiraan Waktu',
            ]);
        });
        })->export('xlsx');
    }
}