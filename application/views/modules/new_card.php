<div class="card-body">
    <h2 class="card-title">Création de votre code à 4 chiffres</h2>
    <div class="text-center">
        <p>Pour pouvoir utiliser votre carte et/ou QRCode vous devez procéder à la création
        d'un code a 4 chiffres.</p>
        <p>Suite a cette création vous serez en mesure de pouvoir imprimer votre QRCode
        ainsi que de recharger votre compte.</p>
        <p class="text-danger">Pensez à bien retenir votre code secret car il n'est défini
        qu'une seule fois.</p>
    </div>
    <div class="text-danger text-center font-weight-bold p-3 m-3">
        <?= form_error('code') ?>
        <?= form_error('code_verif') ?>
    </div>
    <form action="/dashboard#moncompte" method="post">
        <div class="form-row justify-content-center">
            <div class="col-sm-2 my-1">
                <label class="sr-only" for="inlineFormInputName">Code</label>
                <input max="9999" type="number" name="code" class="form-control" placeholder="1234" required>
            </div>
            <div class="col-sm-2 my-1">
                <label class="sr-only" for="inlineFormInputName">Vérification</label>
                <input type="number" max="9999" class="form-control" name="code_verif" placeholder="1234" required>
            </div>
            <div class="col-auto my-1">
              <button style="border-radius: 5px;" name="code_btn" type="submit" value="valider" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </form>
</div>