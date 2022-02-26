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


class TransanctionController extends Controller
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

    
}
