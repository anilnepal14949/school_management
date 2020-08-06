@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <?php $classes = App\SchoolClass::orderBy('id','asc')->get(); ?>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Subjects by Class</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/subjects/create') }}" class="btn btn-success btn-sm" title="Add New Subject">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        @foreach($classes as $class)
                            <?php $subjectss = App\Subject::whereClass($class->id)->get(); ?>
                            @if($subjectss->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-borderless datatable">
                                        <h4> Subjects of Class {{$class->title}} </h4>
                                        <thead>
                                            <tr>
                                                <th>S.No.</th><th>Title</th><th>Order</th><th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                            @foreach($subjectss as $item)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $item->title }}</td><td>{{ $item->order }}</td>
                                                    <td>
                                                        <a href="{{ url('/admin/subjects/' . $item->id) }}" title="View Subject"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                        <a href="{{ url('/admin/subjects/' . $item->id . '/edit') }}" title="Edit Subject"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                        {!! Form::open([
                                                            'method'=>'DELETE',
                                                            'url' => ['/admin/subjects', $item->id],
                                                            'style' => 'display:inline'
                                                        ]) !!}
                                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                                    'type' => 'submit',
                                                                    'class' => 'btn btn-danger btn-xs',
                                                                    'title' => 'Delete Subject',
                                                                    'onclick'=>'return confirm("Confirm delete?")'
                                                            )) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
