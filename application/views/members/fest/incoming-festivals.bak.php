
<h1 class="display-4"><?= $title ?></h1>

<div class="row">
  <div class="col-lg-4 col-12">
        <?php 
        if(!empty($events))
        {
            foreach($events as $event)
            { ?>
            <!--  <div class='events'> -->

        <div class="card">
            <h5 class="card-header bg-primary text-light"><?= $event->title ?></h5>
            <div class="card-body">
                <h6 class="card-title">Description de l'évènement : <?= $event->description ?></h6>
            
                    <!-- <button class="modal-all-places-toggle">Voir les lieux</button> -->
                        
                    <!-- <div style="display: none" class="modal-all-places"> -->
                        <?php
                        $bool = null;
                        foreach($places as $place)
                        {
                            if(!empty($place) || !is_null($place))
                            { 
                                if($place->events_id == $event->id)
                                { ?>
                                   <!--  <= $place->id ?> -->
                                    <p class="card-text" ><strong>Date de début : </strong><?= $place->starting_date ?></p>
                                    <p class="card-text"><strong>Date de fin : </strong><?= $place->ending_date ?></p>
                                    <p class="card-text"><strong>Emplacement : </strong><?= $place->place ?></p>
                                    <?php 
                                    if($_SESSION['oMember']->role === "COM")
                                    { ?>
                                        <a href="/position/event/<?= $place->id ?>/<?= $event->id ?>">Se positionner</a>    
                                    <?php 
                                    }
                                    ?> 
                                    
                                <?php
                                $bool = true;
                                }
                            }
                        }
                        if(!$bool)
                        { ?>
                            <p class="card-text">Il n'y a pas de dates/lieux pour cet évènement !</p>

                        </div>
                     </div> 

                    <div class="col-lg-4 col-12">

                        <?php 
                        }
                        ?>
                   </div>

         </div></br>
         
         
    
</div> 

    <!-- <?php  
    }
}
else
{ ?>
    <p>Vous n'avez pas encore créé d'évènement : <a href="<?= base_url() ?>create-festival"><strong>Créer un évènement ?</strong></a></li></p>
<?php
}
?> -->
