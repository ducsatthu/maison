<?php
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initAutoload() {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath' => dirname(__FILE__),
        ));
        return $autoloader;
    }

    protected function _initDatabase() {
        $db = $this->getPluginResource('db')->getDbAdapter();
        Zend_Registry::set('db', $db);
    }

    protected function _initSession() {
        Zend_Session::start();
    }

    protected function _initView() {
        // Initialize view
        $view = new Zend_View();
        $view->doctype('XHTML1_STRICT');
        $view->headTitle('Maison');
        $view->headMeta()->setHttpEquiv('Content-Type', 'text/html;charset=utf-8');

        $fc = Zend_Controller_Front::getInstance();
        $baseurl = $fc->getBaseUrl();

        //Define public directory
        defined('PUBLIC_URL') || define('PUBLIC_URL', $baseurl . '/public');
        # Bootstrap CSS 

        $view->assign("BaseUrl", $baseurl);
        $view->headLink()->appendStylesheet('https://fonts.googleapis.com/css?family=Roboto');
        $view->headLink()->appendStylesheet('//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/font-awesome/css/font-awesome.css');
        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/bootstrap/css/bootstrap.min.css');
        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/slick/slick.css');
        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/slick/slick-theme.css');
        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/chosen/chosen.min.css');
        //mystyle
        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/css/main.css');
        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/css/header.css');
        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/css/menu.css');
        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/css/slide.css');
        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/css/section.css');
        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/css/products.css');

        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/css/footer.css');
        $view->headLink()->appendStylesheet(PUBLIC_URL . '/assets/css/animate.css');

        # JavaScript
        $view->headscript()->appendFile("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js");
        $view->headscript()->appendFile("https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js");
        $view->headscript()->appendFile(PUBLIC_URL . '/assets/bootstrap/js/bootstrap.min.js');
        $view->headscript()->appendFile(PUBLIC_URL . '/assets/slick/slick.min.js');
//        $view->headscript()->appendFile("//code.jquery.com/jquery-1.10.2.js");
        $view->headscript()->appendFile("//code.jquery.com/ui/1.11.4/jquery-ui.js");
        $view->headscript()->appendFile(PUBLIC_URL . "/assets/js/application.js");

        $view->headscript()->appendFile(PUBLIC_URL . "/assets/js/dataTables/jquery.dataTables.js");
        $view->headscript()->appendFile(PUBLIC_URL . "/assets/js/dataTables/dataTables.bootstrap.js");

        $view->headscript()->appendFile(PUBLIC_URL . "/assets/chosen/chosen.jquery.min.js");
        $view->headscript()->appendFile(PUBLIC_URL . "/assets/chosen/chosen.proto.min.js");


        // Set path to /path/to/more/helpers, with prefix 'My_View_Helper'
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Maison_View_Helper');
        // Add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
                        'ViewRenderer'
        );

        $viewRenderer->setView($view);
        // Return it, so that it can be stored by the bootstrap
        return $view;
    }

}
