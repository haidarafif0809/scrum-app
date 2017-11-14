<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;

use App\Backlog;
use App\Sprintbacklog;
use App\Aplication;
use Session;
use Excel;
use Auth;
use Validator;
use App\User;
use DB;

class BackLogsController extends Controller
{

    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $backlogs = Backlog::with('aplikasi')->get();
            return Datatables::of($backlogs)
            ->escapeColumns([])
            ->addColumn('action', function($backlog) {
                return view('datatable._action_backlog', [
                    'model' => $backlog,
                    'form_url' => route('backlog.destroy', $backlog->id_backlog),
                    'edit_url' => route('backlog.edit', $backlog->id_backlog),
                    'confirm_message' => 'Yakin mau menghapus ' . $backlog->nama_backlog . '?'
                ]);
            })
            ->addColumn('nama_backlog', function($backlog) {
                return '<a title="Detail Backlog" href="'.route('backlog.show', $backlog->id_backlog).'">'.$backlog->nama_backlog.'</a>';

            // })->addColumn('no_urut', function($backlog) {
            // return view('datatable._noUrut', [
            //     'angka' => $backlog->getKolomAttribute()
            // ]);
            // return $backlog->getKolomAttribute();

            })->make(true);
        }
        $html = $htmlBuilder
        // ->addColumn(['data' => 'no_urut', 'name' => 'no_urut', 'title' => 'No.'])
        ->addColumn(['data' => 'aplikasi.nama', 'name' => 'aplikasi.nama', 'title' => 'Aplikasi'])
        ->addColumn(['data' => 'nama_backlog', 'name' => 'nama_backlog', 'title' => 'Nama Backlog'])
        // ->addColumn(['data' => 'demo', 'name' => 'demo', 'title' => 'Demo'])
        // ->addColumn(['data' => 'catatan', 'name' => 'catatan', 'title' => 'Catatan'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => false]);
        return view('backlog.index')->with(compact('html'));
    }

    public function create()
    {
        return view('backlog.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'aplikasi_id' => 'required|exists:aplications,id',
            'nama_backlog' => 'required',
            'demo' => '',
            'catatan' => ''
        ]);
        $backlog = Backlog::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success", 
            "message"=>'Berhasil menyimpan "' . $backlog->nama_backlog . '" !'
        ]);
        return redirect()->route('backlog.index');
    }

    public function show($id)
    {
        $backlog = Backlog::find($id);
        return view('backlog.show', compact('backlog'));
    }

    public function edit($id)
    {
        $backlog = Backlog::find($id);
        return view('backlog.edit')->with(compact('backlog'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'aplikasi_id' => 'required|exists:aplications,id',
            'nama_backlog' => 'required',
            'demo' => 'required',
            'catatan' => ''
        ]);
        $backlog = Backlog::find($id);
        $backlog->update($request->all());
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => 'Berhasil menyimpan "'. $backlog->nama_backlog .'"'
        ]);
        return redirect()->route('backlog.index');
    }

    public function destroy($id)
    {

// Mengecek apakah backlog sedang digunakan
        $sprintBacklog = Sprintbacklog::where('id_backlog', $id)->count();
        if ($sprintBacklog > 0) {

            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Backlog Tidak Bisa Dihapus. Karena Sudah Terpakai."
            ]);

            return redirect()->route('backlog.index');
        }
        else {

            $backlog = Backlog::find($id);
            $backlog->delete();
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => 'Backlog "'. $backlog->nama_backlog .'" berhasil dihapus'
            ]);

            return redirect()->route('backlog.index');

        }

    }
    public function export()
    {
        return view('backlog.export');
    }
    public function exportPost(Request $request)
    {
        // validasi
        $this->validate($request, [
            'id'=>'required'
        ], 
        [
            'id.required'=>'Anda belum memilih Aplikasi. Pilih minimal 1 Aplikasi.'
        ]);

        $aplikasi = Aplication::whereIn('id', $request->get('id'))->get();
        Excel::create('Data Backlog Aplikasi Scrum', function($excel) use ($aplikasi) {
            $excel->setTitle('Data Backlog Aplikasi Scrum')->setCreator(Auth::user()->nama);

            // Merapikan data dari id-id aplikasi yg dikirim
            $arrayApp = json_decode($aplikasi, true);

            for ($i = 0; $i < count($arrayApp); $i++) {
                $dataApp = Aplication::where('id', $arrayApp[$i]['id'])->get();

                // Merapikan data dari aplikasi tertentu sesuai perulangan
                $dataApp = json_decode($dataApp, true);
                $backlog = Backlog::where('aplikasi_id', $arrayApp[$i]['id'])->get();

                // Merapikan data dari backlog tertentu sesuai perulangan
                $backlog = json_decode($backlog, true);

                // Membuat variable array kosong
                $arrayData = [];

                // Memasukkan array $dataApp dan $backlog ke array $arrayData
                array_push($arrayData, $dataApp, $backlog);

                $excel->sheet($arrayData[0][0]['nama'], function($sheet) use ($arrayData) {
                    $row = 1;
                    $sheet->row($row, [
                        'Nama Backlog',
                        'Waktu Dibuat',
                        'Demo',
                        'Catatan'
                    ]);
                    $backlog = Backlog::all()->first();
                    for ($u = 0; $u < count($arrayData[1]); $u++) {   
                        $sheet->row(++$row, [
                            $arrayData[1][$u]['nama_backlog'],
                            $backlog->translateTextTime($arrayData[1][$u]['created_at']),
                            // $arrayData[1][$u]['created_at'],
                            $arrayData[1][$u]['demo'],
                            // Menyaring tag html
                            strip_tags($arrayData[1][$u]['catatan'])
                        ]);
                    }
                });
            }
        })->export('xls');
    }
    public function exportAll() {
        // $aplikasi = Aplication::whereIn('id', $request->get('id'))->get();
        $jumlahAplikasi = Aplication::select('id')->count();
        $aplikasi = Aplication::all();
        $aplikasi = json_decode($aplikasi, true);
        $arrayIdApp = [];
        for ($i = 0; $i < $jumlahAplikasi; $i++) {
            array_push($arrayIdApp, $aplikasi[$i]['id']);
        }
        // echo "<pre>";
        // echo print_r($arrayIdApp);
        // echo "</pre>";
        /*
        */
        $aplikasi = Aplication::whereIn('id', $arrayIdApp)->get();
        Excel::create('Data Backlog Aplikasi Scrum', function($excel) use ($aplikasi) {
            $excel->setTitle('Data Backlog Aplikasi Scrum')->setCreator(Auth::user()->nama);

            // Merapikan data dari id-id aplikasi yg dikirim
            $arrayApp = json_decode($aplikasi, true);

            for ($i = 0; $i < count($arrayApp); $i++) {
                $dataApp = Aplication::where('id', $arrayApp[$i]['id'])->get();

                // Merapikan data dari aplikasi tertentu sesuai perulangan
                $dataApp = json_decode($dataApp, true);
                $backlog = Backlog::where('aplikasi_id', $arrayApp[$i]['id'])->get();

                // Merapikan data dari backlog tertentu sesuai perulangan
                $backlog = json_decode($backlog, true);

                // Membuat variable array kosong
                $arrayData = [];

                // Memasukkan array $dataApp dan $backlog ke array $arrayData
                array_push($arrayData, $dataApp, $backlog);

                $excel->sheet($arrayData[0][0]['nama'], function($sheet) use ($arrayData) {
                    $row = 1;
                    $sheet->row($row, [
                        'Nama Backlog',
                        'Waktu Dibuat',
                        'Demo',
                        'Catatan'
                    ]);
                    $backlog = Backlog::all()->first();
                    for ($u = 0; $u < count($arrayData[1]); $u++) {   
                        $sheet->row(++$row, [
                            $arrayData[1][$u]['nama_backlog'],
                            $backlog->translateTextTime($arrayData[1][$u]['created_at']),
                            $arrayData[1][$u]['demo'],
                            // Menyaring tag html
                            strip_tags($arrayData[1][$u]['catatan'])
                        ]);
                    }
                });
            }
        })->export('xls');
    }
    public function generateExcelTemplate() {
        Excel::create('Template Import Backlog', function($excel) {
        // Set the properties
            $excel->setTitle('Template Import Backlog')
            ->setCreator('Aplikasi Scrum')
            ->setCompany('Aplikasi Scrum')
            ->setDescription('Template import Backlog untuk Aplikasi Scrum');
            $excel->sheet('Data Backlog', function($sheet) {
                $row = 1;
                $sheet->row($row, [
                    'Nama Aplikasi',
                    'Nama Backlog',
                    'Demo',
                    'Catatan'
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
            'Nama Aplikasi' => 'required',
            'Nama Backlog' => 'required',
            'Demo' => '',
            'Catatan' => ''
        ];
        // Catat semua id backlog baru
        // ID ini kita butuhkan untuk menghitung total backlog yang berhasil diimport
        $backlogs_id = [];
        // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang di proses menjadi array
            $validator = Validator::make($row->toArray(), $rowRules);

            // Mengambil data nama dari master data aplikasi
            $namaAplikasi = Aplication::select('nama')->get();
            // Men-decode data
            $namaAplikasi2 = json_decode($namaAplikasi, true);
            // Mengambil data id dari master data aplikasi
            $idAplikasi = Aplication::select('id')->get();
            // Men-decode data
            $idAplikasi = json_decode($idAplikasi, true);
            // Membuat nama menjadi huruf kecil semua
            $importNamaAplikasi = strtolower($row['nama_aplikasi']);

            // Membuat variable array kosong
            $arrayDataAplikasi = [];
            // Memasukkan variable $namaAplikasi2 dan $idAplikasi
            // ke variable array kosong $arrayDataAplikasi
            array_push($arrayDataAplikasi, $namaAplikasi2, $idAplikasi);

            // Membuat variable array kosong
            // untuk menampung array data aplikasi "nama aplikasi => id aplikasi"
            $arrNamaIdAplikasi = [];

            // Mengisi variable array $arrNamaIdAplikasi dengan nama aplikasi sebagai index
            // dan id aplikasi sebagai value
            for ($i = 0; $i < count($arrayDataAplikasi[1]); $i++) {
                $arrNamaIdAplikasi[$arrayDataAplikasi[0][$i]['nama']] = $arrayDataAplikasi[1][$i]['id'];
            }

            // Mengubah semua key (nama aplikasi) menjadi huruf kecil
            $arrNamaIdAplikasi = array_change_key_case($arrNamaIdAplikasi, CASE_LOWER);

            // Membuat variable array kosong untuk menampung nama aplikasi
            $arrayNamaAplikasi = [];
            // Memasukkan data nama aplikasi ke variable $arrayNamaAplikasi
            foreach ($namaAplikasi as $namaApp) {
                array_push($arrayNamaAplikasi, $namaApp->nama);
            }
            // Membuat value dari $arrayNamaAplikasi menjadi huruf kecil semua
            $arrayNamaAplikasi = array_map('strtolower', $arrayNamaAplikasi);

            // Mengecek apakah nilai dari variable $importNamaAplikasi ada atau tidak
            // pada didalam array $arrayNamaAplikasi
            if (in_array($importNamaAplikasi, $arrayNamaAplikasi)) {

                // Membuat backlog baru
                $backlog = Backlog::create([
                    // Mengambil id aplikasi dari array berdasarkan nama aplikasi yang user masukkan
                    // pada file excel
                    'aplikasi_id' => $arrNamaIdAplikasi[$importNamaAplikasi],
                    'nama_backlog' => $row['nama_backlog'],
                    'demo' => $row['demo'],
                    'catatan' => $row['catatan']
                ]);
                // catat id dari backlog yang baru dibuat
                array_push($backlogs_id, $backlog->id_backlog);
            }
            // Proses jika nama aplikasi yang user masukkan belum ada
            else {

                // Membuat aplikasi baru
                $aplikasi = Aplication::create([
                    // Membuat setiap awal kata pada nama aplikasi menggunakan huruf kapital
                    'nama' => ucwords($row['nama_aplikasi'])
                ]);

                // Mengambil id terbaru dari master data aplikasi
                $idAplikasiTerbaru = DB::table('aplications')->orderBy('id', 'desc')->limit(1)->first();

                // Membuat backlog baru
                $backlog = Backlog::create([
                    'aplikasi_id' => $idAplikasiTerbaru->id,
                    'nama_backlog' => $row['nama_backlog'],
                    'demo' => $row['demo'],
                    'catatan' => $row['catatan']
                ]);
                
                // catat id dari backlog yang baru dibuat
                array_push($backlogs_id, $backlog->id_backlog);
            }
        }
        // Ambil semua backlog yang baru dibuat
        $backlogs = Backlog::whereIn('id_backlog', $backlogs_id)->get();
        // redirect ke form jika tidak ada backlog yang berhasil diimport
        if ($backlogs->count() == 0) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Tidak ada Backlog yang berhasil diimport."
            ]);
            return redirect()->back();
        }
        // Membuat alert
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengimport " . $backlogs->count() . " Backlog."
        ]);
        // Tampilkan index backlog
        return redirect()->route('backlog.index');
    }
    public function tes() {
        // $ar = ['Aku', 'kamu'];
        // if (in_array('kamu', $ar)) {
        //     echo "nilai ada";
        // }
        // else {
        //     echo "nilai tidak ada";
        // }
        $namaAplikasi = Aplication::select('nama')->get();
        $namaAplikasi = json_decode($namaAplikasi, true);
        $idAplikasi = Aplication::select('id')->get();
        $idAplikasi = json_decode($idAplikasi, true);
        // print_r($namaAplikasi);
        $arrayNamaAplikasi = [];
        // foreach ($namaAplikasi as $namaApp) {
        //     array_push($arrayNamaAplikasi, $namaApp->nama);
        // }
        array_push($arrayNamaAplikasi, $namaAplikasi, $idAplikasi);
        // foreach($arrayNamaAplikasi as $b) {
        // print_r($arrayNamaAplikasi);
        $arr = [];
        // foreach ($arrayNamaAplikasi[0] as $ar) {
        //     array_push($arr, $ar['nama']);
        // }
        // $aaa = [];
        for ($i = 0; $i < count($arrayNamaAplikasi[1]); $i++) {
            $arr[$arrayNamaAplikasi[0][$i]['nama']] = $arrayNamaAplikasi[1][$i]['id'];
        }


        // array_push($aaa, $arr);
        // $anu = ['a', 'b', 'c'];
        // $anu['a'] = 1;
        //     // echo $b[0][0]['nama'];
        // }
        // $arrayNamaAplikasi = array_map('strtolower', $arrayNamaAplikasi);
        // $arr['Aplikasi Absen Siswa'] = 1;
        $arr = array_change_key_case($arr, CASE_LOWER);

        // echo "<pre>";
        // print_r($arr);
        // echo "</pre>";
        $idne = DB::table('aplications')->orderBy('id', 'desc')->limit(1)->first();
        echo $idne->id;
    }
}
