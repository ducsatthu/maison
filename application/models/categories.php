<?php
/**
 * @version    1.0.0
 * @package    Maison
 * @author     Tran Xuan Duc <ductranxuan.29710@gmail.com>
 * @copyright  2016 Tran Xuan Duc
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
class Model_categories extends Zend_Db_Table_Abstract {

    protected $_name = "tbl_categories";
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

    public function getCategoryById($id) {
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

    public function updateCategory($data = array()) {
        $db = $this->db;
        $db->beginTransaction();
        try {
            $bind = array(
                "name" => $data['name'],
                "descriptions" => $data['descriptions']
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

    public function insertCategory($data = array()) {
        $db = $this->db;
        $db->beginTransaction();
        try {
            $bind = array(
                "name" => $data['name'],
                "descriptions" => $data['descriptions']
            );
            
            $result = $db->insert($this->_name, $bind);

            $db->commit();

            return $result;
        } catch (Exception $exc) {
            $db->rollBack();
            throw $exc->getMessage();
        }
    }
    
    public function deleteCategory($data = array()) {
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
