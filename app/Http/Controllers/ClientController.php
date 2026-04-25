<?php

namespace App\Http\Controllers; // This must be the very first line after <?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index() 
    { 
        $myStatus = [ 
            'room' => 'Room 101', 
            'balance' => '700.00', 
            'is_overdue' => true, 
            'due_date' => 'March 30, 2026' 
        ]; 
        
        return view('client.dashboard', compact('myStatus')); 
    }
}