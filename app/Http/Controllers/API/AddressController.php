<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\UserAddress;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(User $user)
    {
        return $user->client->addresses;
    }

    public function store(Request $request, User $user)
    {
        $user->client->addresses()->create([
            'area_id' => $request->area_id,
            'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'floor_number' => $request->floor_number,
            'falt_number' => $request->falt_number,
            'is_main' => $request->is_main
        ]);
        return response('User address has been created');
    }

    public function show(User $user, $address)
    {
        return $user->client->addresses()->find($address);
    }
    public function update(Request $request, User $user, $address_id)
    {
        $address = $user->client->addresses()->find($address_id);
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
    public function destroy(User $user, $address)
    {
        $user->client->addresses()->find($address)->delete();
        return response('User address has been Deleted');
    }
}
