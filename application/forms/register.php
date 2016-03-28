<?php
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
class Form_register extends Zend_Form {

    public function init() {
        $this->setAction('/login/register')->setMethod('post');
        //input categories name
        $name = $this->createElement("text", "name", array(
            "label" => "Họ Và Tên:",
            "class" => "form-control"
        ));

        $name->setRequired(TRUE);
        $name->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Nhập Đầy Đủ Thông Tin')),
            array('alpha', TRUE, array(
                    'messages' => 'Phải Nhập Một Chuỗi Ký Tự',
                    'allowWhiteSpace' => TRUE
                )),
            array('stringLength', false, array(6, 32, 'messages' => 'Độ Dài Từ 6 ~ 32 Ký Tự')),
        ));

        $username = $this->createElement("text", "user_name", array(
            "label" => "Tên Đăng Nhập:",
            "class" => "form-control"
        ));

        $username->setRequired(TRUE);
        $username->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Bạn Chưa Nhập Tài Khoản')),
            array('Regex', TRUE, array(
                    'pattern' => "/^[a-zA-Z0-9\-_+]*$/",
                    'messages' => 'Nhập Các Ký Tự Không Dấu a-z A-Z 0-9 '
                )),
            array('stringLength', false, array(5, 45, 'messages' => 'Độ Dài Từ 5 ~ 45 Ký Tự')),
            array('Db_NoRecordExists', TRUE, array(
                    array(
                        'table' => 'tbl_users',
                        'field' => 'user_name'),
                    'messages' => 'Tài Khoản Đã Tồn Tại'
                )
            )
        ));
        $email = $this->createElement("text", "email", array(
            "label" => "E-Mail:",
            "class" => "form-control",
            "placeholder"   => "Email của bạn"
        ));

        $email->setRequired(TRUE);
        $email->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Nhập Đầy Đủ Thông Tin')),
            array('EmailAddress', TRUE, array(
                'messages' => 'Email Nhập Không Chính Xác',
                ))
        ));
        
        $phone = $this->createElement("text", "phone", array(
            "label"         => "Số Điện Thoại:",
            "class"         => "form-control",
            "placeholder"   => "Số Điện Thoại Liên Hệ"
        ));

        $phone->setRequired(TRUE);
        
        $phone->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Nhập Đầy Đủ Thông Tin')),
            array('Regex',TRUE,array(
                'pattern' => "/^[0-9+]*$/",
                'messages' => 'Nhập Các Số Từ 0 - 9 và dấu + '
            )),
            array('stringLength', false, array(6, 32, 'messages' => 'Độ Dài Từ 6 ~ 32 Ký Tự')),
        ));
        
        $address= $this->createElement("textarea", "address", array(
            "label"         => "Địa Chỉ",
            "class"         => "form-control",
            "placeholder"   => "Địa Chỉ",
            "rows"           => "3"
        ));

        $address->setRequired(TRUE);
        $address->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Nhập Đầy Đủ Thông Tin')),
            array('alnum', TRUE, array(
                    'messages' => 'Chỉ Nhập Số Và Chữ Cái',
                    'allowWhiteSpace' => TRUE
                )),
        ));
        
        $pass = $this->createElement("password", "password", array(
            "label"             => "Mật Khẩu",
            "class"             => "form-control",
            "placeholder"       => "Mật Khẩu"
        ));
        $pass->setRequired(TRUE);
        $pass->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Bạn Chưa Nhập Mật Khẩu')),
            array('Regex',TRUE,array(
                'pattern' => "/^[a-zA-Z0-9\-+]*$/",
                'messages' => 'Nhập Các Ký Tự Không Dấu a-z A-Z 0-9 '
            )),
            array('stringLength', false, array(6, 45, 'messages' => 'Độ Dài Từ 6 ~ 45 Ký Tự'))
        ));
        
        $vpass = $this->createElement("password", "vpass", array(
            "label"             =>"Xác Nhận Mật Khẩu",
            "class"             => "form-control",
            "placeholder"       => "Xác Nhận Mật Khẩu"
        ));
        $vpass->setRequired(TRUE);
        $vpass->addValidators(array(
            array('NotEmpty', TRUE, array('messages' => 'Bạn Chưa Nhập Mật Khẩu')),
            array('Regex',TRUE,array(
                'pattern' => "/^[a-zA-Z0-9\-+]*$/",
                'messages' => 'Nhập Các Ký Tự Không Dấu a-z A-Z 0-9 '
            )),
            array('stringLength', false, array(6, 45, 'messages' => 'Độ Dài Từ 6 ~ 45 Ký Tự'))
        ));
        

        $captcha = new Zend_Form_Element_Captcha('captcha', array(
            'label' => 'Mã Xác Nhận',
            'captcha' => array(
                'captcha' => 'Image',
                'wordLen' => 6,
                'timeout' => 300,
                'font' => APPLICATION_PATH . '/../public/fonts/captcha.ttf',
                'imgDir' => APPLICATION_PATH . '/../public/img/captcha/',
                'imgUrl' => '/public/img/captcha/',
                'height' => 50,
                'width' => 300,
                'fontSize' => 30,
            ),
            'class' => 'form-control',
        ));

        $submit = $this->createElement('submit', 'OK', array(
            "class" => "btn btn-info btn-block",
        ));
        $this->addElements(array($name,$username,$email,$phone,$address,$pass,$vpass, $captcha, $submit));
    }

}
