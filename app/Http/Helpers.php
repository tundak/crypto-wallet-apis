<?php 
namespace App\Http;
use Config;
use Mail;
use AWS;
use DB;
use Carbon\Carbon;
class Helpers {

    public function _checkToken($user_id,$api_token){

     $user = DB::table('users')
     ->where('id', '=', $user_id)
     ->where('api_token', '=', $api_token)
     ->first();
     return $user;

    }

}
