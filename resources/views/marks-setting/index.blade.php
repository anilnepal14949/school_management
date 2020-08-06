@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Full Marks Setting</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/marks-setting/create') }}" class="btn btn-success btn-sm" title="Add New MarksSetting">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <?php $exams = App\Examination::all(); $classes = App\SchoolClass::orderBy('id','asc')->get(); ?>
                        @foreach($exams as $exam)
                            <?php 
                                $subjects = '';
                                $markssettings = '';
                                $markssetting = '';
                            ?>
                            @foreach($classes as $class)
                                <?php 
                                    $subjects = App\Subject::whereClass($class->id)->orderBy('id','asc')->get();
                                    $markssettings = App\MarksSetting::where('exam',$exam->id)->where('class',$class->id)->get(); 
                                    $markssetting = App\MarksSetting::where('exam',$exam->id)->where('class',$class->id)->paginate(25); 
                                    $i = 1;
                                    ?>

                                @if(($markssettings->count() > 0) && ($subjects->count() > 0))
                                    <h3> Full Marks Setting for {{ $exam->title }}, Class {{ $class->title }} </h3>
                                    <div class="table-responsive">
                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th><th>Subject</th><th>Theory</th><th>Pass</th><th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($markssetting as $item)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ App\Subject::where('id',$item->subject)->first()->title }}</td><td>{{ $item->theory }}</td><td>{{ $item->pass }}</td>
                                                    <td>
                                                        <a href="{{ url('/admin/marks-setting/' . $item->id) }}" title="View MarksSetting"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                        <a href="{{ url('/admin/marks-setting/' . $item->id . '/edit') }}" title="Edit MarksSetting"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                        {{-- {!! Form::open([
                                                            'method'=>'DELETE',
                                                            'url' => ['/admin/marks-setting', $item->id],
                                                            'style' => 'display:inline'
                                                        ]) !!}
                                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                                    'type' => 'submit',
                                                                    'class' => 'btn btn-danger btn-xs',
                                                                    'title' => 'Delete MarksSetting',
                                                                    'onclick'=>'return confirm("Confirm delete?")'
                                                            )) !!}
                                                        {!! Form::close() !!} --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="pagination-wrapper"> {!! $markssetting->appends(['search' => Request::get('search')])->render() !!} </div>
                                    </div>
                                @endif
                            @endforeach       
                        @endforeach    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
