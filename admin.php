<?php


include('Includes/header.php');

if (isset($_POST['date'])) {$_SESSION['date']=$_POST['date'];}

if (isset($_SESSION['date'])) {
	$day = new DateTime($_SESSION['date']);
} else {$day = new DateTime();}

if (!($user->getValue('p_adm') || $user->getValue('s_adm'))) { echo "YOU SHOULDN'T BE HERE";die;}
if (isset($_POST['menu'])){
	$_SESSION['menu']=$_POST['menu'];
}
include('Includes/Useredit.php');
include('Includes/Puntedit.php');
include('Includes/puntstatus.php');?>
<h1>Admin Tasks</h1>
<form method="POST" action=<?php $_SERVER['PHP_SELF'] ?>>
<input type="submit" name="menu" value="User Managment">
</form>
<form method="POST" action=<?php $_SERVER['PHP_SELF'] ?>>
<input type="submit" name="menu" value="Punt Managment">
</form>
<form method="POST" action=<?php $_SERVER['PHP_SELF'] ?>>
<input type="submit" name="menu" value="Booking Managment">
</form>
<?php
switch ($_SESSION['menu']) {
	case "User Managment":
		include('Includes/AdminUserTasks.php');
		break;
	case "Punt Managment":
		include('Includes/puntactions.php');
		break;
	case "Booking Managment":
		include('Includes/Adminupcoming.php');
		include('Includes/changedate.php');
		break;
}

include('Includes/footer.php');

?>