@extends("layouts.layoutUser")

@section("title")
    Login
@endsection


@section("mainContent")
    <div class="container">
        <!-- Content (replace with your e-mail address below)
    ================================================== -->
        <div class="main-content">
            <section>
                <div class="section-title">
                    <h2><span>Register</span></h2>
                </div>
                <div class="article-post">
                    <div class="row">
                        <div class="col-12">
                            @if(session()->has("errorM"))
                                <div class="alert alert-danger">
                                    {{session()->get("errorM")}}
                                </div>
                            @endif


                            @if(session()->has("successM"))
                                    <div class="alert alert-success">
                                        {{session()->get("successM")}}
                                    </div>
                                @endif
                        </div>
                    </div>
                    <form action="{{route("registered")}}" method="POST">
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                @csrf
                                <input class="form-control" type="text" name="first_name" placeholder="First Name">
                                @error('first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <input class="form-control" type="text" name="last_name" placeholder="Last Name">
                                @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <input class="form-control" type="text" name="username" placeholder="Username">
                                @error('username')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                                @error('password')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <input class="form-control" type="text" name="email" placeholder="Email">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <input class="form-control" type="text" name="street" placeholder="Street">
                                @error('street')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input class="btn btn-success" type="submit" value="Register">
                    </form>

                </div>
            </section>
        </div>
    </div>
@endsection
