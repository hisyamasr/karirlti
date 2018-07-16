<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		//$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		$this->load->helper(array('form', 'url'));
		
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
		if($today >= $openRekrut && $today <= $closedRekrut && $getSetting->status_rekrutmen) 
		{
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
			$data = [ 'status' => false, 'errorList' => "No KTP ".$noKTP." sudah terdaftar" ];
		}
		
		echo json_encode($data);
	}
	
	public function input_data_pelamar(){
		$this->load->library('form_validation');
		$isValid =  true;	
		$error = array();	

		#region Validation Rules
		$this->form_validation->set_rules('kode_posisi', 'Kode Posisi', 'required', array( 'required' => "Kode Posisi belum dipilih" ));
		$this->form_validation->set_rules('no_ktp', 'No KTP', 'required|min_length[16]|max_length[16]|is_unique[data_pelamar.no_ktp]|numeric',
									array(
										'required' => "No KTP harus terisi",
										'min_length' => "No KTP terdiri dari 16 digit angka",
										'max_length' => "No KTP terdiri dari 16 digit angka",
										'is_unique' => "No KTP sudah terdaftar",
										'numeric' => "No KTP harus berupa angka"
									)
								);
		$this->form_validation->set_rules('nama', 'Nama', 'required', array( 'required' => "Nama belum terisi" ));						
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', array( 'required' => "Tanggal Lahir belum terisi" ));
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required', array( 'required' => "Tempat Lahir belum terisi" ));
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', array( 'required' => "Jenis Kelamin belum terisi" ));
		//$this->form_validation->set_rules('foto', 'Foto', 'required', array( 'required' => "Foto belum terisi" ));
		
		#endregion

		#region Assign Value from Post
			$kodePosisi = $this->input->post('kode_posisi');
			$noKTP = $this->input->post('no_ktp');
			$nama = $this->input->post('nama');
			$tempatLahir = $this->input->post('tempat_lahir');
			$tanggalLahir = $this->input->post('tanggal_lahir');
			$jenisKelamin = $this->input->post('jenis_kelamin');
			//$foto = $this->input->post('foto');
		#endregion

			if ($this->form_validation->run() == FALSE && !$isValid)
			{
				//var_dump(count(validation_errors()));
				//$errors = 
				if(count(validation_errors()) > 0 ){
					array_push($error,validation_errors());
				}
				
				$data = [ 'status' => false, 'errorList' => $error ];
				echo json_encode($data);
			}else{
				$data = [ 'status' => true, 'errorList' => "Success" ];
				echo json_encode($data);
			}
		
		#endregion
	}

	public function upload_foto(){
		#region upload foto
		$config['upload_path']  = './assets/documents/foto';
		$config['allowed_types']= 'jpg|png';
		$config['max_size']     = 1024;
		$config['file_name']	= "Foto-".$this->input->post('no_ktp');

		$this->load->library('upload', $config);

		if ( !$this->upload->do_upload('input_foto'))
		{
			$data = [ 'status' => false, 'errorList' => $this->upload->display_errors() ];
			//$isValid = false;
		}
		else
		{
			//$data = array('upload_data' => $this->upload->data());
			$data = [ 'status' => true, 'errorList' => $this->upload->data() ];
			//$isValid = true;
		}

		echo json_encode($data);	
	}
}
?>