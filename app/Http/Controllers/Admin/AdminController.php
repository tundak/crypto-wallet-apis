<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Role;
use App\AdminRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Common\Utility;
use App\Country;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $this->checkPermission(['admin']);
        $q = Input::get('keyword');
        if($q != ""){
            # going to next admin is not working yet
            $data = Admin::with('roles')->where('id','<>', 1)
            ->where('first_name', 'LIKE', '%' . $q . '%')
            ->orWhere('last_name', 'LIKE', '%' . $q . '%')
            ->orWhere('email', 'LIKE', '%' . $q . '%')
            ->paginate(10);
            $data->appends(['keyword' => $q]);
        } else {
            $data = Admin::with('roles')->orderBy('id','Asc')->where('id','<>', 1)->paginate(10);
        }
        $admin_title = 'All Employees';
        return view('admin.admins.index',compact('admin_title','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkPermission(['admin']);
        $page_title = 'New Employee';
        $admin = new admin;
        $country_phone_code = Country::select(
            DB::raw("CONCAT('+',phonecode) AS phonecode2"),'phonecode')
            ->pluck('phonecode2', 'phonecode');
        $roles = Role::where('id','<>',1)->pluck('description', 'id');
        return view('admin.admins.create',compact('page_title','admin','roles','country_phone_code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        Utility::stripXSS();
        $this->checkPermission(['admin']);

         $messages = ['password.regex' => "Your password must contain 1 lower case character 1 upper case character one number"];

       $this->validate($request, [
        'first_name' => 'required',
        'last_name' => 'required',
        'phone_code' => 'required',
        'mobile_number' => 'required',
        'email' => 'required|email|max:255|unique:admins',
        'password'  => 'required|min:8|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
        'confirm_password' => 'required|same:password',
    ],$messages);

       if ($request->has(['first_name','last_name','email','password','phone_code','mobile_number'])) {
        $input = $request->all(); 
        if(!Input::has('status')) { $input['status'] = 0;  }
            $input['password'] = bcrypt($request->get('password'));
            try{ 

                $admin = new admin;
                $admin->fill($input)->save();

                $role_ids = $request->get('role_id');
                foreach($role_ids as $role_id){ 
                    $role_admin['role_id']=$role_id;
                    $admin->roles()->attach($role_admin);
                }
                
                flash('New employee added succesully!')->success();
            } catch(\Exception $e){
             flash('Process Failed!')->error();
         }
     }
     return redirect()->route('admins.index');
 }

    /**
     * Display the specified resource.
     *
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        $this->checkPermission(['admin']);
        $admin = Admin::where('id',$admin->id)->where('id','<>',1)->get()->first();
        if($admin->id){
            $admin_title = 'View Employee';
            return view('admin.admins.show',compact('page_title','admin'));
        } else {
            flash('Invalid Request!')->warning();
            return redirect()->route('admins.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $this->checkPermission(['admin']);
        $admin = Admin::where('id',$admin->id)->where('id','<>',1)->get()->first();
        if($admin->id){
            $admin = Admin::with(['roles'])->findOrFail($admin->id);
            $admin_title = 'Edit Employee';
            $roles = Role::where('id','<>',1)->pluck('description', 'id');
            $role_id[]=@$admin->roles[0]->id;
            $role_id[]=@$admin->roles[1]->id;
            $role_id[]=@$admin->roles[2]->id;
            $country_phone_code = Country::select(
            DB::raw("CONCAT('+',phonecode) AS phonecode2"),'phonecode')
            ->pluck('phonecode2', 'phonecode');
            return view('admin.admins.edit',compact('admin_title','admin','roles','role_id','country_phone_code'));
        } else {
            flash('Invalid Request!')->warning();
            return redirect()->route('admins.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        Utility::stripXSS();
        $this->checkPermission(['admin']);
        $admin = Admin::where('id',$admin->id)->where('id','<>',1)->get()->first();

         $messages = ['password.regex' => "Your password must contain 1 lower case character 1 upper case character one number"];
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_code' => 'required',
            'mobile_number' => 'required',
            'password'  => 'nullable|min:8|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
            'confirm_password' => 'same:password',
        ],$messages);

        if ($request->has(['first_name','last_name','phone_code','mobile_number'])) {
            if($request->get('password')!=''){
                $input =  $request->except(['email']); 
                $input['password'] = bcrypt($request->get('password'));
            }else{
                $input =  $request->except(['email','password']); 
            }
            
            if(!Input::has('status')) { $input['status'] = 0;  }
                try{ 
                    
                    $admin->fill($input)->save();
                    DB::table('admin_role')->where('admin_id', '=', $admin->id)->delete();
                    $role_ids = $request->get('role_id');
                    foreach($role_ids as $role_id){ 
                        $role_admin['role_id']=$role_id;
                        $admin->roles()->attach($role_admin);
                    }
                    flash('Updated succesully!')->success();
                } catch(\Exception $e){
                 flash('Process Failed!')->error();
             }
         }
         return redirect()->route('admins.index');
     }

   

    public function changePassword()
    {
        return view('admin.admins.change-password');  
    }

    public function changePasswordSubmit(Request $request)
    {

        Utility::stripXSS();
        
        $messages = ['new_password.regex' => "Your password must contain 1 lower case character 1 upper case character one number"];
        $this->validate($request, [
            'old_password'     => 'required',
            'new_password'     => 'required|min:8|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
            'confirm_password' => 'required|same:new_password',
        ],$messages);

        $data = $request->all();
        
        $user = Admin::find(auth()->user()->id);
        if(!Hash::check($data['old_password'], $user->password)){
            flash('The specified password does not match the database password!')->error();
        }else{
            $user_id = $user->id;
            $obj_user = Admin::find($user_id)->first();
            $obj_user->password = Hash::make($data['new_password']);
            $obj_user->save();
            flash('Password changed succesully!')->success();
        }
        return redirect()->route('change-password');
    }


    public function editProfile()
    {   
        //$this->checkPermission(['admin','employee']);
        $user = Admin::find(auth()->user()->id);
        $admin_title = 'edit profile';
        return view('admin.admins.edit-profile',compact('admin_title','user'));  
    }


    public function editProfileSubmit(Request $request)
    {

        Utility::stripXSS();
        $admin = Admin::find(auth()->user()->id);
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        if ($request->has(['first_name','last_name'])) {
            $input =  $request->only(['first_name','last_name']);
            try{ 
                $admin->fill($input)->save();
                flash('Profile updated succesully!')->success();
            } catch(\Exception $e){
             flash('Process Failed!')->error();
         }
     }
     return redirect()->route('edit-profile');

 }
}
