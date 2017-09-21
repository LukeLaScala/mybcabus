<?php 
if (!session_id()) {
    session_start();
}

function is_logged_in(){
	return isset($_SESSION['uid']);
}

function require_login(){
	if(!is_logged_in()){
		header("Location: controller.php?action=home");
	}
}

$user = 'mybcabus';
$pass = 'mybcabus';
$dbh = new PDO('mysql:host=localhost;dbname=mybcabus', $user, $pass);


function add_subscription($number, $town, $days_purchased){
	global $dbh;
	$stmt = $dbh->prepare("UPDATE user SET number = :number, days_purchased = :days_purchased, town = :town where uid = :uid");
 	$stmt->bindParam(':uid', $_SESSION['uid']);
 	$stmt->bindParam(':number', $number);
 	$stmt->bindParam(':days_purchased', $days_purchased);
 	$stmt->bindParam(':town', $town);
 	
  	$stmt->execute();
}
?>