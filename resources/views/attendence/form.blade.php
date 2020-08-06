<?php 
	$students = App\Student::whereClass($class)->whereSection($section)->orderBy('roll','asc')->get(); 
	$i = 1;
?>
<div class="form-group">
	<table class="table table-striped table-responsive">
	<tr> <th> S.No. </th><th> Student's Name </th><th> Attendence </th><th> Grade in Conduct </th> </tr>
	@foreach($students as $student)
		<tr>
			<td> {{ $i }} </td>
			<th> {{ $student->name }} </th>
			<td> <input type="text" name="attendence{{$i}}" id="attendence{{$i}}" value="0" onchange=""> </td>
			<td> <input type="text" name="grade_in_conduct{{$i}}" id="grade_in_conduct{{$i}}" value="B"> </td>
			<input type="hidden" name="student{{$i}}" value="{{$student->id}}">
			<?php $i++; ?>
		</tr>	
	@endforeach
	<input type="hidden" name="class" id="class" value="{{ $class }}">
	<input type="hidden" name="section" id="section" value="{{ $section }}">
	<input type="hidden" name="exam" id="exam" value="{{ $exam }}">
	</table>
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save Marks', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
