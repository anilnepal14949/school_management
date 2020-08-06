<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SchoolClass;
use App\Section;
use App\Student;
use App\Subject;
use App\Percentage;
use App\Examination;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $my_data;
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->my_data['activeMenu'] = "";
        $this->my_data['classes'] = SchoolClass::all();
        $this->my_data['sections'] = Section::all();
        $this->my_data['students'] = Student::all();
        $this->my_data['subjects'] = Subject::all();
        $this->my_data['examinations'] = Examination::all();

        return view('admin.dashboard',$this->my_data);
    }

    public function getGrade($total, $obtained){
		    $percent = 0;
        if($total > 0) $percent = ($obtained / $total) * 100;

        if($percent >=90 && $percent <= 100){
            $grade = "A+";
        }elseif($percent >= 80 && $percent < 90){
            $grade = "A";
        }elseif($percent >= 70 && $percent < 80){
            $grade = "B+";
        }elseif($percent >= 60 && $percent < 70){
            $grade = "B";
        }elseif($percent >= 50 && $percent < 60){
            $grade = "C+";
        }elseif($percent >= 40 && $percent < 50){
            $grade = "C";
        }elseif($percent >= 30 && $percent < 40){
            $grade = "D+";
        }elseif($percent >= 20 && $percent < 30){
            $grade = "D";
        }else{
          $grade = "E";
        }

        if($percent == 0) $grade = "-";
        
        return $grade;
    }

    public function getDivision($percent){
        if($percent >=80 && $percent <= 100){
            $division = "Distinction";
        }elseif($percent >= 60 && $percent < 80){
            $division = "First";
        }elseif($percent >= 50 && $percent < 60){
            $division = "Second";
        }elseif($percent >= 40 && $percent < 50){
            $division = "Third";
        }else{
            $division = "Failed";
        }

        return $division;
    }

    public function savePercentForRank($student, $class, $section, $exam, $percent, $pf){
        $percentage = Percentage::whereStudent($student)->whereExam($exam)->first();

        if($percentage){
            $percentage->fill([
                'student'=>$student,
                'class'=>$class,
                'section'=>$section,
                'exam'=>$exam,
                'percentage'=>$percent,
                'status'=>$pf
            ])->save();
        }else{
            Percentage::create([
                'student'=>$student,
                'class'=>$class,
                'section'=>$section,
                'exam'=>$exam,
                'percentage'=>$percent,
                'status'=>$pf
            ]);
        }
    }

    public function getPosition($class,$section,$exam,$percent){
        $percents = [];
        $rank = 0;
        $i = 0;

        $percent = round($percent,2);
        $percentages = Percentage::where('class',$class)->where('section',$section)->where('exam',$exam)->where('status',0)->orderBy('percentage','desc')->groupBy('percentage')->get();

        foreach($percentages as $per){
            $percents[$i++] = $per->percentage;
        }

        // return $percentages->count();
        // return count($percents);

        foreach($percents as $key => $value){
            if($percent == $value){
                $rank = $key + 1;
            }
        }

        // print_r($percents);
        return $rank;
        // print_r($percents);
    }

    public function addRankToPercentageTable($student,$class,$section,$exam,$rank){
        $per = Percentage::whereStudent($student)->whereClass($class)->whereSection($section)->whereExam($exam)->first();

        $per->fill([
            'rank'=>$rank
        ])->save();
    }

    public function getGradePoint($totalMarks, $obtained){
        $percent = ($obtained/$totalMarks)*100;

        if($percent >= 90 && $percent <= 100){
            $gpa = 4.0;
        }elseif($percent >= 80 && $percent < 90){
            $gpa = 3.6;
        }elseif($percent >= 70 && $percent < 80){
            $gpa = 3.2;
        }elseif($percent >= 60 && $percent < 70){
            $gpa = 2.8;
        }elseif($percent >= 50 && $percent < 60){
            $gpa = 2.4;
        }elseif($percent >= 40 && $percent < 50){
            $gpa = 2.0;
        }elseif($percent >= 30 && $percent < 40){
            $gpa = 1.6;
        }elseif($percent >= 20 && $percent < 30){
            $gpa = 1.2;
        }else{
            $gpa = 0.8;
        }

        return $gpa;
    }
public function getComment($per,$ps){
	$comment = '';
	if($per >= 90 && $ps == 0) 
		$comment = "Excellent"; 
	elseif($per >= 80 && $per < 90  && $ps == 0)
		$comment = "Very Good";
	elseif($per >= 70 && $per < 80 && $ps == 0)
		$comment = "Good";
	elseif($per>= 60 && $per < 70 && $ps == 0)
		$comment = "Satisfactory";
	elseif($per>= 40 && $per < 60 && $ps == 0)
		$comment = "Labour Hard in Weak Subjects";
	else
		$comment = "Labour Hard in Marked Subjects";
	
	if($ps == 1)
		$comment = "Labour Hard in Marked Subjects";
	
	return $comment;
}



}
