<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// menampilkan user
use App\Role;
use App\RoleUser;
use App\User;
use App\Team;
use App\TeamUser;
use Yajra\Datatables\Html\Builder;
// use Yajra\Datatables\Facades\Datatables;
use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        // ->addColumn($member->role_user->role)
        ->addColumn('action', function($member){
            return view('datatable._action', [
                'model' => $member,
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
            "message"=>"<p>Berhasil menyimpan user " . $user->name . "</p>"
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

    public function repass($id) {
        $user = User::find($id);
        $password = 'rahasiaku';
        if ($user->password == true) {
            $user->update(['password' => $password]);
        }
        return redirect()->route('users.index');
    }

}
