<?php
session_start();
require_once 'configuration.php';

$tracker = new tracker();
$valueIP = $tracker->get_IP();
$valueOS = $tracker->get_OS();
$valueBrowser = $tracker->get_browser();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body onload="getLocation();">
    <form class="loginform" method="post">
        <input type="hidden" id="user_id" name="user_id">
        <label for="username">Username</label>
        <br>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password</label>
        <br>
        <input type="text" id="password" name="password" required>
        <br>
        <br>
        <button type="submit" name="login">Login</button>
        <br>
        <br>
        <input type="hidden" id="ipAddress" name="ipAddress" value="<?php echo $valueIP; ?>">
        <br>
        <input type="hidden" id="os" name="os" value="<?php echo $valueOS; ?>">
        <br>
        <input type="hidden" id="browser" name="browser" value="<?php echo $valueBrowser; ?>">
        <br>
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
    </form> 
    <script src="geolocation.js"></script>
</body>


