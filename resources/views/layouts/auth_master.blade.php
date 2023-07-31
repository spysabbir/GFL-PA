<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="{{ env('APP_NAME') }}">
    <meta name="author" content="{{ env('APP_NAME') }}">

    <link rel="icon" href="favicon.ico" type="image/x-icon"/>

    <title>:: {{ env('APP_NAME') }} :: @yield('title')</title>

    <!-- Bootstrap Core and vandor -->
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/bootstrap/css/bootstrap.min.css" />
    <!-- Core css -->
    <link rel="stylesheet" href="{{ asset('asset') }}/css/main.css"/>
    <link rel="stylesheet" href="{{ asset('asset') }}/css/theme1.css" id="stylesheet"/>

</head>
<body class="font-opensans">

    @yield('content')

    <!-- jQuery and bootstrtap js -->
    <script src="{{ asset('asset') }}/bundles/lib.vendor.bundle.js"></script>
    <!-- Start core js and page js -->
    <script src="{{ asset('asset') }}/js/core.js"></script>
</body>
</html>
