<?php

namespace App\Exports;
use Carbon\Carbon;
use App\Models\User;


use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection
{   
   /**
    * call constructor to get id 
    */
    protected $post_by;
    protected $id;
    protected $start_date;
    protected $end_time;
    function __construct($id, $post_by=null, $end_date="", $start_date=""){
          $this->post_by = $post_by;
          $this->end_date = $end_date; 
          $this->start_date = $start_date; 
          $this->id = $id; 
    }
  /**
  * @return \Illuminate\Support\Collection
  */
 public function collection()
  {  dd("Ankur");
     if( $this->post_by ){
      $report = User::where('users.id', '=', $this->post_by)
      ->leftJoin('jobs','users.id','=','jobs.post_by')
      ->select('jobs.title','users.name','jobs.start_time','jobs.end_time','jobs.date','jobs.total_time','jobs.status')
      ->where('users.role_id', '=', 2)
      ->get();
      $array =[];
      $count = 0;
      for($i=0;$i<count($report);$i++)
    {
      if($report[$i]->status == 0)
     {
       $report[$i]->status = "Schedule";
      }elseif($report[$i]->status == 2){
      $report[$i]->status = "Accepted";
      }elseif($report[$i]->status === 1){
      $report[$i]->status = "Reschedule";
      }else{
      $report[$i]->status = "Decline";
     }
    }
   return $report;
    } else {
     $data = User::where('users.role_id', '=', 3)
      ->leftJoin('jobs','users.id','=','jobs.assign_to')
      ->select('jobs.title','users.name','jobs.start_time','jobs.end_time','jobs.date','jobs.total_time','jobs.status')
      ->where('users.id', '=', $this->id)
      ->where('jobs.date', '>', Carbon::now()->subDays(7))
      ->get();
    $array =[];
    $count = 0;

    for($i=0;$i<count($data);$i++)
    {
      if($data[$i]->status == 0)
     {
       $data[$i]->status = "Schedule";
      }elseif($data[$i]->status == 2){
      $data[$i]->status = "Accepted";
      }elseif($data[$i]->status === 1){
      $data[$i]->status = "Reschedule";
      }else{
      $data[$i]->status = "Decline";
     }
    }
   return $data;
   }
 
}
 
 public function headings():array{
  if( $this->post_by ){
  return[
      'Job Name',
      'Hospital Name',
      'Start_time',
      'End_time',
      'Date', 
      'WorkDone(in Hours)',
      'Status'
  ];
}else{
  return[
     'Job Name',
     'Employee Name',
     'Start_time',
     'End_time',
     'Date', 
     'WorkDone(in Hours)',
     'Status'
];
}
}
}
