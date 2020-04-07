<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\User;
use Yajra\DataTables\Facades\DataTables; 
use App\Http\Requests\StoreClientRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;


class ClientController extends Controller
{
    use RegistersUsers;
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
                    ->addColumn('image', function($clients){   
                        $url = asset('storage/'.$clients->user->image);
                        return '<img src='.$url.' border="0" width="100" height="90" class="img-rounded" align="center" />'; 
                    })
                    ->addColumn('action', function($row){

                            $btn = '<a href="{{ route("clients.edit",["client"=> '.$clients->id.'])}}" class="edit btn btn-primary btn-sm">Edit</a>';
        
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

        $validate = $request->validated();
        if($validate){
            $insured =1;
            if(!$request->is_insured){
                $insured = 0;
            }
            if ($request->hasfile('image')){
                // $path = $request->file('image')->store('avatarss');
                // dd($path);

                $path = Storage::putFile('clients_avatars', $request->file('image'));
            }
            // else if($request->gender == "female"){
            //     $path = 'female.png';
               
            // }
            // else if($request->gender == "male"){
            //     $path = 'male.png';
            // }
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'national_id' => $request->national_id,
                'image' => $path
            ]);
    
            $client = Client::create([
                'gender' => $request->gender,
                'birthdate'=> $request->birthdate,
                'is_insured' =>$insured,
                'mobile' => $request->mobile,
                'user_id' => $user->id
            ]);
            
        }
       
        //Auth::login($user);
       
        return redirect()->route('clients.index');
    }
}

