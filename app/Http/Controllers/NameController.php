<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NameFormRequest;

use Auth;
use App\Name;
use App\Revision;
use App\User;

class NameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', array('except' => 'index'));
    }

    public function index()
    {
        $names = Name::with('latestRevision')->ordered();

        return view('names.index', compact('names'));
    }

    public function create()
    {
        return view('names.create');
    }

    public function store(NameFormRequest $request)
    {
        $name = Name::createAndInitRevision($request->get('name'));

        return redirect('/names/new')->with('status', 'Newly added: ' . $request->get('name')); 
    }
}
