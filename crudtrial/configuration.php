<?php
class dbConnect {
    private $host     = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "ooptrial";
    private $conn;
    // var $date_created = date('Y-m-d H:i:s');
    
    // CONNECT DATABASE
     function __construct(){
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
    }

    function connect(){
        return mysqli_connect('localhost', 'root', '', 'ooptrial');
    }

    function query($query){
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);
        return $result;
    }

     function display_read(){
        $query = mysqli_query($this->conn, "SELECT * from user");
        while($data = mysqli_fetch_assoc($query)){
            $result[] = $data;
        }
        return $result;
    }

    function user_details($id){
        $query = mysqli_query($this->conn, "SELECT u.id, u.name, u.role, u.password, ut.latitude, ut.longitude, ut.status, ut.login_date from user u LEFT JOIN user_tracker ut ON u.id = ut.user_id WHERE ut.user_id = $id AND ut.offline = ''");
        while($data = mysqli_fetch_assoc($query)){
        $result[] = $data;
        return $result;
        }
    }   

     function add_create($name, $role, $pass){
        mysqli_query($this->conn, "INSERT into user (name, role, password) values ('$name', '$role', '$pass')");
    }

     function edit_select($id){
        $query = mysqli_query($this->conn, "SELECT * from user where id ='$id'");
        while($data = mysqli_fetch_array($query)){
            $result[] = $data;
        }
        return $result;
    }

     function edit_update($id, $name, $role, $pass){
        mysqli_query($this->conn, "UPDATE user set name='$name', role='$role', password='$pass' where id='$id'");
    }

     function delete_remove($id){
        mysqli_query($this->conn, "DELETE from user where id='$id'");
    }

    function save_tracker($user_id,$clientIP, $os_platform, $browser_platform, $latitude, $longitude){
        mysqli_query($this->conn, "INSERT into user_tracker (user_id, IP_ADDRESS, OS, browser, latitude, longitude) values ('$user_id', '$clientIP', '$os_platform', '$browser_platform', '$latitude', '$longitude')");
    }

    function update_tracker($logout_date, $offline){
        $logout_date = date('Y-m-d H:i:s');
        $offline = 1;
        mysqli_query($this->conn, "UPDATE user_tracker set logout_date = $logout_date, offline = $offline where offline = NULL");
    }

    function login(){
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (isset($_POST['login'])){

            // $getUSerID = "";
            $username = $_POST['username'];
            $password = $_POST['password'];
            $query    = "SELECT id, name, password FROM user WHERE name = '$username' AND password = '$password'";
            $result   = mysqli_query($this->conn, $query);
            $check    = mysqli_num_rows($result);
            $getUSerID = mysqli_fetch_assoc($result);
            $txt      = 'Has Logged In'. '%0A' . 'Username: '. $_POST['username']. '%0A' . 'IP Address: '. $_POST['ipAddress']. '%0A' . 'Operation System: '. $_POST['os']. '%0A' . 'Browser: '. $_POST['browser']. '%0A' . 'Location: '. $_POST['latitude'].','. $_POST['longitude'];
            $tele_report = "https://api.telegram.org/bot5885434176:AAEaQF0_ZXfCu30gWdYQTAooZePDGO_fcGs/sendMessage?chat_id=-1001504230320&text=$txt";
            if ($check > 0) {
                // set SESSION
                $_SESSION['login'] = true;
                $_SESSION['id'] = $getUSerID['id'];
                $this->save_tracker($_SESSION['id'], $_POST['ipAddress'], $_POST['os'], $_POST['browser'], $_POST['latitude'], $_POST['longitude']);
                file_get_contents($tele_report);       
                echo "<script>alert(\" Successfully Login \");</script>";
                echo "<script>window.location = 'index.php';</script>";
                exit;
            } else {
                echo "<script>alert(\" Incorrect Username or Password \");</script>";
                echo "<script>window.location = 'login.php';</script>";
            }
        } 
    }

    function logout(){
        session_start();
            $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
            $query  = "SELECT user_id FROM user_tracker WHERE offline = 0";
            $exec   = mysqli_query($this->conn, $query);
            $check  = mysqli_num_rows($exec);
            $result = mysqli_fetch_assoc($exec);
            if($check > 0){
                $_SESSION['user_id'] = $result['user_id'];
                mysqli_query($this->conn, "UPDATE user_tracker SET offline = 1 where user_id = '{$_SESSION['user_id']}'");
                unset($_SESSION['user_id']);
                // session_destroy();
                    // echo "<script>alert(\"You Successfully Logout and See U Later !\");</script>";
                    // echo "<script>window.location = 'login.php';</script>";
                    exit;
            } else {
                echo "<script>alert(\" Failed To Logout \");</script>";
            }


       
    }

}
    $dbConnect = new dbConnect();

    if(isset($_GET['action'])){
        $action = $_GET['action'];
        if($action == "create"){
            $dbConnect->add_create($_POST['name'],$_POST['role'],$_POST['password']);
            echo "<script>alert(\" New Data Successfully Created \");</script>";
            header("location:index.php");
        }elseif($action == "delete"){ 	
            $dbConnect->delete_remove($_GET['id']);
            echo "<script>alert(\" Data Successfully Deleted \");</script>";
            echo "<script>window.location = 'index.php';</script>";
        }elseif($action == "edit"){
            $dbConnect->edit_update($_POST['id'],$_POST['name'],$_POST['role'],$_POST['password']);
            echo "<script>alert(\" Edit Data Successfully \");</script>";
            header("location:index.php");
        }else if($action == "logout"){
            $dbConnect->logout();

        }

    }

    $dbConnect = new dbConnect();
    if (isset($_SESSION['login'])) {
        header("Location: index.php");
        exit;
    }

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $login = $dbConnect->login($_POST);
    }

class tracker {
    private $host     = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "ooptrial";
    private $conn;

    function __construct(){
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error){
            die ("connection fail" . $this->conn->connect_error);
        }
    }

    function connect(){
        return mysqli_connect('localhost', 'root', '', 'ooptrial');
    }

    function query($query){
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);
        return $result;
    }
    
    function get_IP() {
        $clientIP = '';

        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $clientIP = $_SERVER['HTTP_CLIENT_IP'];

        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $clientIP= $_SERVER['HTTP_X_FORWARDED_FOR'];

        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $clientIP= $_SERVER['HTTP_X_FORWARDED'];

        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $clientIP= $_SERVER['HTTP_FORWARDED_FOR'];

        else if (isset($_SERVER['HTTP_FORWARDED']))
            $clientIP= $_SERVER['HTTP_FORWARDED'];

        else if (isset($_SERVER['REMOTE_ADDR']))
            $clientIP= $_SERVER['REMOTE_ADDR'];

        else 
            $clientIP= 'UNKNOWN';
        
        return $clientIP;
    }

    function get_browser(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser_platform = '';
        $browser_array = array(
        '/msie/i'       =>  'Internet Explorer',
		'/firefox/i'    =>  'Firefox',
		'/safari/i'     =>  'Safari',
		'/chrome/i'     =>  'Chrome',
		'/msedge/i'     =>  'Microsoft Edge',
		'/opera/i'      =>  'Opera',
        );

        foreach ($browser_array as $regex => $value) { 
            if (preg_match($regex, $user_agent)) {
                $browser_platform = $value;
            }
        }   
        return $browser_platform;
    }

    function get_OS(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform = '';
        $os_array =   array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/iphone/i'             =>  'iPhone',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value) { 
            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }
        }   
        return $os_platform;
    }
}
   

?>