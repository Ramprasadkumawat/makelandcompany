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


class StockTransanctionController extends Controller
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
    public function index()
    {
        return view('admin.stock-transaction.index');
    }
    
    /**
     * add Stock Trannsactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $coldStore = Coldstore::where(['status' => 1])->get();
        return view('admin.stock-transaction.create', ['coldStore'=>$coldStore]);
    }

    /**
     * Store Stock Trannsactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return view('admin.stock-transaction.create');
    }
}
