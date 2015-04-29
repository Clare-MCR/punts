<?php
session_start();
require_once('/societies/claremcr/mcrpwd.php');
require_once('database.class.php');
require_once('user.class.php');
require_once('punts.class.php');

// Define configuration
define("DB_HOST", "localhost");
define("DB_USER", "claremcr");
define("DB_PASS", $pwd);
define("DB_NAME", "claremcr");
define("PREFIXNAME", "");

// Instantiate database.
$user = new user($_SERVER['REMOTE_USER']);
//echo $user;

if (!$user->getValue('permissions'))
{echo "User Doesn't have Viewing Permissions. Please contact the computing officer"; die;}
//echo "$test<br>";

//TODO get number punts from database

//initialise punts
$punt1 = new punt('1');
$punt2 = new punt('2');
$punt1->setValue('crsid',$user->getValue('crsid'));
$punt2->setValue('crsid',$user->getValue('crsid'));

?>

<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
<html class="no-js" lang="en">
<head>
<meta http-equiv="Content-Type\" content="text/html;charset=UTF-8">
<link type="text/css" rel="stylesheet" href="punts.css">
<script src="modernizr.min.js"></script>

<!--
<script>Modernizr.load({
  test: Modernizr.inputtypes.date,
  nope: ['http://code.jquery.com/jquery-1.10.2.js',
  		 'http://code.jquery.com/ui/1.11.1/jquery-ui.js',
  		 'http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css'],
  complete: function () {
    	$('input[type=date]').datepicker({
      		dateFormat: 'yy-mm-dd'
    });
  }
});
</script>

  'http://code.jquery.com/jquery-1.10.2.js',
  		 'http://code.jquery.com/ui/1.11.1/jquery-ui.js',
  		 'http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css',
  		 'http://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/i18n/jquery-ui-timepicker-addon-i18n.min.js',
  		 'http://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css',
  		 'http://trentrichardson.com/examples/timepicker/jquery-ui-sliderAccess.js'

-->

<script>Modernizr.load({
  test: Modernizr.inputtypes.time,
  nope: ['http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css',
  		 'http://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css',
  		 'http://code.jquery.com/jquery-1.11.1.min.js',
  		 'http://code.jquery.com/ui/1.11.1/jquery-ui.min.js',
  		 'http://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.js',
  		 'http://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-sliderAccess.js'],
  complete: function () {
		$('input[type=time]').timepicker({
			controlType: 'select',
			timeFormat: 'hh:mm tt',
			stepMinute: 30,
		});
		$('input[type=date]').datepicker({
      		dateFormat: 'yy-mm-dd'
    	});

  }
});
</script>


<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

<title>Clare MCR Punts Booking System</title>
</head>
<body id="body">
<div id="mainheader">
<h1>Clare MCR Punts Booking System</h1>
</div>
<div id="user_welcome">Welcome
<?php
 if ($user->getValue('p_adm')) {
 	echo "Admiral ";
 }
echo $user->getValue('name') ;
?>
<a href="calendar.php">Calendar</a><a href="logout.php">Home</a>
<?php if ($user->getValue('p_adm')) {echo "<a href=\"admin.php\">Admin</a>";}
?>
</div>
