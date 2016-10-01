<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $tmp = '';

        return view('admin.index', compact('tmp'));
    }

    public function update()
    {

        return redirect()->back()->with('status', 'Back here'); 
    }
}
