<h1 id="rubrique"><?= $title ?></h1>
<h5 class="subtitle"><?php if(isset($text)){ echo $text; } ?></h5>
<div class="row ml-3 mr-3">
    <select style="width: 18rem;" class="custom-select col-lg-4 col-sm-12 mb-3" name="com-event" id="com-event">
        <option value="0" selected>Tout</option>
        <?php foreach($select as $key => $event){ ?>
            <option value="<?= $event->id ?>"><?= $event->title ?></option>
        <?php } ?>
    </select>
    <div id="checkbox-com-dropdown" class='col-lg-8 col-sm-12 text-center mb-3' style='display: none;'>
        <div style="border-radius: 5px;" class="border border-dark bg-light pl-3 pr-3 shadow position-absolute">
            <p class='d-inline'>Êtes vous sur de vouloir valider?</p>
            <p class='text-danger d-inline mb-3'>Cette action est irréverssible</p>
            <p>
                <a style="border-radius: 5px;" id='checkbox-com-yes' class='btn btn-danger col-5 mr-1 text-white font-weight-bold'>Oui</a>
                <a style="border-radius: 5px;" id='checkbox-com-no' class='btn btn-light col-5 ml-1 font-weight-bold border border-dark'>Non</a>
            </p>
        </div>
    </div>
</div>
<div style="min-width: 100%; max-height: 650px; overflow-y: scroll;">
    <table class="table">
        <thead data-role="0" id="table-head" class="thead-dark">
            <?php foreach($column as $col){ ?>
                <th scope="col"><?= $col ?></th>
            <?php } ?>
        </thead>
        <tbody id="table-event">
            <?php $i = 1; foreach($row as $trans){ ?>
            <tr>
                <th scope="row"><?= $i ?></th>
                <?php foreach($trans as $result){ ?>
                <td><?= $result ?></td>
                <?php } ?>
            </tr>
            <?php $i++; } ?>
        </tbody>
    </table>
    <input type="hidden" name="role" id="role" value="<?= $role ?>">
</div>
<div id="data-check"></div>

<div class="modal fade" id="saleModal" tabindex="-1" role="dialog" aria-labelledby="saleModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalTitle">Détail transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Produit</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Prix Total</th>
                        </tr>
                    </thead>
                    <tbody id="table-details">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>