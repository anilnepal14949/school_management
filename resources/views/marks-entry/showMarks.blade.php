<?php
	$students = App\Student::whereClass($class)->whereSection($section)->get();
	$i = 1;
	$markssetting = App\MarksSetting::whereExam($exam)->whereSubject($subject)->first();
    $sub = App\Subject::whereId($subject)->first();
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Marks Entry for Class {{ App\SchoolClass::whereId($class)->first()->title }}, Section {{ $section }} &amp; Subject {{ App\Subject::whereId($subject)->first()->title }} <strong> (Input -1 if student is absent, z for 0 score) </strong></div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/marks-entry/create') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Add Marks </button></a>
                        <br />
                        <br />
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/marks-entry/updateMarks', 'class' => 'form-horizontal', 'files' => true]) !!}
							<div class="form-group">
								<table class="table table-striped table-responsive">
								<tr> <th> S.No. </th><th> Student's Name </th><th> Obtained Marks (Theory - {{ $markssetting->theory }}) </th><th> Obtained Marks (Practical - {{ $markssetting->practical }}) </th> </tr>
								@foreach($marks as $mark)
									<?php
										$student = App\Student::whereId($mark->student)->first();
										$fieldth = "sub".$sub->order."th";
										$fieldpr = "sub".$sub->order."pr";
									?>
									<tr>
										<td> {{ $i }} </td>
										<th> {{ $student->name }} </th>
										<td> <input type="text" name="obtained_theory{{$i}}" id="obtained_theory{{$i}}" value="{{ $mark->$fieldth }}" onchange="checkFullMarks(this.value,{{$markssetting->theory}})"> </td>
										<td> <input type="text" name="obtained_practical{{$i}}" id="obtained_practical{{$i}}" value="{{ $mark->$fieldpr }}" @if($markssetting->practical == 0) readonly @endif onchange="checkFullMarks(this.value,{{$markssetting->practical}})"> </td>
										<input type="hidden" name="student{{$i}}" value="{{$student->id}}">
										<?php $i++; ?>
									</tr>
								@endforeach
								<input type="hidden" name="class" id="class" value="{{ $class }}">
								<input type="hidden" name="subject" id="subject" value="{{ $subject }}">
								<input type="hidden" name="section" id="section" value="{{ $section }}">
								<input type="hidden" name="exam" id="exam" value="{{ $exam }}">
								<input type="hidden" name="subject_order" id="subject_order" value="{{ $sub->order }}">
								</table>
							    <div class="col-md-offset-4 col-md-4">
							        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save Marks', ['class' => 'btn btn-primary']) !!}
							    </div>
							</div>
						{!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footerContent')
<script type="text/javascript">
    $(document).ready(function(){
        $('input:visible:enabled:first').focus().select();
    });
    function checkFullMarks(val, fm){
        if(val > fm){
            alert("Marks cannot be more than "+fm);
        }
        return false;
    }

    window.addEventListener('keydown', function(e) {
        if (e.keyIdentifier == 'U+000A' || e.keyIdentifier == 'Enter' || e.keyCode == 13) {
            if (e.target.nodeName === 'INPUT' && e.target.type !== 'textarea') {
                e.preventDefault();
                return false;
            }
        }
    }, true);
</script>
@endsection
