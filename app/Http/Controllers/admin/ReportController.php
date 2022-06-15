<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use App\Models\UserRating;

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
     'reports.message','reports.subject','reports.user_id','users.first_name','service_categories.name')
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
    $qry = Report::join('service_categories','reports.service_category_id','=','service_categories.id')
     ->join('users','reports.user_id','=','users.id')
     ->select('reports.id','reports.reporting_issue','reports.subcategory_id','reports.service_provider_id',
     'reports.message','reports.subject','users.first_name','service_categories.name');
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
    $category = Report::where('id',$request->id)->pluck('service_category_id');
    $category_name = ServiceCategory::whereIn('id',$category)->select('name')->first();
    $customer = Report::where('id',$request->id)->pluck('user_id');
    $customer_name = User::whereIn('id',$customer)->select('first_name')->first();
    $data = Report::find($request->id);
    return view('admin.query.detailView', compact('data','category_name','customer_name'));
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
      // $customer=User::role(Role::where('id',User::ROLE_CUSTOMER)->value('name'))->count();
      $user = User::count();
      $query = Report::count();
      $maxquery = Report::select('service_category_id', Report::raw('count(*) as total'))
      ->groupBy('service_category_id')->where('service_category_id', \DB::raw("(select max(`service_category_id`) from reports)"))
      ->count();
      $minquery = Report::select('service_category_id', Report::raw('count(*) as total'))
      ->groupBy('service_category_id')->where('service_category_id', \DB::raw("(select min(`service_category_id`) from reports)"))
      ->count();
      $maxtwenty = Report::select('service_category_id', Report::raw('COUNT(*) as `count`'))
       ->groupBy('service_category_id')->having('count', '>', 20)->count();
      $mintwenty = Report::select('service_category_id', Report::raw('COUNT(*) as `count`'))
      ->groupBy('service_category_id')->having('count', '<', 20)->count();
      $maxqueryprovider = Report::select('service_provider_id', Report::raw('count(*) as total'))
      ->groupBy('service_provider_id')->where('service_provider_id', \DB::raw("(select max(`service_provider_id`) from reports)"))
      ->count();
      $maxtwentyprovider = Report::select('service_provider_id', Report::raw('COUNT(*) as `count`'))
      ->groupBy('service_provider_id')->having('count', '>', 20)
      ->count();
      $reviewsexport = UserRating::count();
      return view('admin.report.main',compact('query','user','maxquery','minquery','maxtwenty','mintwenty','maxqueryprovider','maxtwentyprovider','reviewsexport'));
    }
    /**
     * report export.
     *
     * @param  view Report of user
     * @return  Can download excel file for User Report
     */
     //
    public function export_user()
    { 
      $user = User::select('first_name')->get();
      return Excel::download(new ReportExport($user), 'user.xlsx'); 
    }
     /**
     * report export.
     *
     * @param  view Report of query
     * @return  Can download excel file for User Report
     */
     //
    public function export_query()
    { 
      $query = Report::select('service_category_id','user_id','service_provider_id','subject','message')->get();
      return Excel::download(new ReportExport("", $query), 'query.xlsx'); 
    }
    /**
     * report export.
     *
     * @param  view Report of user
     * @return  Can download excel file for User Report
     */
     //
    public function export_max_query()
    {
      $maxquery = Report::join('service_categories','reports.service_category_id','=','service_categories.id')
      ->select('service_category_id', Report::raw('count(*) as total'))
      ->groupBy('service_category_id')->where('service_category_id', \DB::raw("(select max(`service_category_id`) from reports)"))
      ->select('service_categories.name')
      ->get();
      return Excel::download(new ReportExport("","", $maxquery), 'maxquery.xlsx'); 

    }
     /**
     * report export.
     *
     * @param  view Report of user
     * @return  Can download excel file for User Report
     */
     //
    public function export_min_query()
    {
      $minquery = Report::join('service_categories','reports.service_category_id','=','service_categories.id')
      ->select('service_category_id', Report::raw('count(*) as total'))
      ->groupBy('service_category_id')->where('service_category_id', \DB::raw("(select min(`service_category_id`) from reports)"))
      ->select('service_categories.name')
      ->get();
      return Excel::download(new ReportExport("","","", $minquery), 'minquery.xlsx'); 
    }
     /**
     * report export.
     *
     * @param  view Report of user
     * @return  Can download excel file for User Report
     */
     //
    public function export_max_twenty_query()
    {
      $maxtwenty = Report::join('service_categories','reports.service_category_id','=','service_categories.id')
      ->where('is_parent',0)->select('service_categories.name', Report::raw('COUNT(*) as `count`'))
      ->groupBy('service_categories.name')->having('count', '>', 20)->get();
      return Excel::download(new ReportExport("","","","", $maxtwenty), 'maxtwentyquery.xlsx'); 
    }
     /**
     * report export.
     *
     * @param  view Report of user
     * @return  Can download excel file for User Report
     */
     //
    public function export_min_twenty_query()
    { 
      $mintwenty = Report::join('service_categories','reports.service_category_id','=','service_categories.id')
      ->where('is_parent',0)->select('service_categories.name', Report::raw('COUNT(*) as `count`'))
      ->groupBy('service_categories.name')->having('count', '<', 20)->get();
      return Excel::download(new ReportExport("","","","","", $mintwenty), 'mintwentyquery.xlsx'); 

    }
     /**
     * report export.
     *
     * @param  view Report of user
     * @return  Can download excel file for User Report
     */
     //
    public function export_max_provider()
    {
      $maxqueryprovider = Report::join('users','reports.service_provider_id','=','users.id')
      ->select('service_provider_id', Report::raw('count(*) as total'))
      ->groupBy('service_provider_id')
      ->select('users.first_name')->orderByRaw('COUNT(*) DESC')->take(1)
      ->get();
      return Excel::download(new ReportExport("","","","","","", $maxqueryprovider), 'maxprovider.xlsx'); 

    }
    /**
     * top twenty serviceprovider
     *
     * @param  view Report of user
     * @return  Can download excel file for User Report
     */
     //
     public function export_toptwenty_max_provider()
     {
       $maxtwentyprovider = Report::join('users','reports.service_provider_id','=','users.id')
       ->select('service_provider_id', Report::raw('count(*) as total'))
       ->groupBy('service_provider_id')
       ->select('users.first_name')->orderByRaw('COUNT(*) DESC')->take(1)
       ->get();
       return Excel::download(new ReportExport("","","","","","", $maxtwentyprovider), 'toptwentymaxprovider.xlsx'); 
 
     }
     /**
     * reviews export
     *
     * @param  view Report of user
     * @return  Can download excel file for User Report
     */
     //
     public function reviews_export()
     {
       $reviewsexport = UserRating::with('user','fromuser')
       
       ->get();
       return Excel::download(new ReportExport("","","","","","", $reviewsexport), 'reviewsexport.xlsx'); 
 
     }
     

}
