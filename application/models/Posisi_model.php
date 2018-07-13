<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posisi_model extends CI_Model{

	public function __construct()
    {
        $this->load->database();
    }
	
	public function get_all_posisi()
    {
        $this->db->select('setup_posisi.*');
        $this->db->from('setup_posisi');
		$this->db->order_by('setup_posisi.id', 'ASC');
        $query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function set_posisi($database_input_array)
    {
        if($database_input_array['nama'] !== false && $database_input_array['kode_posisi'] !== false && $database_input_array['status'] !== false){
            date_default_timezone_set('Asia/Jakarta');

            $data = array(
                'nama' => $database_input_array['nama'],
				'kode_posisi' => $database_input_array['kode_posisi'],      
				'isActive' => $database_input_array['status'],      
				'created_date' => date("Y-m-d h:i:sa")
            );

            return $this->db->insert('setup_posisi', $data);
        }else{
            return false;
        }
    }
	
	public function get_posisi_by_id($id){
        $query = $this->db->get_where('setup_posisi', array('id' => $id));
        return $query->row_array();
    }
	
	public function update_posisi()
    {
        if($this->input->post('id') !== false && $this->input->post('nama') !== false && $this->input->post('singkatan') !== false){
			date_default_timezone_set('Asia/Jakarta');
			
			$data = array(
				'nama' => $this->input->post('nama'),
				'kode_posisi' => $this->input->post('kode_posisi'),
				'isActive' => $this->input->post('status'),
				'last_modified' => date("Y-m-d h:i:sa")
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('setup_posisi', $data);
			
        }else{
            return false;
        }
    }
	
	public function delete_posisi($id){
        $response = $this->db->delete('setup_posisi', array('id' => $id));
        $affected_row = $this->db->affected_rows();

        $delete_status = false;
        if($response === true && $affected_row > 0){
            $delete_status = true;
        }

        return $delete_status;
    }
	
}