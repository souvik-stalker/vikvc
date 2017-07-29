<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'core/App.php';
require_once 'core/CController.php';
require_once 'core/CModel.php';
require_once 'core/config/DbConfig.php';
require_once 'core/phpMailer/PHPMailerAutoload.php';
require_once 'core/urlmanager/UrlManager.php';
require_once 'core/Vik.php';
foreach( glob(dirname(__FILE__) . '/models/*.php') as $class_path )
require_once( $class_path );
