<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Test{

	public function final1()
	{
            $req_obj=New RequestProtection();
            if($req_obj->is_valid())
            {
                $user=NEW User();
                print_r($_POST);exit;
	    
            }
            else
            {
                echo "Wrong Dude";exit();
            }
	}
}