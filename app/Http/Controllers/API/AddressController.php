<?php

namespace App\Http\Controllers\API;

use App\Client;
use App\Http\Controllers\Controller;
use App\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index(Client $client)
    {
        return $client->addresses;
    }

    public function store(Request $request)
    {
        Auth::user()->client->addresses()->create([
            'area_id' => $request->area_id,
            'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'falt_number' => $request->falt_number,
            'is_main' => $request->is_main
        ]);
        return response('User address has been created');
    }

    public function show(UserAddress $address)
    {
        return $address;
    }
    public function update(Request $request, UserAddress $address)
    {
        $address->update([
            'area_id' => $request->area_id,
            'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'falt_number' => $request->falt_number,
            'is_main' => $request->is_main
        ]);
        return response('User address has been Updated');
    }
    public function destroy(UserAddress $address)
    {
        $address->delete();
        return response('User address has been Deleted');
    }
}
