<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <title>@yield('title') - {{ env('BACKEND_SITENAME') }}</title>

    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('admin/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme styles -->
    <link href="{{ asset('admin/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/skins/' . env('BACKEND_SKIN') . '.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme override -->
    <link href="{{ asset('admin/css/override.css') }}" rel="stylesheet" type="text/css" />

    @stack('styles')
    
    <script type="text/javascript">
        window.cedu = {};
        window.cedu.lang = 'vi';
        window.cedu.env = {};
        window.cedu.config = {};
        window.cedu.backend = "{{ url(config('backend.route')) }}";
        window.cedu.frontend = "{{ url('') }}";
        window.cedu.url = function(url) { return window.cedu.frontend + url};
        window.cedu.route = function(url) { return window.cedu.backend + url};
        window.cedu.back = function() {window.history.back();};
    </script>

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('admin/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!-- jquery.validate + select2 -->
    <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/plugins/select2/i18n/' . config('app.locale') . '.js') }}" type="text/javascript"></script>

    <!-- Datetimepicker -->
    <script src="{{ asset('admin/plugins/bootstrap-datetimepicker/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin/plugins/stickytabs/jquery.stickytabs.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin/js/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/locales/' . config('app.locale') . '.js') }}" type="text/javascript"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="skin-white show-number sidebar-mini fixed @yield('body:class')">
<div class="wrapper">

	@include('backend::partials.header')
    @include('backend::partials.sidebar')

	<div class="content-wrapper">
        @hasSection('header')
        <section class="content-header">
            @yield('header')
        </section>
        @endif

		<section class="content @yield('content:class')">
			@yield('content')
		</section>
	</div>

	@include('backend::partials.control')
    @include('backend::partials.footer')

</div>

<!-- Include start: fileupload  -->
@include('backend::partials.fileupload')
<!-- Include end: fileupload  -->

<!-- Stack start: scripts  -->
@stack('scripts')
<!-- Stack end: scripts  -->

<!-- Stack start: assets  -->
@stack('assets')
<!-- Stack end: assets  -->

</body>
</html>
