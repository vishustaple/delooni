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
    protected $name;
    function __construct($name){
        $this->name = $name;
    }
   /**
   * @return \Illuminate\Support\Collection
   */
    public function collection()
    {  
      $user = User::select('first_name')->get();
      $query = Report::get();
      $minquery = Report::join('service_categories','reports.service_category_id','=','service_categories.id')
      ->where('is_parent',0)->select('service_categories.name', Report::raw('COUNT(*) as `count`'))
      ->groupBy('service_categories.name')->having('count', '=', 1)->get();
      $maxtwenty = Report::join('service_categories','reports.service_category_id','=','service_categories.id')
      ->where('is_parent',0)->select('service_categories.name', Report::raw('COUNT(*) as `count`'))
      ->groupBy('service_categories.name')->having('count', '>', 20)->get();
      $mintwenty = Report::join('service_categories','reports.service_category_id','=','service_categories.id')
      ->where('is_parent',0)->select('service_categories.name', Report::raw('COUNT(*) as `count`'))
      ->groupBy('service_categories.name')->having('count', '<', 20)->get();
      $maxtwentyprovider = Report::join('users','reports.service_provider_id','=','users.id')
      ->select('users.first_name', Report::raw('COUNT(*) as `count`'))
      ->groupBy('users.first_name')->having('count', '<', 20)->get();
      return $name;
    //   return $user;
    //   return $query;
    //   return $minquery;
    //   return $maxtwenty;
    //   return $mintwenty;
    //   return $maxtwentyprovider;
      // return json(["user"=>$user, "query" =>$query, "minquery" =>$minquery,"maxtwenty" =>$maxtwenty,
      // "mintwenty" =>$mintwenty, "maxtwentyprovider" =>$maxtwentyprovider]);
 
}
 
    public function headings():array{
     return[
      'S.no',
      'Total User',
      'Total query',
      'category has minimum query',
      'category has maximum twenty query',
      'category has minimum twenty query',
      'Service Provider with maximum twenty query'
      ];

}
}

