<div class="col-md-3">
    <div class="panel panel-default panel-flush">

        <div class="panel-body">
            <ul class="nav" role="tablist">
                <li role="presentation" @if($activeMenu == '') class="active" @endif>
                    <a href="{{ url('/') }}">
                        Dashboard
                    </a>
                </li>
                <li role="presentation" @if($activeMenu == 'classes') class="active" @endif>
                    <a href="{{ url('admin/school-classes') }}">
                        Classes
                    </a>
                </li>
                {{-- <li role="presentation" @if($activeMenu == 'subject-setting') class="active" @endif>
                    <a href="{{ url('admin/subject-setting') }}">
                        Subject Setting
                    </a>
                </li>
 --}}                <li role="presentation" @if($activeMenu == 'sections') class="active" @endif>
                    <a href="{{ url('admin/sections') }}">
                        Sections
                    </a>
                </li>
                <li role="presentation" @if($activeMenu == 'students') class="active" @endif>
                    <a href="{{ url('admin/students') }}">
                        Students
                    </a>
                </li>
                <li role="presentation" @if($activeMenu == 'roll') class="active" @endif>
                    <a href="{{ url('admin/roll/create') }}">
                        Update Roll Number
                    </a>
                </li>                <li role="presentation" @if($activeMenu == 'subjects') class="active" @endif>
                    <a href="{{ url('admin/subjects') }}">
                        Subjects
                    </a>
                </li>
                <li role="presentation" @if($activeMenu == 'exams') class="active" @endif>
                    <a href="{{ url('admin/examinations') }}">
                        Examinations
                    </a>
                </li>
                <li role="presentation" @if($activeMenu == 'marks-setting') class="active" @endif>
                    <a href="{{ url('admin/marks-setting') }}">
                        Full Marks Setting
                    </a>
                </li>
                <li role="presentation" @if($activeMenu == 'marks-entry') class="active" @endif>
                    <a href="{{ url('admin/marks-entry/create') }}">
                        Marks Entry
                    </a>
                </li>
                <li role="presentation" @if($activeMenu == 'attendence') class="active" @endif>
                    <a href="{{ url('admin/attendence/create') }}">
                        Set Attendences
                    </a>
                </li>
                <li role="presentation" @if($activeMenu == 'ledger') class="active" @endif>
                    <a href="{{ url('admin/ledger/setClass') }}">
                        Generate Ledger
                    </a>
                </li>
                <li role="presentation" @if($activeMenu == 'marksheet') class="active" @endif>
                    <a href="{{ url('admin/marksheet/setClass') }}">
                        Print Marksheet
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
