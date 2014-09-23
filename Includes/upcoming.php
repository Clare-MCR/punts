<?php

if (! $user->has_perm('adm')) {
    echo "<p>User does not have permission</p>";
} else {

    # This function displays all a users bookings, where NOW() < time_to
  
    echo "<h2>Bookings and Status</h2>";
	$upcomingbookings1 = $punt1->userBookings();
	$upcomingbookings2 = $punt2->userBookings();

	if ((bool) $upcomingbookings1 ||(bool) $upcomingbookings2) {
		if ((bool) $upcomingbookings1){
		    echo "<h3>".$punt1->getValue('name')."</h3>";
		    echo "<table border=\"0\" class=\"display_info\">";
        	echo "<tr><th>Date</th><th>Duration</th><th></th></tr>\n";
        	foreach ($upcomingbookings1 as $up1) {
        		$from = new DateTime($up1['time_from']);
        		$to = new DateTime($up1['time_to']);
        		$diff = $from->diff($to);
        		echo "<tr><td>".$from->format('d/m/Y H:i')."</td>";
        		echo "<td>".$diff->format('%H:%I')."</td>";
        		echo "<td><form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
            	echo "<input type=\"submit\" name=\"cancel[cancel]\" value=\"Cancel Booking\">";
            	echo "<input type=\"hidden\" name=\"cancel[id]\" value=\"" . $up1['id'] . "\">";
            	echo "</form></td></tr>\n";
            	unset($from,$to,$diff);
        	}
    		echo "</table>\n";
        }
        if ((bool) $upcomingbookings2){
        	echo "<h3>".$punt2->getValue('name')."</h3>";
        	echo "<table border=\"0\" class=\"display_info\">";
        	echo "<tr><th>Date</th><th>Duration</th><th></th></tr>\n";
        	foreach ($upcomingbookings2 as $up2) {
        		$from = new DateTime($up2['time_from']);
        		$to = new DateTime($up2['time_to']);
        		$diff = $from->diff($to);
        		echo "<tr><td>".$from->format('d/m/Y H:i')."</td>";
        		echo "<td>".$diff->format('%H:%I')."</td>";
        		echo "<td><form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
            	echo "<input type=\"submit\" name=\"cancel[cancel]\" value=\"Cancel Booking\">";
            	echo "<input type=\"hidden\" name=\"cancel[id]\" value=\"" . $up2['id'] . "\">";
            	echo "</form></td></tr>\n";
            	unset($from,$to,$diff);
			}
			echo "</table>\n";
		}
	} else { echo "<p>You have no upcoming bookings</p>";
	}
    
}
?>