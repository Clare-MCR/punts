<h2>Book Punting Slot</h2>
<?php echo "<form method=\"post\" action=\""  . $_POST['SELF.PHP'] . "\">"; ?>
<table border="0" class="booking_table">
<tr><th>Name</th><th>Punt</th><th>Start Day</th><th>Start Time</th> <?php 	if ($user->getValue('p_adm')) {echo "<th>End Day</th><th>End Time</th>";}else{
echo "<th>Duration</th>";} ?> <th>Mobile Number</th><th></th></tr><tr>
<?php

echo "<td><input type=\"text\" name=\"booking[name]\" value=\"". $user->getValue('name')."\" required>";

echo "<td><select name=\"booking[puntid]\" required>";
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
echo "</select></td>";

echo "<td><input type=\"date\" name=\"booking[startdate]\" min=\"". date('Y-m-d') . "\"  value=\"". $day->format('Y-m-d') . "\" required /></td>";
echo "<td><input class=\"timepicker\" type=\"time\" name=\"booking[starttime]\" min=\"00:00\"  value=\"". $day->format('H:i') . "\" step=\"1800\" required /></td>";
	//duration
if ($user->getValue('p_adm')) {
	echo "<td><input type=\"date\" name=\"booking[enddate]\" min=\"". date('Y-m-d') . "\"  value=\"". $day->format('Y-m-d') . "\" required /></td>";
	echo "<td><input type=\"time\" name=\"booking[endtime]\" min=\"00:00\"  value=\"". $day->format('H:i') . "\"  step=\"1800\" required/></td>";
} else {
	echo '<td><input type="time" name="booking[duration]" min="00:30" max="03:00" step="1800" value="00:30" required></td>';
}


echo "<td><input type=\"number\" name=\"booking[mobile]\" value=\"". $user->getValue('mobile')."\" required>";


echo "<td><input type=\"submit\"  value=\"Book\"></td>";

?>
</tr>
</table>
</form>
