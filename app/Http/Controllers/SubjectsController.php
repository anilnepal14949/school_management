<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Subject;
use App\SchoolClass;
use Illuminate\Http\Request;
use Session;

use Alert;

class SubjectsController extends Controller
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

        $activeMenu = "subjects";

        if (!empty($keyword)) {
            $subjects = Subject::where('class', 'LIKE', "%$keyword%")
				->orWhere('title', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $subjects = Subject::paginate($perPage);
        }

        return view('subjects.index', compact('subjects','activeMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $activeMenu = "subjects";

        $classes = SchoolClass::all();

        return view('subjects.setClass',compact('activeMenu','classes'));
    }

    public function newCreate(Request $request)
    {
        $class = $request->get('class');

        $className = SchoolClass::whereId($class)->first()->title;

        $activeMenu = "subjects";

        return view('subjects.create',compact('activeMenu','class','className'));
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
        $i = 1;
        for($i = 1; $i <= 20; $i++){
            if($request->get('title'.$i) != null){
                Subject::create([
                    'class'=>$request->get('class'),
                    'title'=>$request->get('title'.$i),
                    'order'=>$request->get('order'.$i),
                ]);
            }
        }

        Alert::success("You have successfully added subjects","Successful")->persistent("Ok");

        return redirect('admin/subjects');
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
        $activeMenu = "subjects";

        $subject = Subject::findOrFail($id);

        return view('subjects.show', compact('subject','activeMenu'));
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
        $activeMenu = "subjects";

        $subject = Subject::findOrFail($id);

        return view('subjects.edit', compact('subject','activeMenu'));
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
        
        $requestData = $request->all();
        
        $subject = Subject::findOrFail($id);
        $subject->update($requestData);

        Alert::success("You have successfully updated subject ".$request->get('title'),"Successful")->persistent("Ok");

        return redirect('admin/subjects');
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
        Subject::destroy($id);

        Alert::success("You have successfully deleted subject","Successful")->persistent("Ok");

        return redirect('admin/subjects');
    }
}
