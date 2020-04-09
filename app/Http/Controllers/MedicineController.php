<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMedicineRequest;
use App\Medicine;

class MedicineController extends Controller
{	public function create(){
    	$medicines=Medicine::all();	
    	return view('medicines/create',['medicines'=>$medicines]);
    }
    public function store(StoreMedicineRequest $request){
    	// $request=request();
    	Medicine::create([
    		'name'=>$request->name,
    		'quantity'=>$request->quantity,
    		'type'=>$request->type,
    		'price'=>$request->price
    	]);

    	return redirect('/medicines');
    }
    public function show(){
    	$medicines=Medicine::all();
    	return view('/medicines/index',['medicines'=>$medicines]);
    }
    public function edit(){
		$request=request();
		$id = $request->medicineId;
		$medicine=Medicine::where('id',$id)->first();
		return view('medicines/edit' , ['medicine'=>$medicine]);
    }
    public function update(StoreMedicineRequest $request){
		// $request=request();
		$id = $request->ID;
		$medicine=Medicine::where('id',$id)->first()->update([
			'name'=>$request->name,
			'quantity'=>$request->quantity,
			'type'=>$request->type,
			'price'=>$request->price
		]);
		return redirect('/medicines');
    }
    public function delete(){
		$request=request();
		$id=$request->id;
		$medicine=Medicine::where('id',$id)->delete();
		return redirect('/medicines');
	    }
}
