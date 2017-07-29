<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'RequestProtection.php';
class FormElement extends RequestProtection{

   public static $validationError = array();
   public static function textField($model_name,$value="",$htmlOptions=array())
   {
       $htmlOptions=self::renderAttributes($htmlOptions);
       return "<input type='text' name='".$model_name."' value='".$value."' $htmlOptions />";
   }
   public static function passwordField($model_name,$value="",$htmlOptions=array())
   {
       $htmlOptions=self::renderAttributes($htmlOptions);
       return "<input type='password' name='".$model_name."' value='".$value."' $htmlOptions />";
   }
   public static function label($label,$for="",$htmlOptions=array())
   {
       $htmlOptions=self::renderAttributes($htmlOptions);
       return "<label for='$for' $htmlOptions >$label</label>";
   }
   public static function textArea($name,$value="",$htmlOptions=array())
   {
       $htmlOptions=self::renderAttributes($htmlOptions);
       return "<textarea name='$name'  $htmlOptions >$value</textarea>";
   }
   public static function checkBox($name,$checked=false,$htmlOptions=array())
   {
       $checkOptions=self::renderAttributes($htmlOptions);
       $hidden="";
         if(isset($htmlOptions['unCheckedvalue']) &&  $htmlOptions['unCheckedvalue']!="")
         {
             $hidden="<input type='hidden' name='".$name."' value='".$htmlOptions['unCheckedvalue']."'/>";
         }
        return $hidden."<input type='checkbox' $checked name='".$name."'   $checkOptions />";
   }
   public static function radioButton($name,$checked=false,$htmlOptions=array())
   {
       $checkOptions=self::renderAttributes($htmlOptions);
       $hidden="";
         if(isset($htmlOptions['unCheckedvalue']) &&  $htmlOptions['unCheckedvalue']!="")
         {
             $hidden="<input type='hidden' name='".$name."' value='".$htmlOptions['unCheckedvalue']."'/>";
         }
        return $hidden."<input type='radio' $checked name='".$name."'   $checkOptions />";
   }
   public static function radionButtonGroup($name,$checked=true,$listOptions,$htmlOptions=array())
   {
       if(is_array($listOptions) && !empty($listOptions))
       {
           $counter=0;
           $checkOptions=self::renderAttributes($htmlOptions);
           $hidden="";
         if(isset($htmlOptions['unCheckedvalue']) &&  $htmlOptions['unCheckedvalue']!="" && $htmlOptions['unCheckedvalue']!=NULL)
         {
             $hidden="<input type='hidden' name='".$name."' value='".$htmlOptions['unCheckedvalue']."'/>";
         }
         foreach($listOptions as $key=>$val)
         {
             if($counter==0)
               $hidden.="<input type='radio' $checked name='".$name."' value=$key  $checkOptions />".$val."<br/>";
             else
                 $hidden.="<input type='radio' name='".$name."' value=$key  $checkOptions />".$val."<br/>";
         $counter++;
         }
         return $hidden;
       }
       else
           echo "Third parameter should be an array";
   }
   public static function submitButton($value,$htmlOptions=array())
   {
       $htmlOptions=self::renderAttributes($htmlOptions);
       $name="";
       if($htmlOptions==NULL)
           $name='name='.$value;
       $submit="<input type='submit' value='$value' $name $htmlOptions />";
       return $submit;
       
   }
   public  static function createLink($name,$href,$htmlOptions=array())
        {
            $htmlOptions=self::renderAttributes($htmlOptions);
            $id="";
            $link="";
            if(isset($htmlOptions['id']) && $htmlOptions['id']!="")
                $id='id='.  uniqid();
            $link="<a href='$href' $htmlOptions $id>$name</a>";
            return $link;
        }
   /*
    * This function used to create
    * html options for any field type and return as string
    */
   public static function renderAttributes($htmlOptions)
	{
		static $specialAttributes=array(
			'checked'=>1,
			'declare'=>1,
			'defer'=>1,
			'disabled'=>1,
			'ismap'=>1,
			'multiple'=>1,
			'nohref'=>1,
			'noresize'=>1,
			'readonly'=>1,
			'selected'=>1
		);

		if($htmlOptions===array())
			return '';

		$html='';
		if(isset($htmlOptions['encode']))
		{
			$raw=!$htmlOptions['encode'];
			unset($htmlOptions['encode']);
		}
		else
			$raw=false;

		if($raw)
		{
			foreach($htmlOptions as $name=>$value)
			{
				if(isset($specialAttributes[$name]))
				{
					if($value)
						$html .= ' ' . $name . '="' . $name . '"';
				}
				else if($value!==null)
					$html .= ' ' . $name . '="' . $value . '"';
			}
		}
		else
		{
			foreach($htmlOptions as $name=>$value)
			{
				if(isset($specialAttributes[$name]))
				{
					if($value)
						$html .= ' ' . $name . '="' . $name . '"';
				}
				else if($value!==null)
					$html .= ' ' . $name . '="' . self::encode($value) . '"';
			}
		}
		return $html;
	}
        public static function encode($text)
	{
		return htmlspecialchars($text,ENT_QUOTES);
	}
        
