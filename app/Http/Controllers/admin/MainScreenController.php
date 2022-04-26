<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainScreen;
use App\Traits\ImageUpload;

class MainScreenController extends Controller
{
  use ImageUpload;
   /**
    * Splash screen View
    *
    * @param  show admin dashboard
    * @return view detail of splash screen  
   */
    public function splash_screen_View(){
    $datas = MainScreen::orderBy('Id','DESC')->paginate();
   return view('admin.mainscreen.main', compact('datas'));
  }

  /**
    * Store  Splash Screen
    *
    * @param  open pop up modal for store splash screen
    * @return store data in database
  */
   public function storeScreen(Request $request){
   $validatedData = $request->validate([
   'screen_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
   ]);
   $insert = new MainScreen;
   $insert->title = $request->title;
   $insert->screen_image  = $this->uploadImage($request->screen_image, 'profile_image');
   $insert->description = $request->description;
   $insert->save();
   return response()->json(redirect()->back()->with('success','Splash Screen Add Successfully'));
   }
     /**
     *  view update
     *
     * @param click on update button get $r->id
     * @return  open pop up model of $r->id with value
    */
      public function view_update(Request $request){
      $screenData = MainScreen::find($request->id);
      $res =  view('admin.mainscreen.update', compact('screenData'))->render();
      return response()->json($res);
      }
      /**
       *  update screen image
       *
       * @param $r get form data 
       * @return  return response update successfully or not
      */
      public function update_screen_image(Request $request){ 
        $validatedData = $request->validate([
          'title' => 'required',
          'screen_image' => 'image|mimes:jpg,png,jpeg,gif,svg',
          'description' => 'required',
        ]);
     $user = MainScreen::find($request->id);
     if($request->screen_image)
     $service_cate = $this->uploadImage($request->screen_image, 'profile_image');
     else
     $service_cate = $user->screen_image;
     $user->title = $request->title;
     $user->description = $request->description;
     $user->screen_image = $service_cate;
     $user->save();
     if($user){
      return response()->json(redirect()->back()->with('success', 'Updated Successfully.'));
     }
    else{
      return response()->json(redirect()->back()->with('error', 'Updated not successfully'));
    }
    }

     /**
     *   splash screen
     *
     * @param click on delete button get $r->id
     * @return  delete data accordig to $r->id
     */
      public function deletescreen(Request $request){
      $data = MainScreen::where('id',$request->id);
      $data->delete();
      return response()->json(['success' => true]);
     }
      /**
     *  Search screen
     *
     * @param search title in search bar
     * @return  fetch data according to $request
  */
  public function searchscreen(Request $request){
    $search = $request->search;
    $qry = MainScreen::select('*');
    if(!empty($search)){
        $qry->where(function($q) use($search){
            $q->where('title','like',"%$search%");
       });
    }
    $datas = $qry->orderBy('id','DESC')->paginate();
    return view('admin.mainscreen.view', compact('datas','search'));
    }
      /**
     *  Detail view main screen
     *
     * @param get $r->id on click view button
     * @return  detail view page of category according $r->id
     */
    public function detail_screen(Request $request){
      $screen = MainScreen::find($request->id);
      return view('admin.mainscreen.detailview', compact('screen'));
      }
}
