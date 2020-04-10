<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables; 
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;


class RoleController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $roles =Role::all();
            return Datatables::of($roles)
                    ->addcolumn('id',function($roles){
                        return $roles->id;
                    })
                    ->addColumn('name',function($roles){
                        return $roles->name;
                    })
                    ->addColumn('permissions',function($roles){
                        $permissions = $roles->permissions()->get();
                        $text = '';      
                        foreach($permissions as $permission){
                            $text .= '<span id="text">'.$permission->name.'</span>';
                        }
                        return $text;
                    })
                    ->addColumn('action', function($roles){
                        $btn = '<a href="'.route("roles.edit",["role" => $roles->id]).
                        '" class="edit btn btn-primary btn-sm" style="margin-right:10px;">Edit</a>';
                        $btn .= '<button type="button" data-id="'.$roles->id.
                        '" data-toggle="modal" data-target="#DeletePermissionModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';

                        return $btn;
                    })
                    ->rawColumns(['permissions','action'])
                    ->make(true);
            }
            return view('roles.index');
    }

    public function create(){
        $roles = Role::all();
        $permissions = Permission::all();
        return view('roles.create',[
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function store(StoreRoleRequest $request){
    
        $validate = $request->validated();
        if($validate){
            $role = Role::find($request->role_id);

            foreach($request->permissions as $permission){
                $role->givePermissionTo($permission);
            }
        
        }
       
        return redirect()->route('roles.index')->with('message', 'permissions Added successfully');
    }

    public function edit(Request $request){
        
        $roleID = $request->role;
        $role = Role::find($roleID);
        $rolePermissions = $role->permissions()->get();
        $roles = Role::all();
        $permissions = Permission::all();
        if(!$role){
            return redirect()->route('roles.index')->with('error', 'area is not found');
        }
        return view('roles.edit',[
            'role' => $role,
            'roles' => $roles,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);

    }

    public function update(UpdateRoleRequest $request){
        
        $validate = $request->validated();
        if($validate){
            $role = Role::find($request->role_id);
            $rolePermissions =$role->permissions()->get();
            foreach( $rolePermissions as $permission){
                $role->revokePermissionTo($permission);
            }

            foreach($request->permissions as $permission){
                $role->givePermissionTo($permission);
            }    
        }
       
        return redirect()->route('roles.index')->with('message', 'permissions edited successfully');
    }
 

    public function destroy(Request $request)
    {

        $role = Role::find($request->role);
        
        $role->delete();  
        
        return redirect()->back();
    }

}
