<?php $orderMax = App\Subject::where('class',$subject->class)->max('order')+1; ?>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Subject Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-3">
        {!! Form::text('title', $subject->title , ['class' => 'form-control','placeholder'=>'Enter Title..','autofocus'=>'true']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('order', 'Subject Order', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-3">
        {!! Form::number('order', ($subject->order > 0)?$subject->order:$orderMax , ['class' => 'form-control','placeholder'=>'Enter Order..']) !!}
        {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
