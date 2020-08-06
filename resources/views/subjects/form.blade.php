<?php $i = 1; ?>
@for($i == 1; $i <= 20; $i++)
    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
        {!! Form::label('title', 'Subject '. $i .' Title', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-3">
            {!! Form::text('title'.$i, null, ['class' => 'form-control','placeholder'=>'Enter Title..']) !!}
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="col-md-3">
            {!! Form::number('order'.$i, $i, ['class' => 'form-control','placeholder'=>'Enter Order..','readonly']) !!}
            {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endfor
<input type="hidden" name="class" value="{{$class}}">
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Save', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
