<?php

namespace App\Http\Controllers;
use App\Models\State;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('dropdown', compact('countries'));

    }

    public function fetchState(Request $request)
    {
        $states = State::where("country_id", $request->get('country_id'))->get(['state_name', 'state_id']);
        return response()->json([
            'status' => 'success',
            'states' => $states,
        ]);
    }

    public function fetchCity(Request $request)
    {
        $cities = City::where("state_id", $request->get('state_id'))->get(['city_name', 'city_id']);
        return response()->json([
            'status' => 'success',
            'cities' => $cities,
        ]);
    }
}
