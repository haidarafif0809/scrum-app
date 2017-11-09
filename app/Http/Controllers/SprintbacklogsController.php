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
use App\User;

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
    public function testing() {
        // $a = ['hidup' => 'life', 'mati' => 'death'];
        $sprintBacklog = Sprintbacklog::select('assign')->where('id_sprint', 1)->get();
        $a = json_decode($sprintBacklog, true);
        echo "<pre>";
        // foreach ($sprintBacklog as $b) {
        $arr = [];
        foreach ($a as $b) {
            array_push($arr, $b['assign']);
        }
        // print_r($arr);
        echo var_export($arr);
        // echo $a[2]['assign'];
        // }
        echo "</pre>";

        // $sprintBacklog = Sprintbacklog::where('id_sprint', $sprint->id);
        // $user = User::find($sprintBacklog->assign_user_id)->first();
        // if ($sprintBacklog->assign == 0) {
        //     $namaUser = 0;
        // }
        // else {
        //     $namaUser = $user->name;
        // }
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
                

                $sprintBacklog = Sprintbacklog::select(['assign', 'assign_user_id'])->where('id_sprint', $sprint->id)->get();
                $user = User::find($sprintBacklog->assign_user_id)->first();
                $namaUser = $user->name;

                return view('datatable._assign', [ 
                    'assignUrl' => route('sprintbacklogs.assign', $sprint->id),
                    'namaUser' => $namaUser,
                    'assign' => $sprintBacklog->assign
                ]); 


            })
            // ->addColumn('finish', function($sprint) { 
            //     return view('datatable._finish', [ 
            //         'finish' => route('sprintbacklogs.finish', $sprint->id) 
            //     ]); 
            // })
            // ->escapeColumns([])

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

        // $user = User::find($id);
        // $sprintbacklogs = Sprintbacklog::select('id_sprint')->where('id', $id)->first();
        // Sprintbacklog::($id); 

        // return redirect()->route('sprintbacklogs.show',['sprint'=>$sprintbacklogs->id_sprint]); 
} 

    // public function finish()
    // {

    // }

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
    $Sprintbacklogs = Sprintbacklog::with('backlog')->whereIn('id_backlog', $request->id_backlog)->where('id_sprint', $request->id_sprint)->where('id', $request->get('id_sprint'))->get();
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

public function generateExcelTemplate() { 
    Excel::create('Template Import Sprintbacklog', function($excel) {
                // Set the properties
        $excel->setTitle('Template Import Team')
        ->setCreator('Sprintbacklog')
        ->setCompany('Sprintbacklog')
        ->setDescription('Template import data Sprintbacklog');

        $excel->sheet('Data Sprintbacklog', function($sheet) {
            $row = 1;
            $sheet->row($row, [
                'id_backlog',
                'isi_kepentingan',
                'perkiraan_waktu',
            ]);
        });

    })->export('xlsx');
}

public function importExcel(Request $request) {
              //validasi untuk memastikan file yang diupload adalah excel
    $this->validate($request, ['excel'=>'required|mimes:xls,xlsx']);
            //ambil file yang baru di upload
    $excel = $request->file('excel');
            //baca sheet pertama
    $excels = Excel::selectSheetsByIndex(0)->load($excel,function($reader){
              //option ,jika ada
    })->get();


           //rule untuk validasi setiap row pada file excel
    $rowRules = [
     'id_sprint' => 'required',
     'id_backlog' => 'required|exists:backlogs,id_backlog',
     'isi_kepentingan' => 'required',
     'perkiraan_waktu' => 'required'
 ];

           //Catat semua id team baru
            //ID ini kita butuhkan untuk menghitung total team yang berhasil di import
 $sprintbacklogs_id = [''];

           //looping setiap baris ,mulai dari baris ke 2 (karena baris ke 1 adlah nama kolom )
 foreach ($excels as $row) {
              //membuat validasi untuk row di excel
              //Dsini kita ubah baris yang sedang di proses menjadi array
  $validator = Validator::make($row->toArray(),$rowRules);

             //Skip baris ini jadi tidak valid , langsung ke baris selajutnya
  if ($validator->fails()) continue;

             //buat team baru
  $sprintbacklog = Sprintbacklog::create([
    'id_sprint' => $row['id_sprint'],
    'id_backlog' => $row['id_backlog'],
    'isi_kepentingan' => $row['isi_kepentingan'],
    'perkiraan_waktu' => $row['perkiraan_waktu'],

]);

             //catat id dari team yang baru dibuat
  array_push($sprintbacklogs_id, $sprintbacklog->id);

}

           //ambil semua team yang baru dibuat
$sprintbacklogs = Sprintbacklog::whereIn('id',$sprintbacklogs_id)->get();

           //redirect ke form jika tidak ada team yang berhasil di import
if($sprintbacklogs->count() == 0){
  Session::flash('flash_notification',[
    'level' =>'danger',
    'message'=>'Tidak ada Team yang diimport'

]);
  return redirect()->back();
}

           //set feedback
Session::flash('flash_notification',[
    'level' =>'success',
    'message'=>"Berhasil mengimport ".$sprintbacklogs->count()." Team"

]);

           //Tampilkan index team
return redirect()->route('sprintbacklogs.index');
}
}