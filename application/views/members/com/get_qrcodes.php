<section class="qrcode-wrap">
<!--	<header>-->
		<h1 id="rubrique"><?= $title ?></h1>
<!--	</header>-->

	<div class="container-fluid">
		<div class="row">
			<p>
				Voici la liste des QR Codes de vos produits associés au festival <span class="subtitle"><?= $oEvent->title ?></span>
			</p>
		</div>
		<div class="row">
			<a href="<?= current_url() ?>/print" class="mb-3 btn btn-primary">Imprimer</a>
		</div>
		<div class="row justify-content-center">
			<nav aria-label="list qrcode">
				<ul class="pagination">
					<?= $pagination ?>
				</ul>
			</nav>
		</div>
		<div class="parent-row-tile wrap-content mt-3">
			<div class="card-columns">
			<?php foreach ($aoProducts as $oProduct): ?>
				
				<div class="card">
						<div class="card-header bg-primary text-white font-weight-bold">
							<?= $oEvent->title ?>
						</div>
						<div class="row card-body">
							<div class="col-4">
								<img style="width: 18rem; height: auto;" class="qrcode image is-96x96" src="<?= base_url().$oProduct->qrcode ?>" alt="logo">
							</div>
							<div class="col-8">
								<ul class="list-group">
									<li class="list-group-item"><?= $oProduct->name ?></li>
									<li class="list-group-item">Prix: <?= number_format(trim($oProduct->price, "0"), 2) ?></li>
									<li class="list-group-item"><?= $oProduct->description ?></li>
								</ul>
							</div>
						</div>
					</div>
			<?php endforeach; ?>
			</div>
		</div>
		<div class="row justify-content-center mb-3">
			<nav aria-label="list qrcode">
				<ul class="pagination">
					<?= $pagination ?>
				</ul>
			</nav>
		</div>
	</div>