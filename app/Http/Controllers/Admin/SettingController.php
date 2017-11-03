<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Settings;

class SettingController extends Controller
{
    /**
     * Show settings list
     *
     * @param  Request
     * @return Response
     */
    public function index(Request $request)
    {
    

        // pre(Settings::get('adminTheme    '));
        $defaultOrderName = "setting_key";
        $defaultOrderBy = "asc";
        $recordPerPage = globalSetting('adminRecordPerPage');

        // Sets the parameters from the get request to the variables.
        $searchName = $request->get('name');
        $orderBy = ($request->get('orderBy'))?$request->get('orderBy'):$defaultOrderBy;
        $orderName = ($request->get('orderName'))?$request->get('orderName'):$defaultOrderName;

        $query = DB::table('settings__lists');
        
        if (isset($searchName) && $searchName != ''){
            $query->where('setting_key', 'like', '%'.$searchName.'%');
        }

        if(env('APP_ENV') == 'production'){
            $query->where('setting_type', 'prod');
        }

        $query->orderBy($orderName, $orderBy);
        $settings = $query->paginate($recordPerPage);
        
        return view('admin.settinglist', ['settings' => $settings, 'searchFormData' => ['name'=> $searchName, 'orderBy' => $orderBy, 'orderName' => $orderName] ]);
    }

    /**
     * 
     * Create setting
     *
     * @param  Request
     * @param Id : Setting Id
     * @return Response
     */
    public function add(Request $request, $id='')
    {        
        $setting = [];
        if($id != ''){
            $setting = DB::table('settings__lists')->where('id', $id)->first();
        }
        return view('admin.settingadd', ['setting' => $setting]);
    }

    /**
     * 
     * Store setting to database
     *
     * @param  Request
     * @return Response
     */
    public function store(Request $request)
    {        
        $id = $request->input('id');
        $key = $request->input('name');

        $rules = [
            'name' => 'required|min:3|unique:settings__lists,setting_key,'.$id,
            'value' => 'required'
        ];
    
        $customMessages = [
            'name.required' => trans('custom-validation.required', ['attribute' => trans('label.settingName') ]),
            'name.min'  => trans('custom-validation.min', ['attribute' => trans('label.settingName'), 'min' => 3 ]),
            'name.unique'  => trans('custom-validation.exist', ['attribute' => trans('label.settingName') ]),

            'value.required' => trans('custom-validation.required', ['attribute' => trans('label.settingValue') ]),
        ];
    
        $this->validate($request, $rules, $customMessages);

        if($id){

            $setting = DB::table('settings__lists')->where('id', $id)->first();
            Settings::forget($setting->setting_key); //To remove key from cache at the time of update

            setFlashMessage('success', trans('label.success'), trans('message.successEdit', ['attribute' => trans('label.setting') ]));
        }else{
            setFlashMessage('success', trans('label.success'), trans('message.successCreate', ['attribute' => trans('label.setting') ]));
        }

        Settings::set($key, $request->input('value'));

        DB::table('settings__lists')
        ->where('setting_key', $key)
        ->update(['setting_type' => $request->input('settingFor')]);

        return redirect()->route('setting list');
    }

     /**
     * 
     * Delete Setting
     *
     * @param  Request
     * @param  Id : Setting Id
     * @return Response
     */
    public function delete(Request $request, $id)
    {        
        $setting = DB::table('settings__lists')->where('id', $id)->first();
        Settings::forget($setting->setting_key);
        
        setFlashMessage('success', trans('label.success'), trans('message.successDelete', ['attribute' => trans('label.setting') ]));
        return redirect()->route('setting list');
    }

}