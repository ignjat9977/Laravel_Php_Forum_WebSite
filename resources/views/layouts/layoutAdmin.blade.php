<!DOCTYPE html>
<html lang="en">

@include("frontend.fixedAdmin.head")
<body>
<div class="container-fluid position-relative d-flex p-0">
@include("frontend.fixedAdmin.spiner")
@include("frontend.fixedAdmin.sidebar")





    <!-- Content Start -->
    <div class="content">
        @include("frontend.fixedAdmin.navigation")

        @yield("modal")
        @yield("content")


       @include("frontend.fixedAdmin.footer")
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
@include("frontend.fixedAdmin.scripts")
@yield("script")

</body>

</html>
