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
                    <h2><span>Edit post</span></h2>
                </div>
                <div class="article-post">
                    @foreach($post as $p)
                    <form action="{{route("posts.update", ["post"=>$p->postId])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="">Mega title</label>
                                <input class="form-control" type="text" name="mega_title" value="{{$p->mega_title}}" placeholder="Mega Title">
                                @error('mega_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="">Title</label>
                                <input class="form-control" type="text" name="title" value="{{$p->title}}" placeholder="Title">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6 mt-4">
                                <p>Cateogries</p>
                                <ul>
                                    @foreach($categories as $c)
                                        <li class="flex">
                                            <input class="form-check-input" {{in_array($c->id_category, (array)$categoriesOfPost)?"checked":""}} type="checkbox" name="id_category[]" id="inlineCheckbox1_{{$c->id_category}}" value="{{$c->id_category}}">
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
                                            <input class="form-check-input" {{in_array($t->id_tag, (array)$tagsOfPost)?"checked":""}} type="checkbox" name="id_tag[]" id="inlineCheckbox1_{{$t->id_tag}}" value="{{$t->id_tag}}">
                                            <label class="form-check-label" for="inlineCheckbox1">{{$t->title}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                                @error('id_tag')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mt-4">
                                <label for="formFile" class="form-label">Change photo</label>
                                <input class="form-control" type="file" name="picture_href" id="formFile">
                                @error('picture_href')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <h5>Or leave these</h5>
                                @if(substr($p->postImg, 0, 6) == 'https:')
                                    <img class="img-fluid" src="{{$p->postImg}}" alt="Tree of Codes">
                                @elseif($p->postImg=="")
                                    <h5>No image</h5>
                                @else
                                    <img class="img-fluid" src="{{asset("storage/posts/$p->postImg")}}" alt="Tree of Codes">
                                @endif
                            </div>
                            <div class="col-12 mt-4">
                                <label for="">Content</label>
                                <textarea rows="8" class="form-control mb-3" name="content" placeholder="Post content">{{$p->content}}</textarea>
                                @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input class="btn btn-success" type="submit" value="Edit a post">


                    </form>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
