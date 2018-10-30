<?php

class Form_validation_date
{
    public function form_date($starting_date, $ending_date)
    {
        if(!empty($starting_date) && !empty($ending_date))
        {
            if($starting_date > $ending_date)
            {            
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return NULL;
        }
    }

    public function form_date_run($starting_date, $ending_date)
    {
        $data = array();
        $data = $this->form_date($starting_date, $ending_date);
        
        if($data === FALSE)
        {
            $data[] = "Le champ $starting_date doit être après le champ $ending_date";

            return $data;
        }
    }
}

?>
