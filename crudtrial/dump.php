<?php
// class pict {

// private $host     = "localhost";
// private $username = "root";
// private $password = "";
// private $database = "hawayuk";
// private $conn;


// function __construct(){
//     $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
// }

// function pick(){
//         $number = 1;
//         if($number == 1 || $number == 4 || $number == 7){
//             $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
//             $query      = "SELECT * pic from tablename where is_picture = 1";
//             $execute    = mysqli_query($this->conn, $query);
//             $result     = mysqli_fetch_assoc($execute);
//             return $result;
//         } elseif($number == 2 || $number == 5 || $number == 8) {
//             $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
//             $query2     = "SELECT * pic from tablename where is_picture = 2";
//             $execute    = mysqli_query($this->conn, $query2);
//             $result2    = mysqli_fetch_assoc($execute);
//             return $result2;
//         } elseif($number == 3 || $number == 6 || $number == 9){
//             $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
//             $query3     = "SELECT * pi from tablename where is_picture = 3";
//             $execute    = mysqli_query($this->conn, $query3);
//             $result3    = mysqli_fetch_assoc($execute);
//             return $result3;
//         }
//     }
// }
// ?>
<!-- // <table border="1" align="center" method="post">
//     <tr>
//         <th>Number</th>
//         <th>Name</th>
//         <th>Picture</th>
//     </tr> -->
// <?php
// $pict = new pict();
// $data = $pict->pick();
// foreach((array)$data as $value){
// ?>
<!-- 
// <tr align="center">
//     <td></td>
//     <td></td>
//     <td></td>
// </tr> -->

<?php

$approval = array('approval-1', 'approval-2', 'approval-3', 'approval-4', 'approval-5', 'approval-6');
array_push($approval, 'approval-7', 'approval-8', 'approval-9', 'approval-10');
$i = 0;
foreach ($approval as $result) {
    if ($i % 3 == 0) { $person = ' Dary '; }
    elseif ($i % 3 == 1) { $person = ' Fauzan '; }
    elseif ($i % 3 == 2) { $person = ' Naufal '; }
    $i++;
    echo "$person - $result<br>";
}

// $approval = array('approval-1', 'approval-2', 'approval-3', 'approval-4', 'approval-5', 'approval-6');
// $i = 0;
// foreach ( $approval as $approve ) {
//         if($i % 2 === 0) {
//             $dary[] = $approve;
//         } else {
//             $fauzan[] = $approve; 
//         } 
//         $i++;
// }
?>
<!-- </table> -->
