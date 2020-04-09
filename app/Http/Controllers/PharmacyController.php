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
        return view('pharmacies/create');
    }
    public function store(StorePharmacyRequest $request){
        // $request=request();
        if($request->hasfile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/images/',$filename);
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
        $id=$user->id;
        Pharmacy::create([
            'user_id'=>$id,
            'area_id'=>$request->area_id,
        ]);
        return redirect('/pharmacies');
    }
    public function show(){
        $pharmacies=Pharmacy::all();
        return view('pharmacies/index',['pharmacies'=>$pharmacies]);
    }
    public function edit(){
        $request=request();
		$id = $request->pharmacyId;
		$pharmacy=Pharmacy::where('id',$id)->first();
		return view('pharmacies/edit' , ['pharmacy'=>$pharmacy]);
    }
    public function update(StorePharmacyRequest $request){
        $id = $request->ID;
		$pharmacy=Pharmacy::where('id',$id)->first()->update([
			'name'=>$request->name,
			'area_id'=>$request->area_id
		]);
		return redirect('/pharmacies');
    }
    public function delete(){
        $request=request();
        $id=$request->delId;
        $user=Pharmacy::where('id',$id)->first()->user_id;
        $pharmacy=Pharmacy::where('id',$id)->delete();
        $userdel=User::where('id',$user)->first()->delete();
        return redirect('/pharmacies');
    }
}
