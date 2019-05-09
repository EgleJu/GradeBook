<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lecture;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lectures = Lecture::orderBy('name', 'asc')
            ->with(['hasOneGrade' => function($query) {
                $query->select('lecture_id');
                }
            ])
            ->paginate(env('ITEMS_PER_PAGE', 8));
            return view('crud.lectures_index', ['lectures' => $lectures]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.lectures_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'string|required|max:255',
            'description' => 'string|max:255',
        ]);

        $lecture = new Lecture();

        $lecture->name = $valid['name'];
        $lecture->description = $valid['description'];

        $lecture->save();

        return redirect(route('lectures.index'))->with('success', 'Lecture has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(route('lectures.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lecture = Lecture::findOrFail($id);
        return view('crud.lectures_edit', ['lecture' => $lecture]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $valid = $request->validate([
            'name' => 'string|required|max:255',
            'description' => 'string|max:255', 
        ]);

        $lecture = Lecture::find($id);

        $lecture->name = $valid['name'];
        $lecture->description = $valid['description'];

        $lecture->save();

        return redirect(route('lectures.index'))->with('success', 'Lecture has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lecture = Lecture::find($id);
        $lecture->delete();
        return redirect(route('lectures.index'))->with('success, Lecture has been deleted.');
    }
}
