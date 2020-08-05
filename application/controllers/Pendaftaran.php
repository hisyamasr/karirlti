<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		$this->load->library(array('Recaptcha'));
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
		$data['captcha'] = $this->recaptcha->getWidget();
		$data['script_captcha'] = $this->recaptcha->getScriptTag();
		
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
		try{

		
			$this->load->library('form_validation');
			$isValid =  true;	
			$error = array();	

			#region Validation Rules
			$this->form_validation->set_rules('kode_posisi', 'Kode Posisi', 'required', array( 'required' => "Kode Posisi belum dipilih" ));
			$this->form_validation->set_rules('no_ktp', 'No KTP', 'required|min_length[16]|max_length[16]|is_unique[data_pelamar.no_ktp]|numeric',
										array(
											'required' => "No KTP belum terisi",
											'min_length' => "No KTP terdiri dari 16 digit angka",
											'max_length' => "No KTP terdiri dari 16 digit angka",
											'is_unique' => "No KTP sudah terdaftar",
											'numeric' => "No KTP harus berupa angka"
										));
			$this->form_validation->set_rules('nama', 'Nama', 'required', array( 'required' => "Nama belum terisi" ));						
			$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', array( 'required' => "Tanggal Lahir belum terisi" ));
			$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required', array( 'required' => "Tempat Lahir belum terisi" ));
			$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', array( 'required' => "Jenis Kelamin belum terisi" ));
			$this->form_validation->set_rules('agama', 'Jenis Kelamin', 'required', array( 'required' => "Agama belum dipilih" ));
			$this->form_validation->set_rules('status_perkawinan', 'Jenis Kelamin', 'required', array( 'required' => "Status perkawinan belum dipilih" ));
			$this->form_validation->set_rules('foto_url', 'Foto', 'required', array( 'required' => "Silahkah Upload foto Anda" ));
			$this->form_validation->set_rules('cv_url', 'CV', 'required', array( 'required' => "Silahkah Upload CV Anda" ));
			$this->form_validation->set_rules('no_handphone', 'No HP', 'required|numeric',
										array(
											'required' => "No Handphone belum terisi",
											'numeric' => "No Handphone harus berupa angka"
										));
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email',
									array(
										'required' => "Email belum terisi",
										'valid_email' => "Format email salah"
									));
			$this->form_validation->set_rules('domisili', 'Domisili', 'required', array( 'required' => "Domisili belum terisi" ));
			$this->form_validation->set_rules('alamat_asli', 'Alamat Asli', 'required', array( 'required' => "Alamat Asli belum terisi" ));
			$this->form_validation->set_rules('universitas', 'Universitas', 'required', array( 'required' => "Universitas belum ditambahkan" ));
			$this->form_validation->set_rules('jurusan', 'Jurusan', 'required', array( 'required' => "Jurusan belum ditambahkan" ));
			$this->form_validation->set_rules('jenjang', 'Jenjang', 'required', array( 'required' => "Jenjang belum ditambahkan" ));
			$this->form_validation->set_rules('no_ijazah', 'No Ijazah', 'required', array( 'required' => "No Ijazah belum ditambahkan" ));
			$this->form_validation->set_rules('ipk', 'IPK', 'required|less_than_equal_to[4]|decimal', 
								array( 
									'required' => "IPK belum ditambahkan",
									'less_than_equal_to' => "IPK tidak boleh melebihi 4",
									'decimal' => "IPK harus berupa decimal"
								));
			$this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'required|max_length[4]', 
								array( 
									'required' => "Tahun lulus belum ditambahkan", 
									'max_length' => "Tahun lulus maksimal 4 digit",
								));		
			$this->form_validation->set_rules('status_pengalaman', 'Status Pengalaman', 'required', array( 'required' => "Status pengalaman belum dipilih" ));
			$this->form_validation->set_rules('info_loker', 'Info Loker', 'required', array( 'required' => "Info Lowongan kerja belum dipilih" ));
			$this->form_validation->set_rules('g-recaptcha-response', 'Status Pengalaman', 'required', array( 'required' => "Verifikasi Captcha Gagal" ));

			#endregion		
			$recaptcha = $this->input->post('g-recaptcha-response');
			$response = $this->recaptcha->verifyResponse($recaptcha);

			#region Action
				if ($this->form_validation->run() == FALSE)
				{
					$data = [ 'status' => false, 'errorList' => validation_errors() ];
				}else{

					if (!isset($response['success']) || $response['success'] <> true)
					{
						$data = [ 'status' => false, 'errorList' => "Verifikasi Captcha Gagal, tunggu 5 menit untuk mengulangi." ];
					}
					else
					{
						$result = $this->DataPelamar_model->insert_data($this->input->post());
						if($result->status){
							$dataPelamar = array(
								'NoReg' => $result->data['no_registrasi'],
								'NoKTP' => $result->data['no_ktp'],
								'Nama' => $result->data['nama'],
								'TempatLahir' => $result->data['tempat_lahir'],
								'TanggalLahir' => $result->data['tanggal_lahir']
							);
							$data = [ 'status' => true, 'errorList' => "Penyimpanan data pelamar Berhasil", 'dataPelamar' => $dataPelamar ];
						}else{
							$data = [ 'status' => false, 'errorList' => "Penyimpanan data pelamar Gagal" ];
						}
					}								
				}
			
			#endregion
			echo json_encode($data);
		}catch(Exception $e){
			$data = [ 'status' => false, 'errorList' => $e->getMessage() ];
			echo json_encode($data);
		}
	}

	public function upload_foto(){
		#region upload foto
		$config['upload_path']  = './assets/documents/foto';
		$config['allowed_types']= 'jpg|png|jpeg';
		$config['max_size']     = 1024;
		$config['file_name']	= "Foto-".$this->input->post('no_ktp');
		$config['overwrite'] = true;
		// $config['encrypt_name'] = true;

		$this->load->library('upload', $config);

		if ( !$this->upload->do_upload('input_foto'))
		{
			$data = [ 'status' => false, 'errorList' => $this->upload->display_errors('','') ];
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

	public function upload_cv(){
		#region upload cv
		$config['upload_path']  = './assets/documents/cv';
		$config['allowed_types']= 'pdf';
		$config['max_size']     = 2048;
		$config['file_name']	= "CV-".$this->input->post('no_ktp');
		$config['overwrite'] = true;
		// $config['encrypt_name'] = true;

		$this->load->library('upload', $config);

		if ( !$this->upload->do_upload('input_cv'))
		{
			$data = [ 'status' => false, 'errorList' => $this->upload->display_errors('','') ];
		}
		else
		{
			$data = [ 'status' => true, 'errorList' => $this->upload->data() ];
		}

		echo json_encode($data);	
	}

	public function insert_pendidikan(){
		if($this->input->post('data') !== null){
			$data = [ 'status' => true, 'errorList' => json_decode(stripslashes($this->input->post('data'))) ];
			echo json_encode($data);
		}
		
	}

	public function success(){
		$getSetting = $this->Appsetting_model->get_setting();		
		$today = new DateTime("now");
		$openRekrut = new DateTime($getSetting->tanggal_pembukaan);
		$closedRekrut = new DateTime($getSetting->tanggal_penutupan);
		
		$this->load->view('layouts/header');
		if($today >= $openRekrut && $today <= $closedRekrut && $getSetting->status_rekrutmen) 
		{
			$this->load->view('successful_page', $this->input->post());
		}else{
			$this->load->view('welcome_message');
		}
		$this->load->view('layouts/footer');
	}

	public function test_action(){		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('g-recaptcha-response', 'Status Pengalaman', 'required', array( 'required' => "Verifikasi Captcha Gagal" ));

		$recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);
		
		if ($this->form_validation->run() == FALSE)
		{
			$data = [ 'status' => false, 'errorList' => validation_errors() ];
		}else{
			if (!isset($response['success']) || $response['success'] <> true)
			{
				$data = [ 'status' => false, 'errorList' => $response ];
			}
			else
			{
				$data = [ 'status' => true, 'errorList' => $response  ];
			}
		}

		echo json_encode($data);
	}

	public function test_email(){
		$this->load->library('email');
        $this->load->library('encryption');

		$config['protocol'] = "smtp";
		$config['mailtype'] = "html";
		$config['smtp_host'] = 'mail.dishubkabbdg.web.id';
		$config['smtp_user'] = 'admin@dishubkabbdg.web.id';
		$config['smtp_pass'] = 'Dishub2018';
		$config['smtp_port'] = '587';
		//$config['smtp_crypto'] = 'ssl';
		$config['dsn'] = true;

		$dataPelamar = [
			'no_registrasi' => "000002-AKT",
			'no_ktp' => "1234569874563238",
			'nama' => "Andi Yuliandi",
			'tempat_lahir' => 'Bandung',
			'tanggal_lahir' => '1990-07-26',
			'email' => 'andienciel@gmail.com'
		];
        
        $explode = explode("-", $dataPelamar['tanggal_lahir']);
		$encodeParam = urlencode($this->encryption->encrypt($dataPelamar["no_registrasi"].";".$dataPelamar["no_ktp"]));
        $message = '<html><body><div style="text-align:center;"><div><h3>Konfirmasi Rekrutmen PT. Len Telekomunikasi Indonesia</h3></div>';
        $message .='<div><p class="card-text">Data Anda sudah tersimpan dalam sistem kami. Tahap selanjutnya akan diumumkan melalui e-mail pendaftar.</p>';
        $message .='<table class="table table-solid" style="width:40%; margin-left:40%;"><tbody>';
        $message .='<tr><th scope="row" style="width:35%; text-align:left;">No Registrasi</th><td style="width:3%;">:</td><td style="width:65%;  text-align:left;">'.$dataPelamar['no_registrasi'].'</td></tr>';
        $message .='<tr><th scope="row" style="width:35%; text-align:left;">No KTP</th><td>:</td><td style="text-align:left;">'.$dataPelamar['no_ktp'].'</td></tr>';
        $message .='<tr><th scope="row" style="width:35%; text-align:left;">Nama</th><td>:</td><td style="text-align:left;">'.$dataPelamar['nama'].'</td></tr>';
        $message .='<tr><th scope="row" style="width:35%; text-align:left;">Tempat, Tanggal lahir</th><td>:</td><td style="text-align:left;">'.$dataPelamar['tempat_lahir'].', '.$explode[2]."/".$explode[1]."/".$explode[0].'</td></tr>';
        $message .='</tbody></table></div>';		
        $message .='<div><a href="http://karir.len-telko.co.id/konfirmasi?r='.$encodeParam.'"
                    style="display: inline-block; font-weight: 400; text-align: center; white-space: nowrap; vertical-align: middle;border: 1px solid transparent;
                        padding: 0.375rem 0.75rem;font-size: 1rem;line-height: 1.5;border-radius: 0.25rem;
                        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                        color: #fff; background-color: #007bff;border-color: #007bff; text-decoration:none; margin-top:10px;">
                Konfirmasi
                </a></div>';
        $message .='</div></div></body></html>';

		$this->email->initialize($config);
		//$this->email->clear();
        $this->email->from('admin@dishubkabbdg.web.id', 'Rekrutmen PT. Len Telekomunikasi Indonesia (LTI)');
        $this->email->to($dataPelamar['email']);

        $this->email->subject('[Konfirmasi] - Rekrutmen PT. Len Telekomunikasi Indonesia (LTI)');
		$this->email->message($message);

		// if($this->email->send()){
		// 	$data = [ 'status' => true, 'errorList' => $dataPelamar ];
		// }else{
		// 	$data = [ 'status' => false, 'errorList' => $dataPelamar ];
		// }

		//  echo json_encode($data);

		$this->email->send(FALSE);
		echo $this->email->print_debugger();
	}

	public function test_captcha(){
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		
		echo json_encode($data = [ 'status' => $response['success'], 'errorList' => $response ]);
	}
}
