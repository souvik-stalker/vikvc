<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class NewClass extends CModel{
    
    
    public $name;
    
    public function selectedvalue()
    {
        $val=$this::connection()->query("select * from test1");
       print_r($val);
    }
} 
