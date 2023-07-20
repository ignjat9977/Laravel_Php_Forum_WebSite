@extends("layouts.layoutUser")

@section("title")
    Home
@endsection

@section("cover")
    @include("frontend.fixed.cover")
@endsection

@section("mainContent")
    <div class="container">
        <div class="main-content">
            <!-- Featured
            ================================================== -->
            <section class="featured-posts">
                <div class="section-title">
                    <h2><span>Lateast Posts</span></h2>
                </div>
                <div class="row listfeaturedtag">
                    @foreach($newestPosts as $np)
                        @component("components.newPost", [
                            "p" => $np
                        ])
                        @endcomponent
                    @endforeach

                </div>
            </section>

            <hr/>
            <!-- Posts Index
        ================================================== -->

            <section class="recent-posts row">
                <div class="col-sm-4">
                    @component("components.searchForm", [
                      "categories"=>$categories,
                      "checked"=>$checkedCat,
                      "keyword"=>$keyword,
                      "sortBy"=>$sortBy,
                      "perPage"=>$perPage,
                    ])
                    @endcomponent
                </div>

                <div class="col-sm-8">
                    <div class="section-title">
                        <h2><span>All Stories, Total posts: {{$posts->totalCount}}</span></h2>
                    </div>
                    <div class="masonrygrid row listrecent">

                        @forelse($posts->items as $p)
                            @component("components.post", [
                                "p"=>$p,
                            ])
                            @endcomponent
                        @empty
                            <h2>No posts</h2>
                        @endforelse
                    </div>
                    <!-- Pagination -->
                    <div class="bottompagination">
                        <div class="navigation">
                            <nav aria-label="...">
                                <ul class="pagination pagination-sm d-flex flex-row">
                                    @for($i=0; $i<$posts->pageCount; $i++)
                                    <li class="page-item">
                                        <a class="page-link" href="{{route("posts.index", ["page"=>$i+1,"sortBy"=>$sortBy, "keyword"=>$keyword, "id_category"=>$checkedCat, "perPage"=>$perPage])}}" tabindex="-1">{{$i+1}}</a>
                                    </li>
                                    @endfor
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
