
<!-- <div class="jumbotron jumbotron-fluid"> -->
<h1 id="infos"><?= $title ?></h1>
<p class="lead">Bienvenue, <?= $member->firstname ?> !</p>
<!--<p>Vous êtes connecté en tant que  <strong>--><?php //echo $member->role_long_name ?><!--</strong></p>-->
<?php foreach($this->session->flashdata() as $message){ ?>
	<div class="alert alert-success" role="alert"><?= $message ?></div>
<?php } ?>

<!-- Fin Jumbotron -->

<!-- Premier paragraphe -->
<div class="row">
	<div class="col-sm-6">
		<div class="card m-3" style="min-height: 530px;">
			<div class="card-body">
				<h2 id="profile" class="card-title">Informations de profil</h2>

<!--				--><?php //echo (($this->session->flashdata('profile_update_message')) != null) ? $this->session->flashdata('profile_update_message') : ""; ?>

				<form action="#infos" method="post" class="dashboard-form">

					<div class="form-group">
						<label for="pseudo" class="label is-small" >Votre pseudo : &nbsp;</label>
						<input type="text" class="form-control" name="pseudo" disabled="disabled"  value="<?= set_value('pseudo',  isset($member->pseudo)?$member->pseudo:'') ?>" id="pseudo" placeholder="<?= isset($member->pseudo)?$member->pseudo:'Saisissez votre pseudo' ?>">
					</div>

					<?= form_error('email') ?>

					<div class="form-group">
						<label for="email">Votre email : &nbsp;</label>
						<input type="email"  class="form-control" name="email"  id="exampleInputEmail1" value="<?= set_value('email',  isset($member->email)?$member->email:'') ?>" placeholder="<?= isset($member->email)?$member->email:'Saisissez votre email' ?>">

					</div>

					<h5 class="card-title">Réinitialisation de votre mot de passe</h5>

					<?= form_error('password') ?>
					<div class="form-group">
						<label for="password" class="label is-small">Votre nouveau mot de passe : &nbsp;</label>
						<input type="password" class="form-control"  name="password"  id="password" value="<?= set_value('password') ?>"  placeholder="Nouveau mot de passe">
					</div>

					<?= form_error('confirm_password') ?>
					<div class="form-group">
						<label for="confirm_password" class="label is-small" >Confirmez votre mot de passe : &nbsp;</label>
						<input type="password" class="form-control" name="confirm_password" id="confirm_password" value="<?= set_value('confirm_password') ?>" placeholder="Confirmation mot de passe">
					</div>
					<button class="btn btn-primary" type="submit" name="update_profil" value="Modifier">Modifier</button>
				</form>
			</div>
		</div>
	</div>
	<!-- FIN premier paragraphe -->

	<!-- Deuxième paragraphe -->
	<div class="col-sm-6">
		<div class="card m-3">
			<div class="card-body" style="min-height: 530px;">
				<h2 class="card-title">Informations personnelles</h2>

			<?php //echo (($this->session->flashdata('infos_update_message')) != null) ? $this->session->flashdata('infos_update_message') : ""; ?>
				<form action="#infos" method="post" class="dashboard-form">

					<?php if($this->session->userdata('oMember')->role !== "FEST"): ?>
					<h5 class="card-title">Votre Enseigne</h5>
					<?= form_error('company_name') ?>
					<div class="row">
						<div class="col form-group">
							<label for="company_name" class="label is-small" >Nom de votre entreprise :</label>
							<input type="text" class="form-control" name="company_name" id="company_name" value="<?= set_value('company_name',  isset($member->company_name)?$member->company_name:'') ?>" id="lastname" placeholder="">
						</div>
					</div>
					<?php endif; ?>

					<h5 class="card-title">Civilité</h5>
					<?= form_error('lastname') ?>
					<div class="row">
						<div class="col form-group">
							<label for="lastname" class="label is-small" >Votre nom : &nbsp;</label>
							<input type="text" class="form-control" name="lastname" value="<?= set_value('lastname',  isset($member->lastname)?$member->lastname:'') ?>" id="lastname" placeholder="">
						</div>


						<?= form_error('firstname') ?>
						<div class="col form-group">
							<label for="firstname" class="label is-small" >Votre prénom : &nbsp;</label>
							<input type="text" class="form-control" name="firstname" value="<?= set_value('firstname',  isset($member->firstname)?$member->firstname:'') ?>" id="firstname" placeholder="">
						</div>
					</div>

					<h5 class="card-title">Adresse</h5>
					<?= form_error('address') ?>
					<div class="form-group">
						<label for="address" class="label is-small" >Votre adresse : &nbsp;</label>
						<input type="text" class="form-control" name="address" value="<?= set_value('address',  isset($member->address)?$member->address:'') ?>" id="address" placeholder="">
					</div>

					<div class="row">
						<?= form_error('post_code') ?>
						<div class="col form-group">
							<label for="post_code" class="label is-small" >Code postal : &nbsp;</label>
							<input type="text" class="form-control" name="post_code" value="<?= set_value('post_code',  isset($member->post_code)?$member->post_code:'') ?>" id="post_code" placeholder="">
						</div>

						<?= form_error('town') ?>
						<div class="col from-group">
							<label for="town" class="label is-small" >Ville : &nbsp;</label>
							<input type="text" class="form-control" name="town" value="<?= set_value('town',  isset($member->town)?$member->town:'') ?>" id="town" placeholder="">
						</div>
					</div>
					<button class="btn btn-primary" type="submit" name="update_infos" value="Modifier">Modifier</button>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Fin deuxième paragraphe -->
