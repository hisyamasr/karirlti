<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		//$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
	}

	public function index()
	{
		$getSetting = $this->Appsetting_model->get_setting();		
		$today = new DateTime("now");
		$openRekrut = new DateTime($getSetting->tanggal_pembukaan);
		$closedRekrut = new DateTime($getSetting->tanggal_penutupan);

		$getPosisi = $this->Posisi_model->get_as_list();
		$getUniversitas = $this->Instansi_model->get_all_instansi_as_list();
		$getJurusan = $this->db->get("setup_jurusan");
		$getJenjang = $this->db->get("setup_pendidikan");
		
		$data['posisiList'] = $getPosisi;
		$data['universitasList'] = $getUniversitas;
		$data['jurusanList'] = $getJurusan->result();
		$data['jenjangList'] = $getJenjang->result();

		$this->load->view('layouts/header');
		if($today >= $openRekrut && $today <= $closedRekrut && $getSetting->status_rekrutmen) {
			$this->load->view('pendaftaran', $data);
		}else{
			$this->load->view('welcome_message');
		}
		$this->load->view('layouts/footer');
	}

	public function check_ktp(){
		$noKTP = $this->input->post('noKTP');
		$data = [];
		if($this->DataPelamar_model->check_noktp($noKTP)){
			$data = [ 'status' => false, 'errorList' => "No ".$noKTP." sudah terdaftar" ];
		}
		
		echo json_encode($data);
	}
}
?>