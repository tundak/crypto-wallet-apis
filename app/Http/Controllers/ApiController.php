<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Config;
use App\Mail\EmailVerify;
use Mail;
use App\Http\Helpers;

class ApiController extends Controller
{

	use SendsPasswordResetEmails;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $headers = apache_request_headers();
        $token = @$headers['token'];
        if($token!='CQLGSRP2BE3WEEGABP6EPE5KSEXT5V7MTXZTQGZST2DMO34MVRX55T7S'){
            $myObj=new \stdClass();
            $myObj->status = false;
            $myObj->result = [];
            $myObj->msg ='Unauthorized access.';
            $myJSON = json_encode($myObj);
            echo $myJSON; die;
        }
        
    }


public function getProfile(Request $request,Helpers $helpers){
    $input =  $request->only(['user_id']);

    $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
           return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  $message
                ), 200
            );
        }

/*
    $check_token=$helpers->_checkToken($input['user_id'],$input['api_token']);
       if ($check_token === null) {
        return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  'logout'
                ), 200
            );
       }
       */


    $user = User::find($input['user_id']);
     return Response()->json(
                    array(
                        'status' => true,
                        'result' => $user,
                        'msg' =>  'Successfully!'
                        ), 200
    );
 }

public function login(Request $request){
    
     $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
           return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  $message
                ), 200
            );
        }

    if (is_numeric($request->email)) {
        $field = 'mobile_number';
    } else {
        $field = 'email';
    }
     
    if (Auth::attempt([$field => $request->email, 'password' =>$request->password])) {

        $user = Auth::User();
        if($user->status==1){
        $api_token=substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 65)), 0, 65);
        $data = array(
        "user_id" => $user->id,
        "full_name" => $user->name,
        "btc_address" => $user->btc_address,
        "eth_address" => $user->eth_address,
        "uemail" => $user->email,
        "api_token" =>$api_token
        );

        $user->api_token=$api_token;
        $user->save();

        return Response()->json(
            array(
            'status' => true,
            'result' => $data,
            'msg' => "Login Successfully."
            ), 200
        );
     }elseif($user->status==2){
         return Response()->json(
            array(
            'status' => false,
            'result' => [],
            'msg' => "Your account has been blocked please contact to support@radicalhash.com"
            ), 200
        );
     }else{
         return Response()->json(
            array(
            'status' => false,
            'result' => [],
            'msg' => "Your account is not active, please verify your email."
            ), 200
        );
     }
    }else{

        return Response()->json(
            array(
            'status' => false,
            'result' => [],
            'msg' => "Opps! Invalid credentials."
            ), 200
        );
    }

 }

 public function signUp(Request $request){

     $validator = Validator::make($request->all(), [
            'full_name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
           return Response()->json(
			array(
				'status' => false,
				'result' => [],
				'msg' =>  $message
				), 200
			);
        }

       

        $input =  $request->only(['full_name','email','password']);
		$input['name'] = $input['full_name'];
        $input['status'] = 1;
        $input['password'] = bcrypt($request->get('password'));
               try{ 
                    $user = new User;
                    $user->fill($input)->save();

                    $email_data=['email'=>$input['email'],'password'=>$request->get('password')];
                    Mail::to($request->get('email'))->send(new EmailVerify($email_data));

                    return Response()->json(
					array(
						'status' => true,
						'result' => [],
						'msg' =>  'We have sent login access to your email!'
						), 200
					);
                } catch(\Exception $e){

		             return Response()->json(
					array(
						'status' => false,
						'result' => [],
						'msg' =>  'Process Failed!'
						), 200
					);
            }
          
 }


 public function forgotPassword(Request $request){

     $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
           return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  $message
                ), 200
            );
        }

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        
        if ($response === Password::RESET_LINK_SENT) {
            return Response()->json(
            array(
            'status' => true,
            'result' => [],
            'msg' => "We have e-mailed your password reset link!"
            ), 200
        );
        }else{
            return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  trans($response)
                ), 200
            );
        }
         
 }


  public function updateProfile(Request $request,Helpers $helpers)
    {
       
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'api_token' => 'required',
            'full_name' => 'required|max:191',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
           return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  $message
                ), 200
            );
        }

        $input =  $request->only(['full_name','user_id','api_token']);

      $check_token=$helpers->_checkToken($input['user_id'],$input['api_token']);
       if ($check_token === null) {
        return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  'logout'
                ), 200
            );
       }

       $input =  $request->only(['full_name','user_id']);
        $admin = User::find($input['user_id']);
        if ($request->has(['full_name'])) {
            try{ 
                $input['name']=$input['full_name'];
                $admin->fill($input)->save();
                return Response()->json(
                    array(
                        'status' => true,
                        'result' => [],
                        'msg' =>  'Profile updated successfully!!'
                        ), 200);
            } catch(\Exception $e){
             return Response()->json(
                    array(
                        'status' => false,
                        'result' => [],
                        'msg' =>  'Process Failed!'
                        ), 200
                    );
         }
     }
     

 }


 public function changePassword(Request $request,Helpers $helpers)
    {
        
         $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'api_token' => 'required',
            'old_password'     => 'required',
            'new_password'     => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
           return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  $message
                ), 200
            );
        }

        $input =  $request->only(['old_password','new_password','user_id','api_token']);

        $check_token=$helpers->_checkToken($input['user_id'],$input['api_token']);
       if ($check_token === null) {
        return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  'logout'
                ), 200
            );
       }

        $data = $request->all();
        $user = User::find($input['user_id']);
        
        if(!Hash::check($data['old_password'], $user->password)){
            return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  'Current password is invalid!'
                ), 200
            );

        }else{
            $obj_user = $user;
            $obj_user->password = Hash::make($data['new_password']);
            $obj_user->save();
            return Response()->json(
            array(
                'status' => true,
                'result' => [],
                'msg' =>  'Password changed successfully!'
                ), 200
            );
        }
        
    }


    public function createWallet(Request $request,Helpers $helpers)
    {
      
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'api_token' => 'required',
            'wallet_type' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
           return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  $message
                ), 200
            );
        }

        $input =  $request->only(['user_id','api_token','wallet_type']);

      $check_token=$helpers->_checkToken($input['user_id'],$input['api_token']);
       if ($check_token === null) {
        return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  'logout'
                ), 200
            );
       }

        if($input['wallet_type']=='BTC'){
            $WALLET_API_URL= env('WALLET_API_URL').'/btc/test3/addrs';
        }else{
            $WALLET_API_URL= env('WALLET_API_URL').'/beth/test/addrs?token=21324c1cd36540aa90dd12237e161ceb';
        }
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $WALLET_API_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
        // Set Here Your Requesred Headers
        'Content-Type: application/json',
        ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
          return Response()->json(
                    array(
                        'status' => false,
                        'result' => [],
                        'msg' =>  'Process Failed!'
                        ), 200
                    );
        } else {

            $obj_res=json_decode($response);
            $public =$obj_res->public;
            $address =$obj_res->address;
            $private =$obj_res->private;
            $admin = User::find($input['user_id']);

            try{ 

                if($input['wallet_type']=='BTC'){
                    $input['btc_public']=$public;
                    $input['btc_address']=$address;
                    $input['btc_private_key']=encrypt($private);
                }else{
                    $input['eth_address']=$address;
                    $input['eth_private_key']=encrypt($private);
                }
                
                $admin->fill($input)->save();

                $data = array(
                "public" => $public,
                "address" => $address,
                "private" => $private,
                );
                return Response()->json(
                    array(
                        'status' => true,
                        'result' => $data,
                        'msg' =>  'Wallet created successfully!!'
                        ), 200);
            } catch(\Exception $e){
             return Response()->json(
                    array(
                        'status' => false,
                        'result' => [],
                        'msg' =>  'Process Failed!'
                        ), 200
                    );
         }
        }

 }


  public function payment(Request $request,Helpers $helpers)
    {
      
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'api_token' => 'required',
            'wallet_type' => 'required',
            'to' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
           return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  $message
                ), 200
            );
        }

        $input =  $request->only(['user_id','api_token','wallet_type','to','amount','private_key']);
      $check_token=$helpers->_checkToken($input['user_id'],$input['api_token']);
       if ($check_token === null) {
        return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  'logout'
                ), 200
            );
       }

        if($input['wallet_type']=='BTC'){
            $WALLET_API_URL= env('WALLET_API_URL').'/btc/test3/txs/new';
            $input['amount']=$input['amount']*100000000;
        }else{
            $WALLET_API_URL= env('WALLET_API_URL').'/beth/test/txs/new?token=21324c1cd36540aa90dd12237e161ceb';
            $input['amount']=$input['amount']*1000000000000000000;
        }
        
        $admin = User::find($input['user_id']);

       
        if($input['wallet_type']=='BTC'){
            $from_addreess=$admin->btc_address;
            $input['private_key']=decrypt($admin->btc_private_key);
        }else{
            $from_addreess=$admin->eth_address;
            $input['private_key']=decrypt($admin->eth_private_key);
        }

        $post_fields = array( 
        "inputs" => array(array( 
            "addresses" => array($from_addreess), 
        )), 

        "outputs" => array(array( 
            "addresses" => array(trim($input['to'])), 
            "value" => (int)$input['amount'], 
        )  )
    ); 
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $WALLET_API_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS=>json_encode($post_fields),
        CURLOPT_HTTPHEADER => array(
        // Set Here Your Requesred Headers
        'Content-Type: application/json',
        ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
             print_r($err);
        }else{

            $response=json_decode($response);
            if(@$response->errors){

                if (strpos($response->errors[0]->error, 'Not enough funds') !== false) {
                    $response->errors[0]->error='Not enough funds to complete the transaction.';
                }else if (strpos($response->errors[0]->error, 'Unable to find') !== false) {
                    $response->errors[0]->error='Not enough funds to complete the transaction.';
                }else if (strpos($response->errors[0]->error, 'Error building transaction') !== false) {
                    $response->errors[0]->error='Please enter valid address.';
                }
                //echo $response->errors[0]->error; die;
                return Response()->json(
                    array(
                        'status' => false,
                        'result' => [],
                        'msg' => $response->errors[0]->error
                        ), 200
                    );
            }else{
                $tosign=@$response->tosign[0];

                if(!$tosign){
                    return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  'Please enter valid address!'
                ), 200
            );
                }
                $pkey = $input['private_key'];
                $signatures=shell_exec(base_path()."/signer $tosign $pkey 2>&1");

                $signatures=str_replace(array("\n", "\r"), '', $signatures);

                if($input['wallet_type']=='BTC'){
                    $WALLET_API_URL= env('WALLET_API_URL').'/btc/test3/txs/send';
                }else{
                    $WALLET_API_URL= env('WALLET_API_URL').'/beth/test/txs/send?token=21324c1cd36540aa90dd12237e161ceb';
                }

                $response->signatures[0]=$signatures;

                if($input['wallet_type']=='BTC'){
                  $response->pubkeys[0]=$admin->btc_public;
                }

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $WALLET_API_URL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS=>json_encode($response),
                CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
                ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    return Response()->json(
                    array(
                        'status' => false,
                        'result' => [],
                        'msg' => $err
                        ), 200
                    );
        }else{

            $response=json_decode($response);
            if(@$response->errors){

                if (strpos($response->errors[0]->error, 'Signature hex') !== false) {
                    $response->errors[0]->error='Invalid private key.';
                } else if (strpos($response->errors[0]->error, 'signature differs') !== false) {
                    $response->errors[0]->error='Invalid private key.';
                }
                return Response()->json(
                    array(
                        'status' => false,
                        'result' => [],
                        'msg' => $response->errors[0]->error
                        ), 200
                    );
            }else{


        DB::table('payments')->insert(
        ['user_id' =>$input['user_id'], 'to_address' =>$input['to'],'from_addreess'=>$from_addreess,'amount'=>$input['amount'],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'transaction_hash'=>@$response->tx->hash,'wallet_type'=>$input['wallet_type']]
      ); 

                return Response()->json( array(
                        'status' => true,
                        'result' =>[],
                        'msg' =>  'Your transaction has been processed successfully!!'
                        ), 200);

            }
        }

            }
    
        }      

 }


 public function importWallet(Request $request,Helpers $helpers)
    {
      
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'api_token' => 'required',
            'wallet_type' => 'required',
            'address' => 'required',
            'public_key' => 'required',
            'private_key' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
           return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  $message
                ), 200
            );
        }

    $input =  $request->only(['user_id','api_token','wallet_type','address','address','public_key','private_key']);

      $check_token=$helpers->_checkToken($input['user_id'],$input['api_token']);
       if ($check_token === null) {
        return Response()->json(
            array(
                'status' => false,
                'result' => [],
                'msg' =>  'logout'
                ), 200
            );
       }

            $admin = User::find($input['user_id']);

            try{ 

                if($input['wallet_type']=='BTC'){
                    $input['btc_public']=trim($input['public_key']);
                    $input['btc_address']=trim($input['address']);
                    $input['btc_private_key']=encrypt(trim($input['private_key']));
                }else{
                    $input['eth_address']=trim($input['public_key']);
                    $input['eth_private_key']=encrypt(trim($input['private_key']));
                }
                
                $admin->fill($input)->save();
                return Response()->json(
                    array(
                        'status' => true,
                        'result' =>[],
                        'msg' =>  'Wallet paired successfully!!'
                        ), 200);
            } catch(\Exception $e){
             return Response()->json(
                    array(
                        'status' => false,
                        'result' => [],
                        'msg' =>  'Process Failed!'
                        ), 200
                    );
         }
        

 }


}
