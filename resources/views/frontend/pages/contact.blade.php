@extends("layouts.layoutUser")

@section("title")
    Contact
@endsection

@section("mainContent")

    <div class="container">
        @if(session()->has("error"))
            <div class="alert alert-danger">
                {{session()->remove("error")}}
            </div>
        @endif
        @if(session()->has("success"))
            <div class="alert alert-success">
                {{session()->remove("success")}}
            </div>
        @endif
    </div>
    <div class="container">
        <!-- Content (replace with your e-mail address below)
    ================================================== -->
        <div class="main-content">
            <section>
                <div class="section-title">
                    <h2><span>Contact</span></h2>
                </div>
                <div class="article-post">
                    <form action="{{route("contacted")}}" method="POST">
                        <div class="form-group row">
                            @csrf
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="name" placeholder="Name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="email" name="email" placeholder="E-mail Address">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <textarea rows="8" class="form-control mb-3" name="message" placeholder="Message"></textarea>
                        @error('message')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input class="btn btn-success" type="submit" value="Send">
                    </form>
                </div>
            </section>
        </div>
    </div>

@endsection
