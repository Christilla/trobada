

<div class="row justify-content-md-center">
    <div class="col-lg-6 col-12">
        <h2 class="text-center" id="festival">Festivals</h2>
        <p>Et licet quocumque oculos flexeris feminas adfatim multas spectare cirratas, quibus, si nupsissent, per aetatem ter iam nixus poterat suppetere liberorum, ad usque taedium pedibus pavimenta tergentes iactari volucriter gyris, dum exprimunt innumera simulacra, quae finxere fabulae theatrales.</p>
    </div>    
</div>

  <div class="row justify-content-md-center bg-info">    
    <div class="col-lg-10 col-12">
     <h4 class="text-center text-light">Actualité des festivals</h4>
        <div class="container">
             <div class="row justify-content-start"> 
                
                    <div class="col-lg-6 col-12">  

                    <!--     <php $query = $this->db->query('SELECT * FROM `events` INNER JOIN events_dates ON events_dates.events_id= events_dates.events_places_id INNER JOIN events_places ON events_places.id = events_dates.events_places_id LIMIT 6;'); -->
                         <?php $query = $this->db->query('SELECT * FROM `events` INNER JOIN `events_places` ON events.id = events_places.events_id LIMIT 6');
                            foreach ($query->result_array() as $row)
                            { ?>
                                <div class="card" style="height:28rem";>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['title'];?></h5>
                                    <p class="card-text"><strong>Date de début : </strong> <?= $row['starting_date'];?></p>
                                    <p> <strong>Date de fin : </strong><?= $row['ending_date'];?></p>
                                    <p><strong>Lieu : </strong><?= $row['place'];?></p> 
                                    <p><strong>Description : </strong><?= $row['description'];?></p>
                                    </div>
                            </div></br>
                    </div>

                <div class="col-lg-6  col-12">
                    <?php } ?>
                </div>                 
                                        </div>

            </div> <!-- fin div col -->    


        </div> <!-- fin container       -->          


    </div> <!-- fin div row -->       






<div class="row justify-content-center">
    <div class="col-6 text-center">
        <h2 class="text-center">Inscription Newsletter</h2>
        <p>Inscrivez vous à la newsletter de notre site pour ne rien rater de nos actualités!</p>
    
            <a class="btn btn-primary" href="http://www.mailingbox.com/"  target="_blank" role="button">S'inscrire</a>                            
    </div>    
</div>    
