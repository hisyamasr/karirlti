<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataPelamar_model extends CI_Model{

	public function __construct()
    {
        $this->load->database();
    }
	
	public function get_all_pelamar()
    {
        $this->db->select('data_pelamar.*');
        $this->db->from('data_pelamar');
		$this->db->order_by('data_pelamar.id', 'ASC');
        $query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function get_all_pengalaman($id)
    {
        $this->db->select('data_pengalamankerja.*');
        $this->db->from('data_pengalamankerja');
        $this->db->where('data_pengalamankerja.data_pelamar_id', $id);
		$this->db->order_by('data_pengalamankerja.id', 'ASC');
        $query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function get_all_pendidikan($id)
    {
        $this->db->select('data_pendidikan.*');
        $this->db->from('data_pendidikan');
        $this->db->where('data_pendidikan.data_pelamar_id', $id);
		$this->db->order_by('data_pendidikan.id', 'ASC');
        $query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function get_all_sertifikasi($id)
    {
        $this->db->select('data_sertifikasi.*');
        $this->db->from('data_sertifikasi');
        $this->db->where('data_sertifikasi.data_pelamar_id', $id);
		$this->db->order_by('data_sertifikasi.id', 'ASC');
        $query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function get_pendidikan_by_id($id){
        $query = $this->db->get_where('data_pelamar', array('id' => $id));
        return $query->row_array();
    }
    
    public function check_noktp($noKTP){
        $query = $this->db->get_where('data_pelamar', array('no_ktp' => $noKTP));
        return $query->num_rows() > 0 ? true : false;
    }
}