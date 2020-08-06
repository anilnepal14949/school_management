<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Student;
use App\SchoolClass;
use App\Section;
use Illuminate\Http\Request;
use Session;

use Alert;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $activeMenu = "students";

        $classes = SchoolClass::all();

        return view('students.index', compact('classes','activeMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $classes = SchoolClass::all();
        $sections = Section::all();

        $student = null;

        $activeMenu = "students";

        return view('students.create',compact('activeMenu','classes','sections','student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        Student::create([
            'class' => $request->get('class'),
            'section' => $request->get('section'),
            'roll' => $request->get('roll'),
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'house' => $request->get('house'),
            'gender' => $request->get('gender'),
            'date_of_birth' => $request->get('date_of_birth'),
            'parentName' => $request->get('parentName'),
            'parentContact' => $request->get('parentContact'),
            'busStudent' => $request->get('busStudent'),
            'disability' => $request->get('disability'),
        ]);

        Alert::success("You have successfully added student ".$request->get('name'),"Successful")->persistent("Ok");

        return redirect('admin/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $activeMenu = "students";

        $student = Student::findOrFail($id);

        return view('students.show', compact('student','activeMenu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $classes = SchoolClass::all();
        $sections = Section::all();

        $activeMenu = "students";

        $student = Student::findOrFail($id);

        return view('students.edit', compact('student','activeMenu','classes','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $student = Student::findOrFail($id);

        $student->fill([
            'class' => $request->get('class'),
            'section' => $request->get('section'),
            'roll' => $request->get('roll'),
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'house' => $request->get('house'),
            'gender' => $request->get('gender'),
            'date_of_birth' => $request->get('date_of_birth'),
            'parentName' => $request->get('parentName'),
            'parentContact' => $request->get('parentContact'),
            'busStudent' => $request->get('busStudent'),
            'disability' => $request->get('disability'),
        ])->save();

        Alert::success("You have successfully updated student ".$request->get('name'),"Successful")->persistent("Ok");
        return redirect('admin/students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Student::destroy($id);

        Session::flash('flash_message', 'Student deleted!');

        return redirect('admin/students');
    }
}
