<?php 
	$i = 1;
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Attendence Entry for Class {{ App\SchoolClass::whereId($class)->first()->title }}, Section {{ $section }} </div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/attendence/create') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Add Attendence </button></a>
                        <br />
                        <br />
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/attendence/updateAttendence', 'class' => 'form-horizontal', 'files' => true]) !!}
							<div class="form-group">
								<table class="table table-striped table-responsive">
								<tr> <th> S.No. </th><th> Student's Name </th><th> Attendence </th><th> Grade in Conduct </th> </tr>
								@foreach($attendences as $attendence)
									<?php 
										$student = App\Student::whereId($attendence->student)->first(); 
									?>
									<tr>
										<td> {{ $i }} </td>
										<th> {{ $student->name }} </th>
										<td> <input type="text" name="attendence{{$i}}" id="attendence{{$i}}" value="{{ $attendence->attendence }}"> </td>
										<td> <input type="text" name="grade_in_conduct{{$i}}" id="grade_in_conduct{{$i}}" value="{{ $attendence->grade_in_conduct }}"> </td>
										<input type="hidden" name="student{{$i}}" value="{{$student->id}}">
										<?php $i++; ?>
									</tr>	
								@endforeach
								<input type="hidden" name="class" id="class" value="{{ $class }}">
								<input type="hidden" name="section" id="section" value="{{ $section }}">
								<input type="hidden" name="exam" id="exam" value="{{ $exam }}">
								</table>
							    <div class="col-md-offset-4 col-md-4">
							        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save Attendences', ['class' => 'btn btn-primary']) !!}
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
