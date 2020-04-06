<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\User;

class DoctorController extends Controller
{
    public function index(){
        $doctors=User::all();
        return view('doctors.index',[
            'doctors'=>$doctors
        ]);
    }
    
    
            

     public function show()
     {
        $request=request();  
        
        $doctorId=$request->doctor;
        
        
        $doctor=User::find($doctorId);      
        
                

        return view('doctors.show',[
                    'doctor' => $doctor,
                ]);
   
      
         }
         public function edit()
    {
     //   $users = User::all();
        $doctor_id = request('doctor');
        //dd($doctor_id);
        $doctor = User::find($doctor_id);
        //dd($doctor);
        return view('doctors.edit', [
            'doctor' => $doctor, 
        ]);
    }

    public function update(Request $request)
    {
        $doctorId = $request->doctor;
        // dd($request->post);
        $doctor = User::find($doctorId);
        //$slug = SlugService::createSlug(Post::class, 'slug', $request->title);


        $data = $request->only(['national_id', 'name', 'email',]);
        //$data += array('slug' => $slug);
        $doctor->update($data);

//        return redirect()->route('doctors.show', ['doctor' => $request->doctor]);
return redirect()->route('doctors.index');

    }
    public function destroy(){
        $request=request();
        $doctorId=$request->doctor;
        $doctor=User::find($doctorId);
        $doctor->delete();
        return redirect()->route('doctors.index');
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
            
        
    
        User::create([
            'national_id'=>$request->national_id,
            'name'=>$request->name,
            'email'=>$request->email,
           'password'=>$request->password
            //'user_id'=>$request->user_id,
            
        ]);
        
        return redirect()->route('doctors.index');
    }
    

}
