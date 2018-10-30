<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 12/09/18
 * Time: 11:13
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$config['views_rights'] = array(

	/*
	 * routes for 2 members at least
	 */
	'signin' 							=> array('ALL' => true),
	'signup' 							=> array('ALL' => true),
	'manage-event'						=> array('ADM' => true, 'ORG' => true),
	'position' 							=> array('ADM' => true, 'COM' => true),
	'product-management' 				=> array('ADM' => true, 'COM' => true),
	'get-qrcodes/(:num)/(:num)/print' 	=> array('ADM' => true, 'COM' => true),
	'get-qrcodes/(:num)/(:num)'			=> array('ADM' => true, 'COM' => true),
	'select-qrcodes' 					=> array('ADM' => true, 'COM' => true),
	'sales-history' 					=> array('ADM' => true, 'COM' => true, 'FEST' => true),
	'incoming-events'	 				=> array('ADM' => true, 'COM' => true, 'FEST' => true, 'ORG' => true),
	'incoming-festivals'	 			=> array('ADM' => true, 'COM' => true, 'FEST' => true, 'ORG' => true),
	'logout' 							=> array('ADM' => true, 'FEST' => true, 'ORG' => true, 'COM' => true),
	'dashboard/print'					=> array('ADM' => true, 'FEST' => true, 'ORG' => true, 'COM' => true),
	'dashboard' 						=> array('ADM' => true, 'FEST' => true, 'ORG' => true, 'COM' => true),


	'test' 								=> array('ALL' => true),
	'test/charge' 						=> array('ALL' => true),


	/*
	 * 	routes for fixtures
	 */
	'transactions-fixtures'			=> array('ADM' => true, 'COM' => true),
	'users-fixtures'			=> array('ADM' => true, 'COM' => true),

	/*
	 *	3dSecure
	 */
	'payment' 					=> array('ALL' => true),

	/*
	 * 	routes for ADM
	 */
	'partners-management' => array('ADM' => true),
	'partners-management/(:any)' => array('ADM' => true),
	'partners-management/(:any)/(:num)' => array('ADM' => true),

	'members-management' => array('ADM' => true),
	'members-management/(:any)' => array('ADM' => true),
	'members-management/(:any)/(:num)' => array('ADM' => true),

	'categories-partners-management' => array('ADM' => true),
	'categories-partners-management/(:any)' => array('ADM' => true),
	'categories-partners-management/(:any)/(:num)' => array('ADM' => true),

	'events-management' => array('ADM' => true),
	'events-management/(:any)' => array('ADM' => true),
	'events-management.(:any)/(:num)' => array('ADM' => true),

	'events_places-management' => array('ADM' => true),
	'events_places-management/(:any)' => array('ADM' => true),
	'events_places-management.(:any)/(:num)' => array('ADM' => true),

/* routes pour commerçant */

	'product-management/' => array('COM' => true),
	'product-management/(:any)' => array('COM' => true),
	'product-management/(:any)/(:num)' => array('COM' => true),

	/*
	 * 	routes for ORG
	 */
	'manage-events'						=>  array('ADM' => true, 'ORG'=>true),
	'manage-event/(:num)'			=>  array('ADM' => true, 'ORG'=>true),

	'delete/event/(:any)' 		=> array('ADM' => true, 'ORG'=>true),
	'create-festival' => array('ORG' => true),
	'festivals-anouncement' => array('ORG' => true),
	'update/event/(:any)' => array('ADM' => true, 'ORG' => true),
	'add/event-places/(:num)' => array('ORG' => true),
	'delete/event-places/(:num)/(:num)' => array('ORG' => true),
	'update/event-places/(:num)' => array('ORG' => true),


	'position/event/(:num)/(:num)' => array('COM' => true),
	'position-success' => array('COM' => true),


	'delete/registration/(:any)' => array('COM' => true)
);
