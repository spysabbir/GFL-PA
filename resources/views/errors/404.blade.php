<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta name="description" content="{{ env('APP_NAME') }}">
<meta name="author" content="{{ env('APP_NAME') }}">

<link rel="icon" href="favicon.ico" type="image/x-icon"/>

<title>:: {{ env('APP_NAME') }} :: 404</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="{{ asset('asset') }}/plugins/bootstrap/css/bootstrap.min.css" />

<!-- Core css -->
<link rel="stylesheet" href="{{ asset('asset') }}/css/main.css"/>
<link rel="stylesheet" href="{{ asset('asset') }}/css/theme1.css" id="stylesheet"/>

</head>
<body class="font-opensans">

<div class="auth">
    <div class="card">
        <div class="card-body">
            <div class="display-3 text-muted mb-5"><i class="si si-exclamation"></i> 404</div>
            <h1 class="h3 mb-3">Oops.. You just found an error page..</h1>
            <p class="h6 text-muted font-weight-normal mb-3">We are sorry but our service is currently not available&hellip;</p>
            <a class="btn btn-primary" href="javascript:history.back()"><i class="fe fe-arrow-left mr-2"></i>Go back</a>
        </div>
        <div class="card-footer text-center mt-3">
            <button type="button" class="btn btn-icon btn-facebook"><i class="fa fa-facebook"></i></button>
            <button type="button" class="btn btn-icon btn-twitter"><i class="fa fa-twitter"></i></button>
            <button type="button" class="btn btn-icon btn-google"><i class="fa fa-google"></i></button>
            <button type="button" class="btn btn-icon btn-youtube"><i class="fa fa-youtube"></i></button>
            <button type="button" class="btn btn-icon btn-vimeo"><i class="fa fa-vimeo"></i></button>
        </div>
    </div>
</div>

<!-- jQuery and bootstrtap js -->
<script src="{{ asset('asset') }}/bundles/lib.vendor.bundle.js"></script>

<!-- start plugin js file  -->
<!-- Start core js and page js -->
<script src="{{ asset('asset') }}/js/core.js"></script>
</body>
</html>
