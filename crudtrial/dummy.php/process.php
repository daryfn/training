<?php
require 'configuration.php';
$dbConnect = new dbConnect();

    $action = $_GET['action'];
    if($action == "create"){
        $dbConnect->add_create($_POST['name'],$_POST['role'],$_POST['password'], $_POST['date_created']);
        echo "<script>alert(\" New Data Successfully Created \");</script>";
        header("location:index.php");
    }elseif($action == "delete"){ 	
        $dbConnect->delete_remove($_GET['id']);
        echo "<script>alert(\" Data Successfully Deleted \");</script>";
        header("location:index.php");
    }elseif($action == "edit"){
        $dbConnect->edit_update($_POST['id'],$_POST['name'],$_POST['role'],$_POST['password'], $_POST['date_updated']);
        echo "<script>alert('Edit Data Successfully');</script>";
        header("location:index.php");
    }
?>