@extends("layouts.layoutUser")

@section("title")
    Create a Post
@endsection

@section("mainContent")
    <div class="container">
        <!-- Content (replace with your e-mail address below)
    ================================================== -->
        <div class="main-content">
            <section>
                <div class="section-title">
                    <h2><span>Create a post</span></h2>
                </div>
                <div class="article-post">
                    <form action="{{route("posts.store")}}" method="POST" enctype="multipart/form-data">
                        @if(session()->has("errorPosts"))
                            <div class="alert alert-danger">{{ session()->remove("errorPosts") }}</div>
                        @endif
                        <div class="form-group row">
                            <div class="col-6">
                                <input class="form-control" type="text" name="mega_title" value="{{old("mega_title")}}" placeholder="Mega Title">
                                @error('mega_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <input class="form-control" type="text" name="title" value="{{old("title")}}" placeholder="Title">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6 mt-4">
                                <p>Cateogries</p>
                                <ul>
                                    @foreach($categories as $c)
                                        <li class="flex">
                                            <input class="form-check-input"
                                                   @if(in_array($c->id_category, old("id_category")==null?[]:old("id_category")))
                                                       checked
                                                   @endif
                                                   type="checkbox"
                                                   name="id_category[]"
                                                   id="inlineCheckbox1_{{$c->id_category}}"
                                                   value="{{$c->id_category}}">
                                            <label class="form-check-label" for="inlineCheckbox1">{{$c->title}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                                @error('id_category')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6 mt-4">
                                <p>Tags</p>
                                <ul>
                                    @foreach($tags as $t)
                                        <li class="flex">
                                            <input class="form-check-input"
                                                   @if(in_array( $t->id_tag, old("id_tag")==null?[]:old("id_tag")))
                                                       checked
                                                   @endif
                                                   type="checkbox"
                                                   name="id_tag[]"
                                                   id="inlineCheckbox1_{{$t->id_tag}}"
                                                   value="{{$t->id_tag}}">
                                            <label class="form-check-label" for="inlineCheckbox1">{{$t->title}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                                @error('id_tag')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mt-4">
                                <label for="formFile" class="form-label">Choose picture for post</label>
                                <input class="form-control" type="file" value="{{old("picture_href")}}" name="picture_href" id="formFile">
                                @error('picture_href')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mt-4">
                                <textarea rows="8" class="form-control mb-3" name="content" placeholder="Post content">{{old("content")}}</textarea>
                                @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input class="btn btn-success" type="submit" value="Create a post">
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
