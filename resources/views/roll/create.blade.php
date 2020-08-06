@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Roll Update Form for Class {{ App\SchoolClass::whereId($class)->first()->title }}, Section {{ $section }} </div>
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

                        {!! Form::open(['url' => '/admin/roll', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('roll.form')

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
    function checkFullMarks(target, val, fm){
        if(val > fm){
            alert("Marks cannot be more than "+fm);
        }
        setTimeout(function(){target.focus().select();}, 1);
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