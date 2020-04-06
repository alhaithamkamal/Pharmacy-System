<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\User;
use Yajra\DataTables\Facades\DataTables; 


class ClientController extends Controller
{
    // public function index(){
    
    // $clients= Post::paginate(3);

	// return view('clients.index',[
    // 	'clients' => $clients
    // ]);
    // }

    public function index(Request $request)
    {
        $users =Client::with('users')->get();
        
        if ($request->ajax()) {
      //  $client = Client::all();
        $client=Client::all();
        
   //    dd($client);
        return Datatables::of($users)
                ->addColumn('id', function($users) {
                    return $users->id;
                })
                ->addColumn('gender', function($users) {
                    return $users->users->name;
                })
                ->addColumn('email', function($users) {
                    return $users->email;
                })
                ->addColumn('action', function($row){

                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('clients.index');
    }
}

