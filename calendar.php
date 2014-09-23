<?php
include('Includes/header.php');

if (isset($_POST['date'])) {$_SESSION['date']=$_POST['date'];}

if (isset($_SESSION['date'])) {
	$day = new DateTime($_SESSION['date']);
} else {$day = new DateTime();}

if (!$user->getValue('p_adm')||!$user->getValue('s_adm')) { echo "YOU SHOULDN'T BE HERE";die;}
if (isset($_POST['menu'])){
	$_SESSION['menu']=$_POST['menu'];
}
include('Includes/puntstatus.php');

include('Includes/BookingsDay.php');
include('Includes/changedate.php');
include('Includes/footer.php');
?>