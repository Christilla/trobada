<h1><?= $title ?></h1>

<p class="text-danger">La supression n'est pas possible car elle pourrait compromettre le bon déroulement des transactions</p>

<?php echo $output; ?>
  
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>


