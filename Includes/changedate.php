<hr/>
<h2>Check Bookings on Other days</h2>
<p>To book or view other days, please select the date here.</p>
<?php
# Create a form for viewing other days
    //$monthnos = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');

    
    # Play around with HTML5 date input
    # http://diveintohtml5.org/forms.html#type-date
    # currently not functional in most browsers, but if we can detect for it, we can make our life a lot easier
    echo "<form method=\"post\" action=\"" . $_POST['SELF.PHP'] . "\">";

	//echo "<style>::-webkit-calendar-picker-indicator {display: none;}</style>";
	echo "<input type=\"date\" name=\"date\" min=\"". date('Y-m-d') . "\"  value=\"". date('Y-m-d') . "\" />";
    echo "<input type=\"submit\"  value=\"View Day\">";

    
?>
</form>
<hr/>

