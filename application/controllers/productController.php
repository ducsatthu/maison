<?php
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
class ProductController extends Zend_Controller_Action {

    public function init() {

        $option = array(
            "layout" => "product",
            "layoutPath" => APPLICATION_PATH . "/layouts/scripts/"
        );
        Zend_Layout::startMvc($option);
    }

    public function viewAction() {
        $model = new Model_products();

        $id = $this->getRequest()->getParam("id");

        $item = $model->getProductsById($id);

        if ($id) {
            $this->view->assign('item', $item);

            $list = $model->getListPrice($item['price'], $item['category_id'], $item['id']);
            
             $this->view->assign('list', $list);
        } else {
            $this->redirect("/");
        }
    }

}
