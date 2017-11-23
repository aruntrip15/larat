<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  
     * @return Response
     */
    public function index(Request $request)
    {
        $defaultOrderName = "users.created_at";
        $defaultOrderBy = "desc";
        $recordPerPage = globalSetting('adminRecordPerPage');

        // Sets the parameters from the get request to the variables.
        $searchName = $request->get('nameOrEmail');
        $searchRole = $request->get('role');
        $orderBy = ($request->get('orderBy'))?$request->get('orderBy'):$defaultOrderBy;
        $orderName = ($request->get('orderName'))?$request->get('orderName'):$defaultOrderName;

        // User Query
        $query = DB::table('users');
        $query->select('users.id as id', 'users.name as name', 'users.email as email', 'roles.id as role_id', 'roles.name as role_name', 'users.created_at');
        $query->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id');
        $query->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id');
        
        if (isset($searchName) && $searchName != ''){
            $query->where('users.name', 'like', '%'.$searchName.'%')->orWhere('users.email', 'like', '%'.$searchName.'%');
        }

        if (isset($searchRole) && $searchRole != ''){
            $query->where('model_has_roles.role_id', '=', $searchRole);
        }
        
        $query->orderBy($orderName, $orderBy);
        $users = $query->paginate($recordPerPage);

        foreach ($users as $user) {
            $user->formatted_date = date("d F, Y", strtotime($user->created_at));
        }

        // Role Query
        $roles = DB::table('roles')->get();
        
        return view('admin.user.list', ['users' => $users, 'roles' => $roles, 'searchFormData' => ['nameOrEmail'=> $searchName, 'role' => $searchRole, 'orderBy' => $orderBy, 'orderName' => $orderName] ]);
    }

     /**
     * 
     * Create user
     *
     * @param  Request
     * @param Id : User Id
     * @return Response
     */
    public function add(Request $request, $id='')
    {        
        $user = [];
        $selectedRoles = [];
        $randomPassword = "";

        if($id != ''){
            $user = DB::table('users')->where('id', $id)->first();

            $query = DB::table('model_has_roles');
            $query->select('roles.name as role');
            $query->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id');
            $query->where('model_id', $id);
            $selectedRoles = $query->get();
            $selectedRoles = array_pluck($selectedRoles, 'role'); // convert to simple array to check in_array value
        }
        else {
            $randomPassword = str_random(6);
        }

        $roles = DB::table('roles')->get();

        return view('admin.user.add', ['user' => $user, 'roles' => $roles, 'selectedRoles' => $selectedRoles, 'randomPassword' => $randomPassword]);
    }

    
    /**
     * 
     * Store user in database
     *
     * @param  Request
     * @return Response
     */
    public function store(Request $request)
    {        
        $id = $request->input('id');
        $filename = '';

        $rules = [
            'name' => 'required|string|min:4|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => ((!$id)?'required|':'nullable|').'min:6',
            'avatar' => 'mimes:jpeg,jpg,png|max:2048|nullable',
        ];
        
    
        $customMessages = [
            'name.required' => trans('custom-validation.required', ['attribute' => trans('label.userName') ]),
            'name.min'  => trans('custom-validation.min', ['attribute' => trans('label.userName'), 'min' => 4 ]),

            'email.required' => trans('custom-validation.required', ['attribute' => trans('label.userEmail') ]),
            'email.unique'  => trans('custom-validation.exist', ['attribute' => trans('label.userEmail') ]),

            'password.required' => trans('custom-validation.required', ['attribute' => trans('label.userPwd') ]),
            
        ];
    
        
        $this->validate($request, $rules, $customMessages);
        
        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            //Save file to storage
            $request->file('avatar')->store('public/avatars');
            // ensure every image has a different name
            $filename = $request->file('avatar')->hashName();            
        }
       
        if($id){
            $data = ['name' => $request->input('name'), 'email' => $request->input('email'), 'updated_at' => date('Y-m-d H:i:s')];

            $password = $request->input('password');
            
            if($password != ''){
                $data['password'] = bcrypt($password);
            }

            if($filename != ''){
                $data['avatar'] = $filename;
            }

            DB::table('users')
                ->where('id', $id)
                ->update($data);

            $user = User::find($id);
            
            setFlashMessage('success', trans('label.success'), trans('message.successEdit', ['attribute' => trans('label.user') ]));

        }else{

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'avatar' => $filename
            ]);

            setFlashMessage('success', trans('label.success'), trans('message.successCreate', ['attribute' => trans('label.user') ]));
        }

        // UPDATE user role 
        $role = $request->input('role');
        if($role){
            //Update role 
            $user->syncRoles([$role]);
        }else{
            //Remove role 
            DB::table('model_has_roles')->where('model_id', $id)->delete();
        }

        return redirect()->route('user list');
    }

     /**
     * 
     * condition based user bulk action
     * e.g. delete, active
     * @param  Request
     * @return Response
     */
    public function action(Request $request)
    {        

        $ids = $request->input('bulkRecordIds');
        $action = $request->input('bulkRecordAction');

        if($action == 'delete'){

            if($ids != ''){
                $ids = explode(',',$ids);

                DB::table('model_has_roles')->whereIn('model_id', $ids)->delete();
                DB::table('users')->whereIn('id', $ids)->delete();

                setFlashMessage('success', trans('label.success'), trans('message.successDelete', ['attribute' => trans('label.user') ]));    
            }
        }

        return redirect()->route('user list');
    }

    /**
     * Change user password
     *
     * @param  Request
     * @param Id : User Id
     * @return Response
     */
    public function changePassword(Request $request, $id)
    {        

        $user = DB::table('users')->where('id', $id)->first();

        return view('admin.user.password', ['user' => $user]);
    }

    
    /**
     * 
     * Store password in database
     *
     * @param  Request
     * @return Response
     */
    public function storePassword(Request $request)
    {        
      
        $rules = [
            'id' => 'required',
            'password' => 'required|min:6|confirmed',
        ];
        
        $customMessages = [
            'password.required' => trans('custom-validation.required', ['attribute' => trans('label.userPwd') ]),
        ];
    
        $this->validate($request, $rules, $customMessages);
        
        $id = $request->input('id');
        
        $data = [ 'updated_at' => date('Y-m-d H:i:s')];
        $data['password'] = bcrypt($request->input('password'));
        
        DB::table('users')
            ->where('id', $id)
            ->update($data);

        setFlashMessage('success', trans('label.success'), trans('message.successEdit', ['attribute' => trans('label.userPwd') ]));

        return redirect()->route('user add', ['id' => $id ]);
    }


}
