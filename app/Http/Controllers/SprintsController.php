<?php 

namespace App\Http\Controllers; 

use Session; 
use App\Team; 
use App\Sprint; 
use App\Backlog; 
use App\Sprintbacklog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use Yajra\DataTables\Html\Builder; 
use Yajra\DataTables\Datatables; 
use Excel;  
use Validator;  
use DB;  

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
            ->addColumn('nilai_sp', function($sprint) {
                return '<a title="Detail Sprint" href="'.route('sprints.show', $sprint->id).'">'.$sprint->nilai_sp.'</a>';
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
        ->addColumn(['data' => 'nilai_sp', 'name' =>'nilai_sp', 'title'   =>'Nilai SP']) 
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
        $sprint = Sprint::find($id);
        return view('sprints.show', compact('sprint'));
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
    public function detailSd($id){
        //nama sprint di breadcrumb
        $nama_sprint = Sprint::find($id);
        //jumlah assign
        $jumlah_not_checkout = Sprintbacklog::where([
            ['id_sprint', '=', $id],
            ['assign', '=',0]
        ])->count();
        $jumlah_checkout = Sprintbacklog::where([
            ['id_sprint', '=', $id],
            ['assign', '=', 1],
            ['finish', '=', 0]
        ])->count();
        $jumlah_finish = Sprintbacklog::where([
            ['id_sprint', '=', $id],
            ['finish', '=',1]
        ])->count();

        //list not checkout
        $dataNotCheckOut = Sprintbacklog::select('id_backlog')->where([
            ['id_sprint', '=', $id],
            ['assign', '=', 0]
        ])->get();
        $arr = [];
        foreach ($dataNotCheckOut as $dataNC) {
            array_push($arr, $dataNC->id_backlog);
        }
        $namaBacklogNC = Backlog::whereIn('id_backlog', $arr)->get();
        
        //list checkout
        $dataCheckOut = Sprintbacklog::select('id_backlog')->where([
            ['id_sprint', '=', $id],
            ['assign', '=', 1],
            ['finish', '=', 0]
        ])->get();
        $arr = [];
        foreach ($dataCheckOut as $dataC) {
            array_push($arr, $dataC->id_backlog);
        }
        $namaBacklogC = Backlog::whereIn('id_backlog', $arr)->get();

        //list finish
        $dataFinish = Sprintbacklog::select('id_backlog')->where([
            ['id_sprint', '=', $id],
            ['finish', '=', 1]
        ])->get();
        $arr = [];
        foreach ($dataFinish as $dataF) {
            array_push($arr, $dataF->id_backlog);
        }
        $namaBacklogF = Backlog::whereIn('id_backlog', $arr)->get();

        //rasio sprintbacklog
        $data_seluruh_sb = Sprintbacklog::where('id_sprint',$id)->count();
        $dataNotFinish = Sprintbacklog::select('id_sprint')->where([
            ['id_sprint', '=', $id],
            ['finish', '=', 0]
        ])->count();
        if($data_seluruh_sb > 0){
            $persen = $data_seluruh_sb - $dataNotFinish;
            $hasil= $persen / $data_seluruh_sb * 100 . '%';
        }
        else{
            $hasil = "\"Tidak ada Sprintbacklog !\"";
        }
        return view('sprints.detail_sd',compact('jumlah_not_checkout','jumlah_checkout','jumlah_finish', 'namaBacklogNC','namaBacklogC','namaBacklogF','dataNotCheckOut','dataCheckOut','dataFinish','nama_sprint','hasil','data_seluruh_sb'));
    }
    public function export() {  
        return view('sprints.export'); 
    } 
    public function exportPost(Request $request){  
        $request->validate([  
            'nama_sprint' => 'required',  
        ], [  
            'nama_sprint.required' => 'Silahkan pilih minimal satu Data.'  
        ]);  
        $team = Sprint::whereIn('id', $request->get('nama_sprint'))->get();  
        Excel::create('Data Master Data Sprint', function($excel) use ($team){  
            $excel->setTitle('Data Master Data Sprint')  
            ->setCreator(Auth::user()->name);  
            $excel->sheet('Data Sprint', function($sheet) use ($team){  
              $row = 1;  
              $sheet->row($row,[  
                'Tanggal Mulai', 
                'Durasi', 
                'Waktu Mulai',  
                'Team', 
                'Kode Sprint',  
                'Nama Sprint',  
                'Nilai SP',  
                'Goal' 
            ]);  
              foreach ($team as $app) {  
                $sheet->row(++$row, [  
                  $app->tanggal_mulai,  
                  $app->durasi,  
                  $app->waktu_mulai,  
                  $app->team_id,  
                  $app->kode_sprint,  
                  $app->nama_sprint,  
                  $app->nilai_sp,  
                  $app->goal  
              ]);  
            }  
        });  
        })->export('xls');  
    }  


    public function exportAllPost() {  
        $data = Sprint::select('tanggal_mulai', 'durasi', 'waktu_mulai', 'team_id', 'kode_sprint', 'nama_sprint', 'nilai_sp', 'goal')->get();  
        Excel::create('Semua Data Sprint', function($excel) use ($data) {  
            $excel->sheet('Data Sprint', function($sheet) use ($data) {  
                $sheet->fromArray($data);  
            });  

        })->download('xls');  
    }  

    public function generateExcelTemplate() {  
      Excel::create('Template Import Sprint', function($excel) { 
                // Set the properties 
        $excel->setTitle('Template Import Sprint') 
        ->setCreator('Sprint') 
        ->setCompany('Sprint') 
        ->setDescription('Template import data untuk Sprint'); 

        $excel->sheet('Data Sprint', function($sheet) { 
          $row = 1; 
          $sheet->row($row, [ 
            'tanggal_mulai', 
            'durasi', 
            'waktu_mulai', 
            'team_id', 
            'kode_sprint', 
            'nama_sprint', 
            'nilai_sp', 
            'goal' 
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
        'tanggal_mulai' => 'required', 
        'durasi' => 'required', 
        'waktu_mulai' => 'required', 
        'team_id' => 'required', 
        'kode_sprint' => 'required', 
        'nama_sprint' => 'required', 
        'nilai_sp' => 'required', 
        'goal' => 'required' 
    ]; 

           //Catat semua id team baru 
            //ID ini kita butuhkan untuk menghitung total team yang berhasil di import 
    $teams_id = []; 

           //looping setiap baris ,mulai dari baris ke 2 (karena baris ke 1 adlah nama kolom ) 
    foreach ($excels as $row) { 
              //membuat validasi untuk row di excel 
              //Dsini kita ubah baris yang sedang di proses menjadi array 
        $validator = Validator::make($row->toArray(),$rowRules); 

             //Skip baris ini jadi tidak valid , langsung ke baris selajutnya 
        if ($validator->fails()) continue; 

             //buat team baru 
        $team = Sprint::create([ 
          'tanggal_mulai' => $row['tanggal_mulai'], 
          'durasi' => $row['durasi'], 
          'waktu_mulai' => $row['waktu_mulai'], 
          'team_id' => $row['team_id'], 
          'kode_sprint' => $row['kode_sprint'], 
          'nama_sprint' => $row['nama_sprint'], 
          'nilai_sp' => $row['nilai_sp'], 
          'goal' => $row['goal'], 

      ]); 

             //catat id dari team yang baru dibuat 
        array_push($teams_id, $team->id); 

    } 

           //ambil semua team yang baru dibuat 
    $teams = Sprint::whereIn('id',$teams_id)->get(); 

           //redirect ke form jika tidak ada team yang berhasil di import 
    if($teams->count() == 0){ 
        Session::flash('flash_notification',[ 
          'level' =>'danger', 
          'message'=>'Tidak ada Team yang diimport' 

      ]); 
        return redirect()->back(); 
    } 

           //set feedback 
    Session::flash('flash_notification',[ 
        'level' =>'success', 
        'message'=>"Berhasil mengimport ".$teams->count()." Team" 

    ]); 

           //Tampilkan index team 
    return redirect()->route('sprints.index'); 
} 


}