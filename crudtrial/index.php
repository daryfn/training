<?php
session_start();
?>
<a href="create.php"><button>Create Account</button></a>
<a href="configuration.php?&action=logout"><button type="submit" name="logout">logout</button></a>
<table border="1" align="center" method="post">
    <tr>
        <th>Number</th>
        <th>Name</th>
        <th>Role</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php
    require_once "configuration.php";
    $number = 1;
    $dbConnect = new dbConnect();
    $data = $dbConnect->display_read("name", "role", "password", "status");
    foreach((array)$data as $value){

    ?>
    <tr align="center">
        <td><?php echo $number++; ?></td>
        <td><?php echo $value['name']; ?></td>
        <td><?php echo $value['role']; ?></td>
        <td><?php echo $value['status']; ?></td>
        <td>
            <a href="userdetails.php?id=<?php echo $value['id']; ?>&action=viewdetails"><button>View Details</button></a>
        </td>
    </tr>
    <?php
    }
    ?>
</table>



