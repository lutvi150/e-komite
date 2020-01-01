<?php
class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('logged_in') !== true) {
            $this->session->set_flashdata('error', 'Maaf hak akses anda di tolak');
            redirect('controller');
        }
        if ($this->session->userdata('level') !== 'siswa') {
            $this->session->set_flashdata('error', 'Maaf hak akses anda di tolak');
            redirect('controller');
        }
    }
    public function menu($link, $data)
    {
        $username=$this->session->userdata('username');
        $data2=$this->model->find_data('tb_data_user','nisn',$username)->row_array();
        $this->load->view('siswa/header',$data2);
        $this->load->view('siswa/sidebar_siswa');
        $this->load->view($link, $data);
        $this->load->view('siswa/footer');
    }
    public function index(Type $var = null)
    {
 
       $this->menu('siswa/home','a');
    }
    public function sumbangan()
    {
        $username=$this->session->userdata('username');
        $sumbangan=$this->model->find_data('tb_sumbangan','nisn',$username);
        if ($sumbangan->num_rows()=='0') {
            $data['status_data']='0';
        } else {
            $data['status_data']='1';
            foreach ($sumbangan->result_array() as  $value) {
                $waktu=substr($value['waktu'],0,1);
                $tahun=substr($value['waktu'],2,4);
                if ($waktu=='1') {
                    $bulan="Januari Tahun ".$tahun;
                }elseif ($waktu=='2') {
                    $bulan="Feruari Tahun ".$tahun;
                }elseif ($waktu=='12') {
                    $bulan="Desember Tahun ".$tahun;
                }elseif ($waktu=='3') {
                    $bulan="Maret Tahun ".$tahun;
                }elseif ($waktu=='4') {
                    $bulan="April Tahun ".$tahun;
                }elseif ($waktu=='5') {
                    $bulan="Mei Tahun ".$tahun;
                }elseif ($waktu=='6') {
                    $bulan="Juni Tahun ".$tahun;
                }elseif ($waktu=='7') {
                    $bulan="Juli Tahun ".$tahun;
                }elseif ($waktu=='8') {
                    $bulan="Agustus Tahun ".$tahun;
                }elseif ($waktu=='9') {
                    $bulan="September Tahun ".$tahun;
                }elseif ($waktu=='10') {
                    $bulan="Oktober Tahun ".$tahun;
                }elseif ($waktu=='11') {
                    $bulan="November Tahun ".$tahun;
                }
                $data_siswa=$this->model->find_data('tb_data_user','nisn',$value['nisn'])->row_array();
                $data_kelas=$this->model->find_data('tb_kelas','id_kelas',$data_siswa['id_kelas'])->row_array();
                $tarif_komite=$this->model->find_data('tb_tarif','id_tarif',$data_siswa['id_golongan'])->row_array();
                $hasil[]=[
                    'id_sumbangan'=>$value['id_sumbangan'],
                    'jenis_sumbangan'=>$value['jenis_sumbangan'],
                    'nisn'=>$value['nisn'],
                    'waktu'=>$bulan,
                    'status'=>$value['status'],
                    'tgl_bayar'=>$value['tgl_bayar'],
                    'nama_siswa'=>$data_siswa['nama_siswa'],
                    'nama_kelas'=>$data_kelas['nama_kelas'],
                    'tarif_komite'=>$tarif_komite['tarif_komite'],
                ];
            }
            $data['sumbangan']=$hasil;
        }
        $this->menu('siswa/sumbangan_rutin',$data);
    }
}

?>