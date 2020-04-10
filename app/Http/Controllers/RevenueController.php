<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRevenueRequest;
use App\Revenue;
use App\User;
use App\Pharmacy;

class RevenueController extends Controller
{
    public function create(){
        $revenues=Revenue::all();	
        $pharmacies=Pharmacy::all();
    	return view('revenues/create',['revenues'=>$revenues,'pharmacies'=>$pharmacies]);
    }
    public function store(StoreRevenueRequest $request){
        // $request=request();
        $id=User::where('name',$request->pharmacy_name)->first();
        Revenue::create([
            'user_id'=>$id->id,
    		'pharmacy_name'=>$request->pharmacy_name,
    		'total_orders'=>$request->total_orders,
    		'total_revenue'=>$request->total_revenue
    	]);

    	return redirect('/revenues');
    }
    public function show(){
        $revenues=Revenue::all();
        return view('revenues/index',['revenues'=>$revenues]);
    }
    public function edit(){
        $request=request();
		$id = $request->revenueId;
		$revenue=Revenue::where('id',$id)->first();
		return view('revenues/edit' , ['revenue'=>$revenue]);
    }
    public function update(StoreRevenueRequest $request){
        // $request=request();
		$id = $request->ID;
		$revenue=Revenue::where('id',$id)->first()->update([
			'pharmacy_name'=>$request->pharmacy_name,
			'total_orders'=>$request->total_orders,
			'total_revenue'=>$request->total_revenue
		]);
		return redirect('/revenues');
    }
    public function delete(){
        $request=request();
        $id=$request->delId;
        $revenue=Revenue::where('id',$id)->delete();
        return redirect('/revenues');
    }
}
