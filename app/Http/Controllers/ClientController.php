<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\User;
use Yajra\DataTables\Facades\DataTables; 


class ClientController extends Controller
{
   
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $clients =Client::with('user')->get();

            return Datatables::of($clients)
                    ->addColumn('national_id', function($clients) {
                        return $clients->user->national_id;
                    })
                    ->addColumn('name', function($clients) {
                        return $clients->user->name;
                    })
                    ->addColumn('email', function($clients) {
                        return $clients->user->email;
                    })
                    ->addColumn('gender', function($clients) {
                        return $clients->gender;
                    })
                    ->addColumn('mobile', function($clients) {
                        return $clients->mobile;
                    })
                    ->addColumn('birthdate', function($clients) {
                        return $clients->birthdate;
                    })
                    ->addColumn('is_insured', function($clients) {
                        return $clients->is_insured;
                    })
                    ->addColumn('last_login', function($clients) {
                        return $clients->last_login_at;
                    })
                    ->addColumn('role_id', function($clients) {
                        return $clients->user->role_id;
                    })
                    ->addColumn('image', function($clients) {
                        return $clients->user->image;
                    })
                    ->addColumn('action', function($row){

                            $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
        
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('clients.index');
    }

    public function create(){
        return view('clients.create');
    }
}

