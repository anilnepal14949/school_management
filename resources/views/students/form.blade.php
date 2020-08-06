<div class="form-group {{ $errors->has('class') ? 'has-error' : ''}}">
    {!! Form::label('class', 'Class', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <select class="form-control" name="class" id="class" required>
        @foreach($classes as $clas)
            <option value="{!! $clas->id !!}"> {!! $clas->title !!} </option>
        @endforeach
        </select>
        {!! $errors->first('class', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('section') ? 'has-error' : ''}}">
    {!! Form::label('section', 'Section', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <select class="form-control" name="section" id="section" required>
        <option value="0"> Select Section </option>
        @foreach($sections as $section)
            <option value="{{ $section->title }}"> {!! $section->title !!} </option>
        @endforeach
        </select>
        {!! $errors->first('section', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('roll') ? 'has-error' : ''}}">
    {!! Form::label('roll', 'Roll No', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <select class="form-control" name="roll" id="roll" required>
        <option value="0"> Select Roll </option>
        @for($i=1;$i<=70;$i++)
            <option value="{{ $i }}"> {!! $i !!} </option>
        @endfor
        </select>
        {!! $errors->first('roll', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', 'Address', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('house') ? 'has-error' : ''}}">
    {!! Form::label('house', 'House', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <select class="form-control" name="house" id="house" required>
            <option value="0"> Select House </option>
            <option value="Red"> Red </option>
            <option value="Blue"> Blue </option>
            <option value="Green"> Green </option>
            <option value="Yellow"> Yellow </option>
        </select>
        {!! $errors->first('house', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
    {!! Form::label('gender', 'Gender', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('gender', ['Male'=>'Male', 'Female'=>'Female'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('date_of_birth') ? 'has-error' : ''}}">
    {!! Form::label('date_of_birth', 'Date of Birth', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('date_of_birth', null, ['class' => 'form-control']) !!}
        {!! $errors->first('date_of_birth', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('parentName') ? 'has-error' : ''}}">
    {!! Form::label('parentName', 'Parent\'s Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('parentName', null, ['class' => 'form-control']) !!}
        {!! $errors->first('parentName', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('parentContact') ? 'has-error' : ''}}">
    {!! Form::label('parentContact', 'Parent\'s Contact', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('parentContact', null, ['class' => 'form-control']) !!}
        {!! $errors->first('parentContact', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('busStudent') ? 'has-error' : ''}}">
    {!! Form::label('busStudent', 'Bus Student?', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('busStudent', ['Yes'=>'Yes', 'No'=>'No'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('busStudent', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('disability') ? 'has-error' : ''}}">
    {!! Form::label('disability', 'Disability (If Any)', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('disability', null, ['class' => 'form-control']) !!}
        {!! $errors->first('disability', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
