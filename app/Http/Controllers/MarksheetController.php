<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MarksEntry;
use App\Result;

class MarksheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeMenu = "marksheet";

        return view('marksheet.index',compact('activeMenu'));
    }

    public function generateMarksheet(Request $request){
        $class = $request->get('class');
        $section = $request->get('section');
        $exam = $request->get('exam');

        $results = Result::whereClass($class)->whereSection($section)->whereExam($exam)->get();

        return view('marksheet.generate-marksheet',compact('results','class','section','exam'));
    }
}
