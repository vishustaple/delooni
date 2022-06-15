<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\UserRating;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    //
    /**
    * Rating View
    *
    * @param  show admin dashboard  
    * @return view detail of rating 
    */
    public function RatingView(){

         $data=UserRating::with('user','fromuser')->paginate();
         return view('admin.rating.main',compact('data'));
        }
     
    //
    /**
    * Rating detail View
    *
    * @param  show detailpage 
    * @return view detail of rating 
    */
    public function RatingDetailView(Request $request){
        
     $data=UserRating::with('user','fromuser')->Where('id',$request->id)->first();
     return view('admin.rating.detailView',compact('data'));
    }

   /**
     * Rating Back
     *
     * @param click on back button
     * @return  redirect at home page
    */
    public function  RatingBack()
    {
    $url = route('rating');
    return $url;
    }
      /**
     *  Delete rating
     *
     * @param click on delete button get $r->id
     * @return  delete data accordig to $r->id
   */
     public function RatingDelete(Request $request){
     $data = ContactUs::where('id',$request->id);
     $data->delete();
     return response()->json(['success' => true]);
     } 
      /**
     *  Search query
     *
     * @param search name in search bar
     * @return  fetch data according to $request
    */
     public function search_contact_query(Request $request){
     $search = $request->search;
     $qry = ContactUs::join('users','contact_us.from_user','=','users.id')->select('contact_us.message','contact_us.type','users.first_name','contact_us.id','contact_us.from_user');
     if(!empty($search)){
         $qry->where(function($q) use($search){
             $q->where('type','like',"%$search%");
        });
     }
     $data = $qry->orderBy('id','ASC')->paginate();
     return view('admin.contact_query.view', compact('data','search'));
     }
 
    
}
