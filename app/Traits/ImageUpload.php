<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Files;
use Illuminate\Support\Facades\Log;

trait ImageUpload
{

  /**
   * @param Request $request
   * @return $this|false|string
   */
  public function DBimageUpload($file, $model, $id, $column, $filename = "images")
  {
    $model = "App\Models\\" . $model;
    $image = $model::where('id', $id)->first();
    $imageName = "";
    if (empty($file)) {
      $imageName = $image->$column;
    } else {
      $file = $file;
      $imageName = $this->UploadImage($file, $filename);
    }
    return $imageName;
  }
  public function UploadImage($file, $fileName)
  {
    if(!empty($file)){
    $imageName = Str::random(10) . '.' . $file->extension();
    $destinationPath = public_path($fileName);
    $file->move($destinationPath, $imageName);
    
    return $imageName;
    }
  }

  

  public function uploadFiles($fileFolder, $model,$file, $fileType)
  {
    if (!empty($fileFolder)) {
      $image = time() . $fileFolder->getClientOriginalName();
      $imageName = str_replace(' ', '_', $image);
      $extension = ($fileFolder)->getClientOriginalExtension();
      $destinationPath = public_path($file);
      $fileFolder->move($destinationPath,$imageName);
    }
    // $getFileSize = $fileFolder->getSize();
    try {
      $file = new Files;
      $file->file_name = $imageName;
      $file->extension = $extension;
      $file->model_id = $model->id;
      $file->model_type = get_class($model);
      $file->type =  $fileType;
      $file->file_size = 122; //
      $file->created_by = $model->id;
      $file->save();
    } catch (\Throwable $e) {

      return Log::error('upload fils error!' . $e->getMessage());
    }
  }
}
