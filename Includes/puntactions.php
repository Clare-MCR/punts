<h1>Vessel Utilities</h1>
<?php
echo "<h3>" .$punt1->getValue('name') . "</h3>";
if ((bool)$punt1->getValue('active')){
	echo "<p>Vessel is available until " . $punt1->getValue('available_to') . "</p>";
}else{
	echo "<p>Vessel Inactive</p>";
}

echo "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
echo "<input type=\"hidden\" name=\"vessel[puntid]\" value=\"" . $punt1->getValue('id') . "\">";
echo "<table border=\"0\" id=\"puntavailable\">";
echo "<tr><th>Available From</th><th>Available To</th></tr>";
echo "<tr>";
echo "<td><input type=\"date\" name=\"vessel[from]\" min=\"". date('Y-m-d') . "\"  value=\"". $day->format('Y-m-d') . "\" required /></td>";
echo "<td><input type=\"date\" name=\"vessel[to]\" min=\"". date('Y-m-d') . "\"  value=\"". $day->format('Y-m-d') . "\" required /></td>";
 echo "<td><input type=\"submit\" name=\"vessel[change]\" value=\"Change Vessel Activity\"></td></tr>";

echo "</table>";

echo "<h3>" .$punt2->getValue('name') . "</h3>";
if ((bool)$punt2->getValue('active')){
	echo "<p>Vessel is available until " . $punt2->getValue('available_to') . "</p>";
}else{
	echo "<p>Vessel Inactive</p>";
}

echo "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
echo "<input type=\"hidden\" name=\"vessel[puntid]\" value=\"" . $punt2->getValue('id') . "\">";
echo "<table border=\"0\" id=\"puntavailable\">";
echo "<tr><th>Available From</th><th>Available To</th></tr>";
echo "<tr>";
echo "<td><input type=\"date\" name=\"vessel[from]\" min=\"". date('Y-m-d') . "\"  value=\"". $day->format('Y-m-d') . "\" required /></td>";
echo "<td><input type=\"date\" name=\"vessel[to]\" min=\"". date('Y-m-d') . "\"  value=\"". $day->format('Y-m-d') . "\" required /></td>";

echo "<td><input type=\"submit\" name=\"vessel[change]\" value=\"Change Vessel Activity\"></td></tr>";

echo "</table>";
?>