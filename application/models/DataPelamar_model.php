<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataPelamar_model extends CI_Model{

	public function __construct()
    {
        $this->load->database();
    }
	
	public function get_all_pelamar()
    {
        $this->db->select('data_pelamar.*');
        $this->db->from('data_pelamar');
		$this->db->order_by('data_pelamar.id', 'ASC');
        $query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function get_all_pengalaman($id)
    {
        $this->db->select('data_pengalamankerja.*');
        $this->db->from('data_pengalamankerja');
        $this->db->where('data_pengalamankerja.data_pelamar_id', $id);
		$this->db->order_by('data_pengalamankerja.id', 'ASC');
        $query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function get_all_pendidikan($id)
    {
        $this->db->select('data_pendidikan.*');
        $this->db->from('data_pendidikan');
        $this->db->where('data_pendidikan.data_pelamar_id', $id);
		$this->db->order_by('data_pendidikan.id', 'ASC');
        $query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function get_all_sertifikasi($id)
    {
        $this->db->select('data_sertifikasi.*');
        $this->db->from('data_sertifikasi');
        $this->db->where('data_sertifikasi.data_pelamar_id', $id);
		$this->db->order_by('data_sertifikasi.id', 'ASC');
        $query = $this->db->get();

        $result_array = $query->result_array();
        if($result_array === false){
            return false;
        }else{
            return $result_array;
        }
    }
	
	public function get_pendidikan_by_id($id){
        $query = $this->db->get_where('data_pelamar', array('id' => $id));
        return $query->row_array();
    }
    
    public function check_noktp($noKTP){
        $query = $this->db->get_where('data_pelamar', array('no_ktp' => $noKTP));
        return $query->num_rows() > 0 ? true : false;
    }

    private function get_lastid(){
        $this->db->select('MAX(id) as lastID');
        $this->db->from('data_pelamar');
        $query = $this->db->get();
        $lastID = $query->result();

        return $lastID[0]->lastID;
    }

    private function create_noreg($lastID, $kode_posisi){
        $nextID = $lastID + 1;
        $noreg = "000000".$nextID;
        $noreg = substr($noreg,strlen($noreg)-6,6)."-".$kode_posisi; 
        
        return $noreg;
    }

    public function insert_data($data){
        date_default_timezone_set('Asia/Jakarta');

        $noreg = $this->create_noreg($this->get_lastid(), $data['kode_posisi']);
        $idPelamar = $this->get_lastid() + 1;
        $dataPelamar = array(
            'id' => $idPelamar,
            'no_registrasi' => $noreg,
            'kode_posisi' => $data['kode_posisi'],
            'no_ktp' => $data['no_ktp'],
            'nama' => $data['nama'],
            'tempat_lahir' => $data['tempat_lahir'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'umur' => $data['usia'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'agama' => $data['agama'],
            'status_perkawinan' => $data['status_perkawinan'],
            'foto_url' => $data['foto_url'],
            'cv_url' => $data['cv_url'],
            'no_handphone' => $data['no_handphone'],
            'email' => $data['email'],
            'domisili' => $data['domisili'],
            'alamat_asli' => $data['alamat_asli'],
            'status_pengalaman'=> $data['status_pengalaman'],
            'pengalaman_kerja'  => $data['pengalaman_terakhir'],
            'pengalaman_lainnya' => $data['pekerjaan_lainnya'],			
            'info_loker' => $data['info_loker'],
            'created_date' => date("Y-m-d H:i:sa")
        );

        $dataPendidikan = json_decode(stripslashes($data['data_pendidikan']));
        $insertDataPendidikan = array();
        if(count($dataPendidikan) > 0){
            foreach($dataPendidikan as $row){
                $obj = array(
                    'universitas' => $row->universitas,
                    'jurusan' => $row->jurusan,
                    'jenjang' => $row->jenjang,
                    'no_ijazah' => $row->noIjazah,
                    'tahun_lulus' => $row->tahunLulus,
                    'ipk' => $row->ipk,
                    'data_pelamar_id' => $idPelamar,
                    'created_date' => date("Y-m-d H:i:sa")
                );
                array_push($insertDataPendidikan, $obj);
            }
        }

        $this->db->trans_begin();
        $this->db->insert('data_pelamar', $dataPelamar);

        if(count($dataPendidikan) > 0){
            $this->db->insert_batch('data_pendidikan', $insertDataPendidikan);
        }

        if ($this->db->trans_status() === FALSE)
        {              
            $this->db->trans_rollback();
            $result = (object) [ 'status' => true, 'data' => $dataPelamar ];  
        }
        else
        {
            $this->db->trans_commit();
            $result = (object) [ 'status' => false, 'data' => $dataPelamar ]; 
        }  
        // $this->send_email($dataPelamar);
        // $result = (object) [ 'status' => true, 'data' => $dataPelamar ];
        return $result;
    }

    private function send_email($dataPelamar){
        $this->load->library('email');
        $config['mailtype'] = "html";

        $this->email->initialize($config);

        $explode = explode("-", $dataPelamar['tanggal_lahir']);

        $message = '<html><body><div style="text-align:center;"><div><h3>Konfirmasi Rekrutmen PT. Len Telekomunikasi Indonesia</h3></div>';
        $message .='<div><p class="card-text">Data Anda sudah tersimpan dalam sistem kami. Tahap selanjutnya akan diumumkan melalui e-mail pendaftar.</p>';
        $message .='<table class="table table-solid" style="width:40%; margin-left:40%;"><tbody>';
        $message .='<tr><th scope="row" style="width:35%; text-align:left;">No Registrasi</th><td style="width:3%;">:</td><td style="width:65%;  text-align:left;">'.$dataPelamar['no_registrasi'].'</td></tr>';
        $message .='<tr><th scope="row" style="width:35%; text-align:left;">No KTP</th><td>:</td><td >'.$dataPelamar['no_ktp'].'</td></tr>';
        $message .='<tr><th scope="row" style="width:35%; text-align:left;">Nama</th><td>:</td><td>'.$dataPelamar['nama'].'</td></tr>';
        $message .='<tr><th scope="row" style="width:35%; text-align:left;">Tempat, Tanggal lahir</th><td>:</td><td>'.$dataPelamar['tempat_lahir'].','.$explode[2]."/".$explode[1]."/".$explode[0].'</td></tr>';
        $message .='</tbody></table></div>';		
        $message .='<div><a href="https://karir.len-telko.co.id" 
                    style="display: inline-block; font-weight: 400; text-align: center; white-space: nowrap; vertical-align: middle;border: 1px solid transparent;
                        padding: 0.375rem 0.75rem;font-size: 1rem;line-height: 1.5;border-radius: 0.25rem;
                        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                        color: #fff; background-color: #007bff;border-color: #007bff; text-decoration:none; margin-top:10px;">
                Konfirmasi
                </a></div>';
        $message .='</div></div></body></html>';

        $this->email->from('andienciel@gmail.com', 'Rekrutmen PT. Len Telekomunikasi Indonesia (LTI)');
        $this->email->to($dataPelamar['email']);

        $this->email->subject('[Konfirmasi] - Rekrutmen PT. Len Telekomunikasi Indonesia (LTI)');
        $this->email->message($message);

        $this->email->send();

    }
}