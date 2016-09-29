<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NameFormRequest;
use App\Name;
use App\Revision;

class NameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', array('except' => 'index'));
    }

    public function index()
    {
        $names = Name::with('revision')->get();

        return view('names.index', compact('names'));
    }

    public function create()
    {
        return view('names.create');
    }

    public function store(NameFormRequest $request)
    {
        $name = Name::create();

        $revision = $this->save_revision($name, $request->all());

        return redirect('/names/new')->with('status', 'Newly added: ' . $revision->name); 
    }

    public function show($id)
    {
        $name = Name::with('revision')->whereId($id)->firstOrFail();
        return view('names.show', compact('name'));
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $name = Name::with('revision')->whereId($id)->firstOrFail();

        $revision = $this->save_revision($name, $request->all());

        return redirect()->back()->with('status', 'Saved on revision: ' . $revision->revision_title); 
    }

    private function save_revision($name, $data)
    {
        $data = array_add($data, 'name_id', $name->id);

        /**
         * Default to empty string
         */
        $data['revision_title']   = isset($data['revision_title']) ? $data['revision_title'] : 'New';
        $data['verse']            = isset($data['verse']) ? $data['verse'] : '';
        $data['meaning_function'] = isset($data['meaning_function']) ? $data['meaning_function'] : '';
        $data['identical_titles'] = isset($data['identical_titles']) ? $data['identical_titles'] : '';
        $data['significance']     = isset($data['significance']) ? $data['significance'] : '';
        $data['responsibility']   = isset($data['responsibility']) ? $data['responsibility'] : '';

        $revision = new Revision($data);

        \Auth::user()->revisions()->save($revision);

        return $revision;
    }
}
