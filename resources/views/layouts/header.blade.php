<div class="app-header header-shadow">
    <div class="app-header-logo"></div>
    <div class="app-header-mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header-menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="app-header-content">
        <!-- Header-left-Section -->
        <div class="app-header-left">
            <div class="header-pane ">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <!-- End-Header-Left-section -->
        <!-- Header-Rignt-Section -->
        <div class="app-header-right">
            <div class="user-profile-box dropdown">
                <div class="nav-profile-box dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-image">
                        <a href=""><img class="profilepic"
                                src="{{ auth()->user()?->profilePicturePath ?? asset('assets/images/avatars/MD.png') }}"
                                alt=""></a>
                    </div>
                    <div class="profile-content">
                        <span>{{ auth()->user()?->name ?? 'User Name' }}</span>
                        <i class="fa-solid fa-angle-down dropIcon"></i>
                    </div>
                </div>

                <div class="dropdown-menu profile-item">
                    <a href="{{ route('user.edit', auth()->user()?->id) }}" class="dropdown-item"><i
                            class="fa-solid fa-gear me-2"></i>Update Profile</a>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item"><i
                            class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
                </div>
            </div>

        </div>
        <!-- End-Header-Right-Section -->

    </div>
</div>
