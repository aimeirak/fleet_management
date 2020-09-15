<?php
class locator{
  protected $api = "http://api.ipapi.com/%s?access_key=%s&format=%s";
  protected $propert = [];
  protected $token = "6bd65bb4d7d443c8ccf1b18dc398c2d4";


  public function request($ip){
   $format = "1";
   $url  = sprintf($this->api , $ip,$this->token,$format);
   $data = $this->sendRequest($url); 
   echo json_decode($data);
  }


  protected function sendRequest($url){
     $curl = curl_init();
     
     curl_setopt($curl , CURLOPT_URL , $url);
    
     return curl_exec($curl); 
    }

   

}

// 41.216.127.98
$locator = new locator();
$locator->request("41.216.121.98");


if(!empty($_SERVER['HTTP_CLIENT_IP'])){
  //ip from share internet
  $ip = $_SERVER['HTTP_CLIENT_IP'];
  echo  "<br> clint ip address = ". $ip; 
}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  //ip pass from proxy
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  echo "<br> forwards ip address = ". $ip; 
}else{
  $ip = $_SERVER['REMOTE_ADDR'];
  echo  "<br> remote ip address = ". $ip; 
}

