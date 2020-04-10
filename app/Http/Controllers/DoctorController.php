<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Doctor;
use App\User;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DoctorRequest;

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
        $request=request();  
        
        $doctorId=$request->doctor;
        
        
        $doctor=Doctor::find($doctorId);      
        
                

        return view('doctors.show',[
                    'doctor' => $doctor,
                ]);
   
      
         }
         public function edit()
    {
     //   $users = User::all();
        $doctor_id = request('doctor');
        //dd($doctor_id);
        $doctor = Doctor::find($doctor_id);
        //dd($doctor);
        return view('doctors.edit', [
            'doctor' => $doctor, 
        ]);
    }
    public function update(DoctorRequest $request)
    {
        $doctorId = $request->doctor;
        $doctor =Doctor::find($doctorId);
        $data = $request->only(['national_id', 'name', 'email','password']);
        if ($request->hasFile('image')){
               //         $attributes['image'] = User::storeUserImage($request);
               $data += array('image' => User::storeUserImage($request));

                        if($doctor->user->image !== 'images/default.jpeg')Storage::delete('public/'.$doctor->user->image);
                    }

        $doctor->user->update($data);

        
        return redirect()->route('doctors.show', ['doctor' => $request->doctor]);
    }
    //$data += array('slug' => $slug);
// public function update(DoctorRequest $request, Doctor $doctor)
//     {   
//         $attributes = [
//             [
//                 'national_id' => $request->national_id,
//                 'name' =>  $request->name,
//                 'email' =>  $request->email,
//             ]
//         ];
//         if ($request->hasFile('image')){
//             $attributes['image'] = User::storeUserImage($request);
//             Storage::delete('public/'.$doctor->image);
//         }
//         $doctor->user->update($attributes);
//         return redirect()->route('doctors.show', ['doctor' => $request->doctor]);
//     }


//     public function update(Request $request)
//     {
//         $doctorId = $request->doctor;
//         // dd($request->post);
//         $doctor = User::find($doctorId);
//         //$slug = SlugService::createSlug(Post::class, 'slug', $request->title);


//         $data = $request->only(['national_id', 'name', 'email',]);
//         //$data += array('slug' => $slug);
//         $doctor->update($data);

// //        return redirect()->route('doctors.show', ['doctor' => $request->doctor]);
// return redirect()->route('doctors.index');

//     }
public function destroy(Doctor $doctor){
    $doctor->user->delete();
    $doctor->delete();
    return redirect()->route('doctors.index');
}


    // public function destroy(User $doctor)
    // {
    //     if ($doctor->image) Storage::delete('public/'.$doctor->image);
    //     $doctor->user->delete();
    //     return redirect()->route('doctors.index');
    // }
     // public function show()
    // {
    //     //take the id from url param
    //     $request = request();
        
    //     $postId = $request->post;

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

    public function store(DoctorRequest $request){
        // $attributes = [
        //     [
        //         'national_id' => $request->national_id,
        //         'name' =>  $request->name,
        //         'email' =>  $request->email,
        //         'password' => Hash::make($request->password),
        //         'role_id'=>'2',
        //     ]
        // ];    
        // if ($request->hasFile('image')){
        //     $attributes['image'] = User::storeUserImage($request);
        // } 
        
        // $doctor->create($attributes);
        // dd($request->name);
             if ($request->hasFile('image')){
                $doctor=User::create([
                    'national_id'=>$request->national_id,
                    'name'=>$request->name,
                    'email'=>$request->email,
                  //  'password' => Hash::make($request->password),
                  'password' => $request->password,
                    'image' => User::storeUserImage($request),
                    'role_id'=>'2',
                    ]);
                    $doctor->doctor()->create([]);
        } 
        else{
            $doctor=User::create([
                'national_id'=>$request->national_id,
                'name'=>$request->name,
                'email'=>$request->email,
                //'password' => Hash::make($request->password),
                'password' => $request->password,
                //'image' => User::storeUserImage($request),
                'role_id'=>'2',
                ]);
                $doctor->doctor()->create([]);
        }
        $doctor->assignRole('pharmacy');
        // $doctor=User::create([
        //     'national_id'=>$request->national_id,
        //     'name'=>$request->name,
        //     'email'=>$request->email,
        //     'password' => Hash::make($request->password),
        //     'image' => User::storeUserImage($request),
        //     'role_id'=>'2',
        // ]);
        //$doctor->doctor()->create([
            //dd($doctor->id),
            //  'user_id' => $doctor->id,
            //  'pharmacy_id' => $request->birthdate,
            // 'mobile' => $request->mobile
        //]);

        return redirect()->route('doctors.index');
    }
    

}
