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
    // public function changeStatus(Request $request)
    // {
    //     $doctorId=$request->doctor;
    //     dd($request->doctorId);
    //     $doctor = Doctor::find($request->doctor);
    //     dd($request->doctor);
    //     $user->status = $request->status;
    //     $user->save();
  
    //     return response()->json(['success'=>'Status change successfully.']);
    // }

    // public function updateStatus(Request $request)
    // {
    //     $doctorId=$request->doctor;
    //     //dd($request);

    //     $doctor = Doctor::findOrFail($request->doctor);
    //     //dd($request->status);
    //     $doctor->status = $request->status;
    //     //dd($doctor->status);
    //     $doctor->save();
    
    //     return response()->json(['message' => 'User status updated successfully.']);
    // }
    public function updateStatus(Request $request)
    {
        $user = Doctor::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['message' => 'User status updated successfully.']);
    }
            

     public function show()
     {
        $request=request();  
        
        $doctorId=$request->doctor;
        $doctorstatus=$request->
        //dd($request->doctor);
//        dd($request->doctor);
        $doctor=Doctor::find($doctorId);      
        //dd($request->doctor);
                

        return view('doctors.show',[
                    'doctor' => $doctor,
                ]);
        
        
        
        
    //     return view('doctors.show',[
    //         'doctor'=>Doctor::find(request()->doctor),
    //     ]);
     }

     // public function show()
    // {
    //     //take the id from url param
    //     $request = request();
        
    //     $postId = $request->post;
    //     dd($request->post);
    //     //query to retrieve the post by id
    //     $post = Post::find($postId);
    //     // $post = Post::where('id', $postId)->get();
    //     // $postSecond = Post::where('id', $postId)->first();

    //     //send the value to the view
    //     return view('posts.show',[
    //         'post' => $post,
    //     ]);
    // }

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
