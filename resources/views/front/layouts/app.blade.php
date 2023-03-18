<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- header-->
        @include('front.common.head')
        <!-- end of header-->
    </head>
    <body>
        @include('front.common.top_head')
        @include('front.common.slider')
        
        <!-- main content -->
        @yield('content') 
        <!-- end main content -->

        @include('front.common.footer')
    </body>
    @include('front.common.script')
</html>