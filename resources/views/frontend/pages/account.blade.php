@extends("layouts.layoutUser")

@section("title")
    Account
@endsection
@section("script")
    @include("frontend.fixed.script")
@endsection
@section("mainContent")


    <div class="container">
        <div class="row">
            @foreach($user as $u)
            <div class="col-12 col-md-3">
                @if(session()->has("error"))
                    <div class="alert alert-danger">
                        {{session()->get("error")}}
                    </div>
                @endif
                @error("picture_href")
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                @if(session()->has("success"))
                        <div class="alert alert-success">
                            {{session()->get("success")}}
                        </div>
                    @endif
                @if($u->picture_href=="")
                    <img src="{{asset("assets/images/unknown.jpg")}}" alt="User picture" class="ik-auth-thumb">
                @elseif(substr($u->picture_href, 0, 6)=="https:")
                    <img class="img-fluid ik-auth-thumb" src="{{$u->picture_href}}" alt="User picture">
                @else
                    <img class="img-fluid ik-auth-thumb" src="{{asset("storage/posts/$u->picture_href")}}" alt="User picture">
                @endif
                <div>
                    <span class="ik-plus">+</span>
                    <form action="{{route("changeProfileImg")}}" id="accountPictureForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Change your picture</label>
                            <input type="file" name="picture_href" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <input type="hidden" name="id_user" value="{{$u->id_user}}">
                        <button class="btn btn-primary">Change</button>
                    </form>
                </div>
                <div>
                    <p>Account info <span class="ik-plus-info">+</span></p>
                    <div class="accountInfo">
                        <p>First and Last name: {{$u->first_name . " " . $u->last_name}}</p>
                        <p>Username: {{$u->username}}</p>
                        <p>Email: {{$u->email}}</p>
                        <p>Street: {{$u->street}}</p>
                    </div>

                </div>
                    <div>
                        <p>Change password <span class="ik-plus-password">+</span></p>
                        <div class="passwordInfo">
                            <form action="{{route("changeAccountPassword")}}" method="POST">
                                <div class="form-group row">
                                    @csrf
                                    <div class="col-12">
                                        <input class="form-control" type="password" name="password" placeholder="Enter new password">
                                        <input type="hidden" name="id_user" value="{{$u->id_user}}">
                                    </div>
                                    @error("password")
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <input class="btn ml-3 mt-3 btn-success" type="submit" value="Reset">
                                </div>
                            </form>
                        </div>

                    </div>
            </div>
            @endforeach
            <div class="col-12 col-md-9">
                <h2>My posts</h2>
                <div class="row">
                    @forelse($posts as $p)
                        <div class="col-md-6 grid-item border">
                            <div class="card" >
                                <a href="{{route("showPost", ["id"=> $p->postId])}}">
                                    @if(substr($p->postImg, 0, 6) == 'https:')
                                        <img class="img-fluid" src="{{$p->postImg}}" alt="Tree of Codes">
                                    @elseif($p->postImg=="")
                                        <img class="img-fluid" src="{{asset("assets/images/noimage.jpg")}}" alt="Tree of Codes">
                                    @else
                                        <img class="img-fluid" src="{{asset("storage/posts/$p->postImg")}}" alt="Tree of Codes">
                                    @endif
                                </a>
                                <div class="card-block">
                                    <h2 class="card-title"><a href="{{route("showPost", ["id"=> $p->postId])}}">{{$p->mega_title}}</a></h2>
                                    <h4 class="card-text">{{
                                        strlen($p->content) > 80 ? substr($p->content, 0, 80) . "..." : $p->content
                                    }}</h4>
                                    <a href="{{route("showPost", ["id"=> $p->postId])}}">Read more...</a>
                                    <form action="{{route("posts.destroy", ["post"=>$p->postId])}}" method="Post">
                                        @method("DELETE")
                                        @csrf
                                        <button class="btn btn-danger">Delete</button>
                                    </form>

                                    <a href="{{route("posts.edit", ["post"=>$p->postId])}}" class="btn btn-primary">Edit</a>

                                </div>
                            </div>
                        </div>
                        @empty
                        <h4 class="ml-2">No posts yet.</h4>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
