<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function showUsers(){
    $users=DB::table('users')->paginate(10);
    return view('admin.displayUser',["users"=>$users]);


    }

}
