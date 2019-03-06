<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="default-src *; style-src 'self' https://fonts.googleapis.com https://netdna.bootstrapcdn.com http://code.jquery.com 'unsafe-inline'; script-src 'self' 'unsafe-inline' https://ajax.googleapis.com https://cdnjs.cloudflare.com 'unsafe-eval'">


    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Radicalhash</title>



    <!-- Styles -->

    <link href="{{ asset('public/AssetsAdmin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/AssetsAdmin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/AssetsAdmin/bower_components/Ionicons/css/ionicons.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/AssetsAdmin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/AssetsAdmin/plugins/iCheck/square/blue.css') }}" rel="stylesheet">

    <link href="{{ asset('public/css/admincustome.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--<- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <!-- Google Font -->

    <link href="{{ 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic' }}" rel="stylesheet">

    {{-- Scripts --}}

    <script src="{{ 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js' }}"></script>

</head>

<body class="hold-transition login-page" >

    @include('admin.layouts.elements.pageLoader')

    {{-- Body --}}

    @yield('content')

    

    <!-- Scripts -->

    <script src="{{ asset('public/AssetsAdmin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('public/AssetsAdmin/plugins/iCheck/icheck.min.js') }}"></script>

    <script type="text/javascript">



      $(window).load(function() {

        $("#pageloader").fadeOut("slow");

      });



      $(function () {

        $('input').iCheck({

          checkboxClass: 'icheckbox_square-blue',

          radioClass: 'iradio_square-blue',

          increaseArea: '20%' // optional

        });

      });



    </script>
@stack('footer-jquery')
</body>

</html>

