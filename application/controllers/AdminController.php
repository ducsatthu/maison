<?php
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
class AdminController extends Zend_Controller_Action {

    public function init() {
//        $auth = Zend_Auth::getInstance();

        $option = array(
            "layout" => "admin",
            "layoutPath" => APPLICATION_PATH . "/layouts/scripts/"
        );
        Zend_Layout::startMvc($option);
    }

    public function indexAction() {
        // action body
    }

    public function categoriesAction() {
        $categories = new Model_categories();

        $listCategories = $categories->getAll();

        $this->view->assign("listCategories", $listCategories);

        if ($this->getRequest()->getParam("edit")) {
            $id = $this->getRequest()->getParam("edit");

            $category = $categories->getCategoryById($id);

            if ($category) {
                $this->view->assign("category", $category);
            }
            $form = new Form_categories();

            if ($this->_request->getPost()) {

                $data = $this->_request->getPost();

                if (!$form->isValid($data)) {
                    $this->view->form = $form;
                } else {
                    if (!$item) {
                        $result = $categories->insertCategory($data);
                    } else {
                        $result = $categories->updateCategory($data);
                    }
                    if ($result) {
                        $this->renderScript("notify/success.phtml");
                    } else {
                        $this->renderScript("notify/error.phtml");
                    }
                }
            }
            $this->view->form = $form;
        }
        if ($this->getRequest()->getParam("delete")) {
            $id = $this->getRequest()->getParam("delete");

            $category = $categories->getCategoryById($id);

            if ($category) {
                $result = $categories->deleteCategory($category);

                if ($result) {
                    $this->renderScript("notify/success.phtml");
                } else {
                    $this->renderScript("notify/error.phtml");
                }
            }
        }
    }

    public function manufacturersAction() {
        $model = new Model_manufacturers();

        $list = $model->getAll();

        $this->view->assign("list", $list);

        if ($this->getRequest()->getParam("edit")) {
            $id = $this->getRequest()->getParam("edit");

            $item = $model->getById($id);

            if ($item) {
                $this->view->assign("item", $item);
            }
            $form = new Form_manufacturers();

            if ($this->_request->getPost()) {

                $data = $this->_request->getPost();

                if (!$form->isValid($data)) {
                    $this->view->form = $form;
                } else {
                    if (!$item) {
                        $result = $model->insertItem($data);
                    } else {
                        $result = $model->updateItem($data);
                    }
                    if ($result) {
                        $this->renderScript("notify/success.phtml");
                    } else {
                        $this->renderScript("notify/error.phtml");
                    }
                }
            }
            $this->view->form = $form;
        }
        if ($this->getRequest()->getParam("delete")) {
            $id = $this->getRequest()->getParam("delete");

            $item = $model->getById($id);

            if ($category) {
                $result = $model->deleteItem($item);

                if ($result) {
                    $this->renderScript("notify/success.phtml");
                } else {
                    $this->renderScript("notify/error.phtml");
                }
            }
        }
    }
    
    public function colorsAction() {
        $model = new Model_colors();

        $list = $model->getAll();

        $this->view->assign("list", $list);
        
        if ($this->getRequest()->getParam("edit")) {
            $id = $this->getRequest()->getParam("edit");
            
            $item = $model->getById($id);
            
            if ($item) {
                $this->view->assign("item", $item);
            }
            $form = new Form_colors();
            
            

            if ($this->_request->getPost()) {

                $data = $this->_request->getPost();

                if (!$form->isValid($data)) {
                    $this->view->form = $form;
                } else {
                    if (!$item) {
                        $result = $model->insertItem($data);
                    } else {
                        $result = $model->updateItem($data);
                    }
                    if ($result) {
                        $this->renderScript("notify/success.phtml");
                    } else {
                        $this->renderScript("notify/error.phtml");
                    }
                }
            }
            $this->view->form = $form;
        }
        if ($this->getRequest()->getParam("delete")) {
            $id = $this->getRequest()->getParam("delete");

            $item = $model->getById($id);

            if ($category) {
                $result = $model->deleteItem($item);

                if ($result) {
                    $this->renderScript("notify/success.phtml");
                } else {
                    $this->renderScript("notify/error.phtml");
                }
            }
        }
    }
    
     public function sizeAction() {
        $model = new Model_size();

        $list = $model->getAll();

        $this->view->assign("list", $list);
        
        if ($this->getRequest()->getParam("edit")) {
            $id = $this->getRequest()->getParam("edit");
            
            $item = $model->getById($id);
            
            if ($item) {
                $this->view->assign("item", $item);
            }
            $form = new Form_size();
            
            if ($this->_request->getPost()) {

                $data = $this->_request->getPost();

                if (!$form->isValid($data)) {
                    $this->view->form = $form;
                } else {
                    if (!$item) {
                        $result = $model->insertItem($data);
                    } else {
                        $result = $model->updateItem($data);
                    }
                    if ($result) {
                        $this->renderScript("notify/success.phtml");
                    } else {
                        $this->renderScript("notify/error.phtml");
                    }
                }
            }
            $this->view->form = $form;
        }
        if ($this->getRequest()->getParam("delete")) {
            $id = $this->getRequest()->getParam("delete");

            $item = $model->getById($id);

            if ($category) {
                $result = $model->deleteItem($item);

                if ($result) {
                    $this->renderScript("notify/success.phtml");
                } else {
                    $this->renderScript("notify/error.phtml");
                }
            }
        }
    }

    public function productsAction() {
        $form = new Form_Products;

        $model = new Model_products();

        $list = $model->getAll();

        $this->view->assign("list", $list);

        if ($this->getRequest()->getParam("edit")) {




            $id = $this->getRequest()->getParam("edit");

            $item = $model->getProductsById($id);
            if ($item) {
                $form->getElement("name")->removeValidator("Db_NoRecordExists");
                $this->view->title = "Sửa Thông Tin Sản Phẩm";
            } else {
                $this->view->title = "Thêm Mới Sản Phẩm";
            }


            $this->view->assign("item", $item);
            if ($this->_request->getPost()) {
                $data = $this->_request->getPost();
                if (!$form->isValid($data)) {
                    $this->view->form = $form;
                } else {
                    if (!$item) {
                        $lastId = $model->getLastId()['id'];
                        $id = $lastId + 1;
                    }
                    
                    $data['id'] = $id;

                    if (!$_FILES['image']['error']) {
                        $upload = new Form_UploadFile_UploadImages($id);

                        $files = $upload->_upload->getFileInfo();
                        foreach ($files as $file => $info) {
                            if ($upload->_upload->isUploaded($file)) {
                                $upload->_upload->receive();
                            }
                        }

                        $data['image'] = "/public/img/products/" . $id . "/" . $files['image']['name'];
                    }


                    if ($item) {
                        $result = $model->updateData($data);
                    } else {

                        $result = $model->insertData($data);
                    }


                    if ($result) {
                        $this->renderScript("notify/success.phtml");
                    } else {
                        $this->renderScript("notify/error.phtml");
                    }
                }
            } else {
                $this->view->form = $form;
            }
        }
    }

}
