<?php

/*foreach ($_POST as $key=>$value){
    $key = $value;
}*/
/*var_dump($_POST['date']);*/
include('Includes/header.php');
if (isset($_POST['date'])) {$_SESSION['date']=$_POST['date'];}

include('Includes/bookingsandcancelations.php');
include('Includes/puntstatus.php');



if (isset($_SESSION['date'])) {
	$day = new DateTime($_SESSION['date']);
} else {$day = new DateTime();}

if (isset($confirmation) && $confirmation==TRUE) {
	echo "<h1>Congratulations</h1><br><p>You have successfully " .$confirmation." the punt</p><a href='logout.php'>Return to main</a>";
} else if ((isset($_POST['book']) || isset($_SESSION['book'])) && $user->getValue('p_book')) {
	if (isset($_POST['book'])) {
		$_SESSION['book'] = $_POST['book'];
		$_SESSION['puntid'] = $_POST['puntid'];
		}
	include('Includes/BookingsDay.php');
	include('Includes/MakeBooking.php');
	include('Includes/changedate.php');
	include('Includes/puntrules.html');

} else {
	include('Includes/BookingsDay.php');
	include('Includes/BookPunt.php');
	include('Includes/changedate.php');
	include('Includes/upcoming.php');
}


include('Includes/footer.php');
?>
