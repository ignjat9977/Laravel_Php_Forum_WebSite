<div class="p-5 col-12 col-md-6">
    <div class="card">

        @if(substr($p->picture_href, 0, 6) == 'https:')
            <img class="card-img-top" src="{{$p->picture_href}}" alt="Card image cap">
        @elseif($p->picture_href=="")
            <img class="card-img-top" src="{{asset("assets/images/noimage.jpg")}}" alt="Card image cap">
        @else
            <img class="card-img-top" src="{{asset("storage/posts/$p->picture_href")}}" alt="Card image cap">
        @endif
        <div class="card-body">
            <h5 class="card-title text-info">{{$p->mega_title}}</h5>
            <p class="card-text">{{$p->content}}</p>
            <a href="{{route("showPost", ["id"=> $p->id_post])}}"> View full Post</a>
            <a href="#" data-li="{{$p->id_post}}" class="btn btn-danger delete-post-btn">Delete</a>
        </div>
    </div>
</div>

