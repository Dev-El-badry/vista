<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return redirect()->route('manage.dashboard');
    }

    public function dashboard() {
        return view('home');
    }
}
