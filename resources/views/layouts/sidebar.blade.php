<!--Sidebar-Menu-Section-->
<div class="app-sidebar sidebar-shadow">
    <div class="scrollbar-sidebar pb-3">
        <div class="branding-logo mb-2 text-start px-3" style="position: relative; overflow: hidden;">
            <a href="/admin" style="display: block; height: 100%; width: 100%;">
                <img style="width: 100%; height: auto; " src="{{ $app_setting['logo'] }}" alt="">
            </a>
        </div>
        <div class="branding-logo-forMobile mb-4">
            <a href="/admin"><img src="{{ $app_setting['logo'] }}" alt=""></a>
        </div>
        <div class="app-sidebar-inner">
            <ul class="vertical-nav-menu">
                <li class="{{ request()->is('admin') ? 'mm-active' : '' }}">
                    <a href="/admin">
                        <i class="fa-solid fa-home menu-icon"></i>
                        Dashboard
                    </a>
                </li>

                <li
                    class="{{ request()->is('admin/category*') || request()->is('admin/course*') || request()->is('admin/chapter*') ? 'mm-active' : '' }}">
                    <a href="#"
                        class="{{ request()->is('admin/category*') || request()->is('admin/course*') || request()->is('admin/chapter*') ? 'mm-active' : '' }}">
                        <i class="fa-solid fa-gem menu-icon"></i>
                        Course Management
                        <i class="fa fa-angle-down menu-state-icon"></i>
                    </a>
                    <ul
                        class="mm-collapse {{ request()->is('admin/category*') || request()->is('admin/course*') || request()->is('admin/chapter*') ? 'mm-show' : '' }}">
                        <li class="sub-menu {{ request()->is('admin/category*') ? 'mm-active' : '' }}">
                            <a href="{{ route('category.index') }}">
                                <i class="fa-solid fa-swatchbook"></i>
                                Category
                            </a>
                        </li>
                        <li class="sub-menu {{ request()->is('admin/course*') ? 'mm-active' : '' }}">
                            <a href="{{ route('course.index') }}">
                                <i class="fa-solid fa-book-open-reader"></i>
                                Course
                            </a>
                        </li>

                        <li class="sub-menu {{ request()->is('admin/chapter*') ? 'mm-active' : '' }}">
                            <a href="{{ route('chapter.select_course') }}">
                                <i class="fa-solid fa-photo-film"></i>
                                Chapter
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->is('admin/exam*') || request()->is('admin/quiz*') ? 'mm-active' : '' }}">
                    <a href="#"
                        class="{{ request()->is('admin/exam*') || request()->is('admin/quiz*') ? 'mm-active' : '' }}">
                        <i class="fa-solid fa-book-open-reader menu-icon"></i>
                        Exam Management
                        <i class="fa fa-angle-down menu-state-icon"></i>
                    </a>
                    <ul
                        class="mm-collapse {{ request()->is('admin/exam*') || request()->is('admin/quiz*') ? 'mm-show' : '' }}">
                        <li class="sub-menu {{ request()->is('admin/exam*') ? 'mm-active' : '' }}">
                            <a href="{{ route('exam.select_course') }}">
                                <i class="fa-solid fa-swatchbook"></i>
                                Exam
                            </a>
                        </li>
                        <li class="sub-menu {{ request()->is('admin/quiz*') ? 'mm-active' : '' }}">
                            <a href="{{ route('quiz.select_course') }}">
                                <i class="fa-solid fa-cube"></i>
                                Quiz
                            </a>
                        </li class="sub-menu">
                    </ul>
                </li>

                <li class="{{ request()->is('admin/coupon*') ? 'mm-active' : '' }}">
                    <a href="#" class="{{ request()->is('admin/coupon*') ? 'mm-active' : '' }}">
                        <i class="fa-solid fa-receipt menu-icon"></i>
                        Coupon Management
                        <i class="fa fa-angle-down menu-state-icon"></i>
                    </a>
                    <ul class="mm-collapse {{ request()->is('admin/coupon*') ? 'mm-show' : '' }}">
                        <li class="sub-menu {{ request()->is('admin/coupon/list*') ? 'mm-active' : '' }}">
                            <a href="{{ route('coupon.index', 2) }}">
                                <i class="fa-solid fa-tasks"></i>
                                Coupon List
                            </a>
                        </li>
                        <li class="sub-menu {{ request()->is('admin/coupon/create*') ? 'mm-active' : '' }}">
                            <a href="{{ route('coupon.create', 3) }}">
                                <i class="fa-solid fa-plus"></i>
                                New Coupon
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="{{ request()->is('admin/enrollment*') || request()->is('admin/review*') ? 'mm-active' : '' }}">
                    <a href="#"
                        class="{{ request()->is('admin/enrollment*') || request()->is('admin/review*') ? 'mm-active' : '' }}">
                        <i class="fa-solid fa-tasks menu-icon"></i>
                        Enroll Management
                        <i class="fa fa-angle-down menu-state-icon"></i>
                    </a>
                    <ul
                        class="mm-collapse {{ request()->is('admin/enrollment*') || request()->is('admin/review*') ? 'mm-show' : '' }}">

                        <li class="sub-menu {{ request()->is('admin/enrollment*') ? 'mm-active' : '' }}">
                            <a href="{{ route('enrollment.index') }}">
                                <i class="fa-solid fa-cart-shopping"></i>
                                Enrollment
                            </a>
                        </li>
                        <li class="sub-menu {{ request()->is('admin/request/enrollment*') ? 'mm-active' : '' }}">
                            <a href="{{ route('enrollment.request.index') }}">
                                <i class="fa-solid fa-money-check"></i>
                                Enroll Request
                            </a>
                        </li>
                        <li class="sub-menu {{ request()->is('admin/review*') ? 'mm-active' : '' }}">
                            <a href="{{ route('review.index') }}">
                                <i class="fa-solid fa-star-half-stroke"></i>
                                Review
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->is('admin/instructor*') ? 'mm-active' : '' }}">
                    <a href="#" class="{{ request()->is('admin/instructor*') ? 'mm-active' : '' }}">
                        <i class="fa-solid fa-file-lines menu-icon"></i>
                        Instructor Management
                        <i class="fa fa-angle-down menu-state-icon"></i>
                    </a>
                    <ul class="mm-collapse {{ request()->is('admin/instructor*') ? 'mm-show' : '' }}">
                        <li
                            class="sub-menu {{ request()->is('admin/instructor/list*') || request()->is('admin/instructor/edit*') ? 'mm-active' : '' }}">
                            <a href="{{ route('instructor.index', 2) }}">
                                <i class="fa-solid fa-chalkboard-user"></i>
                                Instructor List
                            </a>
                        </li>
                        <li class="sub-menu {{ request()->is('admin/instructor/featured*') ? 'mm-active' : '' }}">
                            <a href="{{ route('instructor.featured', 3) }}">
                                <i class="fa-solid fa-user-check"></i>
                                Featured Instructors
                            </a>
                        </li>
                        <li class="sub-menu {{ request()->is('admin/instructor/create') ? 'mm-active' : '' }}">
                            <a href="{{ route('instructor.create', 1) }}">
                                <i class="fa-solid fa-user-plus"></i>
                                New Instructor
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->is('admin/transaction*') ? 'mm-active' : '' }}">
                    <a href="{{ route('transaction.index') }}">
                        <i class="fa-solid fa-money-bill-transfer menu-icon"></i>
                        Transaction
                    </a>
                </li>
                <li class="{{ request()->is('admin/page*') ? 'mm-active' : '' }}">
                    <a href="#" class="{{ request()->is('admin/page*') ? 'mm-active' : '' }}">
                        <i class="fa-solid fa-file-lines menu-icon"></i>
                        Legal Page
                        <i class="fa fa-angle-down menu-state-icon"></i>
                    </a>
                    <ul class="mm-collapse {{ request()->is('admin/page*') ? 'mm-show' : '' }}">
                        <li class="sub-menu {{ request()->is('admin/page/edit/4*') ? 'mm-active' : '' }}">
                            <a href="{{ route('page.edit', 4) }}">
                                <i class="fa-solid fa-info-circle"></i>
                                About Us
                            </a>
                        </li>

                        <li class="sub-menu {{ request()->is('admin/page/edit/5*') ? 'mm-active' : '' }}">
                            <a href="{{ route('page.edit', 5) }}">
                                <i class="fa-solid fa-envelope"></i>
                                Contact Us
                            </a>
                        </li>

                        <li class="sub-menu {{ request()->is('admin/page/edit/6*') ? 'mm-active' : '' }}">
                            <a href="{{ route('page.edit', 6) }}">
                                <i class="fa-solid fa-question-circle"></i>
                                FAQ
                            </a>
                        </li>

                        <li class="sub-menu {{ request()->is('admin/page/edit/1*') ? 'mm-active' : '' }}">
                            <a href="{{ route('page.edit', 1) }}">
                                <i class="fa-solid fa-user-lock"></i>
                                Privacy Policy
                            </a>
                        </li>

                        <li class="sub-menu {{ request()->is('admin/page/edit/2*') ? 'mm-active' : '' }}">
                            <a href="{{ route('page.edit', 2) }}">
                                <i class="fa-solid fa-user-shield"></i>
                                Terms & Conditions
                            </a>
                        </li>

                        <li class="sub-menu {{ request()->is('admin/page/edit/3') ? 'mm-active' : '' }}">
                            <a href="{{ route('page.edit', 3) }}">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                                Refund Policy
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('admin/user*') ? 'mm-active' : '' }}">
                    <a href="{{ route('user.index') }}">
                        <i class="fa-solid fa-users menu-icon"></i>
                        Student
                    </a>
                </li>
                <li class="{{ request()->is('admin/admin*') ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.index') }}">
                        <i class="fa-solid fa-user-shield menu-icon"></i>
                        Super Admin
                    </a>
                </li>
                <li class="{{ request()->is('admin/payment_gateway*') ? 'mm-active' : '' }}">
                    <a href="{{ route('payment_gateway.index') }}">
                        <i class="fa-solid fa-credit-card menu-icon"></i>
                        Payment Method
                    </a>
                </li>
                <li class="{{ request()->is('admin/notification*') ? 'mm-active' : '' }}">
                    <a href="{{ route('notification.index') }}">
                        <i class="fa-solid fa-bell menu-icon"></i>
                        Notification
                    </a>
                </li>
                <li class="{{ request()->is('admin/setting*') ? 'mm-active' : '' }}">
                    <a href="{{ route('setting.index') }}">
                        <i class="fa-solid fa-gear menu-icon"></i>
                        Settings
                    </a>
                </li>
            </ul>

            <div class="sideBarfooter">
                <a href="{{ route('user.edit', auth()->user()?->id) }}" class="fullbtn"><i
                        class="fa-solid fa-gear"></i></a>
                <button type="button" class="fullbtn hite-icon" onclick="toggleFullScreen(document.body)"><i
                        class="fa-solid fa-expand"></i></button>
                <a href="{{ route('admin.logout') }}" class="fullbtn hite-icon"><i
                        class="fa-solid fa-power-off"></i></a>
            </div>

        </div>
    </div>
</div>
<!-- End-Sidebar-Menu-Section -->
