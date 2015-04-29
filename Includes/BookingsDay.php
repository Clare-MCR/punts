<h2>Bookings Today (" <?php echo $day->format('d/m/Y') ?> ")</h2>
<h3><?php echo $punt1->getValue('name');?></h3>

<?php

//$day = new DateTime();
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
    	echo "</td><td>".$to->format('H:i')."</td><td>".$row['mobile']."</td></tr>";
    	unset($from,$to);
    }
    echo "</table>" ;
}
else {echo "<p>There are currently no bookings for today.</p>";}

?>



<h3><?php echo $punt2->getValue('name');?></h3>

<?php
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
    	echo "</td><td>".$to->format('H:i')."</td><td>".$row['mobile']."</td></tr>";
    	unset($from,$to);
    }
	echo "</table>";}
else {echo "<p>There are currently no bookings for today.</p>";}
?>

