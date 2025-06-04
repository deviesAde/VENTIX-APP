<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    /**
     * Display the organizer dashboard.
     */
    public function index()
    {
        return view('organizer.dashboard'); // Create a Blade file: resources/views/organizer/dashboard.blade.php
    }
}
