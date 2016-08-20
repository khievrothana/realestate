<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class HomeController extends Controller
{
 
  use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth', ['except' => 'getLogout']);
    // }

    public function index()
    {
        return View('admin.home');
    }
 
}
