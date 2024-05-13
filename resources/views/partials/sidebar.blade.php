<div class="sidebar sidebar-show shadow-sm" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="#" class="nav_logo">
                <img class="kdis-logo" src="{{asset('storage/'.auth()->user()->account->logo ?? null)}}" alt="account-logo">
                <div>
                    <p class="text-kdis mb-0" style="font-size: 12px; font-weight: 700;">BENUE STATE</p>
                    <p class="text-kdis-2">POLYTECHNIC</p>
                </div>
            </a>
            <div class="nav_list">
                <a href="{{route('dashboard')}}" class="nav_link {{$activePage == 'Dashboard' ? 'active' : '' }}">
                    <i class='bx bx-grid-alt nav_icon'></i>
                    <span class="nav_name">Dashboard</span>
                </a>
                @can('view set-up account')
                    <div class="has-dropdown">
                        @php
                            $accountLinks = [
                                "Basic Info",
                                "Academic Session",
                                "Faculties",
                                "Departments",
                                "Levels",
                                "Courses",
                                "Exam Officers",
                                "Grade Settings"
                            ];
                        @endphp
                        <a href="javascript:void(0);" class="nav_link {{in_array($activePage, $accountLinks) ? 'active' : '' }}">
                            <i class='bx bx-buildings nav_icon'></i>
                            <span class="nav_name">Account Setup</span>
                        </a>
                        <div class="dropdown {{in_array($activePage, $accountLinks) ? 'open' : '' }}">
                            <a href="{{route('account.index')}}" class="dropdown-link {{$activePage == 'Basic Info' ? 'active' : '' }}">Basic Info</a>
                            <a href="{{route('sessions.index')}}" class="dropdown-link {{$activePage == 'Academic Session' ? 'active' : '' }}">Academic Session</a>
                            <a href="{{route('faculty.index')}}" class="dropdown-link {{$activePage == 'Faculties' ? 'active' : '' }}">Faculties</a>
                            <a href="{{route('departments.index')}}" class="dropdown-link {{$activePage == 'Departments' ? 'active' : '' }}">Departments</a>
                            <a href="{{route('levels.index')}}" class="dropdown-link {{$activePage == 'Levels' ? 'active' : '' }}">Levels</a>
                            <a href="{{route('courses.index')}}" class="dropdown-link {{$activePage == 'Courses' ? 'active' : '' }}">Courses</a>
                            <a href="{{route('exam-officers.index')}}" class="dropdown-link {{$activePage == 'Exam Officers' ? 'active' : '' }}">Exam Officers</a>
                            <a href="{{route('grades.index')}}" class="dropdown-link {{$activePage == 'Grade Settings' ? 'active' : '' }}">Grade Settings</a>
                        </div>
                    </div>
                @endcan
                <div class="has-dropdown">
                    @php
                        $studentLinks = [
                            "Enroll Students",
                            "All Students",
                        ];
                    @endphp
                    <a href="javascript:void(0);" class="nav_link {{in_array($activePage, $studentLinks) ? 'active' : '' }}">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Students</span>
                    </a>
                    <div class="dropdown {{in_array($activePage, $studentLinks) ? 'open' : '' }}">
                        <a href="{{route('students.index')}}" class="dropdown-link {{$activePage == 'Enroll Students' ? 'active' : '' }}">Enroll Students</a>
                        <a href="{{route('students.view')}}" class="dropdown-link {{$activePage == 'All Students' ? 'active' : '' }}">All Students</a>
                    </div>
                </div>
                <div class="has-dropdown">
                    @php
                        $resultLinks = [
                            "Upload Results",
                            "All Results",
                        ];
                    @endphp
                    <a href="javascript:void(0);" class="nav_link {{in_array($activePage, $resultLinks) ? 'active' : '' }}">
                        <i class='bx bxl-stack-overflow nav_icon'></i>
                        <span class="nav_name">Results</span>
                    </a>
                    <div class="dropdown {{in_array($activePage, $resultLinks) ? 'open' : '' }}">
                        <a href="{{route('results.upload')}}" class="dropdown-link {{$activePage == 'Upload Results' ? 'active' : '' }}">Upload Resuslts</a>
                        <a href="{{route('results.index')}}" class="dropdown-link {{$activePage == 'All Results' ? 'active' : '' }}">All Results</a>
                    </div>
                </div>
                <div class="has-dropdown">
                    @php
                        $statLinks = [
                            "Results Stats",
                            "Course Performances",
                        ];
                    @endphp
                    <a href="javascript:void(0);" class="nav_link {{in_array($activePage, $statLinks) ? 'active' : '' }}">
                        <i class='bx bx-bar-chart nav_icon'></i>
                        <span class="nav_name">Statistics</span>
                    </a>
                    <div class="dropdown {{in_array($activePage, $statLinks) ? 'open' : '' }}">
                        <a href="{{route('results.courses.stats')}}" class="dropdown-link {{$activePage == 'Results Stats' ? 'active' : '' }}">Results</a>
                        <a href="#" class="dropdown-link {{$activePage == 'Course Performances' ? 'active' : '' }}">Course Performances</a>
                    </div>
                </div>
                <a href="#" class="nav_link">
                    <i class='bx bx-support nav_icon' ></i>
                    <span class="nav_name">Support</span>
                </a>
                <div class="has-dropdown">
                    @php
                        $settingLinks = [
                            "Roles",
                            "Permissions",
                            "Assign Role",
                            "Assign Permission",
                        ];
                    @endphp
                    <a href="javascript:void(0);" class="nav_link {{in_array($activePage, $settingLinks) ? 'active' : '' }}">
                        <i class='bx bx-cog nav_icon' ></i>
                        <span class="nav_name">Settings</span>
                    </a>
                    <div class="dropdown {{in_array($activePage, $settingLinks) ? 'open' : '' }}">
                        <a href="{{route('roles.index')}}" class="dropdown-link {{$activePage == 'Roles' ? 'active' : '' }}">Roles</a>
                        <a href="{{route('permissions.index')}}" class="dropdown-link {{$activePage == 'Permissions' ? 'active' : '' }}">Permissions</a>
                        <a href="{{route('role-assignment.index')}}" class="dropdown-link {{$activePage == 'Assign Role' ? 'active' : '' }}">Assign Role</a>
                        <a href="{{route('permission-assignment.index')}}" class="dropdown-link {{$activePage == 'Assign Permission' ? 'active' : '' }}">Assign Permission</a>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="nav_link mb-5"
            onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            <i class='bx bx-log-out nav_icon'></i>
            <span class="nav_name">SignOut</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>
</div>

@push('js')
    <script>
        $(document).ready(function(){
            $('.has-dropdown').click(function(){
                $(this).children('.nav_link').toggleClass('show');
                $(this).find('.dropdown').toggleClass('open');
            });
        });
    </script>
@endpush
