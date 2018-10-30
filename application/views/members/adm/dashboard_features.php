<div class="card m-3">
	<div class="card-body">
		<h2 class="card-title">Statistiques</h2>
		<div class="card-deck mb-3">
			<!-- <div class="card mb-3" style="min-width: 18rem; width: 18rem;"> -->
			
				<div class="card-body">
					<h5 class="card-title">Nb d'utilisateurs inscrits</h5>
					<h1><?= $nbrUser ?></h1>
				</div>
			<!-- </div> -->
			<!-- <div class="card mb-3" style="min-width: 18rem; width: 18rem;"> -->
				<div class="card-body">
					<h5 class="card-title">Le plus gros revenu</h5>
					<h1><?php if(is_object($CA['maxCA'])){ echo $CA['maxCA']->amount; }else{ echo 'n/a'; } ?>€</h1>
					<p class="card-text"><small class="text-muted"><?php if(is_object($CA['maxCA'])){ echo $CA['maxCA']->title.' - '.$CA['maxCA']->place; } ?></small></p>
				</div>
			<!-- </div> -->
			<!-- <div class="card mb-3" style="min-width: 18rem; width: 18rem;"> -->
				<div class="card-body">
					<h5 class="card-title">Le plus petit revenu</h5>
					<h1><?php if(is_object($CA['minCA'])){ echo $CA['minCA']->amount; }else{ echo 'n/a'; } ?>€</h1>
					<p class="card-text"><small class="text-muted"><?php if(is_object($CA['minCA'])){ echo $CA['minCA']->title.' - '.$CA['minCA']->place; } ?></small></p>
				</div>
			<!-- </div> -->
			<!-- <div class="card mb-3" style="min-width: 18rem; width: 18rem;"> -->
				<div class="card-body">
					<h5 class="card-title">Total des revenus</h5>
					<h1><?php if(is_object($CAtotal)){ echo $CAtotal->amount; }else{ echo $CAtotal; }  ?>€</h1>
				</div>
			<!-- </div> -->
		</div>
		<a href="<?= site_url() ?>sales-history"><button type="button" class="btn btn-primary text_light"> Gestion des commissions</button></a>
	</div>
</div>
