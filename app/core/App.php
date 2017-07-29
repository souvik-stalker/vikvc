<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class App{
    
    protected $controller="Home";
    protected $method="index";
    protected $params=array();
    public function __construct() {
        
        $url=$this->parseUrl();
        
        if(file_exists("../app/controllers/".$url[0].".php"))
        {
            $this->controller=$url[0];
            unset($url[0]);
        }
        if($this->controller=="Home")
          require_once '../app/controllers/'.$this->controller.'.php';
        else
          require_once '../app/controllers/'.$this->controller.'.php';
        $this->controller=NEW $this->controller;
        
        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method=$url[1];
                unset($url[1]);
            }
        }
        $this->params=$url ? array_values($url):array();
        call_user_func_array(array($this->controller,$this->method), $this->params);
    }
    
    public function parseUrl()
    {
        if(isset($_GET['url']))
        {
            return $url=  explode("/",filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
        }
    }
}
