<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 11/09/18
 * Time: 11:18
 */
	
$config = array(
	'members/signIn' => array(
								array(
									'field' => 'pseudo',
									'label' => 'Pseudo',
									'rules' => 'required|min_length[4]|max_length[12]'
								),
								array(
									'field' => 'password',
									'label' => 'Mot de passe',
									'rules' => 'required|min_length[4]|max_length[12]'
								)
							),
						
	'user/signUp' => array(
							array(
								'field' => 'lastname',
								'label' => 'Nom',
								'rules' => 'htmlspecialchars|trim|required'
							),
							array(
								'field' => 'firstname',
								'label' => 'Prénom',
								'rules' => 'htmlspecialchars|trim|required'
							),
							array(
								'field' => 'email',
								'label' => 'E-mail',
								'rules' => 'htmlspecialchars|trim|required|valid_email|is_unique[users.email]'
							),
							array(
								'field' => 'pseudo',
								'label' => 'Pseudo',
								'rules' => 'htmlspecialchars|trim|required|min_length[4]|max_length[12]|is_unique[users.pseudo]'
							),
							array(
								'field' => 'password',
								'label' => 'Mot de passe',
								'rules' => 'htmlspecialchars|trim|required|min_length[5]|max_length[12]'
							),
							array(
								'field' => 'verif_password',
								'label' => 'Confirmation',
								'rules' => 'htmlspecialchars|trim|required|matches[password]|min_length[5]|max_length[12]'
							),
							array(
								'field' => 'address',
								'label' => 'Adresse',
								'rules' => 'htmlspecialchars|trim|required'
							),
							array(
								'field' => 'town',
								'label' => 'Ville',
								'rules' => 'htmlspecialchars|trim|required'
							),
							array(
								'field' => 'postal_code',
								'label' => 'Code postal',
								'rules' => 'htmlspecialchars|trim|required|is_numeric|min_length[5]'
							),
							array(
								'field' => 'role',
								'label' => 'Votre rôle',
								'rules' => 'integer|required'
							)
						),

	'events/setEvent' => array(
								array(
									'field' => 'title',
									'label' => 'Titre',
									'rules' => 'htmlspecialchars|trim|required|is_unique[events.title]'
								),
								array(
									'field' => 'description',
									'label' => 'Description',
									'rules' => 'htmlspecialchars|trim|required'
								)
							),
				
	'events/updateEvent' => array(
									array(
										'field' => 'new_title',
										'label' => 'Titre',
										'rules' => 'htmlspecialchars|trim|required'
									),
									array(
										'field' => 'new_description',
										'label' => 'Description',
										'rules' => 'htmlspecialchars|trim|required'
									)
								),
	
	'events/addEventsPlaces' => array(
										array(
											'field' => 'add_starting_date',
											'label' => 'Début',
											'rules' => 'required'
										),
										array(
											'field' => 'add_ending_date',
											'label' => 'Fin',
											'rules' => 'required'
										),
										array(
											'field' => 'add_place',
											'label' => 'Emplacement',
											'rules' => 'htmlspecialchars|trim|required'
										)
									),
	'events/updateEventsPlaces' => array(
										array(
											'field' => 'new_starting_date',
											'label' => 'Début',
											'rules' => 'required'
										),
										array(
											'field' => 'new_ending_date',
											'label' => 'Fin',
											'rules' => 'required'
										),
										array(
											'field' => 'new_place',
											'label' => 'Emplacement',
											'rules' => 'htmlspecialchars|trim|required'
										)
									),

	'dashboard/profile' => array(
								array(
									'field' => 'email',
									'label' => '"email"',
									'rules' => 'required|valid_email'
								),
							),

	'dashboard/password' => array(
								array(
									'field' => 'email',
									'label' => '"email"',
									'rules' => 'required|valid_email'
								),
//								array(
//									'field' => 'last_password',
//									'label' => '"mot de passe actuel"',
//									'rules' => array('required', 'min_length[5]', 'max_length[12]', array('last_password_callable', array($this->member_model, 'valid_current_password'))),
//									'errors' => array('last_password_callable' => 'Votre mot de passe actuel est erroné')
////									'rules' => 'required|||array($this, "valid_current_password")'
////									'rules' => 'required|min_length[5]|max_length[12]|valid_current_password'
//								),
								array(
									'field' => 'password',
									'label' => '"nouveau mot de passe"',
									'rules' => 'required|min_length[5]|max_length[12]'
								),
								array(
									'field' => 'confirm_password',
									'label' => '"confirmation du mot de passe"',
									'rules' => 'required|min_length[5]|max_length[12]|matches[password]'
								),
							),

	'dashboard/infos' => array(
								array(
									'field' => 'lastname',
									'label' => '"nom"',
									'rules' => 'required'
								),
								array(
									'field' => 'firstname',
									'label' => '"prénom"',
									'rules' => 'required'
								),
								array(
									'field' => 'address',
									'label' => '"adresse"',
									'rules' => 'required'
								),
								array(
									'field' => 'post_code',
									'label' => '"code postal"',
									'rules' => 'required|exact_length[5]|integer'
								),
								array(
									'field' => 'town',
									'label' => '"ville"',
									'rules' => 'required'
								),
							),

	'dashboard/infos_com' => array(
								array(
									'field' => 'company_name',
									'label' => '"Nom de votre entreprise"',
									'rules' => 'required'
								),
								array(
									'field' => 'lastname',
									'label' => '"nom"',
									'rules' => 'required'
								),
								array(
									'field' => 'firstname',
									'label' => '"prénom"',
									'rules' => 'required'
								),
								array(
									'field' => 'address',
									'label' => '"adresse"',
									'rules' => 'required'
								),
								array(
									'field' => 'post_code',
									'label' => '"code postal"',
									'rules' => 'required|exact_length[5]|integer'
								),
								array(
									'field' => 'town',
									'label' => '"ville"',
									'rules' => 'required'
								),
							),

	'dashboard/code' => array(
								array(
									'field' => 'code',
									'rules' => 'required|numeric|min_length[4]|max_length[4]'
								),
								array(
									'field' => 'code_verif',
									'label' => 'code de vérification',
									'rules' => 'required|numeric|matches[code]|min_length[4]|max_length[4]'
								),
	),

	'email' => array(
						array(
							'field' => 'email',
							'label' => 'Email',
							'rules' => 'required|valid_email'
						),
						array(
							'field' => 'name',
							'label' => 'Name',
							'rules' => 'required'
						)
					),

	'pages/contact' => array(
								array(
									'field' => 'lastname',
									'label' => 'Nom',
									'rules' => 'required',
								),
								array(
									'field' => 'firstname',
									'label' => 'Prénom',
									'rules' => 'required',
									
								),
								array(
									'field' => 'email',
									'label' => 'Email',
									'rules'=> 'required|valid_email',
									
								),
								array(
									'field' => 'message',
									'label' => 'Message',
									'rules' => 'required'
								)
							), 
);
