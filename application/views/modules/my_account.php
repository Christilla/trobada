<div class="card-body">
    <h2 class="card-title">Mon compte Transparence</h2>
    <?php if($this->session->flashdata('payment') != null){ ?>
        <div class="alert alert-success" role="alert"><?= $this->session->flashdata('payment') ?></div>
    <?php } ?>
    <div class="row">
        <div class="col-6">
            <p style="font-size: 1.3rem;">Votre solde est de : </p>
            <h1 class="display-4 font-weight-bold text-info ml-5"><?php if(is_null($member->balance)){echo number_format(0.00, 2, ',', ' ');}else{echo $member->balance;} ?>€</h1>	
        </div>
        <div class="col-6">
        <img style="width: 12rem; height: auto;" class="float-right" src="<?= base_url().$member->qrcode ?>" alt="logo">
            <a href="dashboard/print" style="border-radius: 5px;" type="button" class="m-5 float-right btn btn-primary">
                Imprimer mon QRCode
            </a>
            <button style="border-radius: 5px;" type="button" class="m-5 float-right btn btn-primary" data-toggle="modal" data-target="#paymentModal">
                Recharger
            </button>
        </div>
    </div>
    <div style="min-width: 100%; max-height: 350px; overflow-y: scroll;">
        <table class="table">
            <thead class="thead-dark">
                <th scope="col">#ID</th>
                <th scope="col">Montant</th>
                <th scope="col">Status</th>
                <th scope="col">Message</th>
                <th scope="col">Fait le</th>
            </thead>
            <tbody>
                <?php $i = 1; foreach($payment_info as $info){ ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= number_format($info->amount, 2) ?>€</td>
                    <td><?php if($info->success){ ?><span class="badge badge-success">Accepté</span><?php } elseif($info->success == null){ ?><span class="badge badge-warning">Pending</span><?php } else { ?><span class="badge badge-danger">Refusé</span><?php } ?></td>
                    <td><?= $info->message ?></td>
                    <td><?php $date = new DateTime($info->created_at); echo date_format($date, 'd/m/Y H\hi'); ?></td>
                </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalTitle">Rechargement PlexyCoin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $payment ?>
            </div>
        </div>
    </div>
</div>
