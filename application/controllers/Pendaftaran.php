<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
	
	public function index()
	{
		//$this->load->library('javascript');
		// $query = $this->db->get("setup_jurusan");
		
		// $data['query'] = $query->result();
		$this->load->view('pendaftaran');
	}
}
?>