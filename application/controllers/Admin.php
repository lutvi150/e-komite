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
        $this->menu('admin/tarif_komite','a');
    }
    public function simpan_tarif_komiter(Type $var = null)
    {
        # code...
    }
    
}

?>