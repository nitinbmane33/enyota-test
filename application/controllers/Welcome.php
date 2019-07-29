<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        $this->load->view('welcome_message');
    }

    public function showCountries() {
        $data['arr_country'] = $this->common_model->getCountryList($condition = '');
        $this->load->view('country-list', $data);
    }

    public function getFormData() {
        $country_id = $this->input->post('country_id');
        if ($country_id != '') {
            $condition = array('country_id' => $country_id);
            $data['arr_fields'] = $this->common_model->getFieldsData($condition);
            return $this->load->view('country-field-list', $data, FALSE);
        }
    }

    public function insertFieldsData() {
        if ($this->input->post()) {
            $arr_data = $this->input->post();
            $insertData = array('country_id_fk' => $this->input->post('country'));
            $last_insert_id = $this->common_model->insertData($insertData, 'tbl_temp_data');
            unset($arr_data['country']);
            foreach ($arr_data as $key => $data) {
                $insertData = array(
                    'temp_id_fk' => $last_insert_id,
                    'field_id_fk' => $key,
                    'field_data' => $data
                );
                $last_id=$this->common_model->insertData($insertData, 'tbl_fields_data');
            }
            $this->session->set_userdata('msg', 'Record inserted successfully');
            redirect(base_url() . 'view-country-details/'.$last_insert_id);
        }
    }
    
    public function viewCountryDetails($temp_id){
        $arr_tempdata = $this->common_model->getCountryData(array('ttd.temp_id'=>$temp_id));
        if(count($arr_tempdata)>0){
            $arr_template = $this->common_model->getRecords('tbl_views',array('country_id_fk' => $arr_tempdata[0]['country_id_fk']));
            $data['template'] = $arr_template[0]['view_content'];
            foreach($arr_tempdata as $cou_data){
                $data['template'] = str_replace('<'.$cou_data['fields_names'].'>', $cou_data['field_data'],$data['template']);
            }
        }
        $this->load->view('county-list-details',$data);
    }
}
