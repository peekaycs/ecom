<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{$page_title ?? ''}}</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{URL::asset('assets/admin/img/icon.ico')}}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{URL::asset('assets/admin/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{URL::asset('/assets/admin/css/fonts.min.css')}}"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{URL::asset('assets/admin/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('assets/admin/css/atlantis.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('assets/admin/css/custom.css')}}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{URL::asset('/assets/admin/css/demo.css')}}">