<?php

class Seeder extends CI_Model {

    public function userSeed(){

        $pseudo = ['admin', 'festi', 'comme', 'organ'];

        for($i=0; $i<4; $i++){
            $data = [
                'pseudo' => $pseudo[$i],
                'email' => $pseudo[$i].'@'.$pseudo[$i].'.fr',
                'password' => password_hash('trobada', PASSWORD_DEFAULT),
                'firstname' => $pseudo[$i],
                'lastname' => $pseudo[$i],
                'address' => '10 rue '.$pseudo[$i],
                'town' => $pseudo[$i],
                'role' => key($pseudo[$i])+1,

            ];

            $this->db->insert('users', $data);
        }
    }

    public function productSeed(){
        for($i=0;$i<40;$i++){
            $data = [
                'name' => "Produit n° $i",
                'description' => "Description produit n° $i",
                'price' => rand(1, 100),
                'users_id' => rand(1,4)
            ];

            $this->db->insert('products', $data);
        }
    }

    public function eventSeed(){
        for($i=0;$i<10;$i++){
            $data = [
                'title' => "Event n° $i",
                'description' => "Description event n° $i",
                'users_id' => rand(1,4),
            ];

            $this->db->insert('events', $data);
        }
    }

    public function eventPlacesSeed(){
        for ($i=0; $i < 10; $i++) { 
            $data = [
                'starting_date' => date("Y-m-d H:i:s"),
                'ending_date' => date("2019-05-11 17:16:18"),
                'place' => "Place n° $i",
                'events_id' => rand(1,10)
            ];

            $this->db->insert('events_places', $data);
        }
    }

    public function eventRegistrationSeed(){
        for ($i=0; $i < 10; $i++) { 
            $data = [
                'events_id' => rand(1,10),
                'users_id' => rand(1,4)
            ];

            $this->db->insert('events_registrations', $data);
        }
    }

    public function transactionsSeed(){
        for ($i=0; $i < 10; $i++) { 
            $data = [
                'amount' => rand(1,1000),
                'created_at' => date("Y-m-d H:i:s"),
                'id_fest' => rand(1,4),
                'id_com' => rand(1,4),
                'events_places_id' => rand(1,10)
            ];

            $this->db->insert('transactions', $data);
        }
    }

    public function transactionsEntriesSeed(){
        for ($i=0; $i < 10; $i++) { 
            $data = [
                'products_id' => rand(1,40),
                'price' => rand(1,40),
                'qty' => rand(1,40),
                'transactions_id' => rand(1,10)
            ];

            $this->db->insert('transactions_entries', $data);
        }
    }

}