<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index()
	{
		date_default_timezone_set('Asia/Jakarta');

		$getSetting = $this->Appsetting_model->get_setting();		
		$today = new DateTime("now");
		$openRekrut = new DateTime($getSetting->tanggal_pembukaan);
		$closedRekrut = new DateTime($getSetting->tanggal_penutupan);
		// var_dump($today);
		// var_dump($today >= $openRekrut);
		// var_dump($today <= $closedRekrut);

		$this->load->view('layouts/header');
		if($today >= $openRekrut && $today <= $closedRekrut && $getSetting->status_rekrutmen) {
			$this->load->view('pengumuman');
		}else{
			$this->load->view('welcome_message');
		}	
		$this->load->view('layouts/footer');
	}
}
?>