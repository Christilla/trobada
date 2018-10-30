<div class="col-12">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="nav_item"><a href="<?php echo base_url() ?>dashboard">Tableau de bord</a></li>
			<li class="nav_item"><a href="<?php echo base_url() ?>create-festival">Créer un événement</a></li>
			<li class="nav_item"><a href="<?php echo base_url() ?>manage-events">Mes évènements</a></li>
			<li class="nav_item"><a href="<?php echo base_url() ?>incoming-events">Événements à venir</a></li>
		</ol>
	</nav>
	<p class="tags has-addons"><span class="tag is-dark">Vous êtes connecté en tant que :&nbsp;</span>  <strong class="tag is-warning"><?php echo $this->session->userdata('oMember')->role_long_name ?></strong></p>
</div>
