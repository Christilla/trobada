<h1 class="title is-size-4" id="signin">Créer un évènement</h1>
<form action="create-festival" method="post" class="form-flex-row notification">
	<fieldset class="fieldset-group box has-width-60">
		<legend class="subtitle is-size-5 has-text-white">L'évènement</legend>
		<div class="form-group">
			<?= form_error('title'); ?>
			<label for="title" class="label">Quel est le nom de votre évènement ?</label>
			<input type="text" name="title" id="title" class="form-control" value="<?= set_value('title')?>">
		</div>
		<div class="form-group">
			<?= form_error('description') ?>
			<label for="description" class="label">Décrivez votre évènement :</label>
			<textarea name="description" id="description" class="input"><?= set_value('description')?></textarea>
		</div>
		<div class="form-group">
			<input type="submit" class="button is-link" value="Créer l'évènement">
		</div>
	</fieldset>
</form>
