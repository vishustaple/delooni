<?php

namespace App\Exports;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Report;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection,WithHeadings
   {   
 
    /**
    * call constructor to get id 
    */
    protected $user;
    protected $query;
    protected $maxquery;
    protected $minquery;
    protected $maxtwenty;
    protected $mintwenty;
    protected $maxqueryprovider;
    protected $maxtwentyprovider;
    protected $reviews;

    
    function __construct($user="", $query="",$maxquery="",$minquery="",$maxtwenty="",$mintwenty="",$maxqueryprovider="",$maxtwentyprovider="",$reviews=""){
        $this->user = $user;
        $this->query = $query;
        $this->maxquery = $maxquery;
        $this->minquery = $minquery;
        $this->maxtwenty = $maxtwenty;
        $this->mintwenty = $mintwenty;
        $this->maxqueryprovider = $maxqueryprovider;
        $this->maxtwentyprovider = $maxtwentyprovider;
        $this->reviews=$reviews;
    }
   /**
   * @return \Illuminate\Support\Collection
   */
    public function collection()
    {  
      if($this->user){
        $first_name = User::select('first_name')->get();
        return $first_name;
      
      }if($this->query){
        $query = Report::select('service_category_id','user_id','service_provider_id','subject','message')->get();
        return $query;
      }if($this->maxquery){
        $maxquery = Report::join('service_categories','reports.service_category_id','=','service_categories.id')
        ->select('service_category_id', Report::raw('count(*) as total'))
        ->groupBy('service_category_id')->where('service_category_id', \DB::raw("(select max(`service_category_id`) from reports)"))
        ->select('service_categories.name')
        ->get();
        return $maxquery;
    }if($this->minquery){
        $minquery = Report::join('service_categories','reports.service_category_id','=','service_categories.id')
      ->select('service_category_id', Report::raw('count(*) as total'))
      ->groupBy('service_category_id')->where('service_category_id', \DB::raw("(select min(`service_category_id`) from reports)"))
        ->select('service_categories.name')
      ->get();
      return $minquery;
    }if($this->maxtwenty){
        $maxtwenty = Report::join('service_categories','reports.service_category_id','=','service_categories.id')
        ->where('is_parent',0)->select('service_categories.name', Report::raw('COUNT(*) as `count`'))
        ->groupBy('service_categories.name')->having('count', '>', 20)->get();
         return $maxtwenty;
    }if($this->mintwenty){
        $mintwenty = Report::join('service_categories','reports.service_category_id','=','service_categories.id')
        ->where('is_parent',0)->select('service_categories.name', Report::raw('COUNT(*) as `count`'))
        ->groupBy('service_categories.name')->having('count', '<', 20)->get();
         return $mintwenty;
    }if($this->maxqueryprovider){
      $maxqueryprovider = Report::join('users','reports.service_provider_id','=','users.id')
      ->select('service_provider_id', Report::raw('count(*) as total'))
      ->groupBy('service_provider_id')
      ->select('users.first_name')->orderByRaw('COUNT(*) DESC')->take(1)
      ->get();
      return $maxqueryprovider;
    }
    if($this->maxtwentyprovider){
      $maxtwentyprovider = Report::join('users','reports.service_provider_id','=','users.id')
      ->select('service_provider_id', Report::raw('count(*) as total'))
      ->groupBy('service_provider_id')
      ->select('users.first_name')->orderByRaw('COUNT(*) DESC')->take(20)
      ->get();
      return $maxtwentyprovider;
    }
    if($this->reviewsexport){
      $reviewsexport = UserRating::count();
      return $reviewsexport;
    }
    else{
        "Not Available";
      }
}
 
  public function headings():array{
    if( $this->user ){
         return[
          'Total Registered User',
         ];
        }if( $this->query ){
            return[
              'service_category_id','user_id','service_provider_id','subject','message',
            ];
           }if( $this->maxquery ){
            return[
             'Category has maximum query',
            ];
           }if( $this->minquery ){
            return[
             'Category has minimum query',
            ];
           }if( $this->maxtwenty ){
            return[
                'Category has maximum twenty query',
            ];
           }if( $this->mintwenty ){
            return[
                'Category has minimum twenty query',
            ];
           }if( $this->maxqueryprovider ){
            return[
                'Service Provider has maximum query',
            ];
           }
           if( $this->maxtwentyprovider ){
            return[
                'Top Twenty Service Provider has maximum query',
            ];
          }
          if( $this->reviewsexport ){
            return[
                'Total reviews received',
            ];
          }
          else{
            
        }
      

}
}

