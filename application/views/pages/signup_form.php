<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-lg-8 col-12"> 
            <h2 class="text-center" id="signup">Inscription</h2>
       
           

            <?= form_open("signup#signup") ?>
           
                <div class="form-row">
                    <div class="col">
                        <?=
                        form_error('lastname'),
                        form_label('Nom: ', 'lastname', $class_label),
                        form_input(array('name' => 'lastname', 'class' => 'form-control', 'placeholder' => 'Votre nom', 'value'=>set_value('lastname')))
                        ?>
                     </div>

                        <div class="col">
                        <?=
                            form_error('firstname'),
                            form_label('Prénom: ', 'firstname', $class_label),
                            form_input(array('name' => 'firstname', 'class' => 'form-control', 'placeholder' => 'Votre prenom', 'value'=>set_value('firstname')))
                            ?>
                        </div>
                </div>


                <div class="form-row">
                        <div class="col">
                            <?=
                            form_error('pseudo'),
                            form_label('Pseudo:', 'pseudo', $class_label),
                            form_input(array('name' => 'pseudo', 'class' => 'form-control', 'placeholder' => 'Saississez un pseudo', 'value'=>set_value('pseudo')))
                            ?>
                        </div>
                        
                            <div class="col">
                                <?=
                                form_error('email'),
                                form_label('E-mail: ', 'email', $class_label),
                                form_input(array('name' => 'email', 'class' => 'form-control', 'placeholder' => 'Saississez un mail valide', 'value'=>set_value('email')))
                                ?>
                            </div>
                </div>



                <div class="form-row">
                        <div class="col">
                            <?=
                            form_error('password'),
                            form_label('Mot de passe: ', 'password', $class_label),
                            form_input(array('name' => 'password', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Votre mot de passe'))
                            ?>
                        </div>
                    
                        <div class="col">
                            <?=
                            form_error('verif_password'),
                            form_label('Confirmez: ', 'verif_password', $class_label),
                            form_input(array('name' => 'verif_password', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirmer le mot de passe'))
                            ?>
                        </div>    
                </div>


    <!-- Déplacement du choix du role de l'utilisateur au moment de la connexion -->
                     <div class="form-group">
                    <?=
                    form_error('role'),
                    form_label('Choississez votre catégorie : ', 'categorie', $class_label),
                    $role 
                    ?>
                    </div>

  <!--   Fin choix utilisateur  -->               

                <h4 class="text-center">Coordonnées</h4>

                <div class="form-row">
                    <?=
                    form_error('address'),
                    form_label('Adresse: ', 'address', $class_label),
                    form_input(array('name' => 'address', 'class' => 'form-control', 'placeholder' => 'Votre adresse', 'value'=>set_value('address')))
                    ?>
                </div>

                <div class="form-row">
                    <div class="col">
                        <?=
                        form_error('town'),
                        form_label('Ville: ', 'town', $class_label),
                        form_input(array('name' => 'town', 'class' => 'form-control', 'placeholder' => 'Votre ville', 'value'=>set_value('town')))
                        ?>
                    </div>

                    <div class="col">
                        <?=
                        form_error('postal_code'),
                        form_label('Code postal:', 'postal_code', $class_label),
                        form_input(array('name' => 'postal_code', 'class' => 'form-control', 'placeholder' => 'Votre code postal', 'value'=>set_value('postal_code')))
                        ?>
                    </div>
                </div>

                <?= 
                form_submit("submit","S'inscrire", "class='btn btn-info'")
                ?>
            <?=
            form_close(); 
            ?>


        </div>
    </div>
</div>
