<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MarksEntry;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeMenu = "ledger";

        return view('ledger.index',compact('activeMenu'));
    }

    public function generateLedger(Request $request){
        $class = $request->get('class');
        $section = $request->get('section');
        $exam = $request->get('exam');

        $marksentries = MarksEntry::whereClass($class)->whereSection($section)->get();

        return view('ledger.generate-ledger',compact('marksentries','class','section','exam'));
    }
}
