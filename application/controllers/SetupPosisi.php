<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SetupPosisi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		$this->load->model('Posisi_model');

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
			$data['posisi'] = $this->Posisi_model->get_all_posisi();
			
			$this->load->view('admin/header');
			$this->load->view('admin/nav');
			$this->load->view('admin/posisi/main', $data);
			$this->load->view('admin/footer');
		}
	}
	
	public function create_posisi(){
        // check all necessary input
        if(!empty($this->input->post('nama')) && !empty($this->input->post('kode_posisi')) && !empty($this->input->post('status'))){
            
			$database_input_array = array();
			
            $database_input_array['nama'] = $this->input->post('nama');

            $database_input_array['kode_posisi'] = $this->input->post('kode_posisi');
            
			$database_input_array['status'] = $this->input->post('status');
            
			$response = $this->Posisi_model->set_posisi($database_input_array);

			if($response){
				$message['success'] = "Posisi berhasil disimpan.";
				//$this->load->view('header');
				$this->index($message);
				//$this->load->view('footer');
			}else{
				$message['error'] = "Posisi gagal disimpan.";
				$this->index($message);
			}
			
        }else{
            $message['error'] = "Posisi gagal disimpan.";
            $this->index($message);
        }
    }
	
	public function get_posisi_by_id($posisi_id){
        $posisi_id = urldecode($posisi_id);
        $posisi_detail = $this->Posisi_model->get_posisi_by_id($posisi_id);
        echo json_encode($posisi_detail);
    }
	
	public function update_posisi(){
		$response = $this->Posisi_model->update_posisi();

        if($response){
            $message['success'] = "Posisi berhasil diubah.";
            $this->index($message);
        }else{
            $message['error'] = "Posisi gagal diubah.";
            $this->index($message);
        }
    }
	
	public function delete_posisi(){
		$id = $this->input->post('id');
		$response = $this->Posisi_model->delete_posisi($id);

        // display message according db status
        if($response){
            $message['success'] = "Posisi berhasil dihapus.";
            $this->index($message);
        }else{
            $message['error'] = "Posisi gagal dihapus.";
            $this->index($message);
        }
    }

}

