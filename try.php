<?php
include 'connexion.php';
// class locator{
//   protected $api = "http://api.ipapi.com/%s?access_key=%s&format=%s";
//   protected $propert = [];
//   protected $token = "6bd65bb4d7d443c8ccf1b18dc398c2d4";


// if(!empty($_SERVER['HTTP_CLIENT_IP'])){
//   //ip from share internet
//   $ip = $_SERVER['HTTP_CLIENT_IP'];
//   echo  "<br> clint ip address = ". $ip; 
// }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
//   //ip pass from proxy
//   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//   echo "<br> forwards ip address = ". $ip; 
// }else{
//   $ip = $_SERVER['REMOTE_ADDR'];
//   echo  "<br> remote ip address = ". $ip; 
// }


// $mycurl= curl_init();
// $url = 'https://jsonplaceholder.typicode.com/posts';
// curl_setopt($mycurl,CURLOPT_URL,$url);
// curl_setopt($mycurl,CURLOPT_RETURNTRANSIFER,1);

// $output = curl_exec($mycurl);
// echo $output[0];

// curl_close($mycurl);


// class process{
//   protected $api = "http://api.ipapi.com/%s?access_key=%s&format=%s";
//   protected $propert = [];
//   protected $token = "6bd65bb4d7d443c8ccf1b18dc398c2d4";


//   public function locator($ip){
//    $format = "1";
//    $url  = sprintf($this->api , $ip,$this->token,$format);
//    $data = $this->sendRequest($url); 
//    echo json_decode($data);
//   }


//   protected function sendRequest($url){
//      $curl = curl_init();
     
//      curl_setopt($curl , CURLOPT_URL , $url);
    
//      return curl_exec($curl); 
//     }

//     public function api($url){
//       $data = $this->sendRequest($url); 
//       echo json_decode($data);
//      }
   

// }

// // 41.216.127.98
// $pro = new process();
// $pro->locator("41.216.110.126");
// $pro->api("https://jsonplaceholder.typicode.com/posts");


// class apiHander{
//   protected $field;
//   protected $formart;
//   protected $url ;
//   protected $trackerReceiver;
//   protected $smurl = "ishyiga.net/client/api/sms_fdi/index.php";
//   protected $smfield = '<request>
//                           <header>
//                             <msisdn>%s</msisdn>
//                             <messageBody>%s</messageBody>
//                           </header>
//                       </request>';


//   public function setUrl($resource){
//     $this->url = $resource;
//   } 
 
//   public function setField($field){
//     $this->field = $field;
//   } 


//  //============================send req with post============================ 
//   protected function send(){
    
//     if(empty($this->field) || empty($this->url) ){
//       if(empty($this->field) && !empty($this->url) ){
//          $this->sendRequest();        
//       }else{
//         echo "All fiels are required ==== use setUrl and setField to set them";
//       }
//     }else{
//       $ch = curl_init();
//       curl_setopt($ch, CURLOPT_URL,$this->url);
//       curl_setopt($ch, CURLOPT_POST, 1);
//       curl_setopt($ch, CURLOPT_POSTFIELDS,$this->field);
//       curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//       return curl_exec($ch); 
//     }
    
//   }
//   //============================ end postRequest ============================ ]]
//   //=========================================================================]]


//    //============================send req with post============================ 
//    protected function sms($number,$body){
//       $field = sprintf($this->smfield,$number,$body); 
//       $ch = curl_init();
//       curl_setopt($ch, CURLOPT_URL,$this->smurl);
//       curl_setopt($ch, CURLOPT_POST, 1);
//       curl_setopt($ch, CURLOPT_POSTFIELDS,$field);
//       curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//       return curl_exec($ch); 
//     }
    
//   //============================ end postRequest ============================ ]]
//   //=========================================================================]]





//  //============================send req with none field=========================
//  protected function sendRequest(){
//   $ch = curl_init();
//   curl_setopt($ch, CURLOPT_URL,$this->url);
//   return curl_exec($ch); 
// }
// //============================end req with none field ============================ 
// //===============================================================================]]
 
// //============================ reseciver  start  ==============================

//  public function receiver(){   
//     $data = $this->send();
//     return $data;
  
//  }
//  public function sendmessage($number,$body){
//   $sent  = $this->sms($number,$body);
//   return $sent;
//  }
// //============================ end postRequest ==============================]]
// //===========================================================================]]

// }




  // $api = "'http://ip-api.com/json/%s'";
  // $form = 1;
  // $token = "6bd65bb4d7d443c8ccf1b18dc398c2d4";
  // $api = "http://api.ipapi.com/%s?access_key=%s&format=%s";
  // $api = "http://api.ipapi.com/%s?access_key=%s&format=%s";
 
  // $ip = "41.216.110.126";  
  // $url  = sprintf('http://ip-api.com/json/%s',$ip);
    


// $apiRuner = new apiHander();
// $apiRuner->setUrl($url);
// $data =  $apiRuner->receiver();
// echo json_decode($data);

// $smsSent = $apiRuner->sendmessage('250782095943','class is working'); 
// if($smsSent){
//   echo json_encode($smsSent);
// }

            // $enterntained = 1;
            // $driver = 30;
            // $company = 3;
            // $sql  =  'SELECT  * FROM  fluid_user where live = ? and role = ? and id_subcompany = ? ';
            // $stmt =  $connection->prepare($sql); 
            // $stmt->bind_param('iii',$enterntained,$driver,$company);
            // $stmt->execute();
            // $result = $stmt->get_result();
            
            // while($fetchedDriver = $result->fetch_assoc()){
            //   $smsSent = $apiRuner->sendmessage(strval($fetchedDriver['phone_number']),'New booking from username is pending. will start on date at start time until end time  ');
            //   echo json_encode($smsSent);
            // }