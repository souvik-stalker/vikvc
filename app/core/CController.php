<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '/urlmanager/UrlManager.php';
require_once '/formElement/FormElement.php';

class CController extends UrlManager {

    protected function loadModel($model) {
        require_once '../app/models/' . $model . '.php';
        return NEW $model();
    }

    protected function loadView($view, $data = array()) {
        $this->loadHeadDefaults();
        require_once '../app/views/' . $view . '.php';
        $this->loadfooterDefaults();
    }

    protected function loadHeadDefaults() {
        require_once '../app/views/defaults/header.php';
    }
    
     protected function loadfooterDefaults() {
        require_once '../app/views/defaults/footer.php';
    }

    public function formWidget($name, $htmlOptions = array(), $csrf_array = array()) {
        $form_obj = NEW FormElement();
        $form_obj->createForm($name, $htmlOptions, $csrf_array);
    }

    public function endWidget() {
        echo "</form>";
    }
    
    

}
