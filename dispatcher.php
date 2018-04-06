<?php
session_start();
include_once(dirname(__FILE__) . '/Config/core.php');
echo "dispatcher";


		
	if (isset($_GET['url'])) {
	    $url = $_GET['url'];
	} else {
		//APPEL View Home;
	}


	include_once (dirname(__FILE__) . '/Src/router.php');
	switch ($class) {
		case 'UsersController':
			switch ($method) {
				case 'Inscription':
					$usersController->Inscription($url[2], $url[4], $url[5], $url[3]);
					break;
                case 'Login':
                    $usersController->Login($url[2], $url[3]);
                    break;
                case 'viewLogin':
                    $usersController->viewLogin();
                    break;
                case 'viewSubscription':
                    $usersController->viewSubscription();
                    break;
                case 'viewHome':
                    $usersController->viewHome();
                    break;
                case 'logout':
                    $usersController->logout();
                    break;
                case 'deleteUser':
                    echo "coucou";
                        $usersController->delete($_SESSION['email']);
                    break;
				default:
					# code...
					break;
			}
			break;
		
		default:
            $usersController->viewLogin();
			break;
	}






