<?php
	$students = App\Student::whereClass($class)->whereSection($section)->orderBy('roll','asc')->get();
	$i = 1;
	$markssetting = App\MarksSetting::whereExam($exam)->whereSubject($subject)->first();
	$sub = App\Subject::whereId($subject)->first();
?>
<div class="form-group">
	<table class="table table-striped table-responsive">
	<tr> <th> S.No. </th><th> Student's Name </th><th> Obtained Marks (Theory - {{ $markssetting->theory }}) </th><th> Obtained Marks (Practical - {{ $markssetting->practical }}) </th> </tr>
	@foreach($students as $student)
		<tr>
			<td> {{ $i }} </td>
			<th> {{ $student->name }} </th>
			<td> <input type="text" name="obtained_theory{{$i}}" id="obtained_theory{{$i}}" value="0" onchange="checkFullMarks(this,this.value,{{$markssetting->theory}})"> </td>
			<td> <input type="text" name="obtained_practical{{$i}}" id="obtained_practical{{$i}}" value="0" @if($markssetting->practical == 0) readonly @endif onchange="checkFullMarks(this,this.value,{{$markssetting->practical}})"> </td>
			<input type="hidden" name="student{{$i}}" value="{{$student->id}}">
			<?php $i++; ?>
		</tr>
	@endforeach
	<input type="hidden" name="class" id="class" value="{{ $class }}">
	<input type="hidden" name="subject" id="subject" value="{{ $subject }}">
	<input type="hidden" name="subject_order" id="subject_order" value="{{ $sub->order }}">
	<input type="hidden" name="section" id="section" value="{{ $section }}">
	<input type="hidden" name="exam" id="exam" value="{{ $exam }}">
	</table>
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save Marks', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
