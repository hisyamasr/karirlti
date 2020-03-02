<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendidikan_model extends CI_Model{

	public function __construct()
    {
        $this->load->database();
    }
	
	public function get_all_pendidikan()
    {
        $this->db->select('setup_pendidikan.*');
        $this->db->from('setup_pendidikan');
		$this->db->order_by('setup_pendidikan.id', 'ASC');
        $query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function set_pendidikan($database_input_array)
    {
        if($database_input_array['nama'] !== false && $database_input_array['jenjang'] !== false && $database_input_array['status'] !== false){
            date_default_timezone_set('Asia/Jakarta');

            $data = array(
                'nama' => $database_input_array['nama'],
				'jenjang' => $database_input_array['jenjang'],      
				'isActive' => $database_input_array['status'],      
				'created_date' => date("Y-m-d h:i:sa")
            );

            return $this->db->insert('setup_pendidikan', $data);
        }else{
            return false;
        }
    }
	
	public function get_pendidikan_by_id($id){
        $query = $this->db->get_where('setup_pendidikan', array('id' => $id));
        return $query->row_array();
    }
	
	public function update_pendidikan()
    {
        if($this->input->post('id') !== false && $this->input->post('nama') !== false && $this->input->post('singkatan') !== false){
			date_default_timezone_set('Asia/Jakarta');
			
			$data = array(
				'nama' => $this->input->post('nama'),
				'jenjang' => $this->input->post('jenjang'),
				'isActive' => $this->input->post('status'),
				'last_modified' => date("Y-m-d h:i:sa")
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('setup_pendidikan', $data);
			
        }else{
            return false;
        }
    }
	
	public function delete_pendidikan($id){
        $response = $this->db->delete('setup_pendidikan', array('id' => $id));
        $affected_row = $this->db->affected_rows();

        $delete_status = false;
        if($response === true && $affected_row > 0){
            $delete_status = true;
        }

        return $delete_status;
    }
	
}