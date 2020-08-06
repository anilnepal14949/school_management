<div class="form-group {{ $errors->has('class') ? 'has-error' : ''}}">
    {!! Form::label('exam', 'Exam', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <select class="form-control" name="exam" id="exam" required>
        @foreach($exams as $exam)
            <option value="{!! $exam->id !!}" @if($exam->id == 4) selected @endif> {!! $exam->title !!} </option>
        @endforeach
        </select>
        {!! $errors->first('exam', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('class') ? 'has-error' : ''}}">
    {!! Form::label('class', 'Class', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <select class="form-control" name="class" id="class" required>
        @foreach($classes as $class)
            <option value="{!! $class->id !!}"> {!! $class->title !!} </option>
        @endforeach
        </select>
        {!! $errors->first('class', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<table class="table table-responsive table-striped" id="subjectsTable">
</table>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
