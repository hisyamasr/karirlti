<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurusan_model extends CI_Model{

	public function __construct()
    {
        $this->load->database();
    }
	
	public function get_all_jurusan()
    {
        $this->db->select('setup_jurusan.*');
        $this->db->from('setup_jurusan');
		$this->db->order_by('setup_jurusan.id', 'ASC');
        $query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function set_jurusan($database_input_array)
    {
        if($database_input_array['nama'] !== false && $database_input_array['kode_jurusan'] !== false && $database_input_array['status'] !== false){
            date_default_timezone_set('Asia/Jakarta');

            $data = array(
                'nama' => $database_input_array['nama'],
				'kode_jurusan' => $database_input_array['kode_jurusan'],      
				'isActive' => $database_input_array['status'],      
				'created_date' => date("Y-m-d h:i:sa")
            );

            return $this->db->insert('setup_jurusan', $data);
        }else{
            return false;
        }
    }
	
	public function get_jurusan_by_id($id){
        $query = $this->db->get_where('setup_jurusan', array('id' => $id));
        return $query->row_array();
    }
	
	public function update_jurusan()
    {
        if($this->input->post('id') !== false && $this->input->post('nama') !== false && $this->input->post('singkatan') !== false){
			date_default_timezone_set('Asia/Jakarta');
			
			$data = array(
				'nama' => $this->input->post('nama'),
				'kode_jurusan' => $this->input->post('kode_jurusan'),
				'isActive' => $this->input->post('status'),
				'last_modified' => date("Y-m-d h:i:sa")
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('setup_jurusan', $data);
			
        }else{
            return false;
        }
    }
	
	public function delete_jurusan($id){
        $response = $this->db->delete('setup_jurusan', array('id' => $id));
        $affected_row = $this->db->affected_rows();

        $delete_status = false;
        if($response === true && $affected_row > 0){
            $delete_status = true;
        }

        return $delete_status;
    }
	
}