<?php 
	$students = App\Student::whereClass($class)->whereSection($section)->get(); 
	$i = 1;
?>
<div class="form-group">
	<table class="table table-striped table-responsive">
	<tr> <th> S.No. </th><th> Student's Name </th><th> Roll Number </th>
	@foreach($students as $student)
		<tr>
			<td> {{ $i }} </td>
			<th> {{ $student->name }} </th>
			<td> <input type="text" name="roll{{$i}}" id="roll{{$i}}" value="{{ $i }}"> </td>
			<input type="hidden" name="student{{$i}}" value="{{$student->id}}">
			<?php $i++; ?>
		</tr>	
	@endforeach
	<input type="hidden" name="class" id="class" value="{{ $class }}">
	<input type="hidden" name="section" id="section" value="{{ $section }}">
	</table>
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save Roll', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
