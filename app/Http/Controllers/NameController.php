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
        $this->middleware('auth');
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
        $name = new Name(array());

        $name->save();

        $id = $name->id;
        $revision = $this->save_revision($id, $request->get('name'));

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

        $revision = $this->save_revision($id, 
            $request->get('name'),
            $request->get('verse'),
            $request->get('meaning_function'),
            $request->get('identical_titles'),
            $request->get('significance'),
            $request->get('responsibility')
        );

        return redirect()->back()->with('status', 'Updated: ' . $revision->name); 
    }

    private function save_revision($id, $name, $verse='', $meaning_function='', $identical_titles='', $significance='', $responsibility='')
    {
        $revision = new Revision(array(
            'name_id'          => $id,
            'name'             => $name,
            'verse'            => $verse,
            'meaning_function' => $meaning_function,
            'identical_titles' => $identical_titles,
            'significance'     => $significance,
            'responsibility'   => $responsibility
        ));

        $revision->save();

        return $revision;
    }
}
