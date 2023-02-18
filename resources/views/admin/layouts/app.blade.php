<!DOCTYPE html>
<html lang="en">
<head>
 <!-- header-->
   @include('admin.includes.header')
   <!-- end of header-->
</head>
<body>
<div class="wrapper">
   <!-- top navigation -->
       @include('admin.includes.nav')
   <!-- end top navigation -->
   <!-- side navigation -->
        @include('admin.includes.sidenav')
   <!-- end side navigation -->
   <!-- main content -->
   <div class="main-panel">
		<div class="content">
            @include('admin.includes.panel-header')
            @yield('content')
        </div>
        @include('admin.includes.footer')
   </div>
   <!-- end main content -->
   
    @include('admin.includes.setting')
</div>
    @include('admin.includes.scripts')
</body>
</html>