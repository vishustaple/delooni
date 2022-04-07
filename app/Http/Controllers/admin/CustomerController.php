<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class CustomerController extends Controller
{
  /**
    * customer View
    *
    * @param  show admin dashboard
    * @return view detail of all customers
  */
  public function customerView(){
        $data = User::select('*')->orderBy('id', 'DESC')->paginate();
        return view('admin.customer.main', compact('data'));
      }
}

