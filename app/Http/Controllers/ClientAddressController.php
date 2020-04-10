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
                    ->addColumn('national_id', function($clientAddress) {
                        $client = Client::with('user')->where('id',$clientAddress->client->id)->first();
                        return $client->user->national_id;
                    })
                    ->addColumn('client_id', function($clientAddress) {
                        $client = Client::with('user')->where('id',$clientAddress->client->id)->first();
                        return $client->user->name;
                    })
                    ->addColumn('area_id', function($clientAddress) {
                        return $clientAddress->area->name;
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($clientAddress){
                        $btn = '<a href="'.route("clientsAddresses.show",["clientAddress" => $clientAddress->id]).'" '.
                        'class="edit btn btn-success btn-sm" style="margin-right:10px;">show</a>';
                        $btn .= '<a href="'.route("clientsAddresses.edit",["clientAddress" => $clientAddress->id]).
                        '" class="edit btn btn-primary btn-sm" style="margin-right:10px;">Edit</a>';
                        $btn .= '<button type="button" data-id="'.$clientAddress->id.
                        '" data-toggle="modal" data-target="#DeleteAddressModal" class="btn btn-danger btn-sm"'.
                        ' id="getDeleteId">Delete</button>';

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

    public function check(Request $request)
    {   
        $clientAddresses = UserAddress::where('client_id',$request->check)->get();
        
        foreach($clientAddresses as $clientAddress){
            if($clientAddress->is_main ==1){
                return response()->json(['check'=> 'true']);
            }
        }
        return response()->json(['check'=> 'false']);

    }

    public function store(StoreClientAddressRequest $request){

        $validate = $request->validated();
        if($validate){
            if($request->has('is_main')){
                $main = 1;
            }else{
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
       
    return redirect()->route('clientsAddresses.index')->with('message', 'Client address added successfully');
    }

    public function show(Request $request){

        $clientAddressId = $request->clientAddress;
        $clientAddress = UserAddress::with('client')->with('area')->find($clientAddressId);
        
        if(!$clientAddress){
            return redirect()->route('clientsAddresses.index')->with('error', 'Client address is not found');
        }

    	return view('clientsAddresses.show',[
    		'clientAddress' => $clientAddress
    	]); 
    }

    public function edit(Request $request){
        
        $clientAddressID = $request->clientAddress;
        $clientAddress = UserAddress::with('client')->with('area')->find($clientAddressID);
        if(!$clientAddress){
            return redirect()->route('clientAddress.index')->with('error', 'client address is not found');
        }

        $clientAddresses = UserAddress::where('client_id',$clientAddress->client_id)->get();
        $main = 1;
        foreach($clientAddresses as $address){
            if($address->is_main ==1 && $address->id != $clientAddressID){
                $main = 0 ;
            }
        }

        $client = Client::with('user')->where('id',$clientAddress->client->id)->first();
        $clients = Client::with('user')->get();
        $areas = Area::all();

        return view('clientsAddresses.edit',[
            'clientAddress' => $clientAddress,
            'client' => $client,
            'clients' => $clients,
            'areas' => $areas,
            'main' => $main
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

        return redirect()->route('clientsAddresses.index')->with('message', 'client address edited successfully');
    }



    public function destroy(Request $request)
    {   
        $clientAddress = UserAddress::find($request->clientAddress);
        $clientAddress->delete();      
        return redirect()->back();
    }
}
