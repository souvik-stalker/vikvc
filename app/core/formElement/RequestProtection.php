<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
class RequestProtection {

  public $hash;
  private $previous_hash;
   public function __construct() {
       
       if(isset($_SESSION['request_token']))
           $this->previous_hash=$_SESSION['request_token'];
       $this->hash=$_SESSION['request_token']=md5(uniqid());
   }
   
   public function is_valid()
   {
       return isset($_POST['csrf_token']) && ($_POST['csrf_token']==$this->previous_hash);
   }
}
