<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaticContent;
use App\Traits\ImageUpload;

class StaticContentController extends Controller
{
    use ImageUpload;
  /**
    * Static content View
    *
    * @param  show admin dashboard
    * @return view detail of all content
  */
   public function static_content_View(){
   $content = StaticContent::where('status',StaticContent::STATUS_ACTIVE)->get();
   return view('admin.static_content.main',compact('content'));
 }
    /**
    * Store static Content
    *
    * @param  open pop up modal for add content form
    * @return store data in database
    */
    public function storeContent(Request $request){
        $validatedData = $request->validate([
           'screen_baner_image' => 'required|image|mimes:jpg,png,jpeg',
         ]);
      $insert = new StaticContent;
       $insert->screen_baner_image  = $this->uploadImage($request->screen_baner_image, 'profile_image');
      $insert->save();
      return response()->json(redirect()->back()->with('success','Banner Image Add Successfully'));
        }

      /**
     *  Delete Static content
     *
     * @param click on delete button get $r->id
     * @return  delete data accordig to $r->id
     */
        public function delete_content(Request $request){
        $data = StaticContent::where('id',$request->id);
        $data->delete();
        return response()->json(['success' => true]);
       }
     /**
     *  view update
     *
     * @param click on update button get $r->id
     * @return  open pop up model of $r->id with value
     */
    public function view_update(Request $request){
    $content = StaticContent::find($request->id);
    $res =  view('admin.static_content.update', compact('content'))->render();
    return response()->json($res);
    }
    /**
     *  update content
     *
     * @param $r get form data 
     * @return  return response update successfully or not
     */
     public function update_content(Request $request){
      $validatedData = $request->validate([
      'screen_baner_image' => 'image|mimes:jpg,png,jpeg',
     ]);
     $user = StaticContent::find($request->id);
    if($request->screen_baner_image)
    $service_cate = $this->uploadImage($request->screen_baner_image, 'profile_image');
    else
   $service_cate = $user->screen_baner_image;
   $user->screen_baner_image = $service_cate;
   $user->save();
   if($user){
  return response()->json(redirect()->back()->with('success', 'Updated Successfully.'));
   }
  else{
  return response()->json(redirect()->back()->with('error', 'Updated not successfully'));
  }
  }
     /**
     *  Detail view content
     *
     * @param get $r->id on click view button
     * @return  detail view page of category according $r->id
     */
    public function detailView_content(Request $request){
    $content = StaticContent::find($request->id);
    return view('admin.static_content.detailview', compact('content'));
    }
    /**
    * Screen Baner View
    *
    * @param  show admin dashboard
    * @return view baner image
    */
   public function condition_View(){
    $condition = StaticContent::where('status',StaticContent::STATUS_NEW)->get();
    return view('admin.terms_condition.main',compact('condition'));
  }
       /**
     *  view condition update
     *
     * @param click on update button get $r->id
     * @return  open pop up model of $r->id with value
     */
    public function condition_update(Request $request){
      $condition = StaticContent::find($request->id);
      $res =  view('admin.terms_condition.update', compact('condition'))->render();
      return response()->json($res);
      }
      
     /**
     *  update condition
     *
     * @param $r get form data 
     * @return  return response update successfully or not
     */
    public function update_condition(Request $request){
      $validatedData = $request->validate([
      'terms_and_condition' => 'required',
     ]);
     $insert = StaticContent::where('id', $request->id)->update([
      "terms_and_condition" => $request->terms_and_condition,
   ]);
      if($insert){
      return response()->json(redirect()->back()->with('success', 'Updated Successfully.'));
      }
      else{
      return response()->json(redirect()->back()->with('error', 'Updated not successfully'));
      }
      }
    /**
     *  Detail view condition
     *
     * @param get $r->id on click view button
     * @return  detail view page of condition according $r->id
     */
    public function detailView_condition(Request $request){
      $condition = StaticContent::find($request->id);
      return view('admin.terms_condition.detailview', compact('condition'));
      }

    /**
     *  back to content
     *
     * @param 
     * @return  
     */
    public function ContentBack()
    {
    $url = route('staticcontent');
    return $url;
    }
}
