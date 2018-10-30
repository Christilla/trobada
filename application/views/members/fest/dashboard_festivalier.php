<article id="moncompte" class="message is-info is-medium">
	<div class="message-header">
		<p>Mon compte Trobadollar</p>
	</div>
	<div class="message-body">
		<div class="columns is-multiline">
			<div class="column is-narrow" style="width: 50%;">
				<div class="field">
					<p class="">Votre solde est de :</p>
					<p class="has-text-weight-bold is-size-1 has-text-primary"><?php if(is_null($member->balance)){echo number_format(0.00, 2, ',', ' ');}else{echo $member->balance;} ?> €</p>
				</div>
			</div>		
			<div style="width: 100%;" class="column is-narrow">
				<div class="card">
					<header class="card-header">
						<p class="card-header-title">Historique de recharge</p>
						<button id="payment-modal" class="button is-primary is-pulled-right">Recharger</button>
					</header>
					<div class="card-content" style="max-height: 350px; overflow-y: scroll;">
						<div class="content">
							<table class="table">
								<thead>
									<th>#ID</th>
									<th>Montant</th>
									<th>Status</th>
									<th>Message</th>
									<th>Fait le</th>
								</thead>
								<tbody>
									<?php $i = 1; foreach($payment_info as $info){ ?>
									<tr>
										<th><?= $i ?></th>
										<td><?= $info->amount ?>€</td>
										<td><?php if($info->success){ ?><span class="tag is-success">Accepté</span><?php } elseif($info->success == null){ ?><span class="tag is-warning">Pending</span><?php } else { ?><span class="tag is-danger">Refusé</span><?php } ?></td>
										<td><?= $info->message ?></td>
										<td><?php $date = new DateTime($info->created_at); echo date_format($date, 'd/m/Y H\hi'); ?></td>
									</tr>
									<?php $i++; } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal">
		<div class="modal-background"></div>
		<div class="modal-content">
			<?= $payment ?>
		</div>
		<button class="modal-close is-large" aria-label="close"></button>
	</div>
</article>
