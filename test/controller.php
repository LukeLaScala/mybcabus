<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	require 'functions.php';

	if (!session_id()) {
    	session_start();
	}

	if (isset($_GET['action']))
        $action = $_GET['action'];
    else {
        $action = "";
    }

    switch ($action) {
    	case "login":
    		include 'login.php';
    		break;
    	case "logout":
    		session_destroy();
			header("Location: controller.php");
			break;
        case "subscribe":
            require_login();
            $number = $_POST['number'];
            $town = $_POST['town'];

            add_subscription($number, $town, 10);
            break;
        case "":
		case "home":
			include 'home.php';
            break;
    	}
?>	