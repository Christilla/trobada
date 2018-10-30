<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<title><?= $title ?></title>

	<?php
	if(isset($css_files)):
		foreach($css_files as $file):
			?>
			<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php
		endforeach;
	endif;
	?>
	<?php
	/**
	 * include css file dynamically
	 */
	if(isset($addedCssFiles)){

		switch(true){
			case(is_array($addedCssFiles)):
				foreach($addedCssFiles as $path):
					echo "<link rel='stylesheet' href='" . base_url() . $path . "'/>";
				endforeach;
				break;

			default:
				echo "<link rel='stylesheet' href='" . base_url() . $addedCssFiles . "'/>";
				break;

		}
	}
	?>

	<script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>

	<script
		src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous">
	</script>
	<script
		src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
		integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
		crossorigin="anonymous"></script>
		
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" />
	<script src="<?= base_url() ?>assets/js/dashboard.js"></script>

	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/js/bootstrap.js" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css" />

	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/event.js"></script>
	<script type='text/javascript' src="<?php echo base_url() ?>assets/js/manage_events.js"></script>

	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous">
	</script>

	<script 
		src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous">
	</script>

</head>


<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary" id="menu">
	<img class="img-fluid d-xl-block d-none" src="<?= base_url() ?>assets/img/logo.png" alt="logo">

	<a class="navbar-brand font-weight-bold" href="/home">Trobada</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarColor03">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item"><a class="nav-link" href="<?php echo site_url('/home'); ?>">Accueil</a></li>
			<li class="nav-item"><a class="nav-link" href="<?php echo site_url('/team#team');?>">L'équipe Trobada</a></li>
			<li class="nav-item"><a class="nav-link" href="<?php echo site_url('/festival#festival');?>">Festivals</a></li>
			<li class="nav-item"><a class="nav-link" href="<?php echo site_url('/partenaire#partenaires'); ?>">Partenaires</a></li>
			<li class="nav-item"><a class="nav-link" href="<?php echo site_url('/contact#contact'); ?>">Contact</a></li>
		<?php if(! isset($_SESSION['oMember'])): ?>
			<li class="nav-item" ><a class="nav-link" href="<?php echo site_url('/signup#signup'); ?>" >Inscription</a></li>
			<li class="nav-item"><a class="nav-link bg-info text-light rounded " href="<?php echo site_url('/signin#signin') ?>" >Connexion</a></li>
		<?php else: ?>
			<li class="nav-item"><a class="nav-link bg-light text-dark rounded " href="<?php echo site_url('/logout') ?>" >Déconnexion</a></li>
			<li class="nav-item"><a class="nav-link bg-success text-light rounded " href="<?php echo site_url('/dashboard') ?>" >Mon profil</a></li>
		<?php endif ?>

		</ul>
	</div>
</nav>
<div class="container-fluid">
