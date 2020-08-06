@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Marks Setting</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/marks-setting') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/marks-setting', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('marks-setting.form')

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
        $url = $('#homeRoute').val() + '/ajaxSubjects';
        $val = $('#exam').val();
        $cls = $('#class').val();

        $('#class').on('change',function(){
            $val = $('#exam').val();
            $cls = $(this).val();
            $.ajax({
                url: $url,
                dataType: 'html',
                data: 'input='+$val+'&class='+$cls,
                type: 'GET',
                cache: false,
                success: function(rval){
                    // alert(rval);
                    $('#subjectsTable').html(rval);
                }
            });
        });

        $.ajax({
            url: $url,
            dataType: 'html',
            data: 'input='+$val+'&class='+$cls,
            type: 'GET',
            cache: false,
            success: function(rval){
                // alert(rval);
                $('#subjectsTable').html(rval);
            }
        });
    });
</script>
@endsection
