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
   $content = StaticContent::get();
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
          'terms_and_condition' => 'required',
          'screen_baner_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
         ]);
      $insert = new StaticContent;
      $insert->terms_and_condition = $request->terms_and_condition;
      $insert->screen_baner_image  = $this->uploadImage($request->screen_baner_image, 'profile_image');
      $insert->save();
      return response()->json(redirect()->back()->with('success','Static Content Add Successfully'));
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
     $insert = StaticContent::where('id', $request->id)->update([
        "terms_and_condition" => $request->terms_and_condition,
        "screen_baner_image"  => $this->uploadImage($request->screen_baner_image, 'profile_image'),
     ]);
     if($insert){
        return response()->json(redirect()->back()->with('success', 'Updated Successfully.'));
     } else {
      return response()->json(redirect()->back()->with('error', 'Updated not successfully'));
     }
     }

}
