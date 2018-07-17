<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AppSetting extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		$this->load->model('Appsetting_model');

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
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			// set the flash data error message if there is one
			$data['message'] = $message;

			//list the users
			$data['appsetting'] = $this->Appsetting_model->get_all_appsetting();
			
			$this->load->view('admin/header');
			$this->load->view('admin/nav');
			$this->load->view('admin/appsetting/main', $data);
			$this->load->view('admin/footer');
		}
	}
	
	public function get_appsetting_by_id($appsetting_id){
        $appsetting_id = urldecode($appsetting_id);
        $appsetting_detail = $this->Appsetting_model->get_appsetting_by_id($appsetting_id);
        echo json_encode($appsetting_detail);
    }
	
	public function update_appsetting(){
		$response = $this->Appsetting_model->update_appsetting();

        if($response){
            $message['success'] = "App Setting berhasil diubah.";
            $this->index($message);
        }else{
            $message['error'] = "App Setting gagal diubah.";
            $this->index($message);
        }
    }
	
}

