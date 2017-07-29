<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UrlManager {

    public static function getBaseUrl() {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF'];

        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
        $pathInfo = pathinfo($currentPath);
        // output: localhost
        $hostName = $_SERVER['HTTP_HOST'];

        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https://' ? 'https://' : 'http://';

        // return: http://localhost/myproject/
        return $protocol . $hostName . $pathInfo['dirname'] . "/";
    }
    
    public static function createUrl($route,$params=array())
    {
        $url_extension="";
        if(!empty($params))
            $url_extension=implode("/",$params);
        if($url_extension!="")
        return rtrim(self::getBaseUrl(),"/")."/".$route.'/'.$url_extension;
        else
        return rtrim(self::getBaseUrl(),"/")."/".$route;
    }

}
