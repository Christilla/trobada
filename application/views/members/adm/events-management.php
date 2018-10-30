<h1 class="display-4"><?= $title ?></h1>
         <?php echo $output; ?>
     </div>
     <?php foreach($js_files as $file): ?>
         <script src="<?php echo $file; ?>"></script>
     <?php endforeach; ?>
 
 

