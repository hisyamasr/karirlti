<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instansi_model extends CI_Model{

	public function __construct()
    {
        $this->load->database();
    }
	
	public function get_all_instansi()
    {
        $this->db->select('setup_universitas.*');
        $this->db->from('setup_universitas');
		$this->db->order_by('setup_universitas.id', 'ASC');
        $query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function set_instansi($database_input_array)
    {
        if($database_input_array['nama'] !== false && $database_input_array['singkatan'] !== false){
            date_default_timezone_set('Asia/Jakarta');

            $data = array(
                'nama' => $database_input_array['nama'],
				'singkatan' => $database_input_array['singkatan'],      
				'created_date' => date("Y-m-d h:i:sa")
            );

            return $this->db->insert('setup_universitas', $data);
        }else{
            return false;
        }
    }
	
	public function get_instansi_by_id($id){
        $query = $this->db->get_where('setup_universitas', array('id' => $id));
        return $query->row_array();
    }
	
	public function update_instansi()
    {
        if($this->input->post('id') !== false && $this->input->post('nama') !== false && $this->input->post('singkatan') !== false){
			date_default_timezone_set('Asia/Jakarta');
			
			$data = array(
				'nama' => $this->input->post('nama'),
				'singkatan' => $this->input->post('singkatan'),
				'last_modified' => date("Y-m-d h:i:sa")
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('setup_universitas', $data);
			
        }else{
            return false;
        }
    }
	
	public function delete_instansi($id){
        $response = $this->db->delete('setup_universitas', array('id' => $id));
        $affected_row = $this->db->affected_rows();

        $delete_status = false;
        if($response === true && $affected_row > 0){
            $delete_status = true;
        }

        return $delete_status;
    }
	
}