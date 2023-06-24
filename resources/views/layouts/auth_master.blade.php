<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('asset') }}/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('dashboard') }}/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{ asset('asset') }}/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{ asset('asset') }}/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('asset') }}/css/pace.min.css" rel="stylesheet" />
	<script src="{{ asset('asset') }}/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('asset') }}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('asset') }}/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('asset') }}/css/app.css" rel="stylesheet">
	<link href="{{ asset('asset') }}/css/icons.css" rel="stylesheet">
	<title>{{ env('APP_NAME') }} – @yield('title')</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<div class="authentication-header"></div>
		@yield('content')
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('asset') }}/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ asset('asset') }}/js/jquery.min.js"></script>
	<script src="{{ asset('asset') }}/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ asset('asset') }}/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ asset('asset') }}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="{{ asset('asset') }}/js/app.js"></script>
</body>

</html>
