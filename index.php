<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>APLIKASI SIKUPAT - DINAS KESEHATAN KABUPATEN JEPARA</title>
	<link rel="icon" href="assets/img/icon_jepara.png" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
		ol,
		ul {
			list-style: none !important;
		}

		.element:hover {
			/*animation-delay: 2s;*/
			animation: pulse 3s infinite;
			animation-direction: alternate;
		}

		.cb-slideshow,
		.cb-slideshow:after {
			position: fixed;
			width: 100%;
			height: 100%;
			top: 0px;
			left: 0px;
			z-index: 0;
		}

		.cb-slideshow:after {
			content: '';
			background: transparent url(assets/img/pattern.png) repeat top left;
		}

		.cb-slideshow li span {
			width: 100%;
			height: 100%;
			position: absolute;
			top: 0px;
			left: 0px;
			color: transparent;
			background-size: cover;
			background-position: 50% 50%;
			background-repeat: none;
			opacity: 0;
			z-index: 0;
			-webkit-backface-visibility: hidden;
			-webkit-animation: imageAnimation 42s linear infinite 0s;
			-moz-animation: imageAnimation 42s linear infinite 0s;
			-o-animation: imageAnimation 42s linear infinite 0s;
			-ms-animation: imageAnimation 42s linear infinite 0s;
			animation: imageAnimation 42s linear infinite 0s;
		}

		.cb-slideshow li div {
			z-index: 1000;
			position: absolute;
			bottom: 10px;
			left: 0px;
			width: 100%;
			text-align: right;
			opacity: 0;
			-webkit-animation: titleAnimation 36s linear infinite 0s;
			-moz-animation: titleAnimation 36s linear infinite 0s;
			-o-animation: titleAnimation 36s linear infinite 0s;
			-ms-animation: titleAnimation 36s linear infinite 0s;
			animation: titleAnimation 36s linear infinite 0s;
		}

		.cb-slideshow li div h3 {
			font-family: 'BebasNeueRegular', 'Arial Narrow', Arial, sans-serif;
			font-size: 30px;
			padding: 0 20px;
			line-height: 120px;
			color: #FFFFFF;
			/*color: rgba(169,3,41, 0.8);*/
		}

		.cb-slideshow li:nth-child(1) span {
			background-image: url(assets/img/img1.jpeg)
		}

		.cb-slideshow li:nth-child(2) span {
			background-image: url(assets/img/img2.jpeg);
			-webkit-animation-delay: 8s;
			-moz-animation-delay: 8s;
			-o-animation-delay: 8s;
			-ms-animation-delay: 8s;
			animation-delay: 8s;
		}

		.cb-slideshow li:nth-child(3) span {
			background-image: url(assets/img/img3.jpeg);
			-webkit-animation-delay: 12s;
			-moz-animation-delay: 12s;
			-o-animation-delay: 12s;
			-ms-animation-delay: 12s;
			animation-delay: 12s;
		}

		.cb-slideshow li:nth-child(4) span {
			background-image: url(assets/img/img4.jpeg);
			-webkit-animation-delay: 18s;
			-moz-animation-delay: 18s;
			-o-animation-delay: 18s;
			-ms-animation-delay: 18s;
			animation-delay: 18s;
		}

		.cb-slideshow li:nth-child(5) span {
			background-image: url(assets/img/img5.jpeg);
			-webkit-animation-delay: 24s;
			-moz-animation-delay: 24s;
			-o-animation-delay: 24s;
			-ms-animation-delay: 24s;
			animation-delay: 24s;
		}

		.cb-slideshow li:nth-child(6) span {
			background-image: url(assets/img/img6.jpeg);
			-webkit-animation-delay: 30s;
			-moz-animation-delay: 30s;
			-o-animation-delay: 30s;
			-ms-animation-delay: 30s;
			animation-delay: 30s;
		}

		.cb-slideshow li:nth-child(7) span {
			background-image: url(assets/img/img7.jpg);
			-webkit-animation-delay: 36s;
			-moz-animation-delay: 36s;
			-o-animation-delay: 36s;
			-ms-animation-delay: 36s;
			animation-delay: 36s;
		}

		@-webkit-keyframes imageAnimation {
			0% {
				opacity: 0;
				-webkit-animation-timing-function: ease-in;
			}

			8% {
				opacity: 1;
				-webkit-transform: scale(1.05);
				-webkit-animation-timing-function: ease-out;
			}

			17% {
				opacity: 1;
				-webkit-transform: scale(1.1) rotate(3deg);
			}

			25% {
				opacity: 0;
				-webkit-transform: scale(1.1) rotate(3deg);
			}

			100% {
				opacity: 0
			}
		}

		@-moz-keyframes imageAnimation {
			0% {
				opacity: 0;
				-moz-animation-timing-function: ease-in;
			}

			8% {
				opacity: 1;
				-moz-transform: scale(1.05);
				-moz-animation-timing-function: ease-out;
			}

			17% {
				opacity: 1;
				-moz-transform: scale(1.1) rotate(3deg);
			}

			25% {
				opacity: 0;
				-moz-transform: scale(1.1) rotate(3deg);
			}

			100% {
				opacity: 0
			}
		}

		@-o-keyframes imageAnimation {
			0% {
				opacity: 0;
				-o-animation-timing-function: ease-in;
			}

			8% {
				opacity: 1;
				-o-transform: scale(1.05);
				-o-animation-timing-function: ease-out;
			}

			17% {
				opacity: 1;
				-o-transform: scale(1.1) rotate(3deg);
			}

			25% {
				opacity: 0;
				-o-transform: scale(1.1) rotate(3deg);
			}

			100% {
				opacity: 0
			}
		}

		@-ms-keyframes imageAnimation {
			0% {
				opacity: 0;
				-ms-animation-timing-function: ease-in;
			}

			8% {
				opacity: 1;
				-ms-transform: scale(1.05);
				-ms-animation-timing-function: ease-out;
			}

			17% {
				opacity: 1;
				-ms-transform: scale(1.1) rotate(3deg);
			}

			25% {
				opacity: 0;
				-ms-transform: scale(1.1) rotate(3deg);
			}

			100% {
				opacity: 0
			}
		}

		@keyframes imageAnimation {
			0% {
				opacity: 0;
				animation-timing-function: ease-in;
			}

			8% {
				opacity: 1;
				transform: scale(1.05);
				animation-timing-function: ease-out;
			}

			17% {
				opacity: 1;
				transform: scale(1.1) rotate(3deg);
			}

			25% {
				opacity: 0;
				transform: scale(1.1) rotate(3deg);
			}

			100% {
				opacity: 0
			}
		}

		@-webkit-keyframes titleAnimation {
			0% {
				opacity: 0;
				-webkit-transform: translateX(200px);
			}

			8% {
				opacity: 1;
				-webkit-transform: translateX(0px);
			}

			17% {
				opacity: 1;
				-webkit-transform: translateX(0px);
			}

			19% {
				opacity: 0;
				-webkit-transform: translateX(-400px);
			}

			25% {
				opacity: 0
			}

			100% {
				opacity: 0
			}
		}

		@-moz-keyframes titleAnimation {
			0% {
				opacity: 0;
				-moz-transform: translateX(200px);
			}

			8% {
				opacity: 1;
				-moz-transform: translateX(0px);
			}

			17% {
				opacity: 1;
				-moz-transform: translateX(0px);
			}

			19% {
				opacity: 0;
				-moz-transform: translateX(-400px);
			}

			25% {
				opacity: 0
			}

			100% {
				opacity: 0
			}
		}

		@-o-keyframes titleAnimation {
			0% {
				opacity: 0;
				-o-transform: translateX(200px);
			}

			8% {
				opacity: 1;
				-o-transform: translateX(0px);
			}

			17% {
				opacity: 1;
				-o-transform: translateX(0px);
			}

			19% {
				opacity: 0;
				-o-transform: translateX(-400px);
			}

			25% {
				opacity: 0
			}

			100% {
				opacity: 0
			}
		}

		@-ms-keyframes titleAnimation {
			0% {
				opacity: 0;
				-ms-transform: translateX(200px);
			}

			8% {
				opacity: 1;
				-ms-transform: translateX(0px);
			}

			17% {
				opacity: 1;
				-ms-transform: translateX(0px);
			}

			19% {
				opacity: 0;
				-ms-transform: translateX(-400px);
			}

			25% {
				opacity: 0
			}

			100% {
				opacity: 0
			}
		}

		@keyframes titleAnimation {
			0% {
				opacity: 0;
				transform: translateX(200px);
			}

			8% {
				opacity: 1;
				transform: translateX(0px);
			}

			17% {
				opacity: 1;
				transform: translateX(0px);
			}

			19% {
				opacity: 0;
				transform: translateX(-400px);
			}

			25% {
				opacity: 0
			}

			100% {
				opacity: 0
			}
		}

		/* Show at least something when animations not supported */
		.no-cssanimations .cb-slideshow li span {
			opacity: 1;
		}

		@media screen and (max-width: 1140px) {
			.cb-slideshow li div h3 {
				font-size: 30px
			}
		}

		@media screen and (max-width: 600px) {
			.cb-slideshow li div h3 {
				font-size: 30px
			}
		}

		@keyframes pulse {
			0% {
				opacity: 1;
			}

			100% {
				opacity: 0.3;
			}
		}
	</style>
