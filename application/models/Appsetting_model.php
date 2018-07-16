<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appsetting_model extends CI_Model{

	public function __construct()
    {
        //$this->load->database();
    }   	
	
	public function get_setting(){
        $query = $this->db->get_where('appsetting', array('id' => 1));
        return $query->row();
    }
	
	public function update_setting()
    {
        if($this->input->post('id') !== false){
			date_default_timezone_set('Asia/Jakarta');
			
			$data = array(
                'tanggal_pembukaan' => $this->input->post('tanggal_pembukaan'),
                'tanggal_penutupan' => $this->input->post('tanggal_penutupan'),
				'text_pengumuman' => $this->input->post('text_pengumuman'),
				'status_rekrutmen' => $this->input->post('status_rekrutmen'),
				'last_modified' => date("Y-m-d h:i:sa")
			);

			$this->db->where('id', 1);
			return $this->db->update('appsetting', $data);
			
        }else{
            return false;
        }
    }	
}