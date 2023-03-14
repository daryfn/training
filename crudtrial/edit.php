<?php
require 'configuration.php';
$dbConnect = new dbConnect();

?>

<a  href="index.php"><button>Back To Home</button></a>
<form action="configuration.php?action=edit" method="post">

<?php
foreach((array)$dbConnect->edit_select($_GET['id']) as $data){
?>

<table>
	<tr>
		<td>Name</td>
		<td>
			<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
			<input type="text" name="name" value="<?php echo $data['name'] ?>">
		</td>
	</tr>
	<tr>
		<td>Role</td>
		<td><input type="text" name="role" value="<?php echo $data['role'] ?>"></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="text" name="password" value="<?php echo $data['password'] ?>"></td>
	</tr>
	<tr>
		<td><input type="submit" value="Save"></td>
	</tr>
</table>
<?php
}
?>
</form>




