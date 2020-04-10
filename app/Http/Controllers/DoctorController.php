<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Doctor;
use App\Pharmacy;
use App\User;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DoctorRequest;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;


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
     
        $doctor_id = request('doctor');
     
        $doctor = Doctor::find($doctor_id);
     
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
     
               $data += array('image' => User::storeUserImage($request));

                        if($doctor->user->image !== 'images/default.jpeg')Storage::delete('public/'.$doctor->user->image);
                    }

        $doctor->user->update($data);

        
        return redirect()->route('doctors.show', ['doctor' => $request->doctor]);
    }
    
public function destroy(Doctor $doctor){
    if($doctor->user->image !== 'images/default.jpeg')Storage::delete('public/'.$doctor->user->image);
    $doctor->user->delete();

    $doctor->delete();
    return redirect()->route('doctors.index');
}
public function banned(){
    $doctorId = request()->doctor;
    $doctor =Doctor::find($doctorId);
    if($doctor->user->isNotBanned()){
        $doctor->user->ban();
        Doctor::where('id',$doctorId)->update([
            'is_banned'=>true,
            
        ]);}
        else {
            $doctor->user->unban();
            Doctor::where('id',$doctorId)->update([
                'is_banned'=>false,
                ]);}
                return redirect()->route('doctors.index');
    }


    
    public function create(){
    
        return view('doctors.create');
    }

    public function store(DoctorRequest $request){
      
             if ($request->hasFile('image')){
                $doctor=User::create([
                    'national_id'=>$request->national_id,
                    'name'=>$request->name,
                    'email'=>$request->email,
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
                'password' => $request->password,
                'role_id'=>'2',
                ]);
                $doctor->doctor()->create([]);
                
        }
            $doctor->assignRole('doctor');
            return redirect()->route('doctors.index');

    }
    

}
