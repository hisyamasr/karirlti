<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SetupInstansi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		$this->load->model('Instansi_model');

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
			$data['instansi'] = $this->Instansi_model->get_all_instansi();
			
			$this->load->view('admin/header');
			$this->load->view('admin/nav');
			$this->load->view('admin/instansi/main', $data);
			$this->load->view('admin/footer');
		}
	}
	
	public function create_instansi(){
        // check all necessary input
        if(!empty($this->input->post('nama')) && !empty($this->input->post('singkatan'))){
            
			$database_input_array = array();
			
            $database_input_array['nama'] = $this->input->post('nama');

            $database_input_array['singkatan'] = $this->input->post('singkatan');
            
			$response = $this->Instansi_model->set_instansi($database_input_array);

			if($response){
				$message['success'] = "Instansi pendidikan berhasil disimpan.";
				//$this->load->view('header');
				$this->index($message);
				//$this->load->view('footer');
			}else{
				$message['error'] = "Instansi pendidikan gagal disimpan.";
				$this->index($message);
			}
			
        }else{
            $message['error'] = "Instansi pendidikan gagal disimpan.";
            $this->index($message);
        }
    }
	
	public function get_instansi_by_id($instansi_id){
        $instansi_id = urldecode($instansi_id);
        $instansi_detail = $this->Instansi_model->get_instansi_by_id($instansi_id);
        echo json_encode($instansi_detail);
    }
	
	public function update_instansi(){
		$nama = $this->input->post('nama');
        $singkatan = $this->input->post('singkatan');
        $response = $this->Instansi_model->update_instansi();

        if($response){
            $message['success'] = "Instansi pendidikan berhasil diubah.";
            $this->index($message);
        }else{
            $message['error'] = "Instansi pendidikan gagal diubah.";
            $this->index($message);
        }
    }
	
	public function delete_instansi(){
		$id = $this->input->post('id');
		$response = $this->Instansi_model->delete_instansi($id);

        // display message according db status
        if($response){
            $message['success'] = "Instansi pendidikan berhasil dihapus.";
            $this->index($message);
        }else{
            $message['error'] = "Instansi pendidikan gagal dihapus.";
            $this->index($message);
        }
    }

}

