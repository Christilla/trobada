


<div class="row justify-content-md-center">
    <div class="col-lg-6 col-12">
        <h2 class="text-center" id="signin">Connexion</h2>
		<?php echo (($this->session->flashdata('success')) != null) ? $this->session->flashdata('success') : ""; ?>

			<!-- <h1><= $title ?></h1> -->

			<?= form_open('signin'); ?>
				<?= (($this->session->flashdata('login_error')) != null) ? $this->session->flashdata('login_error') : ""; ?>
				<?= form_error('pseudo'); ?>
				<div class="form-group row">
					<label for="pseudo" class="col-sm-2 col-form-label" >Votre pseudo: </label>
					<div class="col-sm-10">
					<input type="text" class="form-control" name="pseudo" value="<?= set_value('pseudo') ?>" id="pseudo"  placeholder="Saisissez votre pseudonyme">
					</div>
				</div>
				<?= form_error('password'); ?>
				<div class="form-group row">
					<label for="password" class="col-sm-2 col-form-label" >Votre mot de passe : </label>
					<div class="col-sm-10">
					<input type="password" class="form-control" name="password" value="<?= set_value('password') ?>" id="password"  placeholder="Saisissez votre mot de passe">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-sm-10">
					<input type="submit" name="login" class="btn btn-info" id="login" value="Se connecter">
					</div>				
				</div>

			<?= form_close(); ?>
	</div>
</div>	
