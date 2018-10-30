<?php
    /**
     * Created by Niko
     */

class Transaction extends MY_Controller {

    private $member;

    public function __construct(){
        parent::__construct();
        $this->member = $this->session->userdata('oMember');
        $this->load->model('transactions_model', 'trans');
    }

    public function index(){
        $this->load->view('templates/header_member', ['title' => 'Historique']);
        $this->load->view('members/'.strtolower($this->member->role).'/submenu');
        switch($this->member->role){
            case 'FEST' :
                $this->get_fest_history();
                break;
            case 'COM' :
                $this->get_com_history();
                break;

            case 'ADM' :
                $this->get_adm_history();
                break;
        }
        $this->load->view('templates/footer_member');        
    }

    private function get_fest_history(){
        $id = $this->member->id;
        $id_fest = "id_fest = ".$this->member->id;
        $row = [];
            
        $select = $this->trans->findAllTransactionEventByFest($id);
        foreach($select as $key => $event){
            $select[$key]->title .= " - ".$event->place;
            $data = $this->trans->findAllTotalEventByEvent($event->id, $id_fest);
            $data->title .= " - ".$event->place;
            $data->amount .= '€';
            unset($data->place);
            array_push($row, $data);
        }

        $data = [
            'title' => 'Historique des achats',
            'text' => 'Cliquez sur la ligne de votre choix après avoir séléctionné
            un festival dans la liste déroulante suivante pour voir le detail.',
            'select' => $select,
            'role' => strtolower($this->member->role),
            'column' => ['#', 'Evenement', 'Montant Total'],
            'row' => $row
        ];  

        $this->load->view('modules/sale_history', $data);

    }

    private function get_com_history(){
        $id = $this->member->id;
        $id_com = "id_com = ".$this->member->id;
        $row = [];
            
        $select = $this->trans->findAllTransactionEventByCom($id);
        foreach($select as $key => $event){
            $select[$key]->title .= " - ".$event->place;
            $data = $this->trans->findAllTotalEventByEvent($event->id, $id_com);
            $data->title .= " - ".$event->place;
            $data->amount .= '€';
            unset($data->place);
            array_push($row, $data);
        }

        $data = [
            'title' => 'Historique des ventes',
            'select' => $select,
            'role' => strtolower($this->member->role),
            'column' => ['#', 'Evenement', 'Montant Total'],
            'row' => $row
        ];  

        $this->load->view('modules/sale_history', $data);
    }

    private function get_adm_history(){
        $row = [];
            
        $select = $this->trans->findAllTransactionEvent();
        foreach($select as $key => $event){
            $select[$key]->title .= " - ".$event->place;
            $data = $this->trans->findAllTotalEventByEvent($event->id);
            $data->amount .= '€';
            $data->title .= " - ".$event->place;
            unset($data->place);
            array_push($row, $data);
        }

        $data = [
            'title' => 'Historique des commissions',
            'select' => $select,
            'role' => strtolower($this->member->role),
            'column' => ['#', 'Evenement', 'Montant Total'],
            'row' => $row
        ];  

        $this->load->view('modules/sale_history', $data);
    }

    public function test(){
        $this->load->library('seeder');

        /*$this->seeder->eventSeed();
        $this->seeder->eventPlacesSeed();
        $this->seeder->productSeed();
        $this->seeder->transactionsSeed();
        $this->seeder->transactionsEntriesSeed();*/
        //$this->seeder->eventRegistrationSeed();
    }

    private function get_transaction_row($transaction){
        $row = [];
        foreach($transaction as $key => $trans){
            $date = new DateTime($trans->created_at);
            $result = [
                'Montant' => number_format($trans->amount, 2)."€",
                'Festivalier' => $trans->firstname." ".$trans->lastname,
                'Evenement' => $trans->title,
                'Date' => date_format($date, 'd/m/Y H\hi')
            ];
            array_push($row, $result);
        }
        return $row;
    }
}
