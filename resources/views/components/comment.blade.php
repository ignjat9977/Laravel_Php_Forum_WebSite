<div class="ikSubComment">
<div class="media mt-4">
    @if($c->picture_href == "")
        <img class="mr-3 rounded-circle" alt="Bootstrap Media Preview" src="{{asset("assets/images/unknown.jpg")}}" />
    @elseif(substr($c->picture_href, 0, 6)=="https:")
        <img class="mr-3 rounded-circle" src="{{$c->picture_href}}" alt="User picture">
    @else
        <img class="mr-3 rounded-circle" src="{{asset("storage/posts/$c->picture_href")}}" alt="User picture">
    @endif
    <div class="media-body">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <h5 class="w-50">{{$c->first_name . ' ' . $c->last_name}}</h5>
                @if(session()->has("user") && session()->get("user")->id_user == $c->id_user)
                    <a class="deleteComBtn btn btn-danger" data-li="{{$c->id_comment}}">Delete</a>
                @endif
                <span class="d-block w-25">{{$c->created_at}}</span>

                Likes:<span class="num-of-likes" data-li="{{$c->id_comment}}">{{$c->likes}}</span>
                @if(session()->has("user"))
                    <a href="#" class="like-btn" data-li="{{$c->id_comment}}"><i class="bi bi-hand-thumbs-up mr-2"></i></a>
                @endif
            </div>
        </div>

        {{$c->content}}

        <div class="col-12 mt-3">
            @if(session()->has("user"))
            <form class="d-flex">
                <input type="text" id="" placeholder="Comment here" class="form-control content">
                <input type="hidden" value="{{$c->id_post}}" class="id_post"/>
                <input type="hidden" value="{{$c->id_comment}}" class="id_parent"/>
                <input type="hidden" value="{{session()->get("user")->id_user}}" class="id_user"/>
                <a  class="btn rounded-0 ik-btn-comment btn-primary" >Send</a>
            </form>
            @endif
        </div>

        <div class="ikSubComment">
            @if($c->children!=[])
                @foreach($c->children as $c)
                    @component("components.comment", [
                            "c"=>$c
                    ])

                    @endcomponent
                @endforeach
            @endif
        </div>



    </div>
</div>
</div>
