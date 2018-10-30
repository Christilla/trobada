<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="nav_item"><a href="<?= site_url('dashboard') ?>">Tableau de bord</a></li>
		<li class="nav_item"><a href="<?= site_url('dashboard#moncompte') ?>" >Créditer mon compte transparence</a></li>
		<li class="nav_item"><a href="<?= site_url('sales-history') ?>">Historique de mes achats</a></li>
		<li class="nav_item"><a href="<?= site_url('incoming-events') ?>">Les festivals à venir</a></li>
	</ol>
</nav>
<p class="tags has-addons"><span class="tag is-dark">Vous êtes connecté en tant que :&nbsp;</span>  <strong class="tag is-warning"><?php echo $this->session->userdata('oMember')->role_long_name ?></strong></p>