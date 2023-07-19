<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comic;

class MainController extends Controller
{
    public function index() {

        $comics = Comic :: all();

        return view("home", compact('comics'));
    }

    public function show($id) {

        $comic = Comic :: findOrFail($id);

        return view('show', compact('comic'));
    }

    public function create() {

        return view('create');
    }

    public function store(Request $request) {


        $data = $request -> validate(
            $this -> getValidationRule()
        );

        $comic = Comic :: create($data);



        return redirect() -> route('show', $comic -> id);
    }

    public function edit($id) {

        $comic = Comic :: findOrFail($id);

        // return view('edit', compact('comic'));
        return view('edito', ['comic' => $comic]);
    }
    public function update(Request $request, $id) {

       $data = $request -> validate(
            $this -> getValidationRule()
        );
        $comic = Comic :: findOrFail($id);

        $comic -> update($data);

        return redirect() -> route('show', $comic -> id);
    }

    public function delete($id) {

        $comic = Comic :: findOrFail($id);

        $comic -> delete();

        return redirect() -> route('index');
    }

    private function getValidationRule() {

        return [
            'title' => 'required|min:5|max:100',
            'description' => 'required|min:10|max:500',
            'thumb' => 'required|min:100|max:5000',
            'price' => 'required|integer|numeric|min:2|max:200|',
            'type' => 'required|min:3|max:255'
        ];
}

}