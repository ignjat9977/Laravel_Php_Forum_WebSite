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
                <h2><span>Login</span></h2>
            </div>
            <div class="article-post">
                <form action="{{route("logIn")}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-12">
                            <input class="form-control" type="text" name="loginEmail" placeholder="Email">
                        </div>
                        <div class="col-12 mt-4">
                            <input class="form-control" type="password" name="loginPassword" placeholder="Password">
                        </div>
                    </div>
                    <input class="btn btn-success" type="submit" value="Login">
                    @if(session()->has("loginError"))
                        <div class="alert alert-danger" role="alert">
                            {{session()->remove("loginError")}}
                        </div>

                    @endif

                </form>
            </div>
        </section>
    </div>
</div>
@endsection
