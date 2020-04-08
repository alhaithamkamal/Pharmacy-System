<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Client;
use App\UserAddress;
use App\Http\Requests\StoreClientAddressRequest;
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
                    ->addColumn('action', function($userAddress){
                        //$btn = '<a href="'.route("clients.edit",["client" => $clients->id]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        $btn = '<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteClient" data-toggle="tooltip" data-original-title="Delete" id="delete-client" data-id="'. $userAddress->id .'" >Delete</a>';
                       // $btn .= '<button type="button" data-id="'.$clients->id.'" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('clientsAddresses.index');
    }


    public function create(){

        $clients = Client::with('addresses')->with('user')->get();
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
       
       // return redirect()->route('clientsAddresses.index');
    }
}
