@extends("layouts.layoutAdmin")

@section("title")
    Tags
@endsection

@section("script")
    @include('frontend.fixedAdmin.scriptAdminPost')
@endsection

@section("content")

    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Posts</h6>
            </div>
            <div class="row">

                <div class="col-12 col-md-3">

                    <div class="sidebar-section mt-4">
                        <h5><span>Search</span></h5>
                        <input type="text" name="" id="admin-posts-search" class="form-control">
                    </div>

                    <h5 class="mt-4"><span>Categories</span></h5>

                    <ul id="admin-ul">
                        @foreach($categories as $c)
                            <li class="d-flex justify-content-start">
                                <input type="checkbox"
                                       id="inlineCheckbox"
                                       name="id_category[]"
                                       value="{{$c->id_category}}"
                                       class="mr-3 admin-check-cat"/>
                                {{$c->title}}
                            </li>


                        @endforeach
                    </ul>
                </div>
                <div class="col-12 col-md-9">
                    <div class="row" id="admin-post-holder">
                        @forelse($posts->items as $p)
                            @component("components.postAdmin", [
                                "p"=>$p
                            ])
                            @endcomponent
                        @empty
                            <h2>No posts</h2>
                        @endforelse
                    </div>
                    <nav aria-label="Page navigation example" >
                        <ul class="pagination" id="post-admin-pagination-nav">
                            @for($i=0; $i<$posts->numOfPages; $i++)
                            <li class="page-item ik-admin-pagination-posts" data-li="{{$i+1}}"><a class="page-link" href="#">{{$i+1}}</a></li>
                            @endfor
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>

</script>
