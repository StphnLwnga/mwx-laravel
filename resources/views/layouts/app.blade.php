<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/png"
		href="https://res.cloudinary.com/moworx/image/upload/v1632776148/moworx%20site/Moworx_Logo_-_512x509_qeghqf.png" />
	<link rel="icon" type="image/png"
		href="https://res.cloudinary.com/moworx/image/upload/v1632776148/moworx%20site/Moworx_Logo_-_512x509_qeghqf.png" />

	<title>@yield('title')</title>

	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;800&display=swap"
		rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
	<link href="//db.onlinewebfonts.com/c/2d8cf0a1ae3cf90fc45730a9e56b1db2?family=GD+Boing" rel="stylesheet"
		type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
		integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
		integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script async defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
		</script>
	<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js"
		integrity="sha512-cyAbuGborsD25bhT/uz++wPqrh5cqPh1ULJz4NSpN9ktWcA6Hnh9g+CWKeNx2R0fgQt+ybRXdabSBgYXkQTTmA=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	@yield('preprocess_script')

	<style>
		body {
			font-family: 'Montserrat', sans-serif;
			position: inherit;
			width: 100%;
		}

		.footer {
			position: absolute;
			bottom: 0;
			width: 100%;
		}

		.footer .row .col-6 {
			padding: 0 3%;
			font-size: 12px;
			font-family: 'Montserrat';
			font-weight: 400;
		}

		.footer .row .col-6:nth-child(2) {
			text-align: right;
		}

		.fa-spinner {
			margin-top: 5%;
			width: 220px;
			height: 220px;
			color: #8ec444;
			-webkit-animation: spin 2s linear infinite;
			/* Safari */
			animation: spin 2s cubic-bezier(0, -2, 0, 1) infinite;
		}

		/* Safari */
		@-webkit-keyframes spin {
			0% {
				-webkit-transform: rotate(0deg);
			}

			100% {
				-webkit-transform: rotate(360deg);
			}
		}

		@keyframes spin {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}
	</style>

</head>

<body>
	<div class="container-fluid" style="margin: 5% 0;">
		@yield('content')
	</div>
	<footer class="footer mt-auto py-1 bg-dark text-light">
		<div class="row" style="display:flex;">
			<div class="col-6">
				<span class="text-light">Moworx Kenya, <span id="date-display"></span>. A product of Native Ideas
					Kenya.</span>
			</div>
			<div class="col-6">
				<span>Terms of service</span> <span>Privacy Policy</span>
			</div>
		</div>
	</footer>

	<script type="text/javascript">
		const dateDisplay = new Date().getFullYear() === 2021 ? '2021' : `2021 - ${new Date().getFullYear()}`;
		document.querySelector('#date-display').innerHTML = dateDisplay;
	</script>
</body>

</html>