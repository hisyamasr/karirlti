<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SetupJurusan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		$this->load->model('Jurusan_model');

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
			$data['jurusan'] = $this->Jurusan_model->get_all_jurusan();
			
			$this->load->view('admin/header');
			$this->load->view('admin/nav');
			$this->load->view('admin/jurusan/main', $data);
			$this->load->view('admin/footer');
		}
	}
	
	public function create_jurusan(){
        // check all necessary input
        if(!empty($this->input->post('nama')) && !empty($this->input->post('kode_jurusan')) && !empty($this->input->post('status'))){
            
			$database_input_array = array();
			
            $database_input_array['nama'] = $this->input->post('nama');

            $database_input_array['kode_jurusan'] = $this->input->post('kode_jurusan');
            
			$database_input_array['status'] = $this->input->post('status');
            
			$response = $this->Jurusan_model->set_jurusan($database_input_array);

			if($response){
				$message['success'] = "Jurusan berhasil disimpan.";
				//$this->load->view('header');
				$this->index($message);
				//$this->load->view('footer');
			}else{
				$message['error'] = "Jurusan gagal disimpan.";
				$this->index($message);
			}
			
        }else{
            $message['error'] = "Jurusan gagal disimpan.";
            $this->index($message);
        }
    }
	
	public function get_jurusan_by_id($jurusan_id){
        $jurusan_id = urldecode($jurusan_id);
        $jurusan_detail = $this->Jurusan_model->get_jurusan_by_id($jurusan_id);
        echo json_encode($jurusan_detail);
    }
	
	public function update_jurusan(){
		$response = $this->Jurusan_model->update_jurusan();

        if($response){
            $message['success'] = "Jurusan berhasil diubah.";
            $this->index($message);
        }else{
            $message['error'] = "Jurusan gagal diubah.";
            $this->index($message);
        }
    }
	
	public function delete_jurusan(){
		$id = $this->input->post('id');
		$response = $this->Jurusan_model->delete_jurusan($id);

        // display message according db status
        if($response){
            $message['success'] = "Jurusan berhasil dihapus.";
            $this->index($message);
        }else{
            $message['error'] = "Jurusan gagal dihapus.";
            $this->index($message);
        }
    }

}

