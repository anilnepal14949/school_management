<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Section;
use Illuminate\Http\Request;
use Session;

class SectionsController extends Controller
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
            $sections = Section::where('title', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $sections = Section::paginate($perPage);
        }
        $activeMenu = "sections";

        return view('sections.index', compact('sections','activeMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $activeMenu = "sections";

        return view('sections.create', compact('activeMenu'));
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
        
        Section::create($requestData);

        Session::flash('flash_message', 'Section added!');

        return redirect('admin/sections');
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
        $section = Section::findOrFail($id);

        $activeMenu = "sections";

        return view('sections.show', compact('section','activeMenu'));
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
        $activeMenu = "sections";

        $section = Section::findOrFail($id);

        return view('sections.edit', compact('section','activeMenu'));
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
        
        $section = Section::findOrFail($id);
        $section->update($requestData);

        Session::flash('flash_message', 'Section updated!');

        return redirect('admin/sections');
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
        Section::destroy($id);

        Session::flash('flash_message', 'Section deleted!');

        return redirect('admin/sections');
    }
}
