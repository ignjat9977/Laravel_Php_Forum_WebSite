<header class="navbar navbar-toggleable-md navbar-light bg-white fixed-top mediumnavigation">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsWow" aria-controls="navbarsWow" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
        <!-- Begin Logo -->
        <a class="navbar-brand" href="{{route("home")}}">
            <img src="{{asset("assets/images/logo.png")}}" alt="Affiliates - Free Bootstrap Template">
        </a>
        <!-- End Logo -->
        <!-- Begin Menu -->
        <div class="collapse navbar-collapse" id="navbarsWow">
            <!-- Begin Menu -->
            <ul class="navbar-nav ml-auto">
                @foreach($navItems as $n)
                    @if($n->route!="author" && $n->route!="posts.create")
                        <li class="nav-item">
                            <a class="nav-link" href="{{route($n->route)}}">{{$n->text}}</a>
                        </li>
                    @elseif($n->route=="posts.create")
                        @if(session()->has("user"))
                        <li class="nav-item">
                            <a class="nav-link" href="{{route($n->route)}}">{{$n->text}}</a>
                        </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link highlight" href="{{route($n->route)}}">{{$n->text}}</a>
                        </li>
                    @endif
                @endforeach
                <li class="nav-item dropdown">
                    <a class="nav-link ik-nav-btn dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
                    <div class="dropdown-menu ik-nav-div" aria-labelledby="dropdown01">


                        @if(!session()->has("user"))
                            <a class="dropdown-item" href="{{route("login")}}">Login</a>
                            <a class="dropdown-item" href="{{route("register")}}">Register</a>
                        @endif

                        @if(session()->has("user"))
                                <a class="dropdown-item" href="{{route("account")}}">Account</a>
                            @endif

                            @if(session()->has("user") && session()->get("user")->id_role == 11)
                                <a class="dropdown-item" href="{{route("dashboard")}}">Admin Panel</a>
                            @endif
                        @if(session()->has("user"))
                            <a class="dropdown-item" href="{{route("logout")}}">Log out</a>
                        @endif
                    </div>
                </li>
            </ul>
            <!-- End Menu -->
        </div>
    </div>
</header>
