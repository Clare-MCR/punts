<h2>Make Booking</h2>	
<h3><?php echo $punt1->getValue('name');?></h3>
<?php

if ($punt1->getValue('active')) {
	echo "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
    echo "<input type=\"submit\" name=\"book[day]\" value=\"Book\">";
    echo "<input type=\"hidden\" name=\"book[puntid]\" value=\"1\">";
    echo "<input type=\"hidden\" name=\"date\" value=\"" . $day->format('Y-m-d H:i') . "\">";
    echo "</form>";
}
?>
<h3><?php echo $punt2->getValue('name');?></h3>
<?php
if ($punt2->getValue('active')) {
	echo "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
    echo "<input type=\"submit\" name=\"book\" value=\"Book\">";
    echo "<input type=\"hidden\" name=\"puntid\" value=\"2\">";
    echo "<input type=\"hidden\" name=\"date\" value=\"" . $day->format('Y-m-d H:i') . "\">";
    echo "</form>";
}
?>