<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Client;
use App\UserAddress;
use App\Http\Requests\StoreClientAddressRequest;
use App\Http\Requests\UpdateClientAddressRequest;

use Yajra\DataTables\Facades\DataTables; 


class ClientAddressController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $clientAddress = UserAddress::with('client')->with('area')->get();
            
            return Datatables::of($clientAddress)
                    ->addColumn('client_id', function($clientAddress) {
                        $client = Client::with('user')->where('id',$clientAddress->client->id)->first();
                        return $client->user->name;
                    })
                    ->addColumn('area_id', function($clientAddress) {
                        return $clientAddress->area->name;
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($clientAddress){
                        $btn = '<a href="'.route("clientsAddresses.edit",["clientAddress" => $clientAddress->id]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        $btn .= '<button type="button" data-id="'.$clientAddress->id.'" data-toggle="modal" data-target="#DeleteAddressModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('clientsAddresses.index');
    }


    public function create(){

        $clients = Client::with('user')->get();
        $areas = Area::all();

        return view('clientsAddresses.create',[
            'clients' => $clients,
            'areas' => $areas
        ]);
    }

    public function store(StoreClientAddressRequest $request){
        //get the request data
        //store the request data in the database
        //redirect to show page
       
        //dd($insured);
        $validate = $request->validated();
        if($validate){
            if($request->has('is_main')){
                //Checkbox checked
                $main = 1;
            }else{
                //Checkbox not checked
                $main = 0;
            }

            UserAddress::create([
                'area_id' => $request->area_id,
                'client_id' => $request->client_id,
                'street_name' => $request->street_name,
                'building_number' => $request->building_number,
                'floor_number' => $request->floor_number,
                'falt_number' => $request->flat_number,
                'is_main' => $main
            ]);
    
            
        }
       
    return redirect()->route('clientsAddresses.index');
    }

    public function edit(Request $request){
        
        $clientAddressID = $request->clientAddress;
        $clientAddress = UserAddress::with('client')->with('area')->find($clientAddressID);
        if(!$clientAddress){
            return redirect()->route('clientAddress.index')->with('error', 'client address is not found');
        }
        $client = Client::with('user')->where('id',$clientAddress->client->id)->first();
        $clients = Client::with('user')->get();
        $areas = Area::all();
        return view('clientsAddresses.edit',[
            'clientAddress' => $clientAddress,
            'client' => $client,
            'clients' => $clients,
            'areas' => $areas
        ]);

    }

    public function update(UpdateClientAddressRequest $request){

        $clientAddress= UserAddress::find($request->clientAddress);

            $validate = $request->validated();
 
        if($validate){
            if($request->has('is_main')){
                //Checkbox checked
                $main = 1;
            }else{
                //Checkbox not checked
                $main = 0;
            }
           
            
            $clientAddress -> update([
                'area_id' => $request->area_id,
                'client_id' => $request->client_id,
                'street_name' => $request->street_name,
                'building_number' => $request->building_number,
                'floor_number' => $request->floor_number,
                'falt_number' => $request->flat_number,
                'is_main' => $main
            ]); 

              
        }

        return redirect()->route('clientsAddresses.index');
    }



        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $clientAddress = UserAddress::find($request->clientAddress);
        $clientAddress->delete();      
        return redirect()->back();
    }
}
