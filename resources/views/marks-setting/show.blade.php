@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Full Marks Setting For Class {{ App\SchoolClass::whereId($markssetting->class)->first()->title }} &amp; Subject {{ App\Subject::whereId($markssetting->subject)->first()->title }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/marks-setting') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/marks-setting/' . $markssetting->id . '/edit') }}" title="Edit MarksSetting"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/markssetting', $markssetting->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete MarksSetting',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr><th> Class </th><td> {{ App\SchoolClass::whereId($markssetting->class)->first()->title }} </td></tr><tr><th> Subject </th><td> {{ App\Subject::whereId($markssetting->subject)->first()->title }} </td></tr><tr><th> Theory </th><td> {{ $markssetting->theory }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
