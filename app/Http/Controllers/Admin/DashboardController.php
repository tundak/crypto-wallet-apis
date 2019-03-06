<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Admin;



class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //echo "ok"; die;
        $this->middleware('auth:admin');
    }

    /**
     * Show the application Admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $admin_count=0;
        $user_count=0;
        $order_count=0;
        $ticket_count=0; 
        $ticket_count_open=0; 
        $user_unactive=0; 

    

        return view('admin.dashboard.index',compact('admin_count','user_count','order_count','ticket_count','login_logs1','login_logs2','ticket_count_open','user_unactive'));
        
    }

    
    

}
