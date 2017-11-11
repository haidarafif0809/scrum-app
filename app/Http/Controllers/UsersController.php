<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
// menampilkan user
use App\Role;
use App\RoleUser;
use App\User;
use App\Team;
use App\TeamUser;
use Illuminate\Support\Facades\Auth;
// use Yajra\Datatables\Facades\Datatables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// mengunakan Exel
use Excel;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $members = User::with('team');
            return Datatables::of($members)
            ->escapeColumns([])
        // ->addColumn($member->role_user->role)
            ->addColumn('action', function($member){
                return view('datatable._action_user', [
                    'model' => $member,
                    'id_member' => $member->id,
                    'form_url' => route('users.destroy', $member->id),
                    'edit_url' => route('users.edit', $member->id),
                    'confirm_message' => 'Yakin akan menghapus ' . $member->name . ' ?'
                ]);
            })
            ->addColumn('konfirmasi', function($member){
                return view('datatable._konfirmasi', [
                    'model' => $member, 
                    'konfirmasi_url' => route('users.konfirmasi', $member->id),
                    'confirm_message' => 'Apakah Anda Yakin akan mengkonfimasi ' . $member->name . ' ?',
                    'confirm_messages' => 'Apakah Anda Yakin akan membatalkan konfirmasi ' . $member->name . ' ?'
                ]);
            })        
            ->addColumn('re_pass', function($member){
                return view('datatable.re_pass', [
                    'model' => $member, 
                    're_pass_url' => route('users.repass', $member->id),
                    'confirm_message' => 'Apakah Anda Yakin akan me-reset password ' . $member->name . ' ?',
                ]);
            })
            ->addColumn('otoritas', function($member){
               return $member->roleUser->role->name;
           })
            ->addColumn('team', function($member){

                $teams = TeamUser::where('user_id', $member->id)->get();
                $data_team = '';
                foreach($teams as $team) {
                    if ($data_team == '') {
                        $data_team .= $team->team->nama_team;
                    }
                    else {
                        $data_team .= ', ' . $team->team->nama_team;

                    }

                }
                return $data_team;
                
            })->make(true);
        }
        
        $html = $htmlBuilder
        ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
        ->addColumn(['data' => 'email', 'name'=>'email', 'title'=>'Email'])
        ->addColumn(['data' => 'team', 'name'=>'team', 'title'=>'Team', 'orderable'=>false, 'searchable'=>false])
        ->addColumn(['data' => 'otoritas', 'name'=>'otoritas', 'title'=>'Otoritas', 'orderable'=>false, 'searchable'=>false])
        ->addColumn(['data' => 'jml_assign', 'name' => 'jml_assign', 'title' => 'Total Assign'])
        ->addColumn(['data' => 'jml_finish', 'name' => 'jml_finish', 'title' => 'Total Finish'])
        ->addColumn(['data' => 'konfirmasi', 'name'=>'konfirmasi', 'title'=>'Konfirmasi', 'orderable'=>false, 'searchable'=>false])
        ->addColumn(['data' => 're_pass', 'name'=>'re_pass', 'title'=>'Reset password', 'orderable'=>false, 'searchable'=>false])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Aksi', 'orderable'=>false, 'searchable'=>false]);
        return view('users.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('users.create');
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
            'name' => 'required:users',
            'email' => 'required|unique:users',
            'otoritas' => 'required|exists:roles,id',
            'team_id' => 'required'
        ]);
        // $team_id = Team::where('id', $request->team_id)->first();
        $Role = Role::where('id', $request->otoritas)->first();
        $password = 'rahasiaku';
        $is_verified = 1;      
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => $password, 'is_verified' => $is_verified]);
        $user->attachRole($Role);
        foreach($request->team_id as $team_id){
            TeamUser::create(['user_id' => $user->id, 'team_id' => $team_id]);
        }


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan user $user->name"
        ]);
        return redirect()->route('users.index');

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
        $user = User::with('roleUser')->find($id);
        $team = TeamUser::where('user_id', $id)->get();
        $data_team = '';
        foreach ($team as $teams) {
            $data_team .= "'" . $teams->team_id . "', "; 
        }
        return view('users.edit')->with(compact('user', 'data_team'));

        // return $data_team;
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
        $this->validate($request, [
            'name' => 'required:users,name',
            'email' => 'required|unique:users,email,'. $id,
            'otoritas' => 'required|exists:roles,id',
            'team_id' => 'required|exists:teams,id'
        ]);

        //update untuk di data user 
        $roleLama = RoleUser::where('user_id', $id)->delete();
        $teamLama = TeamUser::where('user_id', $id)->delete();
        // $team_id = Team::where('id', $request->team_id, $id)->first();
        $role = Role::where('id', $request->otoritas, $id)->first();
        $user = User::find($id);
        $user->update(['name' => $request->name, 'email' => $request->email]);
        $user->attachRole($role);
        // $team = TeamUser::where('user_id', $id)->where('team_id', $id);

        foreach($request->team_id as $team_id){
            TeamUser::create(['user_id' => $user->id, 'team_id' => $team_id]);
        }

        session::flash('flash_notification', [
            "level" => "success",
            "message" => "Anda Berhasil mengedit " . $user->name . " !"
        ]);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        Session::flash('flash_notification', [
            "level" => "danger", 
            "message" => "Proses menghapus berhasil !"
        ]);
        return redirect()->route('users.index');
    }

    // untuk proses verivikasi user
    public function konfirmasi($id){                                                      
        $user = User::find($id);

        if ($user->is_verified == 0) {
            $user->update(['is_verified' => 1]);
            Session::flash('flash_notification',  [
                'level' => 'success',
                'message' => 'User ' .$user->name . ' berhasil di Konfirmasi ! '
            ]);
        }
        else {
            $user->update(['is_verified' => 0]);
            Session::flash('flash_notification',  [
                'level' => 'danger',
                'message' => 'User ' .$user->name . ' berhasil di batalkan ! '
            ]);
        }

        return redirect()->route('users.index');
    }

    // untuk proses reset password
    public function repass($id) {
        $user = User::find($id);
        $password = 'rahasiaku';
        if ($user->password == true) {
            $user->update([
                'password' => $password
            ]);
        }
        return redirect()->route('users.index');
    }

    // proses export berdasarkan id
    public function export() {
        return view('users.export');
    }

    // proses export 
    public function exportPost(Request $request) {
        // validasi
        $this->validate($request, [
            'name'=>'required',
        ], [
            'name.required'=>'Anda belum memilih penulis. Pilih minimal 1 penulis.'
        ]);

        $users = User::whereIn('id', $request->get('name'))->get();
        Excel::create('Data User Scrum-App', function($excel) use ($users) {
            // Set property
            $excel->setTitle('Data User Scrum-App')
            ->setCreator(Auth::user()->name);
                // ->setCreator(Auth::user()->name);
            $excel->sheet('Data User', function($sheet) use ($users) {
                $row = 1;
                $sheet->row($row, [
                    'Nama',
                    'Email',
                    'Konfirmasi'
                ]);
                foreach ($users as $user) {
                    $sheet->row(++$row, [
                        $user->name,
                        $user->email,
                        $user->is_verified
                    ]);
                }
            });
        })->export('xls');
    }

    // untuk proses export all
    public function exportAllPost() {
        $data = User::select('name', 'email', 'password', 'is_verified')->get();
        Excel::create('Semua Data User', function($excel) use ($data) {
            $excel->sheet('Data User', function($sheet) use ($data) {
                $sheet->fromArray($data);

            });

        })->download('xls');
    }

    public function generateExcelTemplate() { 
        Excel::create('Template Import User', function($excel) {
            // Set the properties
            $excel->setTitle('Template Import User')
            ->setCreator('Scrum-App')
            ->setCompany('Scrum-App')
            ->setDescription('Template import data user untuk Scrum-App');
            $excel->sheet('Data User', function($sheet) {
                $row = 1;
                $sheet->row($row, [
                    'name',
                    'email',
                    'password',
                    'otoritas',
                    'team_id'
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'otoritas' => 'required|exists:roles,id',
            'team_id' => 'required'
        ];
        // Catat semua id buku baru
        // ID ini kita butuhkan untuk menghitung total buku yang berhasil diimport
        $users_id = [];
            // looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang di proses menjadi array
            $validator = Validator::make($row->toArray(), $rowRules);
            // buat buku baru
            $user = User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => $row['password']
            ]);
            $role = RoleUser::create([
                'user_id' => $user->id, 'role_id' => $row['otoritas']
            ]);
            $team = Teamuser::create([
                'user_id' => $user->id,
                'team_id' => $row['team_id']]);
            // catat id dari buku yang baru dibuat
            array_push($users_id, $user->id);
        }
        // Ambil semua buku yang baru dibuat
        $users = User::whereIn('id', $users_id)->get();
        // redirect ke form jika tidak ada buku yang berhasil diimport
        if ($users->count() == 0) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Tidak ada buku yang berhasil diimport."
            ]);
            return redirect()->back();
        }
        // set feedback
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengimport " . $users->count() . " user."
        ]);
        // Tampilkan index buku
        return redirect()->route('users.index');

    }
}

