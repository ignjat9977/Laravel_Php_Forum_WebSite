<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{route("home")}}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                @if($userInfo->picture_href== null)
                    <img class="rounded-circle me-lg-2" src="{{asset("assets/images/unknown.jpg")}}" alt="" style="width: 40px; height: 40px;">
                @elseif(substr($userInfo->picture_href, 0, 6)=="https:")
                    <img class="rounded-circle me-lg-2" src="{{$userInfo->picture_href}}" alt="" style="width: 40px; height: 40px;">
                @else
                    <img class="rounded-circle me-lg-2" src="{{asset("storage/posts/$userInfo->picture_href")}}" alt="" style="width: 40px; height: 40px;">
                @endif
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{$userInfo->first_name." ".$userInfo->last_name}}</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            @foreach($navItems as $n)
                <a href="{{route($n->route)}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>{{$n->text}}</a>
            @endforeach


        </div>
    </nav>
</div>
<!-- Sidebar End -->
