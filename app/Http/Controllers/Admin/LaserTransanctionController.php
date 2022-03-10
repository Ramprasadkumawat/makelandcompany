<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bank;
use App\Coldstore;
use App\ColdStoreStocks;
use App\ColdStoreTransaction;
use App\StockTransaction;
use App\User;
use App\MazdurTransaction;
use DataTables;


class LaserTransanctionController extends Controller
{
    /**
     * Create a Transaction instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Stock Trannsactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function info()
    {
        return view('admin.laser-transaction.info');
    }
    
    /**
     * add Stock Trannsactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $coldStore = Coldstore::where(['status' => 1])->get();
        return view('admin.laser-transaction.create', ['coldStore'=>$coldStore]);
    }
}
