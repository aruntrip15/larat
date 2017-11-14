<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Show role list
     *
     * @param  Request
     * @return Response
     */
    public function index(Request $request)
    {
    
        $defaultOrderName = "created_at";
        $defaultOrderBy = "desc";
        $recordPerPage = globalSetting('adminRecordPerPage');

        // Sets the parameters from the get request to the variables.
        $searchName = $request->get('name');
        $orderBy = ($request->get('orderBy'))?$request->get('orderBy'):$defaultOrderBy;
        $orderName = ($request->get('orderName'))?$request->get('orderName'):$defaultOrderName;

        $query = DB::table('roles');
        
        if (isset($searchName) && $searchName != ''){
            $query->where('name', 'like', '%'.$searchName.'%');
        }

        $query->orderBy($orderName, $orderBy);
        $roles = $query->paginate($recordPerPage);
        
        return view('admin.role.list', ['roles' => $roles, 'searchFormData' => ['name'=> $searchName, 'orderBy' => $orderBy, 'orderName' => $orderName] ]);
    }

    /**
     * 
     * Create prermission
     *
     * @param  Request
     * @param Id : Role Id
     * @return Response
     */
    public function add(Request $request, $id='')
    {        
        $role = [];
        $permissions = [];
        $selectedPermissions = [];

        if($id != ''){
            $role = DB::table('roles')->where('id', $id)->first();

            $query = DB::table('role_has_permissions');
            $query->select('permissions.name as permission');
            $query->leftJoin('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id');
            $query->where('role_id', $id);
            $selectedPermissions = $query->get();
            $selectedPermissions = array_pluck($selectedPermissions, 'permission'); // convert to simple array to check in_array value
           
        }
        $permissions = DB::table('permissions')->get();

        return view('admin.role.add', ['role' => $role, 'permissions' => $permissions, 'selectedPermissions' => $selectedPermissions]);
    }

    /**
     * 
     * Store prermission to save in database
     *
     * @param  Request
     * @return Response
     */
    public function store(Request $request)
    {        
        $id = $request->input('id');

        $rules = [
            'name' => 'required|min:4|unique:roles,name,'.$id
        ];
    
        $customMessages = [
            'name.required' => trans('custom-validation.required', ['attribute' => trans('label.roleName') ]),
            'name.min'  => trans('custom-validation.min', ['attribute' => trans('label.roleName'), 'min' => 4 ]),
            'name.unique'  => trans('custom-validation.exist', ['attribute' => trans('label.roleName') ]),
        ];
    
        $this->validate($request, $rules, $customMessages);
        
        $permissions = $request->input('permissions');

        // The post is valid, store in database...
        if($id){
            DB::table('roles')
                ->where('id', $id)
                ->update(['name' => $request->input('name')]);

            $role = Role::findByName($request->input('name'));

            if(!empty($permissions)){
                 //Update permissions
                $role->syncPermissions($permissions);
            }else{
                //Revoke all permissions
                DB::table('role_has_permissions')->where('role_id', $id)->delete();
            }
            
            setFlashMessage('success', trans('label.success'), trans('message.successEdit', ['attribute' => trans('label.role') ]));
        }else{

            $role = Role::create(['name' => $request->input('name')]); 
            if(!empty( $permissions )){
                $role->givePermissionTo($permissions);
            }  
            setFlashMessage('success', trans('label.success'), trans('message.successCreate', ['attribute' => trans('label.role') ]));
        }

        return redirect()->route('role list');
    }

     /**
     * 
     * condition based role bulk action
     *
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

                DB::table('role_has_permissions')->whereIn('role_id', $ids)->delete();
                DB::table('model_has_roles')->whereIn('role_id', $ids)->delete();
                DB::table('roles')->whereIn('id', $ids)->delete();
        
                setFlashMessage('success', trans('label.success'), trans('message.successDelete', ['attribute' => trans('label.role') ]));
            }
        }

        return redirect()->route('role list');
    }

}