<h1>User Account Management</h1>
<div class="note">
<p>To add users or edit their permissions, please enter a comma separated list of CRSids into the box, and select the type of access permission.</p>
<p>List e.g. foo12,bar13,npx24,nlpd2</p>
</div>

<h2>Add/Edit User(s) in Database</h2>
<p>Add/Edit user(s) by listing their CRSid, and click 'Add User'.</p>
<?php
echo "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
echo "<input type=\"text\" name=\"usersinfo[users]\" size=\"100\" required><br>";
# Add punt permissions boxes (incl. default numbers)
?>
<table id="form">
	<tr><th></th><th>Default</th><th>False</th><th>True</th></tr>
    <tr><td>Punt View</td>
    	<td><input type="radio" name="usersinfo[p_view]" value="0" checked></td>
    	<td><input type="radio" name="usersinfo[p_view]" value="1"></td>
    	<td><input type="radio" name="usersinfo[p_view]" value="2"></td></tr>
    <tr><td>Punt Book</td>
    	<td><input type="radio" name="usersinfo[p_book]" value="0" checked></td>
    	<td><input type="radio" name="usersinfo[p_book]" value="1"></td>
    	<td><input type="radio" name="usersinfo[p_book]" value="2"></td></tr>
    <tr><td>Enabled</td>
    	<td><input type="radio" name="usersinfo[enabled]" value="0" checked></td>
    	<td><input type="radio" name="usersinfo[enabled]" value="1"></td>
    	<td><input type="radio" name="usersinfo[enabled]" value="2"></td></tr>
<?php
if ($user->getValue('s_adm')){
    echo '<tr><td>Event View</td>
    <td><input type="radio" name="usersinfo[e_view]" value="0" checked></td>
    <td><input type="radio" name="usersinfo[e_view]" value="1"></td>
    <td><input type="radio" name="usersinfo[e_view]" value="2"></td></tr> ';
    echo '<tr><td>Event Book</td>
    <td><input type="radio" name="usersinfo[e_book]" value="0" checked></td>
    <td><input type="radio" name="usersinfo[e_book]" value="1"></td>
    <td><input type="radio" name="usersinfo[e_book]" value="2"></td></tr> ';
    echo '<tr><td>Event Admin</td>
    <td><input type="radio" name="usersinfo[e_adm]" value="0" checked></td>
    <td><input type="radio" name="usersinfo[e_adm]" value="1"></td>
    <td><input type="radio" name="usersinfo[e_adm]" value="2"></td></tr> ';
    echo '<tr><td>Punt Admin</td>
    <td><input type="radio" name="usersinfo[p_adm]" value="0" checked></td>
    <td><input type="radio" name="usersinfo[p_adm]" value="1"></td>
    <td><input type="radio" name="usersinfo[p_adm]" value="2"></td></tr> ';
    echo '<tr><td>System Admin</td>
    <td><input type="radio" name="usersinfo[s_adm]" value="0" checked></td>
    <td><input type="radio" name="usersinfo[s_adm]" value="1"></td>
    <td><input type="radio" name="usersinfo[s_adm]" value="2"></td></tr> ';
    echo '<tr><td>Type</td>
    <td><input type="radio" name="usersinfo[type]" value="0" checked></td>
    <td><input type="radio" name="usersinfo[type]" value="1"></td>
    <td><input type="radio" name="usersinfo[type]" value="2"></td></tr> ';
    echo '<tr><td>College Bill</td>
    <td><input type="radio" name="usersinfo[college_bill]" value="0" checked></td>
    <td><input type="radio" name="usersinfo[college_bill]" value="1"></td>
    <td><input type="radio" name="usersinfo[college_bill]" value="2"></td></tr> ';
    }
    echo "</table><br>";
    if ($user->getValue('s_adm')){
		echo "<input type=\"radio\" name=\"usersinfo[membership]\" value=\"mcr_member\" checked>MCR Member<br>";
		echo "<input type=\"radio\" name=\"usersinfo[membership]\" value=\"cra\">CRA<br>";
		echo "<input type=\"radio\" name=\"usersinfo[membership]\" value=\"associate_member\">Associate Member<br>";
    }


?>
<input type="submit" name="addusers[submit]" value="Add User">
</form>
<hr/>



<?php
if ((bool) $user->getValue('s_adm')){
	echo "<h2>Delete Users on System</h2>";
	echo "<p>Edit user(s) by listing their CRSid, and click 'Edit User'.</p>";
	echo "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
	echo "<input type=\"text\" name=\"deleteusers[users]\" size=\"100\" required>";
	echo "<input type=\"submit\" name=\"deleteusers[submit]\" value=\"Delete User\">";
	echo "</form><hr/>";
}
?>
