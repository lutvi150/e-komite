<?php
class Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    public function index()
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('level') == 'admin') {
                redirect('admin/index');
            } elseif ($this->session->userdata('level') == 'siswa') {
                redirect('mahasiswa/home');
            }
        } else {
        $this->load->view('login'); 
        }
    }
    public function login()
    {
        if ($this->session->userdata('logged_in') == true) {
            if ($this->session->userdata('level') == 'admin') {
                redirect('admin/index');
            } elseif ($this->session->userdata('level') == 'mahasiswa') {
                redirect('mahasiswa');
            }
        } else {
            $this->load->view('login');
        }
    }
  
    public function verifikasi_login()
    {

        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $check_data = $this->model->check_account($username, $password);
        if ($check_data->num_rows() > 0) {
            $data = $check_data->row_array();
            $level = $data['level'];
            $id = $data['id_user'];
            $nrp = $data['username'];
            $status_data=$data['status_data'];
            $ses_data = array(
                'id_user' => $id,
                'username' => $nrp,
                'level' => $level,
                'logged_in' => true,
            );
            //print_r($ses_data);
            $this->session->set_userdata($ses_data);
            if ($level == 'admin') {
                redirect('admin');
            } elseif ($level == 'siswa') {
                
                    redirect('siswa/home');
                
            } 

        } else {
            $this->session->set_flashdata('error', 'Maaf Password yang anda masukkan salah');
            redirect('controller');

        }

    }
    public function view_error()
    {
        $this->output->set_status_header('404');
        $this->load->view('404');
    }
    public function ubah_password()
    {
        $this->load->view('menu');
        $this->load->view('ubah_password');
        $this->load->view('footer');
    }
    public function proses_ubah_password()
    {
        $password_lama = md5($this->input->post('password_lama'));
        $password_baru = md5($this->input->post('password_baru'));
        $ulang_password_baru = md5($this->input->post('ulang_password_baru'));
        $chek_data = $this->model->find_data('tb_user', 'password', $password_lama);
        if ($chek_data->num_rows() > 0) {
            if ($password_baru == $ulang_password_baru) {
                $data = array(
                    'password' => $password_baru,
                );
                $this->model->update($password_lama, $data);
                $this->session->set_flashdata('success', 'Ubah Password Berhasil');
                redirect('menu/ubah_password');
            } else {
                $this->session->set_flashdata('error', 'Password Baru Tidak Sama');
                redirect('menu/ubah_password');
            }
        } else {
            $this->session->set_flashdata('error', 'Password Lama Salah');
            redirect('menu/ubah_password');
        }

        print_r($chek_data);
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('controller/login');
    }
    public function buat_akun()
    {
        $data=
        [
            'username'=>'admin',
            'password'=>md5('admin'),
            'no_hp'=>'admin',
            'level'=>'admin',
            'status_data'=>'sudah',
            'tgl_registrasi'=>date('d-m-Y'),
        ];
        $check=$this->model->find_data('tb_user','level','admin');
        if ($check->num_rows()=='0') {
        $this->model->create_data('tb_user',$data);
        $this->session->set_flashdata('success', 'Username admin berhasil di buat');
        redirect('controller/login');
        }
        elseif($check->num_rows()>0)
        {
            $this->model->update_data('tb_user','level','admin',$data);
            $this->session->set_flashdata('success', 'Username admin berhasil di reset');
            redirect('controller/login');
        }
    }

}
