<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request; 
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Sprintbacklog; 
use App\Sprint; 
use App\Backlog; 
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
                    'confirm_message' => 'Yakin mau menghapus ' . $sprintbacklog->backlog->id_backlog . '?' 
                ]);             
            })->make(true); 
        } 
        
        $html = $htmlBuilder 
        ->addColumn(['data' => 'id_backlog', 'name'=>'id_backlog', 'title'=>'Nama Backlog']) 
        ->addColumn(['data' => 'isi_kepentingan', 'name'=>'isi_kepentingan', 'title'=>'Isi Kepentingan']) 
        ->addColumn(['data' => 'perkiraan_waktu', 'name'=>'perkiraan_waktu', 'title'=>'Perkiraan Waktu']) 
        // ->addColumn(['data' => 'assign', 'name'=>'assign', 'title'=>'Assign', 'orderable'=>false, 'searchable'=>false]) 
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
        return view('sprintbacklogs.create',['sprint'=>$id]); 
    } 
    public function store(Request $request) 
    { 

        $this->validate($request, [
            'id_backlog' => 'required|exists:backlogs,id_backlog', 
            'isi_kepentingan' => 'required', 
            'perkiraan_waktu' => 'required',
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
        $jumlahAssign = Sprintbacklog::where('assign_user_id', 1)->count();
        echo $jumlahAssign;
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
            ->escapeColumns([])
            ->addColumn('assign', function($sprint) { 

                if ($sprint->assign_user_id != 0) {
                    $user = User::find($sprint->assign_user_id);
                    $namaUser = $user->name;
                }
                else {
                    $namaUser = "";
                }

                $model = '';
                $backlog = Backlog::find($sprint->id_backlog);
                return view('datatable._assign', [
                    'model' => $model,
                    'assignUrl' => route('sprintbacklogs.assign', $sprint->id),
                    'namaUser' => $namaUser,
                    'assign' => $sprint->assign,
                    'unassignUrl' => route('sprintbacklogs.unassign', $sprint->id),
                    'confirm_message' => 'Apakah Anda yakin ingin meng-unassign backlog "'. $backlog->nama_backlog .'" ?'
                ]); 


            })
            // ->addColumn('finish', function($sprint) { 
            //     return view('datatable._finish', [ 
            //         'finish' => route('sprintbacklogs.finish', $sprint->id) 
            //     ]); 
            // })
            // // ->addColumn('finish', function($sprint) { 
            // //     return view('datatable._finish', [ 
            // //         'finish' => route('sprintbacklogs.finish', $sprint->id) 
            // //     ]); 
            // // })
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
    $sprintbacklog = Sprintbacklog::find($id);
    $backlog = Backlog::find($sprintbacklog->id_backlog);
    $sprintbacklog->update([
        'assign' => 1,
        'assign_user_id' => Auth::user()->id
    ]);
    Session::flash("flash_notification", [ 
        'level'=>'success', 
        'message'=>'Backlog "'. $backlog->nama_backlog .'" berhasil di-assign' 
    ]); 
    return redirect()->route('sprintbacklogs.show', ['sprint' => $sprintbacklog->id_sprint]); 
} 

public function unassign($id) {
    $sprintbacklog = Sprintbacklog::find($id);
    $backlog = Backlog::find($sprintbacklog->id_backlog);
    $sprintbacklog->update([
        'assign' => 0,
        'assign_user_id' => 0
    ]);
    Session::flash("flash_notification", [ 
        'level'=>'success', 
        'message'=>'Backlog "'. $backlog->nama_backlog .'" berhasil di-unassign' 
    ]); 
    return redirect()->route('sprintbacklogs.show', ['sprint' => $sprintbacklog->id_sprint]); 
    
}

public function finish()
{ 

}

public function export($id) {
    return view('sprintbacklogs.export',['sprint'=>$id]);
}
public function exportPost(Request $request)
{
        // validasi
    $this->validate($request, [
        'id_backlog'=>'required',
    ], [
        'id_backlog.required'=>'Anda belum memilih data. Pilih minimal 1 data.'
    ]);
    $sprintbacklogs = Sprintbacklog::with('backlog')->where('id_backlog', $request->id_backlog)->where('id_sprint', $request->id_sprint)->get();
    Excel::create('Data Di Sprintbacklog', function($excel) use ($sprintbacklogs) {

            // Set property
        $excel->setTitle('Data Sprintbacklog')
        ->setCreator(Auth::user()->name);
        $excel->sheet('Data Sprintbacklog', function($sheet) use ($sprintbacklogs) {
            $row = 1;
            $sheet->row($row, [
                'Nama Backlog',
                'Isi Kepentingan',
                'Perkiraan Waktu'
            ]);

            foreach ($sprintbacklogs as $sprintbacklog) {
                $sheet->row(++$row, [
                    $sprintbacklog->backlog->nama_backlog,
                    $sprintbacklog->isi_kepentingan,
                    $sprintbacklog->perkiraan_waktu
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
    Excel::create('Template Import Sprintbacklog', function($excel) {
        // Set the properties
        $excel->setTitle('Template Import Sprintbacklog')
        ->setCreator('Sprintbacklog')
        ->setCompany('Sprintbacklog')
        ->setDescription('Template import data di Sprintbacklog');
        $excel->sheet('Data Sprintbacklog', function($sheet) {
            $row = 1;
            $sheet->row($row, [
                'ID Sprint',
                'Nama Backlog',
                'Isi Kepentingan',
                'Perkiraan Waktu'
            ]);
        });
    })->export('xlsx');
}

public function importExcel(Request $request) {
        // validasi untuk memastikan file yang diupload adalah excel
    $this->validate($request, [ 'excel' => 'required|mimes:xls,xlsx' ]);
        // ambil file yang baru diupload
    $excel = $request->file('excel');
        // baca sheet pertama
    $excels = Excel::selectSheetsByIndex(0)->load($excel, function($reader) {
        // options, jika ada
    })->get();
        // rule untuk validasi setiap row pada file excel
    $rowRules = [
        'ID Sprint',
        'Nama Backlog',
        'Isi Kepentingan' => 'required',
        'Perkiraan Waktu' => 'required',
    ];
        // Catat semua id sprintbacklog
        // ID ini kita butuhkan untuk menghitung yang berhasil diimport
    $sprintbacklogs_id = [];
            // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
    foreach ($excels as $row) {
            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang di proses menjadi array
        $validator = Validator::make($row->toArray(), $rowRules);
            // buat sprintbacklog baru
        $sprintbacklog = Sprintbacklog::create([
            'id_sprint' => $row['id_sprint'],
            'id_backlog' => $row['nama_backlog'],
            'isi_kepentingan' => $row['isi_kepentingan'],
            'perkiraan_waktu' => $row['perkiraan_waktu']
        ]);

            // $backlog = Backlog::create([

            //     'id_backlog' => $sprintbacklog->id,
            // ]);
            // catat id dari sprintbacklog yang baru dibuat
        array_push($sprintbacklogs_id, $sprintbacklog->id);
    }
        // Ambil semua spritnbacklog yang baru dibuat
    $sprintbacklogs = Sprintbacklog::whereIn('id', $sprintbacklogs_id)->get();
        // redirect ke form jika tidak data sprintbacklog yang berhasil diimport
    if ($sprintbacklogs->count() == 0) {
        Session::flash("flash_notification", [
            "level" => "danger",
            "message" => "Tidak ada buku yang berhasil diimport."
        ]);
        return redirect()->back();
    }
        // set feedback
    Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil mengimport "
    ]);
        // Tampilkan index sprintbacklog
    return redirect()->route('sprintbacklogs.show', $row['id_sprint']);
}
}