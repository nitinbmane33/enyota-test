<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common_Model extends CI_Model {

    public function getCountryList($condition = '') {
        $this->db->select('*');
        $this->db->from('tbl_country');
        if ($condition != '')
            $this->db->where($condition);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function getRecords($table,$condition = '') {
        $this->db->select('*');
        $this->db->from($table);
        if ($condition != '')
            $this->db->where($condition);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getFieldsData($condition = '') {
        $this->db->select('*');
        $this->db->from('tbl_country_fields as tcf');
        $this->db->join('tbl_fields as tf', 'tf.field_id = tcf.field_id', 'inner');
        if ($condition != '')
            $this->db->where($condition);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function insertData($insertData, $table_name) {
        $this->db->insert($table_name, $insertData);
        return $this->db->insert_id();
    }

    public function getCountryData($condition = '') {
        $this->db->select('*');
        $this->db->from('tbl_temp_data as ttd');
        $this->db->join('tbl_country as tc', 'tc.country_id = ttd.country_id_fk', 'inner');
        $this->db->join('tbl_fields_data as dd', 'dd.temp_id_fk = ttd.temp_id', 'inner');
        $this->db->join('tbl_fields as tcc', 'tcc.field_id = dd.field_id_fk', 'inner');
        if ($condition != '')
            $this->db->where($condition);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCountryWiseData($condition = '') {
        $this->db->select('*');
        $this->db->from('tbl_fields_data as tfd');
        $this->db->join('tbl_fields as tf', 'tf.field_id = tfd.field_id_fk', 'inner');
        if ($condition != '')
            $this->db->where($condition);

        $query = $this->db->get();
        return $query->result_array();
    }

}
