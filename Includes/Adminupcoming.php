<?php

if (! $user->has_perm('adm')) {
    echo "<p>User does not have permission</p>";
} else {

    # This function displays all a users bookings, where NOW() < time_to
  
    echo "<h1>Bookings and Status</h2>";
    echo "<h2>Bookings (". $day->format('d/m/Y') . ")</h2>";
	echo "<h3>". $punt1->getValue('name')."</h3>";
	$bookedrows = $punt1->bookedDay($day->format('Y-m-d'));
	
	if ($punt1->getValue('bookedDay')){
		echo "<table border=\"0\" class=\"display_info\">\n";
		echo "<tr><th>Booker</th><th>CRSID</th><th>Time From</th><th>Time To</th><th>Mobile</th></tr>\n";
		foreach ($bookedrows as $row)
		{
			$from = new DateTime($row['time_from']);
			$to = new DateTime($row['time_to']);

			echo "<tr><td>". $row['name']."</td><td>".$row['booker']."</td>";
			echo "<td>".$from->format('H:i');
			echo "</td><td>".$to->format('H:i')."</td><td>".$row['mobile']."</td>";
			echo "<td><form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
				echo "<input type=\"submit\" name=\"cancel[cancel]\" value=\"Cancel Booking\">";
				echo "<input type=\"hidden\" name=\"cancel[id]\" value=\"" . $row['id'] . "\">";
				echo "<input type=\"hidden\" name=\"cancel[crsid]\" value=\"" . $row['booker'] . "\">";
			echo "</form></td></tr>\n";
			unset($from,$to);
		}
		echo "</table>" ;
	} else {echo "No Bookings on this Day";}
	
	echo "<h3>". $punt2->getValue('name')."</h3>";

	$bookedrows = $punt2->bookedDay($day->format('Y-m-d'));
	
	if ($punt2->getValue('bookedDay')){
		echo "<table border=\"0\" class=\"display_info\">\n";
		echo "<tr><th>Booker</th><th>CRSID</th><th>Time From</th><th>Time To</th><th>Mobile</th></tr>\n";
		foreach ($bookedrows as $row)
		{
			$from = new DateTime($row['time_from']);
			$to = new DateTime($row['time_to']);

			echo "<tr><td>". $row['name']."</td><td>".$row['booker']."</td>";
			echo "<td>".$from->format('H:i');
			echo "</td><td>".$to->format('H:i')."</td><td>".$row['mobile']."</td>";
			echo "<td><form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
				echo "<input type=\"submit\" name=\"cancel[cancel]\" value=\"Cancel Booking\">";
				echo "<input type=\"hidden\" name=\"cancel[id]\" value=\"" . $row['id'] . "\">";
				echo "<input type=\"hidden\" name=\"cancel[crsid]\" value=\"" . $row['booker'] . "\">";
			echo "</form></td></tr>\n";
			unset($from,$to);
		}
		echo "</table>" ;
	} else {echo "No Bookings on this Day";}

    
}
?>