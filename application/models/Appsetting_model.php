<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appsetting_model extends CI_Model{

	public function __construct()
    {
                $this->load->library('session');
        if (is_null($this->session->userdata('database'))) {
            $array = array(
                'database' => 'lentelko_karir_periode_3'
            );  
            $this->session->set_userdata( $array );
        }
        $database = $this->session->userdata('database');
        $db['hostname'] = 'localhost';
        $db['username'] = 'lentelko_karir';
        $db['password'] = 'Rahasia123!@#';
        $db['database'] = $database;
        $db['dbdriver'] = 'mysqli';

        $this->load->database($db, FALSE, TRUE);
        // $this->load->database();
    }   	
	
	public function get_setting(){
        $query = $this->db->get_where('appsetting', array('id' => 1));
        return $query->row();
    }
	
	public function get_all_appsetting()
    {
        $this->db->select('appsetting.*');
        $this->db->from('appsetting');
		$query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function get_appsetting_by_id($id){
        $query = $this->db->get_where('appsetting', array('id' => $id));
        return $query->row_array();
    }
	
	public function update_appsetting()
    {
        if($this->input->post('id') !== false && $this->input->post('tanggal_pembukaan') !== false && $this->input->post('tanggal_penutupan') !== false && $this->input->post('text_pengumuman') !== false){
			date_default_timezone_set('Asia/Jakarta');
			
			$data = array(
				'tanggal_pembukaan' => $this->input->post('tanggal_pembukaan'),
                'tanggal_penutupan' => $this->input->post('tanggal_penutupan'),
				'text_pengumuman' => $this->input->post('text_pengumuman'),
				'status_rekrutmen' => $this->input->post('status_rekrutmen'),
				'last_modified' => date("Y-m-d h:i:sa")
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('appsetting', $data);
			
        }else{
            return false;
        }
    }
}