<div class="form-group {{ $errors->has('class') ? 'has-error' : ''}}">
    {!! Form::label('class', 'Class', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <select class="form-control" name="class" id="class">
            @foreach($classes as $class)
                <option value="{{ $class->id }}"> {{ $class->title }} </option>
            @endforeach
        </select> 
        {!! $errors->first('class', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('no_of_subjects') ? 'has-error' : ''}}">
    {!! Form::label('no_of_subjects', 'No Of Subjects', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('no_of_subjects', null, ['class' => 'form-control']) !!}
        {!! $errors->first('no_of_subjects', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
