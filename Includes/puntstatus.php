<div class="note punt-status">
<h2>Current Punt Status</h2>
<table border="0" class="display_info" id="punt_status">
<tr><th>Punt Name</th><th>Punt Status</th><th>Present Booking Status</th></tr>

<tr><td><?php echo $punt1->getValue('name'); ?></td><td>
<?php if ($punt1->getValue(active)){
	echo "Active</td> ";
	if ($punt1->getValue('booked')) {echo "<td class=\"booked\">Booked";
	} else {echo "<td class=\"free\">Free";}
} else {echo "Inactive</td><td class=\"Inactive\">Inactive ";} 
	?> </td>

<tr><td><?php echo $punt2->getValue('name'); ?></td><td>
<?php 
if ($punt2->getValue(active)){
	echo "Active</td> ";
	if ($punt2->getValue('booked')) {echo "<td class=\"booked\">Booked";
	} else {echo "<td class=\"free\">Free";}
} else {echo "Inactive</td><td class=\"Inactive\">Inactive ";} 
?> 
</td></table></div>