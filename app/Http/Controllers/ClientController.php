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
        if ($request->ajax()) {
            $clients =Client::with('user')->get();

            return Datatables::of($clients)
                    ->addColumn('id', function($clients) {
                        return $clients->id;
                    })
                    ->addColumn('gender', function($clients) {
                        return $clients->user->name;
                    })
                    ->addColumn('email', function($clients) {
                        return $clients->email;
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

