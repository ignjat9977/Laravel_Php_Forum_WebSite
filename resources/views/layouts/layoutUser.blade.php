<!DOCTYPE html>
<html lang="en">
    @include("frontend.fixed.head")
<body class="layout-default">
    <!-- Begin Menu Navigation
    ================================================== -->
        @include("frontend.fixed.header")
    <!-- End Menu Navigation
    ================================================== -->
    <div class="site-content">
        <!-- Home Jumbotron
        ================================================== -->
            @yield("cover")


        <!-- Container
        ================================================== -->
            @yield("mainContent")
        <!-- /.container -->




        <!-- Before Footer
        ================================================== -->
            @include("frontend.fixed.footerBefore")
        <!-- Begin Footer
        ================================================== -->
            @include("frontend.fixed.footer")
        <!-- End Footer
        ================================================== -->
    </div>


    <!-- JavaScript
    ================================================== -->
        @include("frontend.fixed.basicScripts")
        @yield("script")
</body>
</html>
