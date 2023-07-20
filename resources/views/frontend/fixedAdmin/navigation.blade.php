<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                @if($userInfo->picture_href== null)
                    <img class="rounded-circle me-lg-2" src="{{asset("assets/images/unknown.jpg")}}" alt="" style="width: 40px; height: 40px;">
                @elseif(substr($userInfo->picture_href, 0, 6)=="https:")
                    <img class="rounded-circle me-lg-2" src="{{$u->picture_href}}" alt="" style="width: 40px; height: 40px;">
                @else
                    <img class="rounded-circle me-lg-2" src="{{asset("storage/posts/$userInfo->picture_href")}}" alt="" style="width: 40px; height: 40px;">
                @endif
                <span class="d-none d-lg-inline-flex">{{$userInfo->first_name. " ". $userInfo->last_name}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="{{route("account")}}" class="dropdown-item">My Profile</a>
                <a href="{{route("logout")}}" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->
