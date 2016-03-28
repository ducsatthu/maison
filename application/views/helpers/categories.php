<?php
class Maison_View_Helper_Categories extends Zend_View_Helper_Abstract
{
    public function categories()
    {
       $model = new Model_categories();
       
       $list = $model->getAll();
       
       $option = array();
       
       foreach ($list as $value) {
           $option[$value['id']] = $value['name'];
       }
       
       return $option;
    }
    
    
}