<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePharmacyRequest;
use App\Pharmacy;
use App\User;
use App\Revenue;
class PharmacyController extends Controller
{
    public function create(){
        $pharmacies=Pharmacy::all(); 
        return view('/pharmacies/create');
    }
    public function store(StorePharmacyRequest $request){
        // $request=request();
        if($request->hasfile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->storeAs('public/images/',$filename);
        }else{
            $filename='default.png';
        }
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'national_id'=>$request->national_id,
            'password'=>$request->password,
            'image'=>$filename,
            'role_id'=>$request->role_id,
        ]);
        
        $user=User::where('name',$request->name)->first();
        $user->assignRole('pharmacy');
        $id=$user->id;
        Pharmacy::create([
            'user_id'=>$id,
            'area_id'=>$request->area_id,
        ]);
        return redirect('/pharmacies');
    }
    public function show(){
        $user = auth()->user();
        if($user->hasRole('admin')){
            $pharmacies = Pharmacy::all();
        }else if($user->hasRole('pharmacy')){
            $user=$user->id;
            $pharmacies = Pharmacy::where('user_id',$user)->get();
        }   
       
        return view('/pharmacies/index',['pharmacies'=>$pharmacies]);
    }
    public function edit(){
        $request=request();
        $id = $request->pharmacyId;
        
        $user = auth()->user();
        if ($user->hasRole('admin')){
            $pharmacy=Pharmacy::where('id',$id)->first();
        }else if ($user->hasRole('pharmacy')){
            $pharmacy=Pharmacy::with('user')->where('id',$id)->first();
            if($pharmacy->user->id != $user->id){
                return  redirect()->route('pharmacy.show');
            }else{
               $pharmacy=Pharmacy::where('id',$id)->first();
            }
        }
        
		return view('/pharmacies/edit' , ['pharmacy'=>$pharmacy]);
    }
    public function update(StorePharmacyRequest $request){
        $id = $request->ID;
        if($request->hasfile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->storeAs('public/images/',$filename);
        }else{
            $filename='default.png';
        }
        $userid=Pharmacy::where('id',$id)->first()->user_id;
        $user=User::where('id',$userid)->first()->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'national_id'=>$request->national_id,
            'image'=>$filename,
            'role_id'=>$request->role_id,
        ]);
        
        $userupdate=User::where('name',$request->name)->first();
        $user_id=$userupdate->id;
        $pharmacy=Pharmacy::where('user_id',$user_id)->first()->update([
			'user_id'=>$user_id,
			'area_id'=>$request->area_id,
        ]);
        $pharmacies=Pharmacy::all();
		return view('/pharmacies/index',['pharmacies'=>$pharmacies]);
    }
    public function delete(){
        $request=request();
        $id=$request->delId;
        $user=Pharmacy::where('id',$id)->first()->user_id;
        // dd($user);
        $revenue=Revenue::where('user_id',$user)->delete();
        // dd($revenue);
        $pharmacy=Pharmacy::where('id',$id)->delete();
        $userdel=User::where('id',$user)->first()->delete();
        return redirect('/pharmacies');
    }
}
