<?php

namespace App\Exports;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Report;
use App\Models\UserRating;
use App\Models\ContactUs;
use App\Models\providerAnalytic;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class ReportExport implements FromCollection,WithHeadings,WithEvents
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
    protected $reviewsexport;
    protected $contactexport;
    protected $contactinqueriesexport;
    protected $contactsupportexport;
    protected $customerexport;
    protected $providerexport;
    
    function __construct($user="", $query="",$maxquery="",$minquery="",$maxtwenty="",$mintwenty="",$maxqueryprovider="",$maxtwentyprovider="",$reviewsexport="",$contactexport="",$contactinqueriesexport="",$contactsupportexport="",$customerexport="",$providerexport=""){
        $this->user = $user;
        $this->query = $query;
        $this->maxquery = $maxquery;
        $this->minquery = $minquery;
        $this->maxtwenty = $maxtwenty;
        $this->mintwenty = $mintwenty;
        $this->maxqueryprovider = $maxqueryprovider;
        $this->maxtwentyprovider = $maxtwentyprovider;
        $this->reviewsexport=$reviewsexport;
        $this->contactexport=$contactexport;
        $this->contactinqueriesexport=$contactinqueriesexport;
        $this->contactsupportexport=$contactsupportexport;
        $this->customerexport=$customerexport;
        $this->providerexport=$providerexport;
    }
   /**
   * @return \Illuminate\Support\Collection
   */
    public function collection()
    {  
      if($this->user){
        $first_name = User::select('id','first_name','last_name','business_name','phone','email')->get();
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
      $maxtwentyprovider = Report::join('users as user1','reports.service_provider_id','=','user1.id')
      ->join('users as user2','reports.user_id','=','user2.id')
      ->select('service_provider_id', Report::raw('count(*) as total'))
      ->groupBy('service_provider_id')
      ->select('reports.id','user1.first_name as user_id', 'user2.first_name as service_provider_id','reports.subject','reports.message')->orderByRaw('COUNT(*) DESC')->take(20)
      ->get();
      return $maxtwentyprovider;
    }
    if($this->reviewsexport){
      $reviewsexport = UserRating::join('users as user1', 'user1.id', '=', 'user_ratings.user_id')
      ->join('users as user2', 'user2.id', '=', 'user_ratings.from_user_id')
      ->select('user_ratings.id','user1.first_name as user_id', 'user2.first_name as from_user_id','user_ratings.message')
      ->get();
      return $reviewsexport;
    }
    if( $this->contactexport){
      $contactexport = ContactUs::join('users', 'contact_us.from_user', '=', 'users.id')
      ->select('contact_us.id','contact_us.type', 'contact_us.message','users.first_name',DB::raw("CONCAT(users.country_code, ' ', users.phone)AS Phone"))
      ->get();
      return $contactexport;
    }
    if( $this->contactinqueriesexport){
      $contactinqueriesexport = ContactUs::join('users', 'contact_us.from_user', '=', 'users.id')
                                   ->select('contact_us.id','contact_us.type', 'contact_us.message','users.first_name',DB::raw("CONCAT(users.country_code, ' ', users.phone)AS Phone"))->where('type','=','Inqueries')
                                   ->get();
      return $contactinqueriesexport;
      }
      if( $this->contactinqueriesexport){
        $contactsupportexport = ContactUs::join('users', 'contact_us.from_user', '=', 'users.id')
                                     ->select('contact_us.id','contact_us.type', 'contact_us.message','users.first_name',DB::raw("CONCAT(users.country_code, ' ', users.phone)AS Phone"))->where('type','=','Support Request')
                                     ->get();
        return $contactsupportexport;
        }
        if( $this->customerexport){

        $customerexport = providerAnalytic::join('users as user1', 'user1.id', '=', 'provider_analytics.user_id')
        ->join('users as user2', 'user2.id', '=', 'provider_analytics.service_provider_id')->select('provider_analytics.id','user1.first_name as user_id', 'user2.first_name as service_provider_id')
        ->get();
        
        return $customerexport;
      }
      if( $this->providerexport){
        $providerexport = providerAnalytic::join('users as user1', 'user1.id', '=', 'provider_analytics.user_id')
        ->join('users as user2', 'user2.id', '=', 'provider_analytics.service_provider_id')->select('provider_analytics.id','user1.first_name as user_id', 'user2.first_name as service_provider_id')
        ->get();       
        return $providerexport;
      }
    else{
        "Not Available";
      }
}
 
  public function headings():array{
    if( $this->user ){
         return[
          'Id','First_name','Last_name','Business_name','Phone','Email',
         ];
        }if( $this->query ){
            return[
              'Service_category_id','User_id','Service_provider_id','Subject','Message',
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
              'ID','Customer_name','Provider_name','Subject','Message',
            ];
          }
          if( $this->reviewsexport ){
            return[
                'ID','Customer_name','Provider_name','Reviews',
            ];
          }
          if( $this->contactexport ){
            return[
                'ID','Query_type','Query','Cutomer_name','Contact'
            ];
          }
          if( $this->contactinqueriesexport ){
            return[
                'ID','Query_type','Query','Cutomer_name','Contact'
            ];
          }
          if( $this->contactsupportexport ){
            return[
                'ID','Query_type','Query','Cutomer_name','Contact'
            ];
          }
          if( $this->customerexport ){
            return[
                'ID','Customer_name','Provider_name',
            ];
          }
          if( $this->providerexport ){
            return[
                'ID','Customer_name','Provider_name',
            ];
          }
          else{
            
        }
      }
      /**
     * Write code on Method
     *
     * @return response()
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A1:J1')
                                ->getFont()
                                ->setBold(true);
                                $columns=[
                                  'A' ,   
                                  'B',     
                                  'C' ,    
                                  'D' ,    
                                  'E' ,    
                                  'F'  ,  
                                  'G'  ,   
                                ];
                                foreach($columns as $column){
                                $event->sheet->getDelegate()->getColumnDimension($column)->setWidth(25);
                                }
            },
        ];
    }
}


