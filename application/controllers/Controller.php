<?php
class Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
            $status_akun = $data['status_akun'];
            $ses_data = array(
                'id_user' => $id,
                'username' => $nrp,
                'level' => $level,
                'logged_in' => true,
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
                } elseif ($level == 'siswa') {
                    $username=$this->session->userdata('username');
                    $check_data=$this->model->find_data('tb_data_user','nisn',$username)->row_array();
                    //print_r($check_data);
                    if ($check_data['status_akun_user']=='0') {
                        $this->session->sess_destroy();
                        $this->session->set_flashdata('error', 'Akun anda di NonAktikan Admin');
                       redirect('controller');
                    } else {
                        
                    redirect('siswa');
                    }
                    
                }
            }

        } else {
            $this->session->set_flashdata('error', 'Maaf Password yang anda masukkan salah');
            redirect('controller');

        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
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
        
    }

}
