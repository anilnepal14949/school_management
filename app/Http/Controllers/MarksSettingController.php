<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MarksSetting;
use App\SchoolClass;
use App\Subject;
use App\Examination;
use Illuminate\Http\Request;
use Session;

use Alert;

class MarksSettingController extends Controller
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

        $activeMenu = "marks-setting";

        if (!empty($keyword)) {
            $markssetting = MarksSetting::where('class', 'LIKE', "%$keyword%")
				->orWhere('subject', 'LIKE', "%$keyword%")
				->orWhere('theory', 'LIKE', "%$keyword%")
				->orWhere('practical', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $markssetting = MarksSetting::paginate($perPage);
        }

        return view('marks-setting.index', compact('markssetting','activeMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $activeMenu = "marks-setting";
        $exams = Examination::all();
        $classes = SchoolClass::all();

        return view('marks-setting.create',compact('activeMenu','exams','classes'));
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
        $subjects = Subject::all();
        $i = 1;
        foreach($subjects as $subject){
            $exam = $request->get('exam_id'.$i);
            $class = $request->get('class_id'.$i);
            $subject_id = $request->get('subject_id'.$i);

			if($request->get('th'.$subject_id)){
				MarksSetting::create([
					'exam' => $exam,
                    'class' => $class,
					'subject' => $subject_id,
					'theory' => $request->get('th'.$subject_id),
					'pass' => $request->get('pm'.$subject_id),
					'practical' => $request->get('pr'.$subject_id),
				]);
			}

            $i++;
        }

        Alert::success("You have successfully created marks setting!","Successful")->persistent("Ok");

        return redirect('admin/marks-setting');
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
        $activeMenu = "marks-setting";

        $markssetting = MarksSetting::findOrFail($id);

        return view('marks-setting.show', compact('markssetting','activeMenu'));
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
        $activeMenu = "marks-setting";

        $markssetting = MarksSetting::findOrFail($id);

        $exams = Examination::all();
        $classes = SchoolClass::all();

        return view('marks-setting.edit', compact('markssetting','activeMenu','exams','classes'));
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

        $markssetting = MarksSetting::whereId($id)->first();

        $markssetting->fill([
            'exam' => $request->get('exam'),
            'class' => $request->get('class'),
            'subject' => $request->get('subject'),
            'theory' => $request->get('theory'),
            'pass' => $request->get('pass'),
            'practical' => $request->get('practical')

        ])->save();

        Alert::success("You have successfully updated marks setting!","Successful")->persistent("Ok");

        return redirect('admin/marks-setting');
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
        MarksSetting::destroy($id);

        Alert::success("You have successfully deleted marks setting!","Successful")->persistent("Ok");

        return redirect('admin/marks-setting');
    }

    public function getSubjects(Request $request){
        if($request->ajax()){
            $class = $request->get('class');
            $exam = $request->get('input');
            $subjects = Subject::whereClass($class)->get();

            $i = 1;

            $return = '<tr><th> Subject </th><th> Theory </th><th> Practical </th><th> Pass Marks </th></tr>';
            foreach($subjects as $subject){
                $markssetting = MarksSetting::whereSubject($subject->id)->whereExam($exam)->first();
                if(!$markssetting){
                    $return .= '<tr><td><input type="text" id="subject_name'.$i.'" name="subject_name'.$i.'" readonly value="'.$subject->title.'"></td><td><input type="number" id="th'.$subject->id.'" name="th'.$subject->id.'" value="0"></td><td><input type="number" id="pr'.$subject->id.'" name="pr'.$subject->id.'" value="0"></td><td><input type="number" id="pm'.$subject->id.'" name="pm'.$subject->id.'" value="0"></td></tr>';
                    $return .= '<input type="hidden" name="exam_id'.$i.'" value="'.$exam.'">';
                    $return .= '<input type="hidden" name="class_id'.$i.'" value="'.$class.'">';
                    $return .= '<input type="hidden" name="subject_id'.$i.'" value="'.$subject->id.'">';
                }
                $i++;
            }
            return $return;
        }
        return false;
    }
}
