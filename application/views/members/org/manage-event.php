<h1 id="title" class="display-4"><?= $title ?></h1>

<?php
if(!empty($events))
{
				echo (($this->session->flashdata('success')) != null) ? $this->session->flashdata('success') : "";
				echo (($this->session->flashdata('date-error')) != null) ? $this->session->flashdata('date-error') : "";
				echo (($this->session->flashdata('error')) != null) ? $this->session->flashdata('error') : "";
			?>
		<!--	EVENTS GLOBAL CONTAINER	-->
        <div id="event" class='box events row'>
			<!--	name and description event container	-->
			<div class="col-lg-4 col-sm-12 mb-3">
				<div class="card">
					<div id="event-description" class="card-body box mb-0 my-min-height">
						<h2><?= $events->title ?></h2>
						<p><strong>Description de l'évènement :</strong></p>
						<p class="text-justify"><?= $events->description ?></p>
					</div>
					<div class="card-footer justify-content-center toggle-description down" style='cursor: pointer;'>
						<i class="fas fa-arrow-circle-down"></i>
					</div>
				</div>
			</div>

			<!--	actions and displays on event container	-->
            <div id="manage-event" class="col-lg-8 col-sm-12">
				<!--	actions container	-->
				
					<nav id="actions-triggers" class="rounded mb-2 pt-3" aria-label="breadcrumbs" style='background-color : rgba(0,0,0,0.1)'>
						<ul class="nav col-12 text-center" style='list-style-type: none;'>
							<li class='col-lg-3 mb-3 col-sm-12'><button class="action-trigger button is-link w-100"  id="update-event"  data-target="updating-event"><i class="fas fa-pencil-alt"></i>&nbsp;Évènement</button></li>
							<li class='col-lg-3 mb-3 col-sm-12'><button class="action-trigger button is-info w-100"  id="show-dates-and-places"  data-target="showing-dates-and-places"><i class="far fa-eye"></i>&nbsp;Lieux</button></li>
							<li class='col-lg-3 mb-3 col-sm-12'><button class="action-trigger button is-primary w-100"  id="add-date-and-place-event"  data-target="adding-date-and-place-event"><i class="fas fa-plus-circle"></i>&nbsp;Lieu</button></li>
							<li class='col-lg-3 mb-3 col-sm-12'><button id="delete-event" class="action-trigger button is-danger w-100" data-toggle="modal" data-target="#modalDelete"><i class="far fa-times-circle"></i>&nbsp;Évènement</button></li>
						</ul>
					</nav>
				</div>


				<!--	View part of updating event	-->
				<div id="updating-event" class="box view-parts">
					<form method="POST" action="<?= base_url() ?>update/event/<?= $events->id ?>">
						<fieldset>
							<h3 class="tag is-link">Modification de l'évènement</h3>
							<div class="form-group row">
								<?=
								form_error('new_title'),
								form_label('Titre: ', 'new_title', ["class" => "col-sm-5 col-form-label"]),
								form_input(array('name' => 'new_title', 'class' => 'form-control', 'placeholder' => 'Saisissez un titre', 'value' => $events->title))
								?>
							</div>
							<div class="form-group row">
								<?=
								form_error('new_description'),
								form_label('Description: ', 'new_description', ["class" => "col-sm-5 col-form-label"]),
								form_textarea(array('name' => 'new_description', 'class' => 'form-control', 'placeholder' => 'Décrivez l\'évènement', 'value'=> $events->description))
								?>
							</div>
						</fieldset>
						<div class="form-group row">
							<?=
							form_submit("submit","Modifier", "class='button is-link'")
							?>
						</div>
					</form>
				</div>



				<!--	View part of existing event places and dates 	-->
				<!--	There's also View part of updating and deleting each of them 	-->
                <div id="showing-dates-and-places" class="box view-parts" class="form-places card-columns">
					<div class="display-flex-row">
                    <?php
                    $bool = null;
                    foreach($places as $place):
                        if(!empty($place) || !is_null($place))
                        {
                            if($place->events_id == $events->id)
                            { ?>
									<div class="places-dates">
										<div class="card">
											<span class="card-header tag is-info">Dates et lieu de l'évènement</span>
											<div class="card-body">
												<p>Se déroule à <?= $place->place ?></p>
												<p>Du : <?= date("d/m/Y", strtotime($place->starting_date)) ?></p>
												<p>Au : <?= date("d/m/Y", strtotime($place->ending_date)) ?></p>
												
												<button type="button"  class="button is-link" data-toggle="modal" data-target="#dates_and_places">Modifier</button>
												<a href="<?= base_url() ?>delete/event-places/<?= $place->id ?>/<?= $place->events_id ?>" >
												<button type="button" class="button is-danger">Supprimer</button></a>
											</div>
										</div>

										<div class="modal fade" id="dates_and_places" tabindex="-1" role="dialog" aria-labelledby="dates_and_placesTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content">
													<form action="<?= base_url() ?>update/event-places/<?= $place->id ?>" method="POST">
														<div class="modal-body">
															<fieldset>
																<legend>Emplacement et durée</legend>
																<div class="form-group row m-1">
																	<?=
																	form_error('new_place'),
																	form_label('Lieu de l\'évènement&nbsp;:', 'new_place', ["class" => "col-sm-5 col-form-label"]),
																	form_input(array('name' => 'new_place', 'class' => 'form-control', 'placeholder' => 'Précisez l\'endroit', 'value' => $place->place))
																	?>
																</div>
																<div class="form-group row m-2">
																	<?=
																	form_error('new_starting_date'),
																	form_label('Début: ', 'new_starting_date', ["class" => "col-sm-3 col-form-label"])
																	?>
																	<input type="date" name="new_starting_date" class="form-control" value=<?= $place->starting_date ?>>
																</div>
																<div class="form-group row m-2">
																	<?=
																	form_error('new_ending_date'),
																	form_label('Fin: ', 'new_ending_date', ["class" => "col-sm-3 col-form-label"])
																	?>
																	<input type="date" name="new_ending_date" class="form-control" value=<?= $place->ending_date ?>>
																</div>
															</fieldset>
														</div>
														<div class="modal-footer">
															<button type="button" class="button" data-dismiss="modal">Fermer</button>
															<button type="submit" name="submit" class="button is-link" >Modifier</button>
		<!--                                                    <button type="submit" name="submit" class="button is-link" data-dismiss="modal">Modifier</button>-->
															<?php
		//														echo form_submit("submit","Modifier", "class='btn btn-info'")
															?>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
                            <?php
                            $bool = true;
                            }
                        }
                    endforeach;
                    if(!$bool){ ?>
						<div class="display-flex-column">
							<p class="content">
								Aucune date ni lieu ne sont renseignés pour cet évènement !
							</p>
							<p>
								<button class="action-trigger button is-primary"  id="add-date-and-place-event"  data-target="adding-date-and-place-event">Ajouter une date / un lieu</button>
							</p>
						</div>
                    <?php }
                    ?>
					</div>
                </div>



				<!--	View part of adding a place and dates for event	-->
				<div id="adding-date-and-place-event" class="box view-parts">
					<h3 class="tag is-primary">Ajouter une date et un lieu</h3>
					<form action="<?= base_url() ?>add/event-places/<?= $events_id ?>" method="POST">
						<fieldset>
							<legend>Emplacement et durée</legend>
							<div class="form-group row">
								<?=
								form_error('add_starting_date'),
								form_label('Début: ', 'add_starting_date', ["class" => "col-sm-3 col-form-label"])
								?>
								<input type="date" name="add_starting_date" class="form-control" value=<?php set_value('add_starting_date'); ?>>
							</div>
							<div class="form-group row">
								<?=
								form_error('add_ending_date'),
								form_label('Fin: ', 'add_ending_date', ["class" => "col-sm-3 col-form-label"])
								?>
								<input type="date" name="add_ending_date" class="form-control" value=<?= set_value('add_ending_date'); ?>>
							</div>
							<div class="form-group row">
								<?=
								form_error('add_place'),
								form_label('Emplacement: ', 'add_place', ["class" => "col-sm-3 col-form-label"]),
								form_input(array('name' => 'add_place', 'class' => 'form-control', 'placeholder' => 'Précisez l\'endroit', 'value' => set_value('add_place')))
								?>
							</div>
							<div class="form-group row">
								<?=
								form_submit("submit","Modifier", "class='btn btn-info'")
								?>
							</div>
						</fieldset>
					</form>
				</div>



				<!--	View part of deleting event	-->
				<!--	There's also a view part to confirm deletion 	-->
				<div id="deleting-event" class="box view-parts">
					<h3 class="tag is-danger">Suppression de l'évènement</h3>
					
				</div>
				</div>
            </div>
        </div>
		<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<p class="card-text">Supprimer cet évènement effacera <strong>tous</strong> les emplacements qui lui sont liés.</p>
					<p> Êtes-vous sur de vouloir le supprimer ? </p>
					<div class="d-flex"> 
						<a class ="button is-danger w-50 mr-1" href="<?= base_url() ?>delete/event/<?= $events->id ?>">Oui</a>
						<a data-dismiss="modal" class="button w-50 ml-1">Non</a>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php  
}
else
{ ?>
    <p>Vous n'avez pas encore créé d'évènement : <a href="<?= base_url() ?>create-festival">Créer un évènement ?</a></li></p>
<?php
}
?>
