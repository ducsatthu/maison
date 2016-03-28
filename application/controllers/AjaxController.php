<?php
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
class AjaxController extends Zend_Controller_Action {

    public function init() {

        $option = array(
            "layout" => "site",
            "layoutPath" => APPLICATION_PATH . "/layouts/scripts/"
        );
        Zend_Layout::startMvc($option);
    }

    public function filterAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if ($this->_request->getPost()) {
            $post = $this->_request->getPost();

            $data = FALSE;
            switch ($post['field']) {
                case 'minmax':

                    $data = $this->getByPrice($post['value']);

                    break;
                case 'order':
                    $data = $this->getByOrder($post['value']);
                    
                    break;
                case 'categories':
                    $data = $this->getByCategory($post['value']);
                    
                    break;
                
                case 'colors':
                    $data = $this->getByColors($post['value']);
                    
                    break;
                case 'size':
                    $data = $this->getBysize($post['value']);
                    
                    break;
                default:
                    break;
            }
            echo Zend_Json::encode($data);
        }
    }

    private function getByPrice($data) {
        $data = str_replace('K', '000', $data);
        $data = explode(',', $data);

        if (is_array($data)) {
            $model = new Model_products();

            return $model->getMinmaxPrice($data[0], $data[1]);
        }
        return 0;
    }

    private function getByOrder($data) {
        $model = new Model_products();

        $results = $model->getByOrder($data);
        if ($results) {

            return $results;
        }
        return 0;
    }
    
    private function getByCategory($data){
        $model = new Model_products();

        $results = $model->getByCategory($data);
        if ($results) {

            return $results;
        }
        return 0;
    }
    
    private function getByColors($data){
        $model = new Model_products();

        $results = $model->getByColor($data);
        if ($results) {

            return $results;
        }
        return 0;
    }
    
    private function getBySize($data){
        $model = new Model_products();

        $results = $model->getBySize($data);
        if ($results) {

            return $results;
        }
        return 0;
    }

}
