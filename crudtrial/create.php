<?php
require 'configuration.php';
$dbConnect = new dbConnect();
// $currentDate = date_default_timezone_set('Asia/Jakarta');
?>
<a  href="index.php"><button>Back To Home</button></a>
<form action="configuration.php?action=create" method="post">
<table>
	<tr>
		<td>Name</td>
		<td>
			<input type="hidden" name="id">
			<input type="text" name="name">
		</td>
	</tr>
	<tr>
		<td>Role</td>
        <td>
            <select name="role" id="role">
                <option></option>
                <option>User</option>
                <option>Admin</option>
                <option>Client</option>
            </select>
        </td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="text" name="password"></td>
	</tr>
	<tr>
		<td><input type="submit" value="Create"></td>
	</tr>
</table>
</form>