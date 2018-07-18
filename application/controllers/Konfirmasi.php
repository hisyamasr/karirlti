<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'language'));
		
	}
	
	public function index()
	{
		$this->load->library('encryption');

		$getSetting = $this->Appsetting_model->get_setting();		
		$today = new DateTime("now");
		$openRekrut = new DateTime($getSetting->tanggal_pembukaan);
		$closedRekrut = new DateTime($getSetting->tanggal_penutupan);
		$getData = null;
		$updateData = false;

		if($this->input->get('r') !== null){
			$getParam = $this->input->get('r');
			$getDecrypted = $this->encryption->decrypt(urldecode($getParam));
			//echo $getDecrypted;
			//var_dump(urldecode($getParam));
			$explode = explode(";", $getDecrypted);
			$getData = $this->DataPelamar_model->get_data_by_ktp($explode[0], $explode[1]);
			$updateData = $this->DataPelamar_model->update_konfirmasi($explode[0], $explode[1]);
		}		
		
		$this->load->view('layouts/header');
		if($today >= $openRekrut && $today <= $closedRekrut && $getSetting->status_rekrutmen && $getData !== null && $updateData) 
		{
			$data['data'] = $getData[0];
			$this->load->view('konfirmasi', $data);
		}else{
			$this->load->view('welcome_message');
		}
		$this->load->view('layouts/footer');

		
		$test = urlencode($this->encryption->encrypt('000001-SDM;1234569874563216'));
		//echo $test;
		 //$this->encryption->decrypt("347eeaf8564b846f557934f9454233a5c1bda1db186ee5d4740323912356f9f77f09320bbb6c4c259e50762ededc3f820afe4b170baf4edb097795e4b1a19b87uLMNM7iOm/UDGrdRx3M5M+fS1EjKnXFTABPMCqO4nHC/n+XtPPAYODnWH1SKx075");
	}
}
?>