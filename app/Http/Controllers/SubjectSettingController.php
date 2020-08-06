<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SubjectSetting;
use Illuminate\Http\Request;
use Session;

use App\SchoolClass;

use Alert;

class SubjectSettingController extends Controller
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

        if (!empty($keyword)) {
            $subjectsetting = SubjectSetting::where('class', 'LIKE', "%$keyword%")
				->orWhere('no_of_subjects', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $subjectsetting = SubjectSetting::paginate($perPage);
        }

        $activeMenu = 'subject-setting';

        return view('subject-setting.index', compact('subjectsetting','activeMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $activeMenu = 'subject-setting';

        $classes = SchoolClass::all();

        return view('subject-setting.create',compact('activeMenu','classes'));
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
        
        $requestData = $request->all();
        
        SubjectSetting::create($requestData);

        Alert::success("You have successfully created subject setting","Successful")->persistent("Ok");

        return redirect('admin/subject-setting');
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
        $activeMenu = 'subject-setting';

        $subjectsetting = SubjectSetting::findOrFail($id);

        return view('subject-setting.show', compact('subjectsetting','activeMenu'));
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
        $activeMenu = 'subject-setting';

        $classes = SchoolClass::all();

        $subjectsetting = SubjectSetting::findOrFail($id);

        return view('subject-setting.edit', compact('subjectsetting','activeMenu','classes'));
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
        
        $subjectsetting = SubjectSetting::findOrFail($id);
        $subjectsetting->update($requestData);

        Alert::success("You have successfully updated subject setting","Successful")->persistent("Ok");

        return redirect('admin/subject-setting');
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
        SubjectSetting::destroy($id);

        Alert::success("You have successfully deleted subject setting","Successful")->persistent("Ok");

        return redirect('admin/subject-setting');
    }
}
