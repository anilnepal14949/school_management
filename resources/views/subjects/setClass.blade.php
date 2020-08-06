@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Settings for Subject Entry</div>
                    <div class="panel-body">
                      
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['method'=>'get','url' => '/admin/subjects/newCreate', 'class' => 'form-horizontal', 'files' => true]) !!}
                            <div class="form-group {{ $errors->has('class') ? 'has-error' : ''}}">
                            {!! Form::label('class', 'Choose Class', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-4">
                                    <?php $classes = App\SchoolClass::all(); ?>
                                    <select name="class" id="class" class="form-control">
                                    @foreach($classes as $cls)
                                        <option value="{{ $cls->id }}"> {{ $cls->title }}  </option>
                                    @endforeach
                                    </select>
                                    {!! $errors->first('class', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-2">
                                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Enter', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
