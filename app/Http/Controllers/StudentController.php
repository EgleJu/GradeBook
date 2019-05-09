<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('surname', 'asc')
        ->with(['hasOneGrade' => function($query) {
                $query->select('student_id');} ])
        ->paginate(env('ITEMS_PER_PAGE', 8));
        return view('crud.students_index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.students_create');
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
            'name'=>'string|required|unique:students,name|max:255',
            'surname'=>'string|required|unique:students,surname|max:255',
            'email'=>'string|required|unique:students,email|max:255',
            'phone'=>'string|required|unique:students,phone|max:255',
        ]);

        $student = new Student();

        $student->name = $valid['name'];
        $student->surname = $valid['surname'];
        $student->email = $valid['email'];
        $student->phone = $valid['phone'];

        $student->save();

        return redirect(route('students.index'))->with('success', 'Student has been added.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(route('students.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('crud.students_edit', ['student' => $student]);
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
            'name'=>'string|required|max:255',
            'surname'=>'string|required|max:255',
            'email'=>'string|required|max:255',
            'phone'=>'string|required|max:255',
        ]);

        $student = Student::find($id);

        $student->name = $valid['name'];
        $student->surname = $valid['surname'];
        $student->email = $valid['email'];
        $student->phone = $valid['phone'];

        $student->save();

        return redirect(route('students.index'))->with('success', 'Student has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect(route('students.index'))->with('success', 'Student has been deleted');
    }
}
