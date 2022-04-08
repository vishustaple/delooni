<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class ServiceProviderController extends Controller
{
    /**
     *  Show ServiceProvider List
     *
     * @param 
     * @return 
     */
    public function ViewServiceProvider(){


        $data = User::role(Role::where('id',User::ROLE_SERVICE_PROVIDER)->value('name'))
                        ->orderBy('id', 'DESC')
                        ->where('status','!=',User::STATUS_INACTIVE)
                        ->paginate();
        return view('admin.serviceprovider.create', compact('data'));
     //return view('admin.serviceprovider.addform');

    }
        
}
