<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(Request $req) {
        if(Gate::allows("isAdmin"))  {
            return Inertia::render('AdminPanel');
        }
        return Inertia::render("Dashboard");
    }
}
