<?php
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
class IndexController extends Zend_Controller_Action {

    public function init() {

        $option = array(
            "layout" => "site",
            "layoutPath" => APPLICATION_PATH . "/layouts/scripts/"
        );
        Zend_Layout::startMvc($option);
    }

    public function indexAction() {
        $model = new Model_products();

        $paginator = Zend_Paginator::factory($model->getAll());

        $paginator->setItemCountPerPage(12);
        $paginator->setPageRange(5);
        $curentpage = $this->_request->getParam("page");
        $paginator->setCurrentPageNumber($curentpage);

        $this->view->assign("list", $paginator);
    }
}
