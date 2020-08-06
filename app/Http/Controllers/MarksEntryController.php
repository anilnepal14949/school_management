<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MarksEntry;
use App\Subject;
use App\Student;
use App\SchoolClass;
use App\Result;

use Illuminate\Http\Request;
use Session;

use Alert;

class MarksEntryController extends Controller
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

        $activeMenu = 'marks-entry';

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
        $subject = $request->get('subject');
        $section = $request->get('section');
        $exam = $request->get('exam');

        $activeMenu = 'marks-entry';

        return view('marks-entry.create',compact('activeMenu','subject','class','section','exam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $activeMenu = 'marks-entry';

        return view('marks-entry.setClass',compact('activeMenu'));
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
        $exam = $request->get('exam');
        $students = Student::whereClass($clsId)->whereSection($sec)->get();

        // dd($request->get('subject_order'));

        for($i = 1; $i <= $students->count(); $i++){
            MarksEntry::create([
                'class' => $clsId,
                'section' => $sec,
                'exam' => $exam,
                'student' => $request->get('student'.$i),
                'subject' => $request->get('subject'),
                'obtainedth' => $request->get('obtained_theory'.$i),
                'obtainedpr' => $request->get('obtained_practical'.$i)
            ]);

            $results = Result::whereStudent($request->get('student'.$i))->whereClass($clsId)->whereExam($exam)->first();
            if(!$results){
                Result::create([
                    'student' => $request->get('student'.$i),
                    'class' => $request->get('class'),
                    'section' => $request->get('section'),
                    'exam' => $request->get('exam'),
                    'sub'.$request->get('subject_order').'th' => $request->get('obtained_theory'.$i),
                    'sub'.$request->get('subject_order').'pr' => $request->get('obtained_practical'.$i)
                ]);
            }else{
                $results->fill([
                    'student' => $request->get('student'.$i),
                    'class' => $request->get('class'),
                    'section' => $request->get('section'),
                    'exam' => $request->get('exam'),
                    'sub'.$request->get('subject_order').'th' => $request->get('obtained_theory'.$i),
                    'sub'.$request->get('subject_order').'pr' => $request->get('obtained_practical'.$i)
                ])->save();
            }
        }
        Alert::success("You have successfully stored marks entry for Class ".$className,"Successful")->persistent("Ok");


        return redirect('admin/marks-entry/create');
    }

    public function editMarks(){
        $activeMenu = 'marks-entry';

        return view('marks-entry.setEditClass',compact('activeMenu'));
    }

    public function showMarks(Request $request){
        $class = $request->get('class');
        $exam = $request->get('exam');
        $section = $request->get('section');
        $subject = $request->get('subject');

        $activeMenu = 'marks-entry';

        $marks = Result::whereClass($class)->whereSection($section)->whereExam($exam)->get();

        return view('marks-entry.showMarks',compact('marks','exam','class','section','subject','activeMenu'));
    }

    public function getSubjects(Request $request){
        if($request->ajax()){

            $class = $request->get('input');
            $subjects = Subject::whereClass($class)->get();

            $return = '';
            foreach($subjects as $subject){
                $return .= '<option value="'.$subject->id.'">'.$subject->title.'</option>';
            }
            return $return;
        }
        return false;
    }

    public function updateMarks(Request $request)
    {

        $clsId = $request->get('class');
        $className = SchoolClass::whereId($clsId)->first()->title;
        $sec = $request->get('section');
        $exam = $request->get('exam');
        $subject = $request->get('subject');
        $students = Student::whereClass($clsId)->whereSection($sec)->get();

        for($i = 1; $i <= $students->count(); $i++){
            $student_id = $request->get('student'.$i);
            $marksentry = MarksEntry::whereClass($clsId)->whereSection($sec)->whereExam($exam)->whereSubject($subject)->whereStudent($student_id)->first();
            $marksentry->fill([
                'class' => $clsId,
                'section' => $sec,
                'exam' => $exam,
                'student' => $student_id,
                'subject' => $subject,
                'obtainedth' => $request->get('obtained_theory'.$i),
                'obtainedpr' => $request->get('obtained_practical'.$i)
            ])->save();

            $results = Result::whereStudent($student_id)->whereClass($clsId)->whereExam($exam)->first();

            $results->fill([
                'student' => $request->get('student'.$i),
                'class' => $request->get('class'),
                'section' => $request->get('section'),
                'exam' => $request->get('exam'),
                'sub'.$request->get('subject_order').'th' => $request->get('obtained_theory'.$i),
                'sub'.$request->get('subject_order').'pr' => $request->get('obtained_practical'.$i)
            ])->save();
        }
        Alert::success("You have successfully edited marks entry for Class ".$className,"Successful")->persistent("Ok");


        return redirect('admin/marks-entry/create');
    }
}
