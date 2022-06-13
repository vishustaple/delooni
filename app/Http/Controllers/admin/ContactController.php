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
   




}
