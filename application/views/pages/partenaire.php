
        <div class="row justify-content-center">
            <div class="col-lg-6 col-12">
            <h2 class="text-center" id="partenaires">Partenaires</h2>
            <p> Et licet quocumque oculos flexeris feminas adfatim multas spectare cirratas, quibus, si nupsissent, per aetatem ter iam nixus poterat suppetere liberorum, ad usque taedium pedibus pavimenta tergentes iactari volucriter gyris, dum exprimunt innumera simulacra, quae finxere fabulae theatrales.
                </p>
            </div>
        </div>

       

        <div class="row justify-content-center">
    
		 
	      <div class="col-lg-6 col-12">
          <h4 class="text-center font-weight-bold">Cherchez par catégories</h4>
          
          <?= form_open('partenaire#partenaires') ?> 
                <div class="input-group">
                    <select name="categories" class="custom-select">
                   
                     <option selected value="NULL">Choississez une catégorie</option>

                     
                        <?php
                            foreach($aoCategories as $oCategory):
                        ?>   
                            
                            <option value="<?= $oCategory->id ?>"><?= $oCategory->name_categories ?></option>
                        <?php
                            endforeach;
                        ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit" >Trier</button>
                    </div>
            <?= form_close() ?>                
                        
                </div>
             </div>
        </div>
    

<div class="row justify-content-md-center bg-info">
    <div class="col-lg-8 col-12">
        <h4 class="text-center text-light" id="partenaires"> Résultat de la recherche :  </h4>   
    </div>
    
        <div class="container">
                <div class="row justify-content-start"> 
                                
                        <div class="col-4  col-md-4 col-12">
                        <!-- <div class="col-4 col-12">   -->
                                <?php
                                foreach ($aoPartners as $row)
                                { ?>  

                                
                                <div class="card" style="height:30rem";>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img class="card-img-top" style=""  src="<?= $row->logo_location?>" alt="Card image cap">
                                        </div>

                                        <h3 class="card-title"><?php echo $row->name;?> </h3>
                                        
                                        <p><strong>Description : </strong> <?php echo $row->description; ?></p>
                                    
                                        <p><strong>Lien vers le site : </strong><a href="<?=$row->site_url ?>" target="_blank"><?php echo $row->site_url; ?> </a></p>

                                    </div>
                                </div> </br>    
                            </div>          

                <div class="col-4  col-md-4 col-12">  
                <!-- <div class="col-4 col-12">   -->
                            <?php } ?> 
                </div> 
            <!--   Nouvelle condition php  -->
                <div class="col-4 col-12">
                    <?php if($aoPartners == NULL ) { ?>
                        <h5 class="text-center text-light"> <?php echo 'Aucun résultat trouvé';?> </h5>
                                            <?php } ?>
                </div>        

            </div> <!-- fin row -->
        </div>    
    </div> <!-- Fin container -->

</div> <!-- fin section partenaires (affichage dynamique) -->


<div class="row justify-content-center">
    <div class="col-lg-6 text-center col-12">
        <h2 class="text-center">Inscription Newsletter</h2>
        <p>Inscrivez vous à la newsletter de notre site pour ne rien rater de nos actualités!</p>
        <a class="btn btn-primary" href="http://www.mailingbox.com/"  target="_blank" role="button">S'inscrire</a>  
    </div>    
</div>   
