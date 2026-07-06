<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('company_admin')) {
            return redirect()->route('company.dashboard');
        }

        if ($user->hasRole('supervisor')) {
            return redirect()->route('supervisor.dashboard');
        }

        if ($user->hasRole('agent')) {
            return redirect()->route('agent.dashboard');
        }

        if ($user->hasRole('qa_analyst')) {
            return redirect()->route('qa.dashboard');
        }

        return view('home');
    }
}
