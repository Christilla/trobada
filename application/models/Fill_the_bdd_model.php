<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 09/09/18
 * Time: 22:10
 */

class Fill_the_bdd_model extends CI_Model
{

	protected $table = 'events';
	/*
	 *
		include APPPATH.'third_party/faker/src/autoload.php';
		$faker = Faker\Factory::create('fr_FR');
		$faker->seed(5);

		echo "<strong>Title: </strong>".$faker->title;
		echo "<br>";

		echo "<strong>First Name: </strong>".$faker->firstName;
		echo "<br>";

		echo "<strong>Last Name: </strong>".$faker->lastName;
		echo "<br>";

		echo "<strong>Street Address: </strong>".$faker->streetAddress;
		echo "<br>";

		echo "<strong>Postcode: </strong>".$faker->postcode;
		echo "<br>";

		echo "<strong>City: </strong>".$faker->city;
		echo "<br>";

		echo "<strong>Country: </strong>".$faker->country;
		echo "<br>";

		for($i = 1 ; $i < 10 ; $i++){
			echo "<strong>Phrase : </strong>".$faker->sentence($nbWords = 6, $variableNbWords = true);
			echo "<br>";
			echo "<strong>Paragraphe : </strong>".$faker->paragraph($nbSentences = 5, $variableNbSentences = true);
			echo "<br>";

		}
	 */


	public function addEvents(){
		include APPPATH.'third_party/faker/src/autoload.php';

		$faker = Faker\Factory::create('fr_FR');
		$faker->seed(5);

		$this->load->database();

		for($i = 1 ; $i < 10 ; $i++){
			$title =  $faker->sentence($nbWords = 6, $variableNbWords = true);
			$description =  $faker->paragraph($nbSentences = 5, $variableNbSentences = true);

			//	Ces données seront automatiquement échappées
			$this->db->set('title', $faker->sentence($nbWords = 6, $variableNbWords = true));
			$this->db->set('description',   $faker->paragraph($nbSentences = 5, $variableNbSentences = true));

			$this->db->insert($this->table);
		}
	}

	public function getEvents(){

		$this->load->database();
		$query = $this->db->get($this->table);

		$data['html'] = "";
		foreach ($query->result() as $row)
		{
			$data['html'].= "<strong>" . $row->title . "</strong>"
			. "<br>"
			. $row->description
			. "<br>"
			. "<br>"
			. "<br>";
		}

		$this->load->view('templates/header');
		$this->load->view('welcome_message', $data);
	}
}
