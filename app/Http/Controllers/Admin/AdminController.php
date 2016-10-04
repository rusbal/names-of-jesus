<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tmp = '';

        return view('admin.index', compact('tmp'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'color' => 'required|color'
        ]);

        $user = Auth::user();
        $user->color = $request->color;
        $user->save();

        return redirect()->back()->with('status', 'Your profile was successfully updated.'); 
    }
}
