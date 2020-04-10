<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables; 
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $permissions =Permission::all();

        if ($request->ajax()) {
            
            return Datatables::of($permissions)
                    ->addIndexColumn()
                    ->addColumn('action', function($permissions){
                        $btn = '<a href="'.route("permissions.edit",["permission" => $permissions->id]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        $btn .= '<button type="button" data-id="'.$permissions->id.'" data-toggle="modal" data-target="#DeletePermissionModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('permissions.index');
    }

    public function create(){
        return view('permissions.create');
    }

    public function store(Request $request){
       
        $validate = $this->validate($request, [
            'name' => 'required|unique:permissions'
        ]);
        
        if(!$validate){
            return redirect()->back();
        }
            Permission::create([
                'name' => $request->name,
            ]);
           
       
        return redirect()->route('permissions.index');
    }

    public function edit(Request $request){
        
        $permissionID = $request->permission;
        $permission = Permission::find($permissionID);
        if(!$permission){
            return redirect()->route('permissions.index')->with('error', 'area is not found');
        }
        return view('permissions.edit',[
            'permission' => $permission
        ]);

    }

    public function update(Request $request){
        
        $validate = $this->validate($request, [
            'name' => 'required|unique:permissions,name,'.$request->permission
        ]);
        
        if(!$validate){
            return redirect()->back();
        }

        $permission = Permission::find($request->permission);

        $permission -> update([
                'name' => $request->name,
            ]);
           

        return redirect()->route('permissions.index');
    }
 

    public function destroy(Request $request)
    {

        $permission = Permission::find($request->permission);

        $permission->delete();      
        return redirect()->back();
    }

}
