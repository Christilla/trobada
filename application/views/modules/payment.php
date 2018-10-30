<form action="/payment" method="POST" id="payment-form">
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1"><span class="fas fa-stroopwafel">at</span></span>
		</div>
		<input type="email" class="form-control" name="mail" placeholder="Votre@mail.fr" value="<?= $member->email ?>" aria-label="Username" aria-describedby="basic-addon1" required>
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1"><i class="far fa-address-book"></i></span>
		</div>
		<input type="text" class="form-control" name="nom" placeholder="Nom" value="<?= $member->firstname ?>" aria-label="Username" aria-describedby="basic-addon1" required>
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1"><i class="far fa-address-book"></i></span>
		</div>
		<input type="text" class="form-control" name="prenom" placeholder="Prénom" value="<?= $member->lastname ?>" aria-label="Username" aria-describedby="basic-addon1" required>
	</div>
	<div class="form-group text-center">
		<div style="width: 100%;">
			<input style="width: 100%;" type="range" min="10" max="100" value="10" name="amount" id="amount">
		</div>
		<h1 id="value-range" style="width: 100%;" class="text-info font-weight-bold"></h1>
	</div>
	
	<div class="form-group">
		<label for="card-element">Carte</label>
		<div id="card-element">
		<!-- A Stripe Element will be inserted here. -->
		</div>
	</div>
	<div class="form-group">
		<div id="card-errors" class="has-text-danger has-text-centered" role="alert"></div>
	</div>
	<!-- Used to display Element errors. -->
	<div class="form-group">
		<button style="border-radius: 5px;" class="btn btn-primary">Valider</button>
	</div>
</form>
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="<?= base_url()."assets/js/payment.js" ?>"></script>