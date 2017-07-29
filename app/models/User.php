<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class User extends CModel{
    
    public $username;
    public $password;
    public $comments;
    public $gender;
    
     var $validate=array(
        'notEmpty'=>array('username,password,comments'),
        'Unique'=>array('username'),
        'charOnly'=>array('username'),
        'attributes'=>array('username,password,comments,gender')
     );
    
    public function __construct() {
        
     parent::__construct();
 }
 
    public function tableName()
    {
        return "test1";
    }
   
    public function selectedvalue()
    {
        $val=$this::connection()->query("select * from test1");
       print_r($val);
    }
} 
