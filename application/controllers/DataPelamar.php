<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DataPelamar extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		$this->load->model('DataPelamar_model');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}
	
	public function index($message=null)
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		/* else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		} */
		else
		{
			// set the flash data error message if there is one
			$data['message'] = $message;
			$datpendidikan = array();
			//list the users
			$data['pelamar'] = $this->DataPelamar_model->get_all_pelamar();
			$no = 1;
			foreach($data['pelamar'] as $pel){
				//$data['pengalaman'] = $this->DataPelamar_model->get_all_pengalaman($pel['id']);
				$pendidikan= $this->DataPelamar_model->get_all_pendidikan($pel['id']);
				
				//$data['sertifikasi'] = $this->DataPelamar_model->get_all_sertifikasi($pel['id']);
				array_push($datpendidikan, [ $no, $pendidikan]);
				$no++;
			}

			$data['pendidikan'] = $datpendidikan;
			$this->load->view('admin/header');
			$this->load->view('admin/nav');
			$this->load->view('admin/pelamar/main', $data);
			$this->load->view('admin/footer');
		}
	}
	
}

