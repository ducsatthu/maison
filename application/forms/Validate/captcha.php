<?php 
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
class Form_Validate_Captcha{ 
    static function isValid($captcha){ 
        $capId = $captcha['id']; 
        $capInput = $captcha['input']; 
        $capSession = new Zend_Session_Namespace('Zend_Form_Captcha_'.$capId); 
        $capWord = $capSession->getIterator(); 
        if(isset($capWord['word']) && $capWord['word'] == $capInput){ 
            return TRUE; 
        }else{ 
            return FALSE; 
        } 
    } 
}