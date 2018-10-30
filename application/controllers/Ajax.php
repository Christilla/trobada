<?php

class Ajax extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->member = $this->session->userdata('oMember');
    }

    public function get_table(){
        $this->load->model('transactions_model', 'trans');
        if(null !== ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) && $_SERVER['HTTP_X_REQUESTED_WITH']){
            $post = $this->input->post();
            $id = $this->member->id;
            $role = $this->member->role;
            $place_id = $post['event'];

            switch($role){
                case 'ADM':
                    $transaction = $this->trans->findAllTransactionEventByEvent($place_id);
                    break;
                case 'FEST':
                    $transaction = $this->trans->findAllFestTransactionByEvent($id, $place_id);
                    break;
                case 'COM':
                    $transaction = $this->trans->findAllComTransactionByEvent($id, $place_id);
                    break;
            }

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($transaction));
        }
    }

    public function allEvent(){
        $this->load->model('transactions_model', 'trans');
        $role = $this->member->role;
        $id = $this->member->id;
        if(null !== ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) && $_SERVER['HTTP_X_REQUESTED_WITH']){
            switch($role){
                case 'ADM':
                    $select = $this->trans->findAllTransactionEvent();
                    $id = null;
                    break;
                case 'FEST':
                    $select = $this->trans->findAllTransactionEventByFest($id);
                    $id = 'id_fest = '.$id;
                    break;
                case 'COM':
                    $select = $this->trans->findAllTransactionEventByCom($id);
                    $id = 'id_com = '.$id;
                    break;
            }
            //$select = $this->trans->findAllTransactionEventByCom($id);
            $row = [];
            foreach($select as $event){
                $data = $this->trans->findAllTotalEventByEvent($event->id, $id);
                array_push($row, $data);
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($row));
        }
    }

    public function details(){
        if(null !== ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) && $_SERVER['HTTP_X_REQUESTED_WITH']){
            $this->load->model('transactions_model', 'trans');
            $post = $this->input->post();
            $trans_id = $post['trans_id'];
            $role = $this->member->role;
            $id = $this->member->id;
            
            $data = $this->trans->findDetailByTrans($trans_id);
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
        }
    }

    public function checked(){
        if(null !== ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) && $_SERVER['HTTP_X_REQUESTED_WITH']){
            $post = $this->input->post();
            $this->load->model('transactions_model', 'trans');

            $where = [
                'id_com' => $post['id_com'],
                'events_places_id' => $post['id_place']
            ];

            try{
                $data = $this->trans->updateChecked($where);
            } catch(Exception $e){
                $data = false;
            }
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
        }
    }
}