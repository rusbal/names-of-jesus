<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NameFormRequest;

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
        $names = Name::with('latestRevision')->get();

        return view('names.index', compact('names'));
    }

    public function create()
    {
        return view('names.create');
    }

    public function store(NameFormRequest $request)
    {
        $name = Name::create_and_init_revision($request->get('name'));

        return redirect('/names/new')->with('status', 'Newly added: ' . $request->get('name')); 
    }

    public function show(Name $name)
    {
        $name->load('latestRevision');

        $users_revision = User::revisions_for_name($name->id);

        return view('names.show', compact('name', 'users_revision'));
    }

    public function update(Name $name, Request $request)
    {
        $name->save_revision($request->all());

        return redirect()->back()->with('status', 'Saved on revision: ' . $request->get('revision_title')); 
    }
}
