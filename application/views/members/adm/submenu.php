<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Tableau de bord</a></li>
		<li class="breadcrumb-item"><a href="<?= site_url('sales-history'); ?>">Commissions</a></li>
		<li class="breadcrumb-item"><a href="<?= site_url ('members-management'); ?>">Membres</a></li>
		<li class="breadcrumb-item"><a href="<?= site_url('partners-management');?>">Partenaires</a></li>
		<li class="breadcrumb-item"><a href="<?= site_url('categories-partners-management');?>">Catégories partenaires</a></li>
		<li class="breadcrumb-item"><a href="<?= site_url('events-management')?>">Évènements</a></li>
		<li class="breadcrumb-item"><a href="<?= site_url('events_places-management')?>">Lieux et dates des évènements</a></li>
	</ol>
</nav>
<p class="tags has-addons"><span class="tag is-dark">Vous êtes connecté en tant que :&nbsp;</span>  <strong class="tag is-warning"><?php echo $this->session->userdata('oMember')->role_long_name ?></strong></p>
