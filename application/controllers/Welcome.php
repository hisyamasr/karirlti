<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index()
	{
		//$this->load->database();
		// $query = $this->db->query("SELECT * FROM setup_jurusan;");
		$query = $this->db->get("setup_jurusan");
		//var_dump($query);
		// foreach ($query->result() as $row)
		// {
		// 	echo $row->nama;
		// 	echo $row->kode_jurusan;
		// 	echo $row->isActive;
		// }
		
		$data['query'] = $query->result();
		$this->load->view('welcome_message', $data);
	}
}
?>