</head>

<body>
	<ul class="cb-slideshow">
		<li><span>Image 01</span>
			<div>
				<h3></h3>
			</div>
		</li>
		<li><span>Image 02</span>
			<div>
				<h3></h3>
			</div>
		</li>
		<li><span>Image 03</span>
			<div>
				<h3></h3>
			</div>
		</li>
		<li><span>Image 04</span>
			<div>
				<h3></h3>
			</div>
		</li>
		<li><span>Image 05</span>
			<div>
				<h3></h3>
			</div>
		</li>
		<li><span>Image 06</span>
			<div>
				<h3></h3>
			</div>
		</li>
		<li><span>Image 07</span>
			<div>
				<h3></h3>
			</div>
		</li>
	</ul>

	<div class="container-fluid p-4">
		<br>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="row p-3">
					<div class="col-md-3 col-sm-6 text-center">
					</div>
					<div class="col-md-3 col-sm-6 text-center">
						<a href="http://sikupat2020.sikdkkjepara.net/" class="element" target="_blank">
							<img src="assets/logo/keuangan.png" width="100px">
						</a>
						<h4 class="text-white mt-3">Tahun 2020</h4>
					</div>
					<div class="col-md-3 col-sm-6 text-center">
						<!-- <a href="http://sikupat.sikdkk.jepara.go.id/2021/" class="element" target="_blank">
							<img src="assets/logo/keuangan.png" width="100px">
						</a> -->
						<a href="http://sikupat.mi-kes.net/2021/" class="element" target="_blank">
							<img src="assets/logo/keuangan.png" width="100px">
						</a>
						<h4 class="text-white mt-3">Tahun 2021</h4>
					</div>
				</div>
				<div class="row p-3">
					<div class="col-md-12 text-center">
						<audio src="http://masima.rastream.com/masima-pramborsjakarta?" preload="auto" controls></audio>

					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>