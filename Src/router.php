<?php

$url = explode('/', $url);
//var_dump($url);
$class =  $url[0];
$method = $url[1];

/*
switch ($class) {
	case 'UsersController':
		switch ($method) {
			case 'Edit':
				
				break;
			case 'Inscription':

				break;
			case 'checkUsers':

				break;
			case 'viewUsers':

				break;
			case 'checkSingleUser':

				break;
			case 'viewSingleUser':

				break;
			case 'checkUserGroup':

				break;
			case 'secure_input':

				break;
			case 'hashPassword':

				break;
			case 'checkPassword':

				break;
			case 'checkEmailExist':

				break;
			case 'checkEmailFormat':

				break;
			case 'checkStatus':

				break;
			
			default:
				//Appel View Home
				break;
		}
		break;
	case 'ArticlesController':

		break;
	default:
		// APPEL View home
		break;
}
*/