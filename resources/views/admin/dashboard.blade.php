@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row col-md-12">
                        <a href="{{ route('admin.school-classes.create') }}">
                            <div class="well col-md-3 text-center">
                                <h2> {{ $classes->count() }} </h2>
                                <h4 style="color:#000;">  Classes Added </h4>
                                <p> Click to Add Class </p>
                            </div>
                        </a>

                        <a href="{{ route('admin.sections.create') }}">
                            <div class="well col-md-3 text-center">
                                <h2> {{ $sections->count() }} </h2>
                                <h4 style="color:#000;">  Sections Added </h4>
                                <p> Click to Add Section </p>
                            </div>
                        </a>

                        <a href="{{ route('admin.students.create') }}">
                            <div class="well col-md-3 text-center">
                                <h2> {{ $students->count() }} </h2>
                                <h4 style="color:#000;">  Students Added </h4>
                                <p> Click to Add Student </p>
                            </div>
                        </a>

                        <a href="{{ route('admin.subjects.create') }}">
                            <div class="well col-md-3 text-center">
                                <h2> {{ $subjects->count() }} </h2>
                                <h4 style="color:#000;">  Subjects Added </h4>
                                <p> Click to Add Subject </p>
                            </div>
                        </a>

                        <a href="{{ route('admin.examinations.create') }}">
                            <div class="well col-md-3 text-center">
                                <h2> {{ $examinations->count() }} </h2>
                                <h4 style="color:#000;">  Exams Added </h4>
                                <p> Click to Add Exam </p>
                            </div>
                        </a>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
