<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// menampilkan user
use App\Role;
use App\RoleUser;
use App\User;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Facades\Datatables;
// use Illuminate\Support\Facades\DB;
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
        $members = User::all();
        return Datatables::of($members)
        // ->addColumn($member->role_user->role)
        ->addColumn('action', function($member){
            return view('datatable._action', [
                'model' => $member,
                'form_url' => route('users.destroy', $member->id),
                'edit_url' => route('users.edit', $member->id),
                'confirm_message' => 'Yakin mau menghapus ' . $member->name . ' ?'
            ]);
         })
        ->addColumn('konfirmasi', function($member){
            return view('datatable._konfirmasi', [
                'model' => $member, 
                'konfirmasi_url' => route('users.konfirmasi', $member->id),
                'confirm_message' => 'Apakah Anda Yakin mau mengkonfimasi ' . $member->name . ' ?',
                'confirm_messages' => 'Apakah Anda Yakin mau membatalkan konfirmasi ' . $member->name . ' ?'
            ]);
        })
        ->addColumn('otoritas', function($member){
               return $member->roleUser->role->name;
        })->make(true);

    }
    
    $html = $htmlBuilder
        ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
        ->addColumn(['data' => 'email', 'name'=>'email', 'title'=>'Email'])
        ->addColumn(['data' => 'otoritas', 'name'=>'otoritas', 'title'=>'Otoritas', 'orderable'=>false, 'searchable'=>false])
         ->addColumn(['data' => 'konfirmasi', 'name'=>'konfirmasi', 'title'=>'Konfirmasi', 'orderable'=>false, 'searchable'=>false])
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
        'name' => 'required|unique:users',
        'email' => 'required|unique:users',
        'otoritas' => 'required|exists:roles,id'
        ]);
        $Role = Role::where('id', $request->otoritas)->first();
        $password =  bcrypt('rahasiaku');
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => $password]);
        $user->attachRole($Role);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"<p>Berhasil menyimpan user <h4 style'font-color:red'>" . $user->name . " !</h4></p>"
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
        return view('users.edit')->with(compact('user'));   
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
            'name' => 'required|unique:users,name,'. $id,
            'email' => 'required|unique:users,email,'. $id,
            'otoritas' => 'required|exists:roles,id'
        ]);

        //update untuk di data user 
        $roleLama = RoleUser::where('user_id', $id)->delete();
        $role = Role::where('id', $request->otoritas, $id)->first();
        $user = User::find($id);
        $user->update(['name' => $request->name, 'email' => $request->email]);
        $user->attachRole($role);
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
}
