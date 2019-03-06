<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Admin;
use App\Common\Utility;
use App\Http\helpers;
use Hash;

class AdminLoginController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest:admin', ['except' => ['logout','admin_otp']]);
  }

  public function showLoginForm()
  {
    return view('admin.auth.admin-login');
  }

  public function login(Request $request)
  {
    //Utility::stripXSS();
      // Validate the form data
    $this->validate($request, [
      'email'   => 'required|email',
      'password' => 'required|min:6'
    ]);

      // Attempt to log the user in
    if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,'status' => 1], $request->remember)) {
        // if successful, then redirect to their intended location
     $user = Admin::select('id')->where('email', $request->email)->first();
  
     return redirect()->intended(route('dashboard'));
   }

   $request->session()->flash('message.danger', 'These credentials do not match our records');

      // if unsuccessful, then redirect back to the login with the form data
   return redirect()->back()->withInput($request->only('email', 'remember'));
 }


 


  public function admin_otp(){

   $email=session('admin_email');
   $password=session('admin_password');
   if($email!='' and $password!=''){
    return view('admin.auth.otp');
  }else{
   return redirect('admin/login');
 }

}

public function submitAdminOtp(Request $request){
Utility::stripXSS();
  $this->validate($request, [
    'otp' => 'required',
  ]);

  $email=session('admin_email');
  $password=session('admin_password');
  $remember=session('admin_remember');
  if($email!='' and $password!=''){

   $valid_date_time=date("Y-m-d H:i:s", strtotime("-30 minutes"));
   $count= DB::table('admins')->where('email','=',$email)->where('otp', '=', $request->get('otp'))->where('otp_date', '>', $valid_date_time)->get()->count();
   if($count > 0){

   if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password,'status' => 1], $remember)) {
     // if successful, then redirect to their intended location
      $user = \App\Admin::select('id')->where('email', $email)->first();
      $user->otp=null;
      $user->otp_date=null;
      $user->save();
      DB::table('login_logs')->insert(
        ['user_id' =>$user->id, 'user_type' =>'admin','ip'=>$request->ip(),'user_agent'=>$request->header('user-agent'),'created_at'=>date('Y-m-d H:i:s')]
      );

      $request->session()->forget('admin_email');
      $request->session()->forget('admin_password');
      $request->session()->forget('admin_remember');

      return redirect('admin/dashboard');
    }else{

      flash('Something went wrong please try again!')->error();
      return redirect('admin/login');
    }

  }else{
   $errors = ['otp' => 'Invalid OTP'];
   return redirect()->back()->withInput()->withErrors($errors);
 }
}else{
 return redirect('admin/login');
}

return redirect()->back()->withInput();

}

public function reAdminSendOtp(Request $request,Helpers $helpers){
  $email=session('admin_email');
  $password=session('admin_password');
  $remember=session('admin_remember');
  $mobile_number=session('admin_mobile_number');
  if($email!='' and $password!='' and $mobile_number!=''){
     $six_digit_random_number = mt_rand(100000, 999999);
     $message='LaxmiCoin login OTP '.$six_digit_random_number;
     $status= $helpers->sendOtp($mobile_number,$message);
     if ($status) {
         $user = \App\Admin::select('id')->where('email', $email)->first();
         $user->otp=$six_digit_random_number;
         $user->otp_date=date('Y-m-d H:i:s');
         $user->save();

        echo "ok";

    } else {
      echo "error";
  }
}else{
    echo "session_expire";
}
  die;
}


 public function logout()
 {
  Auth::guard('admin')->logout();
  return redirect('/admin/login');
}

}
