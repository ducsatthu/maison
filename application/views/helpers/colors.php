<?php
class Maison_View_Helper_Colors extends Zend_View_Helper_Abstract
{
    public function colors()
    {
       $model = new Model_colors();
       
       $list = $model->getAll();
       
       $option = array();
       
       foreach ($list as $value) {
           $option[$value['id']] = $value['name'];
       }
       
       return $option;
    }
    
    
}