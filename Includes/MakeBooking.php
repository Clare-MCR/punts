<div name="Puntbooking">
<h2>Book Punting Slot</h2>
<?php echo "<form method=\"post\" action=\""  . $_POST['SELF.PHP'] . "\">"; ?>
<table border="0" class="booking_table">
<tr><th>Name</th></tr>
<tr><?php echo "<td><input type=\"text\" name=\"booking[name]\" value=\"". $user->getValue('name')."\" required>"; ?></td></tr></table>

<table border="0" class="booking_table">
<tr><th>Punt</th></tr>
<tr><?php echo "<td><select name=\"booking[puntid]\" required>";
if (isset($_SESSION['puntid']) )
{
	if ($_SESSION['puntid']=="1"){
		echo "<option value=\"1\" selected>" . $punt1->getValue('name') ."</option>";
		if ($punt2->getValue(active)){echo "<option value=\"2\">" . $punt2->getValue('name') ."</option>";}
	} else {
		if ($punt1->getValue('active')){echo "<option value=\"1\">" . $punt1->getValue('name') ."</option>";}
		echo "<option value=\"2\" selected>" . $punt2->getValue('name') ."</option>";
	}
} else {
	if ($punt1->getValue('active')){echo "<option value=\"1\">" . $punt1->getValue('name') ."</option>";}
	if ($punt2->getValue('active')){echo "<option value=\"2\">" . $punt2->getValue('name') ."</option>";}
}
echo "</select>"; ?></td></tr></table>

<table border="0" class="booking_table">
<tr><th>Start Day</th></tr>
<tr><?php echo "<td><input type=\"date\" name=\"booking[startdate]\" min=\"". date('Y-m-d') . "\"  value=\"". $day->format('Y-m-d') . "\" required />";
?></td></tr></table>

<table border="0" class="booking_table">
<tr><th>Start Time</th></tr>
<tr><?php echo "<td><input class=\"timepicker\" type=\"time\" name=\"booking[starttime]\" min=\"00:00\"  value=\"". $day->format('H:i') . "\" step=\"1800\" required />";
?></td></tr></table>

<?php if ($user->getValue('p_adm')) {
	echo '<table border="0" class="booking_table">';
	echo '<tr><th>End Day</th></tr>';
	echo "<tr><td><input type=\"date\" name=\"booking[enddate]\" min=\"". date('Y-m-d') . "\"  value=\"". $day->format('Y-m-d') . "\" required />";
	echo '</td></tr></table>';

	echo '<table border="0" class="booking_table">';
	echo '<tr><th>End Time</th></tr>';
	echo "<tr><td><input type=\"time\" name=\"booking[endtime]\" min=\"00:00\"  value=\"". $day->format('H:i') . "\"  step=\"1800\" required/>";
	echo '</td></tr></table>';

} else {
	echo '<table border="0" class="booking_table">';
	echo '<tr><th>Duration</th></tr>';
	echo '<tr><td><select name="booking[duration]" required>';
	for($hours=0; $hours<4; $hours++) // the interval for hours is '1'
    	{for($mins=0; $mins<60; $mins+=30) // the interval for mins is '30'
        	{echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                    	    .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';}}
	echo '</td></tr></table>';

}

echo '<table border="0" class="booking_table">';
echo '<tr><th>Mobile Number</th></tr>';
echo "<tr><td><input type=\"number\" name=\"booking[mobile]\" value=\"". $user->getValue('mobile')."\" required>";
echo '</td></tr></table>';

echo '<table border="0" class="booking_table">';
echo '<tr><td><input type="submit"  value="Book"></td></tr></table>';


?>

</form></div>
