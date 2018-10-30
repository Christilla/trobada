<?php //	var_dump($_SESSION) ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<title><?= $title ?></title>

<!--	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />-->
	<!--     <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>  -->
<!--	<link rel="stylesheet" type="text/css" href="assets/js/bootstrap.js" />-->



	<script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
	<script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
	<script src="<?= base_url() ?>assets/js/dashboard.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/nav_backoffice.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/member_style.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/dashboard.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/config_qrcodes.css" />

	<?php
	/**
	 * include css file dynamically
	 */
		if(isset($addedCssFiles)){

			var_dump($addedCssFiles);
			switch(true){
				case(is_array($addedCssFiles)):
					foreach($addedCssFiles as $path):
						echo "<link rel='stylesheet' href='" . $path . "'/>";
					endforeach;
				break;

				default:
					var_dump($addedCssFiles);
					echo "<link rel='stylesheet' href='" . $addedCssFiles . "'/>";
				break;

			}
		}
	?>


<!--	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
<!--	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->



</head>


<body>

<nav class="navigation" id="menu">

	<a class="home-logo" href="<?= base_url() ?>home"><img class="logo" src="<?= base_url() ?>assets/img/logo.png" alt="logo"><span>Trobada</span></a>

<!--	<button class="" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">-->
<!--		<span class=""></span>-->
<!--	</button>-->

<!--	<div class="" id="navbarColor03">-->
		<ul class="nav-items">
			<li class="nav-item">
				<a class="nav-link" href="<?= site_url('home'); ?>">Accueil</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= site_url('team#team');?>">L'équipe Trobada</a>
			</li>
<!--			<li class="nav-item">-->
<!--				<a class="nav-link" href="--><?php //echo site_url('festival#festival');?><!--">Festivals</a>-->
<!--			</li>-->
			<li class="nav-item">
				<a class="nav-link" href="<?= site_url('partenaire#partenaires'); ?>">Partenaires</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?= site_url('contact#contact'); ?>">Contact</a>
			</li>
			<?php if(! isset($_SESSION['oMember'])): ?>
				<li class="nav-item">
					<a class="" href="<?= site_url('signin#signin') ?>" >Connexion</a>
				</li>
			<?php else: ?>
				<li class="nav-item">
					<a class="" href="<?= site_url('logout') ?>" >Déconnexion</a>
				</li>
			<?php endif ?>
		</ul>

<!--	</div>-->
</nav>

<div class="container">
<!-- <main> -->
	<!-- <div id="body"> -->

