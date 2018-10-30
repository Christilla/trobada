<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


/**
 * Routes grocery CRUD
 */
$route['members-management'] = 'grocery_admin/members';
$route['members-management/(:any)'] = 'grocery_admin/members/$1';
$route['members-management/(:any)/(:num)'] = 'grocery_admin/members/$1/$2';

$route['events-management'] = 'grocery_admin/events';
$route['events-management/(:any)'] = 'grocery_admin/events/$1';
$route['events-management/(:any)/(:num)'] = 'grocery_admin/events/$1/$2';

$route['events_places-management'] = 'grocery_admin/events_places';
$route['events_places-management/(:any)'] = 'grocery_admin/events_places/$1';
$route['events_places-management/(:any)/(:num)'] = 'grocery_admin/events_places/$1/$2';

$route['partners-management'] = 'grocery_admin/partners';
$route['partners-management/(:any)'] = 'grocery_admin/partners/$1';
$route['partners-management/(:any)/(:num)'] = 'grocery_admin/partners/$1/$2';

$route['categories-partners-management'] = 'grocery_admin/categories_partners';
$route['categories-partners-management/(:any)'] = 'grocery_admin/categories_partners/$1';
$route['categories-partners-management/(:any)/(:num)'] = 'grocery_admin/categories_partners/$1/$2';

$route['product-management'] = 'grocery_admin/product_management';
$route['product-management/(:any)'] ='grocery_admin/product_management/$1';
$route['product-management/(:any)/(:num)'] = 'grocery_admin/product_management/$1/$2';



/**
 * Routes Members
 */
			/*
			 * 	All members
			 */
			$route['dashboard'] = 'members/dashboard';
			$route['logout'] = 'members/logout';
			$route['incoming-events'] = 'members/incoming_events';


			/*
			 * 	Members ADM
			 */
            $route['commissions-management'] = '';


			/*
			 * 	Members COM
			 */
			$route['sales-history'] = 'transaction';
			$route['position'] = 'events/toPositionYourself';
			$route['get-qrcodes'] = 'trader/get_qrcodes';
            $route['get-qrcodes/(:num)/(:num)'] = 'trader/get_qrcodes/$1/$2';
			$route['get-qrcodes/(:num)/(:num)/print'] = 'trader/print_qrcode/$1/$2';
            $route['select-qrcodes'] = 'trader/select_qrcodes';
			$route['incoming-events'] = 'events/allEvents';
			$route['position/event/(:num)'] = 'events/toPositionYourself/$1';
			$route['position/event/(:num)/(:num)'] = 'events/toPositionYourself/$1/$2';
			$route['delete/registration/(:num)'] = 'events/deleteEventsRegistrations/$1';



			/*
			 * fixtures
			 */
			$route['transactions-fixtures'] = 'fixtures/transactions_fixtures';
			$route['users-fixtures'] = 'fixtures/users_fixtures';

			/*
			 * 	Members FEST
			 */
			$route['dashboard/print'] = 'members/printable';

			/*
			 * 	Members ORG
			 */
	
			$route['create-festival'] = 'events/setEvent';
			$route['festivals-anouncement'] = 'events/allEventsBy';

			$route['update/event/(:num)'] = 'events/updateEvent/$1';
			$route['delete/event/(:num)'] = 'events/deleteEvent/$1';

			$route['add/event-places/(:num)'] = 'events/addEventsPlaces/$1';
			$route['delete/event-places/(:num)/(:num)'] = 'events/deleteEventPLaces/$1/$2';
			$route['update/event-places/(:num)'] = 'events/updateEventPlaces/$1';

			$route['manage-event/(:num)'] = 'events/manage_event/$1';
			$route['manage-events'] = 'events/allEventsBy';


/**
 * Routes for all users
 */
$route['ajax/table/details'] = "ajax/details";
$route['ajax/table/all'] = "ajax/allEvent";
$route['ajax/check'] = "ajax/checked";
$route['ajax/table'] = "ajax/get_table";
$route['test'] = 'transaction/ajax_request';

$route['festival'] = 'pages/festival';

$route['payment'] = 'payment/payment';

$route['signup'] = 'user/signUp';
$route['signin'] = 'members/signIn';
$route['errors/(:any)'] = 'errors/$1';

$route['sendmessage'] = 'pages/sendMessage';
$route['partenaire'] = 'pages/partenaire';
$route['(:any)'] = 'pages/view/$1';


/**
 * Keys routes
 */
$route['default_controller'] = 'pages/view';

//$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
