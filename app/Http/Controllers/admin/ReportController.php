<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class ReportController extends Controller
{
    /**
    * Query View
    *
    * @param  show admin dashboard  
    * @return view detail of Query 
    */
    public function query_View(){
    $data =Report::join('service_categories','reports.service_category_id','=','service_categories.id')
     ->join('users','reports.user_id','=','users.id')
     ->select('reports.id','reports.reporting_issue','reports.subcategory_id','reports.service_provider_id',
     'reports.message','reports.subject','users.first_name','service_categories.name')
     ->orderBy('Id','DESC')->paginate();
     return view('admin.query.main',compact('data'));
    }
   /**
     *  Delete query
     *
     * @param click on delete button get $r->id
     * @return  delete data accordig to $r->id
   */
    public function delete_query(Request $request){
    $data = Report::where('id',$request->id);
    $data->delete();
    return response()->json(['success' => true]);
    } 
   /**
     *  Search query
     *
     * @param search name in search bar
     * @return  fetch data according to $request
    */
    public function search_query(Request $request){
    $search = $request->search;
    $qry = Report::select('*');
    if(!empty($search)){
        $qry->where(function($q) use($search){
            $q->where('subject','like',"%$search%");
       });
    }
    $data = $qry->orderBy('id','DESC')->paginate();
    return view('admin.query.view', compact('data','search'));
    }

     /**
     *  Detail view query
     *
     * @param get $r->id on click view button
     * @return  detail view page of query according $r->id
     */
    public function detailView_query(Request $request){
    $data = Report::find($request->id);
    return view('admin.query.detailView', compact('data'));
    }

    /**
     * query Back
     *
     * @param click on back button
     * @return  redirect at home page
    */
    public function  queryBack()
    {
    $url = route('query');
    return $url;
    }

    /**
    * Report View
    *
    * @param  show admin dashboard  
    * @return view detail of Report 
    */
    public function report_View(){
      $user = User::get();
      $query = Report::get();
      return view('admin.report.main',compact('query','user'));
    }
    /**
     * report export.
     *
     * @param  view Report of user
     * @return  Can download excel file for User Report
     */
     //
    public function reportexport(Request $request)
    { 
     return Excel::download(new ReportExport($request->id), 'report.xlsx'); 
    }

}
