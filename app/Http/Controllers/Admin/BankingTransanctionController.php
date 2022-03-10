<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bank;
use App\BankTransaction;
use App\Coldstore;
use App\ColdStoreStocks;
use App\ColdStoreTransaction;
use App\StockTransaction;
use App\User;
use App\MazdurTransaction;
use DataTables;


class BankingTransanctionController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.banktransactions.index');
    }

    /**
     * Get Bank List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getBankTransactionsData()
    {
        $transactions = BankTransaction::latest()->get();
        return Datatables::of($transactions)
                ->addIndexColumn()
                ->addColumn('edit', function($row){

                   $btn = '<a href="'.url('admin/edit-bank/').'/'.base64_encode($row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';

                    return $btn;
                })
                ->addColumn('delete', function($row){
                   $btn = '<button  onclick="deleteArtist('.$row->id.');" class="delete btn btn-danger btn-sm">Delete</button>';

                    return $btn;
                })
                ->rawColumns(['edit', 'delete'])
                ->make(true);
    }
    
}
