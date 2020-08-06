<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SchoolClass;
use Illuminate\Http\Request;
use Session;

use Alert;

class SchoolClassesController extends Controller
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
            $schoolclasses = SchoolClass::where('title', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $schoolclasses = SchoolClass::paginate($perPage);
        }

        $activeMenu = "classes";

        return view('school-classes.index', compact('schoolclasses','activeMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $activeMenu = "classes";

        return view('school-classes.create',compact('activeMenu'));
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
        
        SchoolClass::create($requestData);

        Session::flash('flash_message', 'SchoolClass added!');

        Alert::success("You have successfully added class ".$request->get('title'),"Successful")->persistent("Ok");

        return redirect('admin/school-classes/create');
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
        $schoolclass = SchoolClass::findOrFail($id);

        $activeMenu = "classes";

        return view('school-classes.show', compact('schoolclass','activeMenu'));
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
        $schoolclass = SchoolClass::findOrFail($id);
        
        $activeMenu = "classes";

        return view('school-classes.edit', compact('schoolclass','activeMenu'));
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
        
        $schoolclass = SchoolClass::findOrFail($id);
        $schoolclass->update($requestData);

        Session::flash('flash_message', 'SchoolClass updated!');


        Alert::success("You have successfully updated class ".$schoolclass->title,"Successful")->persistent("Ok");


        return redirect('admin/school-classes');
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
        SchoolClass::destroy($id);

        Session::flash('flash_message', 'SchoolClass deleted!');


        Alert::success("You have successfully deleted class","Successful")->persistent("Ok");


        return redirect('admin/school-classes');
    }
}
