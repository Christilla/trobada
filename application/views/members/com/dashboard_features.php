<div class="card m-3">
	<div class="card-body">
		<h2 class="card-title">Statistiques de mes ventes</h2>
		<div class="card-deck mb-3">
			<!-- <div class="card mb-3" style="min-width: 18rem; width: 18rem;"> -->
				<div class="card-body">
					<h6 class="card-title">Nb de festivals auxquels j'ai participé</h6>
					<h2><?= $participation ?></h2>
				</div>
			<!-- </div> -->
			<!-- <div class="card mb-3" style="min-width: 18rem; width: 18rem;"> -->
				<div class="card-body">
					<h6 class="card-title">Le plus gros chiffre d'affaire</h6>
					<h2><?php if(is_object($CA['maxCA'])){ echo $CA['maxCA']->amount; }else{ echo 'n/a'; } ?>&nbsp;€</h2>
				</div>
			<!-- </div> -->
			<!-- <div class="card mb-3" style="min-width: 18rem; width: 18rem;"> -->
				<div class="card-body">
					<h6 class="card-title">Le plus petit chiffre d'affaire</h6>
					<h2><?php if(is_object($CA['minCA'])){ echo $CA['minCA']->amount; }else{ echo 'n/a'; } ?>&nbsp;€</h2>
				</div>
			<!-- </div> -->
			<!-- <div class="card mb-3" style="min-width: 18rem; width: 18rem;"> -->
				<div class="card-body">
					<h6 class="card-title">Moyenne des CA</h6>
					<h2><?= str_replace(',', '',number_format($averageCA, 2)) ?>&nbsp;€</h2>
				</div>
			<!-- </div> -->
		</div>
		<a style="border-radius: 5px;" class="btn btn-primary" href="<?= site_url() ?>sales-history">Historique de mes ventes</a>
	</div>
</div>