        public function createForm($name,$htmlOptions,$csrf_array=array())
        {
            $htmlOptions=self::renderAttributes($htmlOptions);
            $form_hidden="";
            if(isset($csrf_array['csrf']) && $csrf_array['csrf']===true)
                $form_hidden="<input type='hidden' name='csrf_token' value='".$this->hash."'/>";
            $form="<form $htmlOptions><br/>".$form_hidden;
            
            echo $form;
            
        }
        
        public static function ActivetextField($object,$field,$htmlOptions=array())
        {
            if(is_object($object))
            {
                $htmlOptions=self::renderAttributes($htmlOptions);
                $class_name=  get_class($object);
                return "<input type='text' name=".$class_name."[".$field."]"."  value='".$object->$field."'  $htmlOptions />";
            }
        }
        
         public static function ActivepasswordField($object,$field,$htmlOptions=array())
        {
            if(is_object($object))
            {
                $htmlOptions=self::renderAttributes($htmlOptions);
                $class_name=  get_class($object);
                return "<input type='password' name=".$class_name."[".$field."]"."  value='".$object->$field."'  $htmlOptions />";
            }
        }
        
        public static function getError($object,$field)
        {
            $return="";
            if(is_object($object))
            {
                if(isset($object->validate['notEmpty'][0]) && !empty($object->validate['notEmpty'][0]))
                {
                    $explode_notempty=explode(",",$object->validate['notEmpty'][0]);
                    if(in_array($field,$explode_notempty))
                    {
                               $style="style='display:none;'";
                               if(isset(self::$validationError['notEmpty']))
                               {
                                    if(in_array($field,self::$validationError['notEmpty']))
                                    {
                                            $style="style='display:block;'";
                                    }
                               }
                        $return .="<div class='errorClass notEmpty' $style>$field can not be blank.</div>";
                    }
                }
                if(isset($object->validate['Unique'][0]) && !empty($object->validate['Unique'][0]))
                {
                    $explode_unique=explode(",",$object->validate['Unique'][0]);
                    if(in_array($field,$explode_unique))
                    {
                        
                        $style="style='display:none;'";
                               if(isset(self::$validationError['Unique']))
                               {
                                    if(in_array($field,self::$validationError['Unique']))
                                    {
                                            $style="style='display:block;'";
                                    }
                               }
                        $return .="<div class='errorClass unique' $style>Value already exist.</div>";
                    }
                }
                if(isset($object->validate['charOnly'][0]) && !empty($object->validate['charOnly'][0]))
                {
                    $explode_caronly=explode(",",$object->validate['charOnly'][0]);
                    if(in_array($field,$explode_caronly))
                    {
                        
                               $style="style='display:none;'";
                               if(isset(self::$validationError['charOnly']))
                               {
                                    if(in_array($field,self::$validationError['charOnly']))
                                    {
                                            $style="style='display:block;'";
                                    }
                               }
                        $return .="<div class='errorClass caronly' $style >$field must be charector only.</div>";
                    }
                }
                
                return $return;
            }
        }
        
        
       

}
