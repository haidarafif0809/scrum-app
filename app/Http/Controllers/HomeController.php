<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
use App\Backlog;
use App\Sprint;
use App\Team;
use App\RoleUser;
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
        if (Laratrust::hasRole('admin')) return $this->adminDashboard();
           if (Laratrust::hasRole('member')) return $this->memberDashboard();
            return view('home');
        }
        protected function adminDashboard()
        {   
            $jumlah_member  = RoleUser::where('role_id',2)->count();
            $jumlah_team    = Team::count();
            $jumlah_sprint  = Sprint::count();
            $jumlah_backlog = Backlog::count();
            return view('dashboard.admin',[
                'jumlah_member' => $jumlah_member,
                'jumlah_team'   => $jumlah_team,
                'jumlah_sprint' => $jumlah_sprint,
                'jumlah_backlog'=> $jumlah_backlog
                
            ]);
            
        }

        protected function memberDashboard()
        {
         $jumlah_member = RoleUser::where('role_id',2)->count();
         $jumlah_team = Team::count();
         $jumlah_sprint = Sprint::count();
         $jumlah_backlog = Backlog::count();
         return view('dashboard.member', [
           'jumlah_member'    => $jumlah_member,
           'jumlah_team'      => $jumlah_team,
           'jumlah_sprint'    => $jumlah_sprint,
           'jumlah_backlog'   => $jumlah_backlog
       ]);
     }
 }
