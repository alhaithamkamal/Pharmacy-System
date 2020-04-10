<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\User;
use App\Area;
use App\UserAddress;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($request->ajax()) {
            if ($user->hasRole('admin'))
                $clients = Client::with('user')->get();
            elseif ($user->hasRole('pharmacy|doctor'))
                $clients = $user->pharmacy->clients;
             

            return Datatables::of($clients)
                ->addColumn('national_id', function ($clients) {
                    return $clients->user->national_id;
                })
                ->addColumn('name', function ($clients) {
                    return $clients->user->name;
                })
                ->addColumn('email', function ($clients) {
                    return $clients->user->email;
                })
                ->addColumn('gender', function ($clients) {
                    return $clients->gender;
                }) 
                ->addColumn('mobile', function ($clients) {
                    return $clients->mobile;
                })
                ->addColumn('birthdate', function ($clients) {
                    return $clients->birthdate;
                })
                ->addColumn('last_login', function ($clients) {
                    return $clients->last_login_at;
                })
                ->addColumn('role_id', function ($clients) {
                    return $clients->user->role_id;
                })
                ->addColumn('image', function ($clients) {
                    $url = asset('storage/' . $clients->user->image);
                    return '<img src=' . $url . ' border="0" width="100" height="90" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($clients) {
                    $btn = '<a href="' . route("clients.show", ["client" => $clients->id]) . '" ' .
                        'class="btn btn-success btn-sm" style="margin-right:5px;">show</a>';
                    $btn .= '<a href="' . route("clients.edit", ["client" => $clients->id]) . '"' .
                        ' class="edit btn btn-primary btn-sm " style="margin-right:5px;">Edit</a>';
                    $btn .= '<button type="button" data-id="' . $clients->id . '" data-toggle="modal"' .
                        ' data-target="#DeleteClientModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';

                    return $btn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        return view('clients.index');
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(StoreClientRequest $request){
        
        $validate = $request->validated();
        if ($validate) {
            if ($request->hasfile('image')) {
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
                'birthdate' => $request->birthdate,
                'mobile' => $request->mobile,
                'user_id' => $user->id
            ]);
            $user = auth()->user();
            if($user->hasRole('pharmacy|doctor')){
                $user->pharmacy->clients()->attach($client->id);
            }
        }

        return redirect()->route('clients.index')->with('message', 'client Added successfully');
    }


    public function show(Request $request)
    {
        $user = auth()->user();

        $clientId = $request->client;
        $client = Client::with('user')->find($clientId);

        if (!$client) {
            return redirect()->route('clients.index')->with('error', 'Client is not found');
        }
        $check = 0;
        if ($user->hasRole('pharmacy|doctor')){
            $clients = $user->pharmacy->clients;
            
            foreach($clients as $c){
                if($c->id == $client->id ){
                   $check = 1 ;
                    break;
                }
            }
            if(! $check)
                return redirect()->route('clients.index')->with('error', 'client is not found');

        }

        return view('clients.show', [
            'client' => $client
        ]);
    }


    public function edit(Request $request){
        
        $user = auth()->user();
        $clientID = $request->client;

        $client = Client::with('user')->find($clientID);

        if(!$client){
            return redirect()->route('clients.index')->with('error', 'client is not found');
        }
        $check = 0;
        if ($user->hasRole('pharmacy|doctor')){
            $clients = $user->pharmacy->clients;
            
            foreach($clients as $c){
                if($c->id == $client->id ){
                   $check = 1 ;
                    break;
                }
            }
            if(! $check)
                return redirect()->route('clients.index')->with('error', 'client is not found');

        }
       
        return view('clients.edit', [
            'client' => $client
        ]);
    }

    public function update(UpdateClientRequest $request)
    {

        $client = Client::find($request->client);

        $validate = $request->validated();

        if ($validate) {
            $client = Client::with('user')->find($request->client);
            $path = $client->user->image;
            if ($request->hasfile('image')) {
                Storage::disk('public')->delete($path);
                $path = Storage::disk('public')->put('clients_avatars', $request->file('image'));
            }

            $client->update([
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'mobile' => $request->mobile,
                'user_id' => $request->user_id
            ]);

            $user = User::withTrashed()->find($request->user_id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'national_id' => $request->national_id,
                'image' => $path
            ]);
        }

        return redirect()->route('clients.index')->with('message', 'client edited successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();
        $client = Client::with('user')->find($request->client);
        if(!$client){
            return redirect()->route('clients.index')->with('error', 'client is not found');
        }
        $check = 0;

            if ($user->hasRole('pharmacy|doctor')){
                $clients = $user->pharmacy->clients;
                
                foreach($clients as $c){
                    if($c->id == $client->id ){
                        $check =1 ;
                        break;
                    }
                }
                if(!$check)
                    return redirect()->route('clients.index')->with('error', 'client is not found');

            }
            
        $client->user()->delete();
        $client->delete();
        return redirect()->back();
    }


    public function trashed(Request $request)
    {
         
        $user = auth()->user();

        if ($request->ajax()) {
            if ($user->hasRole('admin'))
                $clients = Client::with('user')->onlyTrashed()->get();
            elseif ($user->hasRole('pharmacy|doctor'))
                $clients = $user->pharmacy->clients()->onlyTrashed()->get();

            return Datatables::of($clients)
                ->addColumn('national_id', function ($clients) {
                    return $clients->user->national_id;
                })
                ->addColumn('name', function ($clients) {
                    return $clients->user->name;
                })
                ->addColumn('email', function ($clients) {
                    return $clients->user->email;
                })
                ->addColumn('gender', function ($clients) {
                    return $clients->gender;
                })
                ->addColumn('mobile', function ($clients) {
                    return $clients->mobile;
                })
                ->addColumn('birthdate', function ($clients) {
                    return $clients->birthdate;
                })
                ->addColumn('last_login', function ($clients) {
                    return $clients->last_login_at;
                })
                ->addColumn('role_id', function ($clients) {
                    return $clients->user->role_id;
                })
                ->addColumn('image', function ($clients) {
                    $url = asset('storage/' . $clients->user->image);
                    return '<img src=' . $url . ' border="0" width="100" height="90" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($clients) {
                    $btn = '<button type="button" data-id="' . $clients->id . '" data-toggle="modal" data-target="#restoreModal" class="btn btn-danger btn-sm" id="getRestoreId">restore</button>';
                    return $btn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        return view('clients.trashed');
    }


    public function restoreClient($id)
    {
        Client::onlyTrashed()->find($id)->restore();
        $address = UserAddress::onlyTrashed()->where('client_id', $id);
        $address->restore();

        return redirect()->route('clients.index');
    }
}
