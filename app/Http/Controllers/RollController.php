<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MarksEntry;
use App\Subject;
use App\Student;
use App\SchoolClass;
use App\Result;
use App\Attendence;

use Illuminate\Http\Request;
use Session;

use Alert;

class RollController extends Controller
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

        $activeMenu = 'roll';

        if (!empty($keyword)) {
            $marksentry = MarksEntry::where('student', 'LIKE', "%$keyword%")
				->orWhere('subject', 'LIKE', "%$keyword%")
				->orWhere('obtainedth', 'LIKE', "%$keyword%")
				->orWhere('obtainedpr', 'LIKE', "%$keyword%")
				->orWhere('obtainedgradeth', 'LIKE', "%$keyword%")
				->orWhere('obtainedgradepr', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $marksentry = MarksEntry::paginate($perPage);
        }

        return view('marks-entry.index', compact('marksentry','activeMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function newCreate(Request $request)
    {
        $class = $request->get('class');
        $section = $request->get('section');

        $activeMenu = 'roll';

        return view('roll.create',compact('activeMenu','class','section','exam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $activeMenu = 'roll';

        return view('roll.setClass',compact('activeMenu'));
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
        
        $clsId = $request->get('class');
        $className = SchoolClass::whereId($clsId)->first()->title;
        $sec = $request->get('section');   
        $students = Student::whereClass($clsId)->whereSection($sec)->get();

        for($i = 1; $i <= $students->count(); $i++){    
            $student = Student::whereId($request->get('student'.$i))->first();

            $student->fill([
                'roll' => $request->get('roll'.$i)
            ])->save();
        }
        Alert::success("You have successfully updated roll number for Class ".$className,"Successful")->persistent("Ok");


        return redirect('admin/roll/create');
    }
}
