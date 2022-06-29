<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\AllCity;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
class CountryCityController extends Controller
{
    /**
    * City View
    *
    * @param  show admin dashboard
    * @return view detail of all Cities
    */
      public function CitiesView(){
     
        $data = City::orderBy('id', 'DESC')->paginate();
        $getcountry=Country::get();
        return view('admin.Cities.create', compact('data','getcountry'));
      }

     /*
    * add city
    *
    * @param  store city
    * @return  response success msg or fail
    */
      public function addCity(CityRequest $request){
      try{
        $city =  City::create([
          "city_name" => $request->city_name,
          "latitude" => $request->latitude,
          "longitude" => $request->longitude,
          "radius" => $request->radius,
          "country_id"=>$request->countries,
        ]);
        if($city){
          return response()->json(redirect()->back()->with('success', 'New City is added Successfully'));
        }
      }
      catch (\Throwable $th) {
          return $this->error($th->getMessage());
      }
      }
    /**
     *  Enable disable city
     *
     * @param
     * @return
     */
    public function ToggleCityStatus(Request $r)
    {
        try{
        $getcityStatus = City::find($r->id);
        $status = ($getcityStatus->status == City::STATUS_ACTIVE) ? City::STATUS_INACTIVE: City::STATUS_ACTIVE;
        $data = City::where('id', $r->id)->update(['status' => $status]);
        return response()->json($data);
        }
        catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
     /**
     *  View service Provider
     *
     * @param   send id 
     * @return  data from db and show into view 
     */

    public function viewCity($id){ 
        
      $data=City::select('*')->where('id', '=', $id)->first();
      $city=Country::where('id',$data->country_id)->first();
      return view('admin.Cities.detailview',compact('data','city'));
    
   }
  
   /**
     *  back to citylist
     *
     * @param 
     * @return  
     */
    public function CityBack()
    {
    $url = route('view-cities');
    return $url;
    }
     /**
     *  return update form  
     *
     * @param    
     * @return  update form 
     */
    public function UpdateCity(request $request){ 
      $data=City::where('id', '=', $request->id)->first();
      $city=Country::get();
      return view('admin.Cities.update',compact('data','city'));
      }
      /**
     *  update city form  
     *
     * @param    
     * @return  update form 
     */
    public function UpdateCityData(request $request){
 
      $validatedData = $request->validate([
        'countries'=>'required',
        'city_name' => 'required|alpha|max:100',
        'latitude' => 'required|between:-90,90',
        'longitude' => 'required|between:-180,180',
        'radius'=>'required',
      ]);
    $insert = City::where('id', $request->id)->update([
      "country_id" => $request->countries,
      "city_name" => $request->city_name,
      "latitude" => $request->latitude,
      "longitude" => $request->longitude,
      "radius"=>$request->radius,
   ]);
  
    if($insert){
      return response()->json(redirect()->back()->with('success', 'Updated Successfully.'));
    } else {
    return response()->json(redirect()->back()->with('error', 'Updated not successfully'));
    }
  }

      /**
     *  Search city
     *
     * @param search city name in search bar
     * @return  fetch data according to $request
*/
public function filter(Request $request){
  $search = $request->search;
  $qry = City::select('*');
  if(!empty($search)){
      $qry->where(function($q) use($search){
          $q->where('city_name','like',"%$search%");
     });
  }
 $data = $qry->orderBy('id','DESC')->paginate();
 return view('admin.Cities.view', compact('data','search'));
 }
    /**
     *  Delete city
     *
     * @param click on delete button get $r->id
     * @return  delete data accordig to $r->id
    */
    public function CityRemove(Request $request){
      $data = City::where('id',$request->id);
      $data->delete();
      return response()->json(['success' => true]);
      } 


        /**
     *  get city
     *
     * @param click on delete button get $r->id
     * @return  delete data accordig to $r->id
    */
    public function GetCity(Request $request){
      $data = AllCity::where('country_id',$request->country_id)->get();
      return $data ;
      } 
}