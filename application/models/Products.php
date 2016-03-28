<?php
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
class Model_products extends Zend_Db_Table_Abstract {

    protected $_name = "tbl_products";
    protected $_primary = "id";
    protected $db;

    /**
     * Khoi tao
     */
    public function __construct() {
        $this->db = Zend_Registry::get('db');
    }

    /**
     * 
     * @return type
     */
    public function getAll() {
        $db = $this->db;
        try {
            $select = $db->select();

            $select->from($this->_name);

            $select->order("id");

            $result = $db->fetchAll($select);

            return $result;
        } catch (Exception $exc) {
            $db->rollBack();
            echo $exc->getMessage();
        }
    }

    /**
     * 
     * @param type $min
     * @param type $max
     * @return int
     */
    public function getMinmaxPrice($min, $max) {
        $db = $this->db;

        $select = $db->select();

        $select->from($this->_name);

        $select->where("price >= ?", $min);
        $select->where("price <= ?", $max);

        $result = $db->fetchAll($select);

        if ($result) {
            return $result;
        }


        return 0;
    }

    public function getByOrder($data) {
        $db = $this->db;

        $select = $db->select();

        $select->from($this->_name);

        $select->order("id $data");

        $result = $db->fetchAll($select);

        if ($result) {
            return $result;
        }


        return 0;
    }

    public function getList() {
        $db = $this->db;

        $select = $db->select();

        $select->from($this->_name, array("id", "name", "price"));

        $result = $db->fetchAll($select);

        return $result;
    }

    /**
     * 
     * @param type $CategoryId
     * @return type
     */
    public function getByCategory($CategoryId) {
        $db = $this->db;
        $select = $db->select();

        $select->from($this->_name);

        $select->where("category_id = ?", $CategoryId);

        $result = $db->fetchAll($select);

        return $result;
    }

    /**
     * 
     * @param type $ColorId
     * @return type
     */
    public function getByColor($ColorId) {
        $db = $this->db;
        $select = $db->select();

        $select->from($this->_name);

        $select->where("color_id = ?", $ColorId);

        $result = $db->fetchAll($select);

        return $result;
    }

    /**
     * 
     * @param type $SizeId
     * @return type
     */
    public function getBySize($SizeId) {
        $db = $this->db;
        $select = $db->select();

        $select->from($this->_name);

        $select->where("size_id = ?", $SizeId);

        $result = $db->fetchAll($select);

        return $result;
    }

    public function getListProductsOrder($listid) {
        $db = $this->db;
        $select = $db->select();

        $select->from($this->_name);

        $select->where("id IN (?)", $listid);

        $result = $db->fetchAll($select);

        return $result;
    }

    public function getListPrice($price = NULL, $category = NULL, $product = NULL) {
        $db = $this->db;

        $select = $db->select();

        $select->from($this->_name);

        $select->where("price <= ?", $price + 500000);

        $select->where("price >= ?", $price - 500000);

        $select->where("id NOT IN (?)", $product);

        $select->where("category_id = ?", $category);

        $select->limit(3, 0);

        $result = $db->fetchAll($select);
        
        return $result;
    }

    public function getProductsById($id) {
        $db = $this->db;
        $select = $db->select();

        $select->from($this->_name);

        $select->where("id = ?", $id);

        $result = $db->fetchRow($select);

        return $result;
    }

    public function getLastId() {
        $db = $this->db;
        try {
            $select = $db->select();

            $select->from($this->_name, "id");

            $select->order("id DESC");

            $result = $db->fetchRow($select);

            return $result;
        } catch (Exception $exc) {
            $db->rollBack();
            echo $exc->getMessage();
        }
    }

    public function insertData($data = array()) {


        $db = $this->db;
        $db->beginTransaction();

        try {

            $bind = array(
                "name" => $data['name'],
                "price" => $data['price'],
                "price_old" => $data['price_old'],
                "descriptions" => $data['descriptions'],
                "category_id" => $data['category_id'],
                "manufacturer_id" => $data['manufacturer_id'],
                "size_id" => $data['size_id'],
                "color_id" => $data['color_id'],
                "image" => $data['image'],
            );


            $result = $db->insert($this->_name, $bind);

            $db->commit();

            return $result;
        } catch (Exception $exc) {
            $db->rollBack();
            echo $exc->getMessage();
        }
    }

    public function updateData($data = array()) {
        $db = $this->db;
        $db->beginTransaction();

        try {

            $bind = array(
                "name" => $data['name'],
                "price" => $data['price'],
                "price_old" => $data['price_old'],
                "descriptions" => $data['descriptions'],
                "category_id" => $data['category_id'],
                "manufacturer_id" => $data['manufacturer_id'],
                "size_id" => $data['size_id'],
                "color_id" => $data['color_id'],
            );

            if (isset($data['image'])) {
                $bind['image'] = $data['image'];
            }


            $where = array(
                "id = ?" => $data['id'],
            );


            $result = $db->update($this->_name, $bind, $where);


            $db->commit();

            return $result;
        } catch (Exception $exc) {
            $db->rollBack();
            echo $exc->getMessage();
        }
    }

}
