<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
use App\Backlog;
use App\Sprint;
use App\Team;
use App\RoleUser;
use App\Sprintbacklog;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       $jumlah_member  = RoleUser::where('role_id',2)->count();
       $jumlah_team    = Team::count();
       $jumlah_sprint  = Sprint::count();
       $jumlah_backlog = Backlog::count();
       $jumlah_assign = Sprintbacklog::where('assign',1)->count();
       $jumlah_finish = Sprintbacklog::where('finish',1)->count();
       return view('dashboard.admin',[
        'jumlah_member' => $jumlah_member,
        'jumlah_team'   => $jumlah_team,
        'jumlah_sprint' => $jumlah_sprint,
        'jumlah_backlog'=> $jumlah_backlog,
        'jumlah_assign' => $jumlah_assign,
        'jumlah_finish' => $jumlah_finish
    ]);
       
   }
   protected function adminDashboard()
   {   

   }

   protected function memberDashboard()
   {
      
    
   }
}
