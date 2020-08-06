@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Student {{ $student->name }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/students') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/students/' . $student->id . '/edit') }}" title="Edit Student"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {{-- {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/students', $student->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Student',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!} --}}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $student->name }}</td>
                                    </tr>
                                    <tr>
                                        <th> Class </th>
                                        <td> {!! App\SchoolClass::where('id',$student->class)->first()->title !!} </td>
                                    </tr>
                                    <tr>
                                        <th> Section </th>
                                        <td> {{ $student->section }} </td>
                                    </tr>
                                    <tr>
                                        <th> Address </th>
                                        <td> {{ $student->address }} </td>
                                    </tr>
                                    <tr>
                                        <th> House </th>
                                        <td> {{ $student->house }} </td>
                                    </tr>
                                    <tr>
                                        <th> Gender </th>
                                        <td> {{ $student->gender }} </td>
                                    </tr>
                                    <tr>
                                        <th> Date of Birth </th>
                                        <td> {{ $student->date_of_birth }} </td>
                                    </tr>
                                    <tr>
                                        <th> Parent's Name </th>
                                        <td> {{ $student->parentName }} </td>
                                    </tr>
                                    <tr>
                                        <th> Parent's Contact </th>
                                        <td> {{ $student->parentContact }} </td>
                                    </tr>
                                    <tr>
                                        <th> Bus Student </th>
                                        <td> {{ $student->busStudent }} </td>
                                    </tr>
                                    <tr>
                                        <th> Physical Disability </th>
                                        <td> {{ $student->disability }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
