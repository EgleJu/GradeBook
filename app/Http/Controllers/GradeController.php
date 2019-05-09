<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Grade;
use App\Lecture;
use App\Student;

class GradeController extends Controller
{

        private $lectures;

        private $students;

        public function __construct() {

            $this->lectures = Lecture::get();
            $this->students = Student::get();
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    
    {

        $lectureFilter = $request->input('lecture_filter', 'All');
        $studentFilter = $request->input('student_filter', 'All');
        $gradeFilter = $request->input('grade_filter', 'All');


        $grades = Grade::orderBy('lecture_id', 'asc');
            $grades->with('lecture');

        if ($lectureFilter !=='All') {
            $grades->whereHas('lecture', 
            function($q) use ($lectureFilter) {$q->where('id', $lectureFilter);});
        }

            $grades->with('student');
    if ($studentFilter !== 'All') {
        $grades->whereHas('student',
        function($q) use ($studentFilter) {$q->where('id', $studentFilter);});
    }
        
            $grades = $grades->paginate(env('ITEMS_PER_PAGE', 8));
        return view('crud.grades_index',
        [
        'lecturesList'  => $this->lectures,
        'studentsList'  => $this->students,
        'grades' => $grades,
        'studentFilter' => $studentFilter,
        'lectureFilter' => $lectureFilter,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.grades_create',
        [
            'lecturesList' => $this->lectures,
            'studentsList' => $this->students,
        ]);
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
            'lecture_id'    => 'numeric',
            'student_id'    => 'numeric',
            'grade'         => 'string|required|max:128',
        ]);

         $grade = new Grade();
         
         $grade->lecture_id  = $valid['lecture_id'];
         $grade->student_id  = $valid['student_id'];
         $grade->grade       = $valid['grade'];


         $grade->save();

         return redirect(route('grades.index'))->with('success', 'Grade has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);

        return view('crud.grades_edit', [
            'lecturesList' => $this->lectures,
            'studentsList' => $this->students,
            'grade'=> $grade,
        ]);

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
            'lecture_id' => 'numeric',
            'student_id' => 'numeric',
            'grade' => 'numeric',
        ]);

         $grade = Grade::find($id);
         
         $grade->lecture_id  = $valid['lecture_id'];
         $grade->student_id  = $valid['student_id'];
         $grade->grade       = $valid['grade'];

         $grade->save();

         return redirect(route('grades.index'))->with('success', 'Grade has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Grade::find($id);
        $grade->delete();
        return redirect(route('grades.index'))->with('success', 'Grade has been deleted.');
    }
}
