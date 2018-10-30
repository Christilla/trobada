<h1 class="display-4"><?= $title ?></h1>
<?php echo (($this->session->flashdata('success')) != null) ? $this->session->flashdata('success') : ""; ?>
    <div class="row">
        <div class="col-12">
            <div class="card-columns">
                <?php foreach($events as $event) 
                { ?>
                    <div class="card col-12" style="height: 29rem">
                        <div class="card-body">
                            <h2><p><strong></strong><?= $event->title ?></p></h2>
                            <p><strong>Description : </strong><?= $event->description ?></p>

                                
                            <a href="manage-event/<?= $event->id ?>" class="button is-info">Afficher détails</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div> 
