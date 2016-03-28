<?php
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
class Form_Products extends Zend_Form {

    public function init() {
        $this->setAction('')->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        $id = $this->addElement("text","id",array(
            'label'     => "ID",
            'class'     => "form-control",
            'readonly'  => TRUE
        ));
        
        //input categories
        $categories = $this->createElement("select", "category_id", array(
            'label' => "Danh Mục Sản Phẩm",
            'class' => "form-control",
            'multiOptions' => array("" => "") + $this->getView()->categories(),
            'required' => TRUE
        ));
        $categories->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Bạn Phải Chọn Thông Tin'))
        ));

        $color = $this->createElement("select", "color_id", array(
            'label' => "Hãng Sản Phẩm",
            'class' => "form-control",
            'multiOptions' => array("" => "") + $this->getView()->colors(),
            'required' => TRUE
        ));
        $color->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Phải Chọn Thông Tin'))
        ));
        
        $size = $this->createElement("select", "size_id", array(
            'label' => "Hãng Sản Phẩm",
            'class' => "form-control",
            'multiOptions' => array("" => "") + $this->getView()->size(),
            'required' => TRUE
        ));
        $size->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Phải Chọn Thông Tin'))
        ));
        
        
        $manufacturers = $this->createElement("select", "manufacturer_id", array(
            'label' => "Hãng Sản Phẩm",
            'class' => "form-control",
            'multiOptions' => array("" => "") + $this->getView()->manufacturers(),
            'required' => TRUE
        ));
        $manufacturers->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Phải Chọn Thông Tin'))
        ));
        
        

        $productName = $this->createElement("text", "name", array(
            'label'         => "Tên Sản Phẩm",
            'class'         => "form-control",
            'maxlength'     => "100",
            'autocomplete'  => "on",
            'placeholder'   => "Nhập Tên Sản Phẩm",
            'required'      => TRUE
        ));
        
        $productName->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Không Được Phép Để Trống')),
            array('Alnum', TRUE, array(
                    'messages'          => 'Chỉ Nhập Ký Tự Và Số',
                    'allowWhiteSpace'   => TRUE
                )),
            array('stringLength', false, array(6, 100, 'messages' => 'Độ Dài Từ 6 ~ 100 Ký Tự')),
            array('Db_NoRecordExists', true, array(
                    array(
                        'table' => 'tbl_products',
                        'field' => 'name'),
                    'messages' => 'Tên Này Đã Được Sử Dụng Vui Lòng Chọn Tên Khác'
                )
            )
        ));
        
        $productsPriceOld = $this->createElement("text", "price_old", array(
            'label' => "Giá Cũ",
            'class' => "form-control",
            'autocomplete' => "on",
            'placeholder' => "VNĐ"
        ));
        
        $productsPriceOld->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Nhập Đầy Đủ Thông Tin')),
        
            array('Digits',FALSE,array(
                'messages' => 'Chỉ Được Nhập Số'
                )),
        ));
        
        $productsPrice = $this->createElement("text", "price", array(
            'label' => "Giá",
            'class' => "form-control",
            'autocomplete' => "on",
            'placeholder' => "VNĐ",
            'required' => TRUE
        ));
        
        $productsPrice->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Nhập Đầy Đủ Thông Tin')),
        
            array('Digits',FALSE,array(
                'messages' => 'Chỉ Được Nhập Số'
                )),
            array('stringLength', false, array(6, 15, 'messages' => 'Độ Dài Từ 6 ~ 15 Ký Tự'))
        ));
        
        
       
        
        $image = $this->createElement("file", "image",array(
            'label'     =>"Ảnh",
            'class'     =>"form-control",
        ));
        $image->addValidators(array(
            array('FilesSize', false, array(
                'max' => '2MB',
                'messages' => 'Dung lượng tối đa 2MB'
                )),
            array('Extension', false, array(
                 'jpg', 'png',
                'messages' => 'Chỉ Được Upload File Ảnh jpg,png' 
                )),
        ));
        
        
        
        $descriptions = $this->createElement("textarea", "descriptions",array(
            'label'         => "Mô Tả",
            'class'         => "form-control",
            'autocomplete'  => "on",
            'placeholder'   => "Mô Tả",
            'value'         => "Thông Tin Đang Được Cập Nhật"
        ));
        
        //submit
        $submit = $this->createElement("button", "OK", array(
            'value' => "Xác Nhận",
            'lable' => "Xác Nhận",
            'type' => "submit",
            'class' => "btn btn-primary"
        ));
        
        $this->addElements(array(
            $categories,
            $manufacturers,
            $color,
            $size,
            $productName,
            $productsPrice,
            $productsPriceOld,
            $image,
            $descriptions,
            $submit
        ));
        
    }

}
