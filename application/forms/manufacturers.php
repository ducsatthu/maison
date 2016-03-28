<?php
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
class Form_manufacturers extends Zend_Form {

    public function init() {
        $this->setAction('')->setMethod('post');

        $id = $this->createElement("text", "id", array(
            "label" => "Id",
            "class" => "form-control",
            "readonly" => TRUE,
            "defaults" => "0"
        ));

        //input categories name
        $name = $this->createElement("text", "name", array(
            "label" => "Tên Nhà sản xuất",
            "class" => "form-control"
        ));

        $name->setRequired(TRUE);
        $name->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Nhập Đầy Đủ Thông Tin')),
           
            array('stringLength', false, array(6, 50, 'messages' => 'Độ Dài Từ 6 ~ 50 Ký Tự')),
            array('Db_NoRecordExists', true, array(
                    array(
                        'table' => 'tbl_manufacturers',
                        'field' => 'name'),
                    'messages' => 'Tên Này Đã Được Sử Dụng Vui Lòng Chọn Tên Khác'
                )
            )
        ));

        $descriptions = $this->createElement("text", "address", array(
            "label" => "Địa chỉ",
            "class" => "form-control"
        ));


        $submit = $this->createElement('submit', 'OK', array(
            "class" => "btn btn-primary",
        ));
        $this->addElements(array($id, $name, $descriptions, $submit));
    }

}
