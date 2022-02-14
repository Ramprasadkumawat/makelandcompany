<?php

namespace App\Http\Controllers\Admin;

use App\Configuration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ConfigurationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a Configurations of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function configuration(Request $request)
    {
        $configuration = Configuration::latest()->first();;
        
        return view('admin.configurations', ['configuration' => $configuration]);
    }

    /**
     * Update Configuration Data
     *
     * @return \Illuminate\Http\Response
     */
    public function updateConfiguration(Request $request)
    {
        $request->validate([
            'amount_uploading' => 'required|numeric',
            'min_critique_buy' => 'required|numeric',
            'max_critique_buy' => 'required|numeric',
            'eligible_nft_creation' => 'required|numeric',
            'percentage_share_nft' => 'required|numeric',
        ]);

        $data = [
            'amount_uploading' => $request->amount_uploading,
            'min_critique_buy' => $request->min_critique_buy,
            'max_critique_buy' => $request->max_critique_buy,
            'eligible_nft_creation' => $request->eligible_nft_creation,
            'percentage_share_nft' => $request->percentage_share_nft,
        ];
        
        $artist = Configuration::where('id', $request->id)
            ->update($data);

        return redirect()->route('admin.configuration')->with('success', 'Configuration Updated Successfully!');
    }
}
