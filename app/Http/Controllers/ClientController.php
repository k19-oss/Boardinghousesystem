<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.dashboard');
    }
    public function login(Request $request)
    {
        return redirect()->route('client.dashboard');
    }
    public function logout()
    {
        return redirect('/client/login');
    }
}