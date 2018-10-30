<h1><?= $title ?></h1>

<?php foreach($this->session->flashdata() as $message){ ?>
	<div class="alert alert-success" role="alert"><?= $message ?></div>
<?php } ?>

<p>
	Voici la liste des festivals sur lesquels vous vous êtes positionnés dans la rubrique
	<a href="<?= site_url('incoming-events') ?>">Les festivals à venir</a>.
</p>
<p>Cliquez sur le festival pour lequel vous désirez obtenir les QR Codes produits.</p>
	<?php if(isset($aoEvents)): ?>
	<div class="card-columns">
	<?php foreach($aoEvents as $oEvent): ?>
		
		<div class="card" >
		<h5 class="card-header bg-primary text-light"><?= $oEvent->title ?>	</h5>
		<a class="text-dark" style="text-decoration:none" href="<?= site_url('get-qrcodes/' . $this->session->userdata('oMember')->id . '/' . $oEvent->id) ?>">
				<div class="card-body">
					<p class="card-text font-weight-bold" >Lieu : <?= $oEvent->place ?></p>
					<p class="card-text"><strong> Dates : </strong> <?php $date = new DateTime($oEvent->starting_date); echo date_format($date, 'd/m/Y') ?> au <?php $date = new DateTime($oEvent->ending_date); echo date_format($date, 'd/m/Y') ?></p>
					<p class="card-text"><?= $oEvent->description ?>.</p>
					
				</div>
			</a>
		</div>
		
	<?php endforeach; ?>
	</div>
	<?php else: ?>
	<p>Aucun événement a afficher !</p>
	<?php endif; ?>
