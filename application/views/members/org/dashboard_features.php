<div class="row justify-content-md-center bg-info text-light">

	 <div class="col-lg-8 col-12">
                <h3 class="text-center">Mes derniers évènements</h3>

				<div class="row justify-content-start"> 
              	  <div class="col-lg-4 col-12"> 
               
				
					
				<!-- 	<php $query = $this->db->query('SELECT * FROM `events` INNER JOIN events_dates ON events_dates.events_id= events_dates.events_places_id INNER JOIN events_places ON events_places.id = events_dates.events_places_id WHERE `users_id`= '. $member->id); Ma belle requete... -->

					<?php $query = $this->db->query("
														SELECT 
															e.id,
															e.title,
															e.description,
															ep.place
														FROM 
															`events` e 
														INNER JOIN 
															`events_places` ep 
														ON 
															e.id = ep.events_id  
														WHERE 
															e.users_id = " . $member->id . " 
														GROUP BY
															e.id
														ORDER BY 
															e.id 
														DESC LIMIT 
															3");

					foreach ($query->result_array() as $event)
					{ ?>
								
							
									<div class="card" style="height: 20rem">
										<div class="card-body">
											<h5 class="card-title"><span class="tag is-info"><?= $event['place'];?></span> <?= $event['title'];?></h5>
											<p class="card-text"><?= substr ( $event['description'], 0 , 148 )." "."(...)"  ;?></p>
											
											<a href="<?= base_url() ?>manage-event/<?= $event['id'];?>" class="btn btn-primary">Modifier</a>
										</div>
									</div></br>	
								

							</div> <!-- fin div col lg 3 -->

								<div class="col-lg-4 col-12">		
								<?php } ?>

								
					</div></br>
						
				</div>
				
			</div>	<!-- fin row justify -->
	</div> <!-- fin col -->


</div> <!-- fin div row -->

