<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.php">
            {{--<img src="vendors/images/deskapp-logo.png" alt="">--}}
            <img src="{{asset('vendors/images/deskapp-logo.png')}}" alt="">
        </a>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
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
                        <span class="fa fa-clone"></span><span class="mtext">Group</span>
                    </a>
                    <ul class="submenu">

                        <li><a href="/groups/create">Create Group</a></li>
                        <li><a href="/groups">View Group</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Shift</span>
                    </a>
                    <ul class="submenu">

                        <li><a href="/shifts/create">Create Shift</a></li>
                        <li><a href="/shifts">View Shift</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Section</span>
                    </a>
                    <ul class="submenu">

                        <li><a href="/sections/create">Create Section</a></li>
                        <li><a href="/sections">View Section</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Grade Points</span>
                    </a>
                    <ul class="submenu">

                        <li><a href="/grades/create">Create Grade point</a></li>
                        <li><a href="/grades">View Grade point</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Notice</span>
                    </a>
                    <ul class="submenu">

                        <li><a href="/notices/create">Add Notice</a></li>
                        <li><a href="/notices">View Notices</a></li>

                    </ul>
                </li>


                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Exam Terms</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('exam-terms.create')}}">Create Exam Terms</a></li>
                        <li><a href="{{route('exam-terms.index')}}">View Exam Terms</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Group</span>
                    </a>
                    <ul class="submenu">

                        <li><a href="/groups/create">Create Group</a></li>
                        <li><a href="/groups">View Group</a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Class</span>
                    </a>
                    <ul class="submenu">

                        <li><a href="/class/create">Create Class</a></li>
                        <li><a href="/class">View Class</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Role</span>
                    </a>
                    <ul class="submenu">

                        <li><a href="/roles/create">Create Role</a></li>
                        <li><a href="/roles">View Role</a></li>

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
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="fa fa-clone"></span><span class="mtext">Subject</span>
                            </a>
                            <ul class="submenu">
                        <li><a href="/subjects/create">Add Subject</a></li>
                        <li><a href="/subjects">View Subjects</a></li>

                    </ul>
                </li>


                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="fa fa-clone"></span><span class="mtext">Exam Terms</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('exam-terms.create')}}">Create Exam Terms</a></li>
                        <li><a href="{{route('exam-terms.index')}}">View Exam Terms</a></li>
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
            </ul>


        </div>
    </div>
</div>