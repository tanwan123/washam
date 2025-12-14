<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    public function index()
    {
        // Fetch all services from the database
        $services = Service::all();
        return view('services', compact('services'));
    }
}
