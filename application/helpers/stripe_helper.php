<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
    This is an helper for Stripe use with caution
*/

//Verify if the actual customer have already an id for Stripe in database
function customer_exists(stdClass $customer){
    if(!is_null($customer->cus_id)){
        return true;
    } else {
        return false;
    }
}

//Get 10 futur year
function get_year(){
    $current_date = date('Y');
		$year = [];
		for($i = 0; $i < 10; $i++){
			if($i == 0){
				$year = [(int)$current_date];
			} else {
				$new = $current_date+$i;
				array_push($year, $new);
			}
		}
    return $year;
}

//Get all month
function get_month(){
	$month = [
		'Janvier' => 1,
		'Fevrier' => 2,
		'Mars' => 3,
		'Avril' => 4,
		'Mai' => 5,
		'Juin' => 6,
		'Juillet' => 7,
		'Aout' => 8,
		'Septembre' => 9,
		'Octobre' => 10,
		'Novembre' => 11,
		'Decembre' => 12
	];
	return $month;
}
