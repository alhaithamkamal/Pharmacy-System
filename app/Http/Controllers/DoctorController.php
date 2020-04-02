<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
//use App\User;

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
}
