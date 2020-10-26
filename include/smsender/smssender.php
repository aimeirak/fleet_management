<?php
class apiHander{
    protected $field;
    protected $formart;
    protected $url ;
    protected $trackerReceiver;
    protected $smurl = "ishyiga.net/client/api/sms_fdi/index.php";
    protected $smfield = '<request>
                            <header>
                              <msisdn>%s</msisdn>
                              <messageBody>%s</messageBody>
                            </header>
                        </request>';
  
  
    public function setUrl($resource){
      $this->url = $resource;
    } 
   
    public function setField($field){
      $this->field = $field;
    } 
  
  
   //============================send req with post============================ 
    protected function send(){
      
      if(empty($this->field) || empty($this->url) ){
        if(empty($this->field) && !empty($this->url) ){
           $this->sendRequest();        
        }else{
          echo "All fields are required ==== use setUrl and setField to set them";
        }
      }else{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$this->field);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        return curl_exec($ch); 
      }
      
    }
    //============================ end postRequest ============================ ]]
    //=========================================================================]]
  
  
     //============================send req with post============================ 
     protected function sms($number,$body){
        $field = sprintf($this->smfield,$number,$body); 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->smurl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$field);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        return curl_exec($ch); 
      }
      
    //============================ end postRequest ============================ ]]
    //=========================================================================]]
  
  
  
  
  
   //============================send req with none field=========================
   protected function sendRequest(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$this->url);
    return curl_exec($ch); 
  }
  //============================end req with none field ============================ 
  //===============================================================================]]
   
  //============================ reseciver  start  ==============================
  
   public function receiver(){   
      $data = $this->send();
      return $data;
    
   }
   public function sendmessage($number,$body){
    $sent  = $this->sms($number,$body);
    return $sent;
   }
  //============================ end postRequest ==============================]]
  //===========================================================================]]
  
  }
  