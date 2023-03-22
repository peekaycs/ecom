<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- header-->
        @include('front.common.head')
        <!-- end of header-->
    </head>
    <body>
        @include('front.common.nav')
        
        <!-- main content -->
        @yield('content') 
        <!-- end main content -->

        @include('front.common.footer')
    </body>
    @include('front.common.script')
    <!-- script -->
    @yield('script') 
    <!-- end script -->
</html>