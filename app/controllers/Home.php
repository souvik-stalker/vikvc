<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class Home extends CController
{
    public function index($name="")
    {
        Vik::import("app.models.new.NewClass");
        $user=NEW User();
        $new=NEW NewClass();
        if(isset(Vik::app()->request['User']))
        {
            $user->setAttributes(Vik::app()->request['User']);
           
            if($user->validate('test1'))
            {
                
            }
           
        }
       $this->loadView("home/index", array('user'=>$user));
    }
    public function view()
    {
        $this->loadView("home/view", array("name"=>"aaa"));
    }
    public function post()
    {
        $this->loadView("home/post");
    }
}

