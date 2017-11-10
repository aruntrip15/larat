<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public $defaults;

    public $request;

    public function __construct() {
        $this->defaults = [
            'orderBy' => 'created_at',
            'order' => 'desc',
            'recordsPerPage' => globalSetting('adminRecordPerPage'),
        ];
    }

    public function get_default($key = "") {
        return $this->defaults[$key];
    }

    public function get_value($key = "") {
        $value = "";
        if ($this->request->get($key) !== null) {
            $value = $this->request->get($key);
        }
        else if (isset($this->defaults[$key])) {
            $value = $this->defaults[$key];
        }
        return $value;
    }

    /**
     * Show prermission list
     *
     * @param  Request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->request = $request;
        // Sets the parameters from the get request to the variables.
        $searchName = $this->get_value('name');
        $orderBy = $this->get_value('orderBy');
        $order = $this->get_value('order');

        $query = DB::table('permissions');
        
        if (isset($searchName) && $searchName != '') {
            $query->where('name', 'like', '%'.$searchName.'%');
        }

        $query->orderBy($orderBy, $order);
        $permissions = $query->paginate($this->get_default('recordsPerPage'));
        
        return view('admin.permission.list',
            [
                'permissions' => $permissions,
                'searchFormData' => [
                    'name'=> $searchName,
                    'orderBy' => $orderBy,
                    'order' => $order
                ]
            ]
        );
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
        return view('admin.permission.add',
            [
                'permission' => $permission
            ]
        );
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
     * Delete Prermission
     *
     * @param  Request
     * @param  Id : Permission Id
     * @return Response
     */
    public function delete(Request $request, $id)
    {
        DB::transaction(function () {
            DB::table('role_has_permissions')->where('permission_id', $id)->delete();
            DB::table('model_has_permissions')->where('permission_id', $id)->delete();
            DB::table('permissions')->where('id', $id)->delete();
        }, 3);

        setFlashMessage('success', trans('label.success'), trans('message.successDelete', ['attribute' => trans('label.permission') ]));
        return redirect()->route('permission list');
    }
}