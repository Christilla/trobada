		</div> <!-- fin container -->


		<!-- Footer -->
		<footer class=" bg-light text-info "  >

			<!-- Footer Links -->
			<div class="container-fluid text-center text-md-left">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-12 ">
							<h5 class="text-uppercase ">TROBADA</h5>
							<img class="mr-3 xs-d-none" src="assets/img/logo.png" alt="logo">
						</div>

						<div class=" col-md-4 col-6">
							<h5 class="text-uppercase ">Plan du site</h5>

							<ul class="list-unstyled">
								<li>
									<a  href="<?php echo site_url('/home'); ?>">Accueil</a>
								</li>
								<li>
									<a href="<?php echo site_url('/festival#festival')?>">Festivals</a>
								</li>
								<li>
									<a href="<?php echo site_url('/partenaire#partenaires')?>">Nos partenaires </a>
								</li>
								<li>
									<a href="<?php echo site_url('/team#team')?>">L'équipe Trobada</a>
								</li>
								<li>
									<a  href="<?php echo site_url('/contact#contact')?>">Contact</a>
								</li>
								<li>
									<a  href="<?php echo site_url('/mention')?>">Mentions légales</a>
								</li>
							</ul>
						</div>
						<div class="col-md-4 col-6 ">
							<h5 class="text-uppercase">Contact</h5>

							<ul class="list-unstyled">
								<li>Adresse postale 1</li>
								<li>Adresse postale 2</li>
								<li>Numéro de tel</li>
								<li>Mail</li>
								<li>Suivez nous sur :</li>
								<li>
									<a href="https://www.facebook.com/ProjetRencontre/" target="_blank">
										<img class="mr-3" src="assets/img/facebook.png" alt="logo">
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>

		<div class="footer-copyright text-center text-light ">© 2018 Trobada :
			<a class="text-light" href="#/"> Beweb</a>
		</div>

		<?php
		/**
		 * include css file dynamically
		 */
		if(isset($addedJsFiles)){

			switch(true){
				case(is_array($addedJsFiles)):
					foreach($addedCssFiles as $path):
						echo "<script type='text/javascript' src='" . base_url() . $path . "'><script/>";
					endforeach;
					break;

				default:
					echo "<script type='text/javascript' src='" . base_url() . $addedJsFiles . "'><script/>";
					break;

			}
		}
		?>
    </body>
</html>
