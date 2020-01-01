<?php
class Admin extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('logged_in') !== true) {
            $this->session->set_flashdata('error', 'Maaf hak akses anda di tolak');
            redirect('controller');
        }
        if ($this->session->userdata('level') !== 'admin') {
            $this->session->set_flashdata('error', 'Maaf hak akses anda di tolak');
            redirect('controller');
        }
    }
    public function menu($link, $data)
    {
        $this->load->view('admin/header');
        $this->load->view('admin/sidebar_admin');
        $this->load->view($link, $data);
        $this->load->view('admin/footer');
    }
    public function index(Type $var = null)
    {
       $this->menu('admin/home','a');
    }
    public function tarif_komite(Type $var = null)
    {
        $data['tarif']=$this->model->get_data('tb_tarif','id_tarif','DESC')->result_array();
        $this->menu('admin/tarif_komite',$data);
    }
    public function simpan_tarif_komite($status,$id)
    {
        $data=
        [
            'golongan_komite'=>$this->input->post('golongan_komite'),
            'keterangan_komite'=>$this->input->post('keterangan_komite'),
            'tarif_komite'=>$this->input->post('tarif_komite'),
        ];
        if ($status=='simpan') {
            $this->model->create_data('tb_tarif',$data);
            $this->session->set_flashdata('success', 'Tarif Berhasil di tambahkan');
        }
        elseif ($status=='edit') {
            $this->model->update_data('tb_tarif','id_tarif',$id,$data);
            $this->session->set_flashdata('success', 'Tarif Berhasil di Ubah');
        }
        redirect('admin/tarif_komite');
        //print_r($data);
    }
    // perintah simpan kelas
    public function simpan_kelas($status,$id)
    {
        $data=
        [
            'nama_kelas'=>$this->input->post('nama_kelas'),
           
        ];
        if ($status=='simpan') {
            $this->model->create_data('tb_kelas',$data);
            $this->session->set_flashdata('success', 'Kelas Berhasil di tambahkan');
        }
        elseif ($status=='edit') {
            $this->model->update_data('tb_kelas','id_kelas',$id,$data);
            $this->session->set_flashdata('success', 'Kelas Berhasil di Ubah');
        }
        elseif ($status=='hapus') {
            $this->model->delete_data('tb_kelas','id_kelas',$id);
            $this->session->set_flashdata('success', 'Kelas Berhasil di Hapus');
        }
        redirect('admin/data_kelas');
        //print_r($data);
    }
    // detail kelas
    public function detail_json($tabel,$id_reference)
    {
        $id=$this->input->get('id');
        //$id='1';
        $response=$this->model->find_data('tb_kelas','id_kelas',$id)->row_array();
        echo json_encode($response);        
    }
    // untuk hapus tarif
    public function hapus_tarif($id_tarif)
    {
        $this->model->delete_data('tb_tarif','id_tarif',$id_tarif);
        $this->session->set_flashdata('success', 'Data Berhasil Anda Hapus');
        redirect('admin/tarif_komite');
    }
    // detail tarif
    public function detail_tarif(Type $var = null)
    {
        $id=$this->input->get('id');
        $response=$this->model->find_data('tb_tarif','id_tarif',$id)->row_array();
        echo json_encode($response);
    }
    // data siswa
    public function data_siswa(Type $var = null)
    {
        $data['golongan']=$this->model->get_data('tb_tarif','id_tarif','DESC')->result_array();
        $data['kelas']=$this->model->get_data('tb_kelas','id_kelas','DESC')->result_array();
        $data['siswa']=$this->model->get_data('tb_data_user','id_siswa','DESC')->result_array();
        $this->menu('admin/data_siswa',$data);
    }
    // view data kelas
    public function data_kelas(Type $var = null)
    {
        $data['kelas']=$this->model->get_data('tb_kelas','id_kelas','DESC')->result_array();
        $this->menu('admin/data_kelas',$data);
    }
    public function crud_siswa()
    {
       
        if ($status=='simpan') {
            $foto=$this->upload_foto('foto_diri');
            print_r($foto                                                                                                                                                                                                                   );
            // $data=
            // [
            //     'nama_kelas'=>$this->input->post('nisn'),
            //    'nama_siswa'=>$this->input->post('nama_siswa'),
            //    'tanggal_lahir'=>$this->input->post('tanggal_lahir'),
            //    'tempat_lahir'=>$this->input->post('tempat_lahir'),
            //    'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
            //    'alamat'=>$this->input->post('alamat'),
            //    'id_kelas'=>$this->input->post('id_kelas'),
            //    'id_golongan'=>$this->input->post('id_kelas'),
            //    'foto_siswa'=>$foto,
            // ];
            // $this->model->create_data('tb_siswa',$data);
            // $this->session->set_flashdata('success', 'Data Siswa Berhasil di tambahkan');
        }
        elseif ($status=='edit') {
            $this->model->update_data('tb_kelas','id_siswa',$id,$data);
            $this->session->set_flashdata('success', 'Data Siswa Berhasil di Ubah');
        }
        elseif ($status=='hapus') {
            $this->model->delete_data('tb_kelas','id_siswa',$id);
            $this->session->set_flashdata('success', 'Data Siswa Berhasil di Hapus');
        }
        redirect('admin/data_kelas');
    }
    public function upload_foto($name)
    {
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt']=true;
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload($name)){
            $error['error']=$this->upload->display_errors();
            $error['status']='0';
            return $error;
        }
        else{
            $error['error'] = array($name => $this->upload->data());
            $error['status']='1';
            return $error;
        }
        
    }
    
}

?>