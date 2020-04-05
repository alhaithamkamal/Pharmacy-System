<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\User;

class DoctorController extends Controller
{
    public function index(){
        $doctors=Doctor::all();
        return view('doctors.index',[
            'doctors'=>$doctors
        ]);
    }
    public function show()
    {
        // $request=request();  
        // $doctorId=$request->doctor;
        // $doctor=Doctor::find($doctorId);      
        
        
        
        
        
        return view('doctors.show',[
            'doctor'=>Doctor::find(request()->doctor),
        ]);
    }

    public function create(){
    // //    $users=User::all();
    //     return view('posts.create',[
    //     'users'=>$users 
    //     ]);
        return view('doctors.create');
    }

    public function store(){
         $request=request();
            
        
    
        Doctor::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'national_id'=>$request->national_id,
            //'user_id'=>$request->user_id,
            
        ]);
        
        return redirect()->route('doctors.index');
    }

}
