<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Examination;
use Illuminate\Http\Request;
use Session;

class ExaminationsController extends Controller
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

        $activeMenu = "exams";

        if (!empty($keyword)) {
            $examinations = Examination::where('title', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $examinations = Examination::paginate($perPage);
        }

        return view('examinations.index', compact('examinations','activeMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $activeMenu = "exams";

        return view('examinations.create',compact('activeMenu'));
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
        
        Examination::create($requestData);

        Session::flash('flash_message', 'Examination added!');

        return redirect('admin/examinations');
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
        $examination = Examination::findOrFail($id);

        $activeMenu = "exams";

        return view('examinations.show', compact('examination','activeMenu'));
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
        $examination = Examination::findOrFail($id);

        $activeMenu = "exams";

        return view('examinations.edit', compact('examination','activeMenu'));
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
        
        $examination = Examination::findOrFail($id);
        $examination->update($requestData);

        Session::flash('flash_message', 'Examination updated!');

        return redirect('admin/examinations');
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
        Examination::destroy($id);

        Session::flash('flash_message', 'Examination deleted!');

        return redirect('admin/examinations');
    }
}
