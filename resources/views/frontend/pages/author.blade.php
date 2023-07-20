@extends("layouts.layoutUser")

@section("title")
    Author
@endsection

@section("script")
    @include("frontend.fixed.scriptAuthor")
@endsection

@section("mainContent")


    <div class="container">
        <!-- Content
    ================================================== -->
        <div class="main-content">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="author-div">
                            <img src="{{asset("assets/images/author.jpg")}}" class="img-fluid author-img" alt="Img author">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h3 class="text-capitalize mb-5">About author</h3>
                        <p>First name: Ignjat</p>
                        <p>Last name: Koički</p>
                        <p>Index: 220/21</p>
                        <p>Biography: I was born on January 26, 1997 in Novi Sad. Elementary school and
                            and high school I finished in Belgrade. I'm attending ICT college now.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
