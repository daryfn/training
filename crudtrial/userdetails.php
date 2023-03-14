<?php
session_start();

?>
<a href="index.php"><button>Back To Home</button></a>
<a href="configuration.php?&action=logout"><button type="submit" name="logout">Logout</button></a>
<table border="1" align="center">
    <tr>
        <th>Account ID</th>
        <th>Name</th>
        <th>Role</th>
        <th>Password</th>
        <th>Status</th>
        <th>Login Date</th>
        <th>Location</th>
        <th>Actions</th>
    </tr>
    <?php
    require_once "configuration.php";
    if(isset($_GET['id'])){
    $id = $_GET['id'];
    $dbConnect = new dbConnect();
    $data = $dbConnect->user_details($id);
    }
    foreach((array)$data as $value){

    ?>
    <tr align="center">
        <td><?php echo $value['id']; ?></td>
        <td><?php echo $value['name']; ?></td>
        <td><?php echo $value['role']; ?></td>
        <td><?php echo $value['password']; ?></td>
        <td><?php echo $value['status']; ?></td>
        <td><?php echo $value['login_date']; ?></td>
        <td style="width:50%;height:300px;"><iframe src="https://www.google.com/maps?q=<?php echo $value['latitude'];?>, <?php echo $value['longitude'];?>&hl=es;z=14&output=embed" style="width:100%; height:100%;"></iframe></td>
        <td>
            <a href="edit.php?id=<?php echo $value['id']; ?>&actions=edit"><button>Edit</button></a>
            <a href="configuration.php?id=<?php echo $value['id']; ?>&action=delete"><button>Delete</button></a>
        </td>
    </tr>
    <?php
    }
    ?>
    <script src="geolocation.js"></script>
</table>



