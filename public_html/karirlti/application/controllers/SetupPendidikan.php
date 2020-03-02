<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SetupPendidikan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		$this->load->model('Pendidikan_model');

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

			//list the users
			$data['pendidikan'] = $this->Pendidikan_model->get_all_pendidikan();
			
			$this->load->view('admin/header');
			$this->load->view('admin/nav');
			$this->load->view('admin/pendidikan/main', $data);
			$this->load->view('admin/footer');
		}
	}
	
	public function create_pendidikan(){
        // check all necessary input
        if(!empty($this->input->post('nama')) && !empty($this->input->post('jenjang')) && !empty($this->input->post('status'))){
            
			$database_input_array = array();
			
            $database_input_array['nama'] = $this->input->post('nama');

            $database_input_array['jenjang'] = $this->input->post('jenjang');
            
			$database_input_array['status'] = $this->input->post('status');
            
			$response = $this->Pendidikan_model->set_pendidikan($database_input_array);

			if($response){
				$message['success'] = "Pendidikan berhasil disimpan.";
				//$this->load->view('header');
				$this->index($message);
				//$this->load->view('footer');
			}else{
				$message['error'] = "Pendidikan gagal disimpan.";
				$this->index($message);
			}
			
        }else{
            $message['error'] = "Pendidikan gagal disimpan.";
            $this->index($message);
        }
    }
	
	public function get_pendidikan_by_id($pendidikan_id){
        $pendidikan_id = urldecode($pendidikan_id);
        $pendidikan_detail = $this->Pendidikan_model->get_pendidikan_by_id($pendidikan_id);
        echo json_encode($pendidikan_detail);
    }
	
	public function update_pendidikan(){
		$response = $this->Pendidikan_model->update_pendidikan();

        if($response){
            $message['success'] = "Pendidikan berhasil diubah.";
            $this->index($message);
        }else{
            $message['error'] = "Pendidikan gagal diubah.";
            $this->index($message);
        }
    }
	
	public function delete_pendidikan(){
		$id = $this->input->post('id');
		$response = $this->Pendidikan_model->delete_pendidikan($id);

        // display message according db status
        if($response){
            $message['success'] = "Pendidikan berhasil dihapus.";
            $this->index($message);
        }else{
            $message['error'] = "Pendidikan gagal dihapus.";
            $this->index($message);
        }
    }

}

