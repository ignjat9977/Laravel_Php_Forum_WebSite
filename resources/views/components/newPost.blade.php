<!-- begin post -->
<div class="col-sm-6">
    <div class="card">
        <div class="row">
            <div class="col-md-5 wrapthumbnail">
                <a href="{{route("showPost", ["id"=> $p->postId])}}">

                    @if(substr($p->postImg, 0, 6) == 'https:')
                        <div class="thumbnail" style="background-image:url({{$p->postImg}});">
                        </div>
                    @elseif($p->postImg=="")
                        <div class="thumbnail" style="background-image:url({{asset("assets/images/noimage.jpg")}});">
                        </div>
                    @else
                        <div class="thumbnail" style="background-image:url({{asset("storage/posts/$p->postImg")}});">
                        </div>
                    @endif

                </a>
            </div>
            <div class="col-md-7">
                <div class="card-block">
                    <h2 class="card-title"><a href="{{route("showPost", ["id"=> $p->postId])}}">{{$p->mega_title}}</a></h2>
                    <h4 class="card-text">
                        {{strlen($p->content) > 80 ? substr($p->content, 0, 80) . "..." : $p->content}}
                    </h4>
                    <a href="{{route("showPost", ["id"=> $p->postId])}}">Read more...</a>
                    <div class="metafooter">
                        <div class="wrapfooter">
                            <span class="meta-footer-thumb">

                                @if($p->userImg == "")
                                    <img class="author-thumb" src="{{asset("assets/images/unknown.jpg")}}" alt="John"/>
                                @elseif(substr($p->userImg, 0, 6) == "https:")
                                    <img class="author-thumb" src="{{$p->userImg}}" alt="John"/>
                                @else
                                    <img class="author-thumb" src="{{asset("storage/posts/$p->userImg")}}" alt="John"/>

                                @endif
                            </span>
                            <span class="author-meta">
                                <span class="post-name"><a target="_blank" href="#">{{$p->first_name." ".$p->last_name}}</a></span><br/>
                                <span class="post-date">{{$p->createdDateTime}}</span>
                            </span>
                            <span class="post-read-more"><a href="single.html" title="Read Story"><i class="fa fa-link"></i></a></span>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end post -->
