<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        return view('user.dashboard'); // Create a Blade file: resources/views/user/dashboard.blade.php
    }
}
