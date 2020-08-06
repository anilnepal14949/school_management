@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Settings for Roll Number Update</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/roll/create') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Edit Roll </button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['method'=>'get','url' => '/admin/roll/newCreate', 'class' => 'form-horizontal', 'files' => true]) !!}

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
                            <div class="form-group {{ $errors->has('section') ? 'has-error' : ''}}">    
                                {!! Form::label('section', 'Choose Section', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-4">
                                    <?php $sections = App\Section::all(); ?>
                                    <select name="section" id="section" class="form-control"> 
                                    @foreach($sections as $section)  
                                        <option value="{{ $section->title }}"> {{ $section->title }}  </option>
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

@section('footerContent')
{{-- <script type="text/javascript">
    $(document).ready(function(){
        $url = $('#homeRoute').val() + '/ajaxClassSubjects';
        $val = $('#class').val();
        $('#class').on('change',function(){
            $val = $(this).val();
            $.ajax({
                url: $url,
                dataType: 'html',
                data: 'input='+$val,
                type: 'GET',
                cache: false,
                success: function(rval){
                    // alert(rval);
                    $('#subject').html(rval);
                }
            });
        });

        $.ajax({
            url: $url,
            dataType: 'html',
            data: 'input='+$val,
            type: 'GET',
            cache: false,
            success: function(rval){
                // alert(rval);
                $('#subject').html(rval);
            }
        });
    });
</script> --}}
@endsection
