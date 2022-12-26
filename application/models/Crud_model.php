<?php

//extend from this model to execute basic db operations
class Crud_model extends CI_Model {

    private $table;

    function __construct($table = null) {
        $this->use_table($table);

        $this->db->query("SET sql_mode = ''");
    }

    protected function use_table($table) {
        $this->table = $table;
    }

    function get_one($id = 0) {
        return $this->get_one_where(array('id' => $id));
    }

    function get_one_where($where = array()) {
        $result = $this->db->get_where($this->table, $where, 1);
        if ($result->num_rows()) {
            return $result->row();
        } else {
            $db_fields = $this->db->list_fields($this->table);
            $fields = new stdClass();
            foreach ($db_fields as $field) {
                $fields->$field = "";
            }
            return $fields;
        }
    }

    function get_all($include_deleted = false) {
        $where = array("deleted" => 0);
        if ($include_deleted) {
            $where = array();
        }
        return $this->get_all_where($where);
    }

    function get_all_where($where = array(), $limit = 1000000, $offset = 0, $sort_by_field = null) {
        $where_in = get_array_value($where, "where_in");
        if ($where_in) {
            foreach ($where_in as $key => $value) {
                $this->db->where_in($key, $value);
            }
            unset($where["where_in"]);
        }

        if ($sort_by_field) {
            $this->db->order_by($sort_by_field, 'ASC');
        }

        return $this->db->get_where($this->table, $where, $limit, $offset);
    }

    function save(&$data = array(), $id = 0) {
        if ($id) {
            //update
            $where = array("id" => $id);
            return $this->update_where($data, $where);
        } else {
            //insert
            if ($this->db->insert($this->table, $data)) {
                $insert_id = $this->db->insert_id();
                return $insert_id;
            }
        }
    }

    function update_where($data = array(), $where = array()) {
        if (count($where)) {
            if ($this->db->update($this->table, $data, $where)) {
                $id = get_array_value($where, "id");
                if ($id) {
                    return $id;
                } else {
                    return true;
                }
            }
        }
    }

    function delete($id = 0, $undo = false) {
        $data = array('deleted' => 1);
        if ($undo === true) {
            $data = array('deleted' => 0);
        }
        $this->db->where("id", $id);
        return $this->db->update($this->table, $data);
    }

    function get_dropdown_list($option_fields = array(), $key = "id", $where = array()) {
        $where["deleted"] = 0;
        $list_data = $this->get_all_where($where, 0, 0, $option_fields[0])->result();
        $result = array();
        foreach ($list_data as $data) {
            $text = "";
            foreach ($option_fields as $option) {
                $text .= $data->$option . " ";
            }
            $result[$data->$key] = $text;
        }
        return $result;
    }

}
