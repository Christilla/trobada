
<h1 class="display-4"><?= $title ?></h1>
<?php 
echo (($this->session->flashdata('success')) != null) ? $this->session->flashdata('success') : "";
echo (($this->session->flashdata('error')) != null) ? $this->session->flashdata('error') : ""; 
?>
<h1>Festivals à venir</h1>
<?php
if(!empty($events))
{
    foreach($events as $event)
    { ?>
        <div class='events row'>
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3><?= $event->title ?></h3>
                        <p>Créé par <em><strong><?= $event->pseudo ?></strong></em></p>
                        <p>
                            <strong>Description de l'évènement : </strong><?= $event->description ?>
                        </p>
                        <button class="modal-all-places-toggle button is-info">Afficher les détails</button>
                    
                        <div style="display: none" class="modal-all-places form-places card-deck">
                            <?php
                            $bool = null;
                            foreach($places as $place)
                            {
                                if(!empty($place) || !is_null($place))
                                { 
                                    if($place->events_id == $event->id)
                                    { ?>
                                        <div class="places">
                                            <div class="card mt-3" style="width: 18rem;">
                                                <div class="card-body">
                                                    <p><strong>Date de début : </strong><?= date("d/m/Y", strtotime($place->starting_date)) ?></p>
                                                    <p><strong>Date de fin : </strong><?= date("d/m/Y", strtotime($place->ending_date)) ?></p>
                                                    <p><strong>Emplacement : </strong><?= $place->place ?></p>
                                                    <?php 
                                                    if($_SESSION['oMember']->role === "COM")
                                                    { 
                                                        if($place->reg == null || empty($place->reg))
                                                        { ?>
                                                            <a class="button is-success" href="/position/event/<?= $place->id ?>/<?= $event->id ?>">S'inscrire</a>    
                                                        <?php
                                                        } 
                                                        else
                                                        { ?>
                                                            <a class="button is-warning" href="/delete/registration/<?= $place->id ?>">Se désinscrire</a>
                                                        <?php
                                                        }    
                                                    }
                                                    ?> 
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    $bool = true;
                                    }
                                }
                            }
                            if(!$bool)
                            { ?>
                                <div class="card col-4 mt-3" style="width: 18rem;">
                                    <div class="card-body">
                                        <p>Aucune dates n'a étée définie sur cet évènement !</p>
                                    </div>  
                                </div>
                            <?php 
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php  
    }
}
else
{ ?>
    <p>Il n'y a pas d'évènement</p>
<?php
}
?>
