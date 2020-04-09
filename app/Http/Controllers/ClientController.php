<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\User;
use App\UserAddress;
use Yajra\DataTables\Facades\DataTables; 
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Auth;


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
                    ->addColumn('last_login', function($clients) {
                        return $clients->last_login_at;
                    })
                    ->addColumn('role_id', function($clients) {
                        return $clients->user->role_id;
                    })
                    ->addColumn('image', function($clients){   
                        $url = asset('storage/'.$clients->user->image);
                        return '<img src='.$url.' border="0" width="100" height="90" class="img-rounded" align="center" />'; 
                    })
                    ->addColumn('action', function($clients){
                        $btn = '<a href="'.route("clients.edit",["client" => $clients->id]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        $btn .= '<button type="button" data-id="'.$clients->id.'" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';

                        return $btn;
                    })
                    ->rawColumns(['image','action'])
                    ->make(true);
            }
            return view('clients.index');
    }

    public function create(){
        return view('clients.create');
    }

    public function store(StoreClientRequest $request){
        //get the request data
        //store the request data in the database
        //redirect to show page
       
        //dd($insured);
        $validate = $request->validated();
        if($validate){
            if ($request->hasfile('image')){
                $path = Storage::disk('public')->put('clients_avatars', $request->file('image'));
            }
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'national_id' => $request->national_id,
                'image' => $path
            ]);
            
            $user->assignRole('client');
    
            $client = Client::create([
                'gender' => $request->gender,
                'birthdate'=> $request->birthdate,
                'mobile' => $request->mobile,
                'user_id' => $user->id
            ]);
            
        }

        return redirect()->route('clients.index');
    }


    public function edit(Request $request){
        
        $clientID = $request->client;
        $client = Client::with('user')->find($clientID);
        if(!$client){
            return redirect()->route('clients.index')->with('error', 'client is not found');
        }
        //dd($client);
        return view('clients.edit',[
            'client' => $client
        ]);

    }

    public function update(UpdateClientRequest $request){

        $client= Client::find($request->client);
 
        $validate = $request->validated();
 
        if($validate){
            $client= Client::with('user')->find($request->client);
            $path = $client->user->image;
            if ($request->hasfile('image')){
                Storage::disk('public')->delete($path);
                $path = Storage::disk('public')->put('clients_avatars', $request->file('image'));

            }
            
            $client -> update([
                'gender' => $request->gender,
                'birthdate'=> $request->birthdate,
                'mobile' => $request->mobile,
                'user_id' => $request->user_id
            ]); 
            
            $user= User::withTrashed()->find($request->user_id);

            $user -> update([
                'name' => $request->name,
                'email' => $request->email,
                'national_id' => $request->national_id,
                'image' => $path
            ]);

              
        }

        return redirect()->route('clients.index');
    }



        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $client = Client::with('user')->find($request->client);
        $client->user()->delete();
        $client->delete();      
        return redirect()->back();
    }


    public function trashed(Request $request)
    {
        $clients =Client::with('user')->onlyTrashed()->get();
        
        if ($request->ajax()) {
            
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
                    ->addColumn('last_login', function($clients) {
                        return $clients->last_login_at;
                    })
                    ->addColumn('role_id', function($clients) {
                        return $clients->user->role_id;
                    })
                    ->addColumn('image', function($clients){   
                        $url = asset('storage/'.$clients->user->image);
                        return '<img src='.$url.' border="0" width="100" height="90" class="img-rounded" align="center" />'; 
                    })
                    ->addColumn('action', function($clients){
                        $btn = '<button type="button" data-id="'.$clients->id.'" data-toggle="modal" data-target="#restoreModal" class="btn btn-danger btn-sm" id="getRestoreId">restore</button>';
                        return $btn;
                    })
                    ->rawColumns(['image','action'])
                    ->make(true);
            }
            return view('clients.trashed');
    }


    public function restoreClient($id)
    {
        Client::onlyTrashed()->find($id)->restore();
        UserAddress::onlyTrashed()->where('client_id',$id)->restore();
        return redirect()->route('clients.index');
    }
}

