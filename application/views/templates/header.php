	<?php //	var_dump($_SESSION) ?>
<html>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "theme": "classic",
  "content": {
    "message": "Ce site Internet utilise des cookies pour vous garantir une meilleure expérience utilisateur",
    "dismiss": "Accepter",
    "link": "En Savoir plus",
    "href": "https://www.cnil.fr/fr/exemple-de-bandeau-cookie"
  }
})});
</script>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title><?= $title ?></title>
 
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" /> 
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap.js" /> 
    <link rel="stylesheet" href="assets/css/style.css" />

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 

     <script src="assets/js/jquery.js"></script>


  </head>


<body>
<noscript>
  <div class="badge badge-danger w-100 sticky-top" style='border-radius: 0px;'>
    <h3 class='text-white font-weight-bold'>
	Javascript doit être activé pour profiter pleinement du site.
    </h3>
  </div>
  </noscript>

<nav class="navbar navbar-expand-lg navbar-light bg-light" id="menu">
	<img class="img-fluid d-xl-block d-none" src="assets/img/logo.png" alt="logo">

	<a class="navbar-brand font-weight-bold" href="/home">Trobada</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

  <div class="collapse navbar-collapse" id="navbarColor03">
        <ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('/home#home'); ?>">Accueil</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('/team#team');?>">L'équipe Trobada</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('/festival#festival');?>">Festivals</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('/partenaire#partenaires'); ?>">Partenaires</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('/contact#contact'); ?>">Contact</a>
			</li>
			<?php if(! isset($_SESSION['oMember'])): ?>
				<li class="nav-item" >
					<a class="nav-link" href="<?php echo site_url('/signup#signup'); ?>" >Inscription</a>
				</li>
				<li class="nav-item">
					<a class="nav-link bg-info text-light rounded " href="<?php echo site_url('/signin#signin') ?>" >Connexion</a>
				</li>
			<?php else: ?>
				<li class="nav-item">
					   <a class="nav-link bg-info text-light rounded " href="<?php echo site_url('/logout') ?>" >Déconnexion</a>
				</li>
				<li class="nav-item">
					   <a class="nav-link bg-success text-light rounded " href="<?php echo site_url('/dashboard') ?>" >Mon profil</a>
				</li>
			<?php endif ?>
        </ul>
  
  </div>
</nav>

<img src="assets/img/picture.jpg" class="img-fluid" alt="trobada carte">



<div class="container-fluid">

