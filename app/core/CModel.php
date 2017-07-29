<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '/config/DbConfig.php';
require_once 'formElement/FormElement.php';
class CModel extends DbConfig
{
    public $attributes=array();
    public function __construct() {
        
        $this->defaultDBConfig();
        $this->set_connections();
        

    }
    
      public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
    
    public function setAttributes($array)
    {
       if(!empty($array))
       {
           foreach($array as $key=>$value)
               $this->__set($key,$value);
       }
    }
    
    public function validate($table)
    {
       
        $explode_unique=array();
        $explode_notempty=array();
        $explode_caronly=array();
        if(is_object($this))
        {
           if(is_array($this->validate['attributes']))
           {
               $explode_attr=explode(",",$this->validate['attributes'][0]);
               
               if(isset($this->validate['notEmpty'][0]) && !empty($this->validate['notEmpty'][0]))
                {
                    $explode_notempty=explode(",",$this->validate['notEmpty'][0]);
                    
                }
                if(isset($this->validate['Unique'][0]) && !empty($this->validate['Unique'][0]))
                {
                    $explode_unique=explode(",",$this->validate['Unique'][0]);
                    
                }
                
                 if(isset($this->validate['charOnly'][0]) && !empty($this->validate['charOnly'][0]))
                {
                    $explode_caronly=explode(",",$this->validate['charOnly'][0]);
                    
                }
               foreach($explode_attr as $key=>$value)
               {
                  if(in_array($value,$explode_notempty))
                  {
                      if($this->{$value}==NULL)
                      {
                          FormElement::$validationError['notEmpty'][$key]=$value;
                      }
                      
                  }
                  
                  if(in_array($value,$explode_caronly))
                  {
                      if($this->{$value}!=NULL && !ctype_alpha($this->{$value}))
                      {
                          FormElement::$validationError['charOnly'][$key]=$value;
                      }
                      
                  }
                  
                  if(in_array($value,$explode_unique))
                  {
                     
                      if($this->{$value}!=NULL)
                      {
                          $dbh=DbConfig::connection(); 
                          $dbh=$dbh->set_connections();
                          
                          $sth = $dbh->prepare("SELECT COUNT(*) as count_val FROM $table WHERE  $value= '".$this->{$value}."'");
                          
                          $sth->execute();

                            /* Fetch all of the remaining rows in the result set */
                            $result = $sth->fetch(PDO::FETCH_ASSOC);
                            if($result['count_val']>0)
                              FormElement::$validationError['Unique'][$key]=$value;
                      }
                      
                  }
                   
               }
           }
        }
    }
}