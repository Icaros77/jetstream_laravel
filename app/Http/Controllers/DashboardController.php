<?php

namespace App\Http\Controllers;

use App\Models\Product;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $req)
    {
        return Inertia::render('Dashboard',['title' => 'Dashboard']);
    }
}
