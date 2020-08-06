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

class AttendenceController extends Controller
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

        $activeMenu = 'attendence';

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
        $exam = $request->get('exam');

        $activeMenu = 'attendence';

        return view('attendence.create',compact('activeMenu','class','section','exam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $activeMenu = 'attendence';

        return view('attendence.setClass',compact('activeMenu'));
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

        for($i = 1; $i <= $students->count(); $i++){    
            Attendence::create([
                'class' => $clsId,
                'section' => $sec,
                'exam' => $exam,
                'student' => $request->get('student'.$i),
                'attendence' => $request->get('attendence'.$i),
                'grade_in_conduct' => $request->get('grade_in_conduct'.$i)
            ]);
        }
        Alert::success("You have successfully stored attendence and grade in conduct for Class ".$className,"Successful")->persistent("Ok");


        return redirect('admin/attendence/create');
    }

    public function editAttendence(){
        $activeMenu = 'attendence';

        return view('attendence.setEditClass',compact('activeMenu'));
    }

    public function showAttendence(Request $request){
        $class = $request->get('class');
        $exam = $request->get('exam');
        $section = $request->get('section');

        $activeMenu = 'attendence';

        $attendences = Attendence::whereClass($class)->whereSection($section)->whereExam($exam)->get();

        return view('attendence.showAttendence',compact('attendences','exam','class','section','activeMenu'));
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

    public function updateAttendence(Request $request)
    {
        
        $clsId = $request->get('class');
        $className = SchoolClass::whereId($clsId)->first()->title;
        $sec = $request->get('section');
        $exam = $request->get('exam');
        $students = Student::whereClass($clsId)->whereSection($sec)->get();

        for($i = 1; $i <= $students->count(); $i++){    
            $student_id = $request->get('student'.$i);
            $attendence = Attendence::whereClass($clsId)->whereSection($sec)->whereExam($exam)->whereStudent($student_id)->first();
            $attendence->fill([
                'class' => $clsId,
                'section' => $sec,
                'exam' => $exam,
                'student' => $student_id,
                'attendence' => $request->get('attendence'.$i),
                'grade_in_conduct' => $request->get('grade_in_conduct'.$i)
            ])->save();
        }
        Alert::success("You have successfully updated attendence and grade in conduct entry for Class ".$className,"Successful")->persistent("Ok");

        return redirect('admin/attendence/create');
    }
}
