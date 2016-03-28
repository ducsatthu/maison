<?php
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
class Model_manufacturers extends Zend_Db_Table_Abstract {

    protected $_name = "tbl_manufacturers";
    protected $_primary = "id";
    protected $db;

    public function __construct() {
        $this->db = Zend_Registry::get('db');
    }

    public function getAll() {
        $db = $this->db;
        try {

            $select = $db->select();

            $select->from($this->_name);

            $result = $db->fetchAll($select);

            return $result;
        } catch (Exception $exc) {
            $db->rollBack();
            throw $exc->getMessage();
        }
    }

    public function getById($id) {
        $db = $this->db;
        try {
            $select = $db->select();

            $select->from($this->_name);

            $select->where("id = ?", $id);

            $result = $db->fetchRow($select);

            return $result;
        } catch (Exception $exc) {
            $db->rollBack();
            throw $exc->getMessage();
        }
    }

    public function updateItem($data = array()) {
        $db = $this->db;
        $db->beginTransaction();
        try {
            $bind = array(
                "name" => $data['name'],
                "address" => $data['address']
            );

            $where = array(
                "id = ?" => $data['id']
            );

            $result = $db->update($this->_name, $bind, $where);

            $db->commit();

            return $result;
        } catch (Exception $exc) {
            $db->rollBack();
            throw $exc->getMessage();
        }
    }

    public function insertItem($data = array()) {
        $db = $this->db;
        $db->beginTransaction();
        try {
            $bind = array(
                "name" => $data['name'],
                "address" => $data['address']
            );
            
            $result = $db->insert($this->_name, $bind);

            $db->commit();

            return $result;
        } catch (Exception $exc) {
            $db->rollBack();
            throw $exc->getMessage();
        }
    }
    
    public function deleteItem($data = array()) {
        $db = $this->db;
        $db->beginTransaction();
        try {
            $where = array(
                "id = ?" => $data['id']
            );
            
            $result = $db->delete($this->_name, $where);

            $db->commit();

            return $result;
        } catch (Exception $exc) {
            $db->rollBack();
            throw $exc->getMessage();
        }
    }
}
