<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Show prermission list
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

        $query = DB::table('permissions');
        
        if (isset($searchName) && $searchName != ''){
            $query->where('name', 'like', '%'.$searchName.'%');
        }

        $query->orderBy($orderName, $orderBy);
        $permissions = $query->paginate($recordPerPage);
        
        return view('admin.permission.list', ['permissions' => $permissions, 'searchFormData' => ['name'=> $searchName, 'orderBy' => $orderBy, 'orderName' => $orderName] ]);
    }

    /**
     * 
     * Create prermission
     *
     * @param  Request
     * @param Id : Permission Id
     * @return Response
     */
    public function add(Request $request, $id='')
    {        
        $permission = [];
        if($id != ''){
            $permission = DB::table('permissions')->where('id', $id)->first();
        }
        return view('admin.permission.add', ['permission' => $permission]);
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
            'name' => 'required|min:4|unique:permissions,name,'.$id //Id will be excluded from validation while edit
        ];
    
        $customMessages = [
            'name.required' => trans('custom-validation.required', ['attribute' => trans('label.permissionName') ]),
            'name.min'  => trans('custom-validation.min', ['attribute' => trans('label.permissionName'), 'min' => 4 ]),
            'name.unique'  => trans('custom-validation.exist', ['attribute' => trans('label.permissionName') ]),
        ];
    
        $this->validate($request, $rules, $customMessages);

        // The post is valid, store in database...
        if($id){
            DB::table('permissions')
                ->where('id', $id)
                ->update(['name' => $request->input('name')]);

            setFlashMessage('success', trans('label.success'), trans('message.successEdit', ['attribute' => trans('label.permission') ]));
        }else{
            $permission = Permission::create(['name' => $request->input('name')]);
            setFlashMessage('success', trans('label.success'), trans('message.successCreate', ['attribute' => trans('label.permission') ]));
        }

        return redirect()->route('permission list');
    }

     /**
     * 
     * condition based permission bulk action
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
                
                DB::table('role_has_permissions')->whereIn('permission_id', $ids)->delete();
                DB::table('model_has_permissions')->whereIn('permission_id', $ids)->delete();
                DB::table('permissions')->whereIn('id', $ids)->delete();
        
                setFlashMessage('success', trans('label.success'), trans('message.successDelete', ['attribute' => trans('label.permission') ]));
            }
        }

        return redirect()->route('permission list');
    }

}