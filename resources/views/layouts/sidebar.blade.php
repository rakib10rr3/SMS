<div class="left-side-bar">
    <div class="brand-logo">
        <a href="/">
            <img src="/vendors/images/logo-full-color.png" alt="Logo">
        </a>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">

                @can('staff-crud')

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-clone"></span><span class="mtext">Staffs</span>
                        </a>
                        <ul class="submenu">

                            <li><a href="{{route('staff.create')}}">Create Staff</a></li>
                            <li><a href="{{route('staff.index')}}">All Staffs</a></li>

                        </ul>
                    </li>

                @endcan

                @can('teacher-crud')

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-clone"></span><span class="mtext">Teachers</span>
                        </a>
                        <ul class="submenu">

                            <li><a href="{{route('teachers.create')}}">Create Teacher</a></li>
                            <li><a href="{{route('teachers.index')}}">View Teacher</a></li>

                        </ul>
                    </li>

                @endcan

                @can('student-crud')

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-clone"></span><span class="mtext">Students</span>
                        </a>
                        <ul class="submenu">

                            <li><a href="{{route('students.create')}}">Create Student</a></li>
                            <li><a href="{{route('students.index')}}">View Students</a></li>

                        </ul>
                    </li>


                    {{-- ===================================================== --}}

                    <li class="ts-sidebar-divider"></li>


                @endcan

                @can('notice-crud')

                    {{-- ===================================================== --}}

                    <li class="dropdown">
                        <a href="{{route('notices.index')}}" class="dropdown-toggle no-arrow">
                            <span class="fa fa-clone"></span><span class="mtext">Notice</span>
                        </a>
                    </li>

                    {{-- ===================================================== --}}

                    <li class="ts-sidebar-divider"></li>

                @endcan

                {{-- ===================================================== --}}

                @can('attendance-crud')

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-clone"></span><span class="mtext">Attendance</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('attendance.select') }}">Add Attendance</a></li>
                            <li><a href="{{ route('attendance.edit') }}">Edit Attendance</a></li>
                            <li><a href="{{ route('attendance.selectForView') }}">View Attendance</a></li>
                        </ul>
                    </li>

                @endcan

                @can('mark-crud')

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-clone"></span><span class="mtext">Result</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('marks.add.query')}}">Add Marks</a></li>
                            <li><a href="{{route('marks.show.query')}}">Show/Update Marks</a></li>
                            <li><a href="{{route('meritList.index')}}">Result Generator</a></li>
                            {{--<li><a href="{{route('meritList.final.index')}}">Final Result Generator</a></li>--}}
                        </ul>
                    </li>

                @endcan

                @can('promotion-crud')

                    <li class="dropdown">
                        <a href="{{route('promotion.select')}}" class="dropdown-toggle no-arrow">
                            <span class="fa fa-clone"></span><span class="mtext">Promotion</span>
                        </a>
                    </li>


                @endcan

                {{-- ===================================================== --}}

                @can('roll-generator-crud')

                    <li class="dropdown">
                        <a href="{{route('rollGenerator.index')}}" class="dropdown-toggle no-arrow">
                            <span class="fa fa-clone"></span><span class="mtext">Roll Generator</span>
                        </a>
                    </li>

                    {{-- ===================================================== --}}

                    <li class="ts-sidebar-divider"></li>

                @endcan


                {{-- ===================================================== --}}

                @can('optional-assign-crud')

                    <li class="dropdown">
                        <a href="{{route('subjects.optional.index')}}" class="dropdown-toggle no-arrow">
                            <span class="fa fa-clone"></span><span class="mtext">Optional Subject Assign</span>
                        </a>
                    </li>

                @endcan

                @can('class-assign-crud')

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-clone"></span><span class="mtext">Class Assign</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('classAssigns.create')}}">Create</a></li>
                            <li><a href="{{route('classAssigns.index')}}">View</a></li>
                        </ul>
                    </li>

                    {{-- ===================================================== --}}

                    <li class="ts-sidebar-divider"></li>

                @endcan

                {{-- ===================================================== --}}

                @can('sms-send')

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-clone"></span><span class="mtext">Send SMS</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('sendSms.select')}}">Send</a></li>
                            <li><a href="{{route('smsHistory.index')}}">SMS History</a></li>
                        </ul>
                    </li>

                    {{-- ===================================================== --}}

                    <li class="ts-sidebar-divider"></li>

                @endcan

                {{-- ===================================================== --}}

                @can('recovery-password-crud')

                    <li class="dropdown">
                        <a href="{{route('recovery.password.index')}}" class="dropdown-toggle no-arrow">
                            <span class="fa fa-clone"></span><span class="mtext">Reset Users Password</span>
                        </a>
                    </li>

                @endcan

                {{-- ===================================================== --}}

                @can('preference-crud')

                    <li class="dropdown">
                        <a href="{{route('preference.index')}}" class="dropdown-toggle no-arrow">
                            <span class="fa fa-clone"></span><span class="mtext">Preferences</span>
                        </a>
                    </li>

                @endcan


                {{-- ===================================================== --}}

                @can('access-system-setup')

                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-list"></span><span class="mtext">System Setup</span>
                        </a>

                        <ul class="submenu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="fa fa-clone"></span><span class="mtext">Subject</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="{{route('subjects.create')}}">Add Subject</a></li>
                                    <li><a href="{{route('subjects.index')}}">View Subjects</a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="submenu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="fa fa-clone"></span><span class="mtext">Group</span>
                                </a>
                                <ul class="submenu child">
                                    <li><a href="/groups">View Group</a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="submenu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="fa fa-clone"></span><span class="mtext">Shift</span>
                                </a>
                                <ul class="submenu child">
                                    <li><a href="/shifts">View Shift</a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="submenu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="fa fa-clone"></span><span class="mtext">Section</span>
                                </a>
                                <ul class="submenu child">
                                    <li><a href="/sections">View Section</a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="submenu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="fa fa-clone"></span><span class="mtext">Grade Point</span>
                                </a>
                                <ul class="submenu child">
                                    <li><a href="/grades">View Grade point</a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="submenu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="fa fa-clone"></span><span class="mtext">Class</span>
                                </a>
                                <ul class="submenu child">
                                    <li><a href="/class">View Class</a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="submenu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="fa fa-clone"></span><span class="mtext">Role</span>
                                </a>
                                <ul class="submenu child">
                                    <li><a href="/roles">View Role</a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="submenu">
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="fa fa-clone"></span><span class="mtext">Exam Terms</span>
                                </a>
                                <ul class="submenu child">
                                    <li><a href="{{route('exam-terms.index')}}">View Exam Terms</a></li>
                                </ul>
                            </li>
                        </ul>


                    </li>

                @endcan

            </ul>


        </div>
    </div>
</div>