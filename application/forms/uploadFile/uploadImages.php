<?php
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

class Form_UploadFile_UploadImages {
    public $_upload;
    public function __construct($id){
        $this->_upload = new Zend_File_Transfer;
        $dir = APPLICATION_PATH.'/../public/img/products/'.$id.'/';
        @rmdir($dir);
        @mkdir($dir);
        $this->_upload->setDestination($dir);
    }
}