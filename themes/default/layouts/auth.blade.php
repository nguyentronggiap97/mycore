<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ env('BACKEND_SITENAME') }}</title>

    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('admin/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme styles -->
    <link href="{{ asset('admin/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/skins/' . env('BACKEND_SKIN') . '.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme plugins -->
    <link href="{{ asset('admin/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme override -->
    <link href="{{ asset('admin/css/override.css') }}" rel="stylesheet" type="text/css" />

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('admin/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!-- iCheck plugin -->
    <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @stack('styles')

    <script type="text/javascript">
        window.cedu = {};
        window.cedu.env = {};
        window.cedu.lang = 'vi';
        window.cedu.config = {};
        window.cedu.backend = "{{ url(config('backend.route')) }}";
        window.cedu.frontend = "{{ url('') }}";
        window.cedu.csrf = '{{ csrf_token() }}';
        window.cedu.user = {!! json_encode(Auth::user()) !!};
    </script>
</head>

<body class="skin-white show-number @yield('body:class')">
    @yield('content')
    @stack('scripts')
</body>
</html>
