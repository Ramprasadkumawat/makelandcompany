<?php

namespace App\Http\Controllers\Admin;

use App\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DataTables;
class SuggestionController extends Controller
{
   /**
     * Create a Artist controller instance.
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
        return view('admin.suggestions.index');
    }


    /**
     * Get Suggestion List From DB  For Datatables
     *
     * @return \Illuminate\Http\Response
    */
    public function getSuggestionData()
    {
        $suggestions = Suggestion::latest()->get();
        
        return Datatables::of($suggestions)
                ->addIndexColumn()
                ->editColumn('description', function($row) {  
                    return substr($row->description, 0, 50);
                })
                ->addColumn('show', function($row){

                   $btn = '<a href="'.url('/admin/show-suggestion/').'/'.$row->id.'" class="edit btn btn-info btn-sm">Show</a>';

                    return $btn;
                })
                ->addColumn('markRead', function($row){
                    $url ='admin/mark-as-read/'.$row->id.'/';
                    $text ='';
                   if ($row->status) {
                    
                    $text ='Mark As Unread';
                    $btnclass ='btn-danger';
                    $url .= '0';
                   } else {
                    $text ='Mark As Read';
                    $btnclass ='btn-primary';
                    $url .= '1';
                   }

                   $mainUrl = url($url);
                   $btn = '<a href="'.$mainUrl.'"  class="btn '.$btnclass.' btn-sm"> '.$text.'</a>';
                   return $btn;
                })
                ->rawColumns(['markRead', 'show'])
                ->make(true);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suggestion = Suggestion::where('id', $id)->first();

        return view('admin.suggestions.show', ['suggestion' => $suggestion]);  
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function markAsRead($id, $status)
    {
        $data = [
            'status' => $status,
        ];

        $suggestions = Suggestion::where('id', $id)
            ->update($data);

        return redirect()->route('admin.suggestions')->with('success', 'Status Updated Successfully!');
    }

}
