<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    /**
    * contact Query View
    *
    * @param  show admin dashboard  
    * @return view detail of Query 
    */
    public function ContactQueryView(){
        
         $data=ContactUs::join('users','contact_us.from_user','=','users.id')->select('contact_us.message','contact_us.type','users.first_name','contact_us.id','contact_us.from_user')->paginate();
 
         return view('admin.contact_query.main',compact('data'));
        }
     
         //
    /**
    * contact detail View
    *
    * @param  show detailpage 
    * @return view detail of Query 
    */
    public function detailContactView_query(Request $request){
        
     $data=ContactUs::join('users','contact_us.from_user','=','users.id')->select('contact_us.message','contact_us.type','users.first_name','contact_us.id','contact_us.from_user')->Where('contact_us.id',$request->id)->first();

     return view('admin.contact_query.detailView',compact('data'));
    }

   /**
     * query Back
     *
     * @param click on back button
     * @return  redirect at home page
    */
    public function  ContactQueryBack()
    {
    $url = route('contactquery');
    return $url;
    }
      /**
     *  Delete contact query
     *
     * @param click on delete button get $r->id
     * @return  delete data accordig to $r->id
   */
     public function delete_contact_query(Request $request){
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
