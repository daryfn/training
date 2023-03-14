<?php
include "configuration.php";
class tracker {
    private $host     = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "ooptrial";
    private $conn;
    // public  $clientIP;
    // public  $browser_platform;
    // public  $os_platform;
    function __construct(){
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error){
            die ("connection fail" . $this->conn->connect_error);
        }
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

    function get_location(){

    }

    function save_tracker($clientIP, $os_platform, $browser_platform){
        mysqli_query($this->conn, "INSERT into user_tracker (IP_ADDRESS, OS, browser) values ('$clientIP', '$os_platform', '$browser_platform')");
        // while($data = mysqli_fetch_assoc($query)){
        //    print_r($data) ;
        }
        
    function query($query){
        $data = mysqli_query($this->conn, $query);
        while($result = mysqli_fetch_assoc($query)){
               print_r($result) ;
        }
    }
}

$tracker = new tracker();
if(isset($_GET['action'])){
    $action = $_GET['action'];
        if($action == "login"){
            if (isset($_POST['username']) && isset($_POST['password'])){
                $username = $_POST['username'];
                $password = $_POST['password'];

                $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
                $data = $tracker->query($query);
                // // echo $query;
                // print_r($data);

                if ($_POST['username'] == $data['username'] && $_POST['password'] == $data['password']){
                    echo "<script>alert('Welcome Back')</script>";
                    $tracker->save_tracker($_POST['ipAddress'],$_POST['os'],$_POST['browser']);
                    echo "<script>window.location = 'index.php';</script>";
                
                } else {
                    echo "<script>alert('Wrong Username or Password')</script>";
                    echo "<script>window.location = 'login.php';</script>";
                }
            }
        } 
    }


// function add_tracker($clientIP, $browser_platform, $os_platform){
//     $clientIP->get_IP();
//     $browser_platform->get_browser();
//     $os_platform->get_OS();
//     if ($clientIP == !NULL && $browser_platform == !NULL && $os_platform == !NULL){
//         mysqli_query($this->conn, "INSERT INTO user_tracker VALUES($clientIP, $browser_platform, $os_platform,'')");
//     } else {
//         echo "<script>alert(\" Failed to Record User Infomation \");</script>";
//     }
// }


// TRACKER TEST
// $getIP = new tracker();
// $value = $getIP->get_IP();
// $value1 = $getIP->get_OS();
// $value2 = $getIP->get_browser();
// $getIP->add_tracker($value,$value1,$value2);
// echo "Your IP Address: " . $value;
// echo "<br>";

// echo "Operation System: " . $value1;
// echo "<br>";
// echo "Browser: " . $value2;
?>