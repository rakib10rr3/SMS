<div class="left-side-bar">
    <div class="brand-logo">
        <a href="/">
            {{--<img src="vendors/images/deskapp-logo.png" alt="">--}}
            <img src="/vendors/images/logo-full-color.png" alt="Logo">
        </a>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">


                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-list"></span><span class="mtext">System Setup</span>
                    </a>

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
                                <span class="fa fa-clone"></span><span class="mtext">Notice</span>
                            </a>
                            <ul class="submenu child">
                                <li><a href="/notices">View Notices</a></li>
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

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Attendance</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('attendance.select') }}">Add Attendance</a></li>
                        <li><a href="{{ route('attendance.edit') }}">Edit Attendance</a> </li>
                        <li><a href="{{ route('attendance.selectForView') }}">View Attendance</a> </li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Class Assign</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('classAssigns.create')}}">Create</a></li>
                        <li><a href="{{route('classAssigns.index')}}">View</a></li>

                    </ul>
                </li>


                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Exam Terms</span>
                    </a>
                    <ul class="submenu">

                        <li><a href="{{route('exam-terms.index')}}">View Exam Terms</a></li>
                    </ul>
                </li>

                <li class="dropdown">

                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Marks</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('marks.add.query')}}">Add Marks</a></li>
                        <li><a href="{{route('marks.add.show.query')}}">Show Marks</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="{{route('preference.index')}}" class="dropdown-toggle no-arrow">
                        <span class="fa fa-clone"></span><span class="mtext">Preferences</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="{{route('promotion.select')}}" class="dropdown-toggle no-arrow">
                        <span class="fa fa-clone"></span><span class="mtext">Promotion</span>
                    </a>
                </li>



                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Subject</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="/subjects/create">Add Subject</a></li>
                        <li><a href="/subjects">View Subjects</a></li>
                        <li><a href="/subjects/optional">Assign Optional Subject</a></li>
                        <li><a href="/subjects/optional/edit">Edit Optional Subject</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Subject Assign</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('subjectAssigns.index')}}">Assign</a></li>

                    </ul>
                </li>


                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Result</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('marks.add.query')}}">Add Marks</a></li>
                        <li><a href="{{route('marks.show.query')}}">Show/Update Marks</a></li>
                        <li><a href="{{route('meritList.index')}}">Result Generator</a></li>
                    </ul>
                </li>
                <li class="dropdown">

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Students</span>
                    </a>
                    <ul class="submenu">

                        <li><a href="/students/create">Create Student</a></li>
                        <li><a href="/students">View Students</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Send Sms </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('sendSms.select')}}">Send</a></li>
                        {{--<li><a href="{{route('sendSms.index')}}">View</a></li>--}}
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Teachers</span>
                    </a>
                    <ul class="submenu">

                        <li><a href="/teachers/create">Create Teacher</a></li>
                        <li><a href="/teachers">View Teacher</a></li>

                    </ul>
                </li>

            </ul>


        </div>
    </div>
</div>