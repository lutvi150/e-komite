<?php
class Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
<<<<<<< HEAD
        $this->load->model('model');

    }
    public function index()
    {
        {
            if ($this->session->userdata('level') == 'admin') {
                redirect('admin');
            } elseif ($this->session->userdata('level') == 'murid') {
                redirect('murid');
            }
            $this->load->view('login');
        }
    }
=======
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
  
>>>>>>> 5cfdddaa18e257ffd6830e93268bd6987a2aa1d8
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
<<<<<<< HEAD
            $status_akun = $data['status_akun'];
=======
            $status_data=$data['status_data'];
>>>>>>> 5cfdddaa18e257ffd6830e93268bd6987a2aa1d8
            $ses_data = array(
                'id_user' => $id,
                'username' => $nrp,
                'level' => $level,
                'logged_in' => true,
<<<<<<< HEAD
                'status_akun' => $status_akun,
            );
            //print_r($ses_data);
            if ($status_akun == '0') {
                $this->session->set_flashdata('error', 'Akun yang anda gunakan di nonaktifkan oleh admin');
                redirect('controller');
            } else {
                $this->session->set_userdata($ses_data);
                if ($level == 'admin') {
                    redirect('admin');
                } elseif ($level == 'agen') {
                    redirect('siswa');
                }
            }
=======
            );
            //print_r($ses_data);
            $this->session->set_userdata($ses_data);
            if ($level == 'admin') {
                redirect('admin');
            } elseif ($level == 'siswa') {
                
                    redirect('siswa/home');
                
            } 
>>>>>>> 5cfdddaa18e257ffd6830e93268bd6987a2aa1d8

        } else {
            $this->session->set_flashdata('error', 'Maaf Password yang anda masukkan salah');
            redirect('controller');

        }
<<<<<<< HEAD
=======

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
>>>>>>> 5cfdddaa18e257ffd6830e93268bd6987a2aa1d8
    }
    public function logout()
    {
        $this->session->sess_destroy();
<<<<<<< HEAD
        redirect('controller');
    }
    public function buat_akun(Type $var = null)
    {
        $data =
            [
            'username' => 'admin',
            'password' => md5('admin'),
            'level' => 'admin',
            'status_akun' => '1',
            'tgl_registrasi' => date('d-m-Y'),
        ];
        $this->model->create_data('tb_user', $data);
    }
    public function error_404(Type $var = null)
    {
        $this->load->view('404_page');
        
=======
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
>>>>>>> 5cfdddaa18e257ffd6830e93268bd6987a2aa1d8
    }

}
