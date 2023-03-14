<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
class dbConnect {
    private $host     = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "ooptrial";
    private $conn;
    // var $result;
    // var $id;
    // var $data;
    // var $name;
    // var $role;
    // var $pass;
    // var $date_created;
    // var $date_updated;

     function __construct(){
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        mysqli_select_db($conn, $this->database);
    }

     function display_read($name, $role, $pass){
        $conn = new mysqli($this->host, $this->username, $this->password);
        $sql = "SELECT * from user name='$name', role='$role', password='$pass'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $rows = $row;
        }
        return $rows;
    }

     function add_create($name, $role, $pass, $date_created){
        $conn = new mysqli($this->host, $this->username, $this->password);
        $conn->query("INSERT into user values ('$name', '$role', '$pass', '$date_created')");
    }

     function edit_select($id){
        $conn = new mysqli($this->host, $this->username, $this->password);
        $sql = "SELECT * from user where id ='$id'";
        $result = $conn->query($sql);
        while($fetch = mysqli_fetch_array($result)){
            $result[] = $fetch;
        }
    }

     function edit_update($id, $name, $role, $pass, $date_updated){
        $conn = new mysqli($this->host, $this->username, $this->password);
        $conn->query("UPDATE user set name='$name', role='$role', password='$pass', date_updated='$date_updated' where id='$id'");
    }

     function delete_remove($id){
        $conn = new mysqli($this->host, $this->username, $this->password);
        $remove = $conn->query("DELETE from user where id='$id'");
    }
}

?>