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
    public function storeColdStoreStockTransaction(Request $req)
    {
        $coldStoreStockId = $req->coldstore_stock_id;
        $coldStoreStocks = ColdStoreStocks::where('id',  $coldStoreStockId)->first();
        
        if(($coldStoreStocks->available_capacity < $req->maal) && ($req->type == 1)) {
            return redirect()->route('add.stockTransaction')->with('error', "Stock don't have capacity to store! Available Capacity:".$coldStoreStocks->available_capacity." (50 KG bore count)"."Available Weight:".$coldStoreStocks->available_weight );        
        }

        $arr = [
            'stock_id_FK'=>$req->coldstore_stock_id,
            'item_name'=>$req->name,
            'maal'=>$req->maal,
            'maal_weight'=>$req->maal_weight,
            'type'=>$req->type,
        ];

        StockTransaction::create($arr);
        
        if ($req->type == 1) {
            $coldStoreStocks->available_capacity = $coldStoreStocks->available_capacity - $req->maal;
            $coldStoreStocks->available_weight = $coldStoreStocks->available_weight - $req->maal_weight;
        } else {
            $coldStoreStocks->available_capacity = $coldStoreStocks->available_capacity + $req->maal;
            $coldStoreStocks->available_weight = $coldStoreStocks->available_weight + $req->maal_weight;
        }
        $coldStoreStocks->save();

        return redirect()->route('add.stockTransaction')->with('success', 'Transaction added sccessFully!');        
    }
}
