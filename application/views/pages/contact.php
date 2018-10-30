<div class="row justify-content-md-center">
<div class="col-lg-6 col-12">
          <h1 class = "text-center" id="contact">Contact</h1>

 
   <?= form_open('sendmessage#contact')?> 
   
  
      <form>

      <?= form_error('lastname') ?>
        <div class="form-group row">  
            <label for="Lastname" class="col-sm-2 col-form-label">Votre nom</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="votre nom" value="<?php echo set_value('lastname'); ?>" >
            </div>
          </div>

        <?= form_error('firstname') ?>
        <div class="form-group row">
            <label for="Firstname" class="col-sm-2 col-form-label">Votre prénom</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="firstname" name="firstname" placeholder="votre prénom" value="<?php echo set_value('firstname') ?>">
            </div>
          </div>

          <?= form_error('email') ?>
          <div class="form-group row">
            
            <label for="Email"  class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" placeholder="votre email" value="<?php echo set_value('email')?>">
            </div>
          </div>

         <?= form_error('message') ?>
            <div class="form-group row">
                      <label for="Message"  class="col-sm-2 col-form-label">Message</label>
                      <div class="col-sm-10">
                        <textarea id="message" id="message" name="message" class="form-control" rows="5" placeholder="votre message" value="<?php echo set_value('message')?>" required></textarea>
                      </div>  
            </div>
      
            
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" name="send" id="send" class="btn btn-info" value="Submit" >Envoyer</button>
              </div>
            </div>
          
    </form>
  <?= form_close() ?> 







  </div>        
</div>
