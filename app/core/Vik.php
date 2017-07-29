<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Vik 
{
    public $request = array();
    public $basePath="";
    public $baseUrl="";
    public function __construct() {
        
       
           $this->basePath=dirname(dirname(dirname(__FILE__)));
           $this->request=$_REQUEST;
           $this->baseUrl=$_SERVER['REQUEST_URI'];
   }
    public static function import($param)
    {
       $exploded_arr=array();
       $exploded_arr= explode(".",$param);
       $imploded_str=implode("/",$exploded_arr);
       if(file_exists("../".$imploded_str.".php"))
       {
           require_once "../".$imploded_str.".php";
       }
    }
    
    public static function app()
    {
        return NEW Vik();
    }
    
    public function includeJs()
    {
            $js = '';
            $handle = '';
            $file = '';
            // open the "js" directory
             $path=$this->baseUrl;
             $path=realpath($path);
            if ($handle = opendir($path.'js')) {
                while (false !== ($file = readdir($handle))) {
                    if (is_file($path.'js/'.$file)) { 
                        $js .= '<script src="'.$path.'js/'.$file.'" type="text/javascript"></script>' . "\n";
                    }
                }
                closedir($handle);
                echo $js;
            }
    }
}