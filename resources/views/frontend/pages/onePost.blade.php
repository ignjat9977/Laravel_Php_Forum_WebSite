@extends("layouts.layoutUser")

@section("title")
    Home
@endsection

@section("postScript")
    @include("frontend.fixed.onePostScript")
@endsection

@section("mainContent")


    <div class="container">
        <!-- Content
    ================================================== -->
        <div class="main-content">
            <!-- Begin Article
            ================================================== -->
            <div class="row">
                <!-- Sidebar -->
                @component("components.sidebarOnePost",[
                    "categories"=>$categories,
                    "tags"=>$tags
                ])

                @endcomponent
                <!-- Post -->
                @foreach($post as $p)
                <div class="col-sm-8">
                    <div class="mainheading">
                        <!-- Post Categories -->
                        <div class="after-post-tags">
                            <ul class="tags">
                                @foreach($categories as $c)
                                <li>
                                    <a href="#">{{$c->title}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Categories -->
                        <!-- Post Title -->
                        <h1 class="posttitle">{{$p->mega_title}}</h1>
                    </div>
                    <!-- Post Featured Image -->
                    @if(substr($p->postImg, 0, 6) == 'https:')
                        <img class="featured-image img-fluid" src="{{$p->postImg}}" alt="Post Image">
                    @elseif($p->postImg == "")
                        <img class="featured-image img-fluid" src="{{asset("assets/images/noimage.jpg")}}" alt="Post Image">

                    @else
                        <img class="featured-image img-fluid" src="{{asset("storage/posts/$p->postImg")}}" alt="Post Image">
                    @endif
                    <!-- End Featured Image -->
                    <!-- Post Content -->
                    <div class="article-post">
                        <p>
                            {{$p->content}}
                        </p>
                        <div class="clearfix">
                        </div>
                    </div>
                    <!-- Post Date -->
                    <p>
                        <small>
                            <span class="post-date"><time class="post-date" datetime="2018-01-12">{{$p->createdDateTime}}</time></span>
                        </small>
                    </p>
                    Likes:<span class="num-of-likes-post">{{$p->likes}}</span>
                    @if(session()->has("user"))
                        <a href="" class="like-btn-post" data-li="{{$p->postId}}"><i class="bi bi-hand-thumbs-up mr-2"></i></a>
                    @endif

                    <!-- Prev/Next -->
                    <div class="row PageNavigation mt-4 prevnextlinks">
                        <div class="col-md-6 rightborder pl-0">
                            <a class="thepostlink" href="{{route("home")}}">All posts</a>
                        </div>
                        <div class="col-md-6 text-right pr-0">
                            <a class="thepostlink" href="{{route("home")}}">All posts</a>
                        </div>
                    </div>
                    <!-- End Prev/Next -->
                    <!-- Author Box -->
                    <div class="row post-top-meta">
                        <div class="col-md-2">
                            @if($p->userImg == "")
                                <img class="author-thumb" alt="Bootstrap" src="{{asset("assets/images/unknown.jpg")}}" />
                            @elseif(substr($p->userImg, 0, 6) == 'https:')
                                <img class="author-thumb" alt="Bootstrap Media Preview" src="{{$p->userImg}}" />
                            @else
                                <img class="author-thumb" alt="Bootstrap Media Preview" src="{{asset("storage/posts/$p->userImg")}}" />
                            @endif
                        </div>
                        <div class="col-md-10">
                            <p>Author of post: </p>
                            <span class="author-description">{{$p->first_name . " ". $p->last_name}}</span>
                        </div>
                    </div>


                    <!-- Begin Comments
                    ================================================== -->


                </div>
                    <div class="container mb-5 mt-5">


                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="mb-5">
                                    Comments section
                                </h3>
                                @if(session()->has("user"))
                                    @error("content")
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                <form>
                                    @csrf
                                    <textarea rows="5" class="form-control mb-3" class="content" name="content" placeholder="Post comment"></textarea>
                                    <input type="hidden" value="{{$p->postId}}"  class="id_post" name="id_post"/>
                                    <input type="hidden" value="0"  class="id_parent" name="id_parent"/>
                                    <input type="hidden"  class="id_user" value="{{session()->get("user")->id_user}}" name="id_user"/>
                                    <a class="btn btn-primary ik-btn-comment">Send</a>
                                </form>
                                @else
                                    <h3>Please register to get access to comment posting!</h3>
                                @endif

                            </div>
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-12" id="commentBox">
                                        @foreach($comments as $c)
                                            @component("components.comment", [
                                                    "c"=>$c
                                            ])

                                            @endcomponent
                                        @endforeach


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
                <!-- End Post -->
            </div>
            <!-- End Article
            ================================================== -->
        </div>
    </div>

@endsection
