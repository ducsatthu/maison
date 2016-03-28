<?php
class Maison_View_Helper_Size extends Zend_View_Helper_Abstract
{
    public function size()
    {
       $model = new Model_size();
       
       $list = $model->getAll();
       
       $option = array();
       
       foreach ($list as $value) {
           $option[$value['id']] = $value['name'];
       }
       
       return $option;
    }
    
    
}