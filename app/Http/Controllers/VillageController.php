<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Village;
use App\City;
use DB;

class VillageController extends Controller
{
    public function index()
    {
        $data = Village::select('cities.*','villages.*','cities.name as cityname','villages.name as villagename')->leftjoin('cities', 'villages.city_id_FK', '=', 'cities.id')->orderBy('villages.created_at', 'DESC')->get();
       
        return view('villages.list',compact('data'));
    }

    public function addVillage()
    {
        $data = City::where('state_id', 21)->get();
        return view('villages.add',compact('data'));
    }

    public function insert(Request $request)
    {
        $villagename = $request->input('villagename');
        $cityname = $request->input('cityname');
        $data=array(
            'name'=>$villagename,
            "city_id_FK"=>$cityname
        );
        Village::insert($data);
        return redirect('village')->with('status',"Record inserted successfully");
    }

    public function edit(Request $request)
    {
        $id = base64_decode($request->id);
        $data = Village::where('id', $id)->first();
        $cities = City::where('state_id', 21)->get();
        return view('villages.edit',compact('data','cities'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $villagename = $request->input('villagename');
        $cityname = $request->input('cityname');
        $data=array(
            'name'=>$villagename,
            "city_id_FK"=>$cityname
        );
        Village::where('id', $id)->update($data);
        return redirect('village')->with('status',"Record updated successfully");
    }
}
