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
        $name = Name::createAndInitRevision($request->get('name'));

        return redirect('/names/new')->with('status', 'Newly added: ' . $request->get('name')); 
    }

    public function show(Name $name)
    {
        $name->load('latestRevision');

        $authors = Revision::authorsOnNameId($name->id);

        return view('names.show', compact('name', 'authors'));
    }

    public function update(Name $name, Revision $revision, Request $request)
    {
        $isNewRevision = $request->revision_title != '';

        if ($isNewRevision) {
            return $this->saveNewRevision($name, $request);
        } else {
            return $this->updateRevision($revision, $request);
        }
    }

    /**
     * Private
     */
    private function saveNewRevision($name, $request)
    {
        $message = 'Saved to revision: ' . $request->get('revision_title');
        $revision = $name->createRevision($request->all());

        return redirect()->action(
            'NameController@show', [$name->id, $revision->id]
        )->with('status', $message);
    }

    private function updateRevision($revision, $request)
    {
        $message = 'Updated revision: ' . $revision->revision_title;

        /**
         * Keep revision_title by not including it on mass assigned replacement.
         */
        $revision->update(
            $this->removeRevisionTitle($request->all())
        );

        return redirect()->back()->with('status', $message); 
    }

    private function removeRevisionTitle($arr)
    {
        unset($arr['revision_title']);
        return $arr;
    }
}
