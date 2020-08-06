<div class="form-group {{ $errors->has('exam') ? 'has-error' : ''}}">
    {!! Form::label('exam', 'Exam', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        <select class="form-control" name="exam" id="exam" required>
        @foreach($exams as $exam)
            <option value="{!! $exam->id !!}" @if($markssetting->exam == $exam->id) selected @endif> {!! $exam->title !!} </option>
        @endforeach
        </select>
        {!! $errors->first('exam', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('class') ? 'has-error' : ''}}">
    {!! Form::label('class', 'Class', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        <select class="form-control" name="class" id="class" required>
        @foreach($classes as $class)
            <option value="{!! $class->id !!}" @if($markssetting->class == $class->id) selected @endif> {!! $class->title !!} </option>
        @endforeach
        </select>
        {!! $errors->first('class', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
    {!! Form::label('subject', 'Subject', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        <input type="text" class="form-control" name="subject_name" id="subject_name" value="{{ App\Subject::whereId($markssetting->subject)->first()->title }}" readonly>
        <input type="hidden" name="subject" id="subject" value="{{ $markssetting->subject }}"> 
        {!! $errors->first('subject_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('theory') ? 'has-error' : ''}}">
    {!! Form::label('theory', 'Theory', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        <input type="number" class="form-control" name="theory" id="theory" value="{{ $markssetting->theory }}">
        {!! $errors->first('theory', '<p class="help-block">:message</p>') !!}
    </div>
</div>    
<div class="form-group {{ $errors->has('pass') ? 'has-error' : ''}}">
    {!! Form::label('pass', 'Pass', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        <input type="number" class="form-control" name="pass" id="pass" value="{{ $markssetting->pass }}">
        {!! $errors->first('pass', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('practical') ? 'has-error' : ''}}">
    {!! Form::label('practical', 'Practical', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        <input type="number" class="form-control" name="practical" id="practical" value="{{ $markssetting->practical }}">
        {!! $errors->first('practical', '<p class="help-block">:message</p>') !!}
    </div>
</div>    
<div class="form-group">
    <div class="col-md-offset-2 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
