<?php
class Maison_View_Helper_Manufacturers extends Zend_View_Helper_Abstract
{
    public function manufacturers()
    {
       $model = new Model_manufacturers();
       
       $list = $model->getAll();
       
       $option = array();
       
       foreach ($list as $value) {
           $option[$value['id']] = $value['name'];
       }
       
       return $option;
    }
    
    
}