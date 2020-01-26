<?php
class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('pdf');
        
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
        $username=$this->session->userdata('username');
        $data['jumlah_siswa']=$this->model->get_data('tb_data_user','id_siswa','DESC')->num_rows();
        $tagihan=$this->model->tagihan_siswa($username);
        if ($tagihan->num_rows()=='0') {
            $data['total']='0';
        }else {
            foreach ($tagihan->result_array() as $value) {
                $hasil[]=$value['total'];
            }
            $data['total']=array_sum($hasil);
        }
        //print_r($data);
       $this->menu('siswa/home',$data);
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
    public function bukti_bayar(Type $var = null)
    {
        $id=$this->input->get('id');
        $response=$this->model->find_data('tb_bukti_bayar','id_sumbangan',$id)->row_array();
        echo json_encode($response);
        
    }
    public function upload_bukti_bayar()
    {
        $foto=$this->upload_foto("bukti_bayar");
        if ($foto['status']=='0') {
            $this->session->set_flashdata('error', 'Maaf Foto yang anda upload tidak sesuai kriteria sistem'.$foto['error']);
            redirect('siswa/sumbangan');
        } else {
            $id_sumbangan=$this->input->post('id_sumbangan');
            
            $data=
            [
                'id_sumbangan'=>$id_sumbangan,
                'bukti_bayar'=>'upload/'.$foto['error']['bukti_bayar']['file_name'],
                'keterangan'=>'-',
            ];
            $data_update=
            [
                'status'=>'3',
            ];
            $this->model->create_data('tb_bukti_bayar',$data);
            $this->model->update_data('tb_sumbangan','id_sumbangan',$id_sumbangan,$data_update);
            $this->session->set_flashdata('success', 'Bukti Bayar berhasil di upload');
        redirect('siswa/sumbangan');
            
        }
        
    }
    public function upload_ulang(Type $var = null)
    {
        $id_sumbangan=$this->input->post('id_sumbangan');
      
        $data=
        [
            //'keterangan'=>$this->input->post('keterangan'),
            'id_sumbangan'=>'D'.$id_sumbangan,
        ];
        $data_update=
        [
            'status'=>'-',
        ];
        $this->model->update_data('tb_bukti_bayar','id_sumbangan',$id_sumbangan,$data);
        $this->model->update_data('tb_sumbangan','id_sumbangan',$id_sumbangan,$data_update);
        $this->session->set_flashdata('success', 'Silahkan di upload ulang bukti bayar anda');
        redirect('siswa/sumbangan');
    }
    public function upload_foto($name)
    {

        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($name)) {
            $error['error'] = $this->upload->display_errors();
            $error['status'] = '0';
            return $error;
        } else {
            $error['error'] = array($name => $this->upload->data());
            $error['status'] = '1';
            return $error;
        }

    }
    public function cetak_bukti_bayar($id_sumbangan)
    {
        $sumbangan=$this->model->find_data('tb_sumbangan','id_sumbangan',$id_sumbangan)->row_array();
        $siswa=$this->model->find_data('tb_data_user','nisn',$sumbangan['nisn'])->row_array();
        $kelas=$this->model->find_data('tb_kelas','id_kelas',$siswa['id_kelas'])->row_array();
          
        $pdf = new FPDF('l', 'mm', 'A5'); //Ukuran kertas
        //Membuat halaman baru
        $pdf->AddPage();
        //seting jenis font yang di gunakan
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(20, 7, $pdf->image(base_url() . 'asset/images/4.png', $pdf->GetX(), $pdf->GetY(), 20), 0, 0, 'C');
        $pdf->SetFont('Times', 'B', 15);
        //mencetak setting
        $pdf->Cell(170, 6, 'DINAS PENDIDIKAN SUMATERA BARAT', 0, 1, 'C');
        $pdf->Cell(210, 6, 'UPT SMA NEGERI 1 RAMBATAN ', 0, 1, 'C');
        $pdf->Cell(210, 6, 'KABUPATEN TANAH DATAR', 0, 1, 'C');
        $pdf->SetFont('Times', 'BI',8);
        $pdf->Cell(20, 6, '', 0, 0, 'L');
        $pdf->Cell(75, 6, 'Alamat: Simpang Gobah Rambatan', 0, 0, 'L');
        $pdf->Cell(100, 6, 'Kode Pos: 27271', 0, 1, 'R');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(210, 0, '', 0, 1, 'C');
        $pdf->Cell(195, 1, '', ':', 0, 1, 'C');
        $pdf->Cell(210, 5, '', 0, 1, 'C');
        //Membri spasi kEBawah
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(210, 8, 'BUKTI PENYETORAN UANG' , 0, 1, 'C');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(210, 6, 'Telah diterima uang untuk keperluan :' , 0, 1, 'L   ');
        $pdf->Cell(40, 4, 'NISN ' , 0, 0, 'L   ');        
        $pdf->Cell(70, 4, $siswa['nisn'], 1, 1, 'L   ');
        $pdf->Cell(40, 2, ' ' , 0, 1, 'L   ');
        $pdf->Cell(40, 4, 'Nama Siswa ' , 0, 0, 'L   ');
        $pdf->Cell(70, 4, $siswa['nama_siswa'] , 1, 1, 'L   ');
        $pdf->Cell(40, 2, ' ' , 0, 1, 'L   ');
        $pdf->Cell(40, 4, 'Kelas ' , 0, 0, 'L   ');
        $pdf->Cell(70, 4,  $kelas['nama_kelas'], 1, 1, 'L   ');
        $pdf->Cell(40, 2, ' ' , 0, 1, 'L   ');
        $pdf->Cell(40, 4, 'Jenis Sumbangan ' , 0, 0, 'L   ');
        $pdf->Cell(70, 4, $sumbangan['jenis_sumbangan'] , 1, 1, 'L   ');
        $pdf->Cell(40, 2, ' ' , 0, 1, 'L   ');
        $pdf->Cell(40, 4, 'Nominal ' , 0, 0, 'L   ');
        $pdf->Cell(70, 4, 'Rp. '.number_format($sumbangan['total']) , 1, 1, 'L   ');
        $pdf->Cell(40, 2, ' ' , 0, 1, 'L   ');
        $pdf->Cell(40, 4, 'Tanggal Bayar ' , 0, 0, 'L   ');
        $pdf->Cell(70, 4, $sumbangan['tgl_bayar'] , 1, 1, 'L   ');
        $pdf->Cell(40, 2, ' ' , 0, 1, 'L   ');
        $pdf->Cell(40, 4, 'Keterangan ' , 0, 0, 'L   ');
        $pdf->Cell(70, 4, '-' , 1, 1, 'L   ');
         $pdf->SetFont('Times', '', 10);
       
        $pdf->Cell(150,4,'',0,0);
        $pdf->cell(70, 4, 'Simpang Gobah '.date('d-m-Y'), 0, 1,'L');
        $pdf->Cell(165,4,'',0,0);
        $pdf->cell(70, 4, 'Petugas', 0, 1,'L');
        $pdf->cell(256, 6, '', 0, 0);
        $pdf->ln(18);
        $pdf->SetFont('Times', 'BU', 10);
        $pdf->Cell(150,4,'',0,0);
        $pdf->cell(70, 6, '(...........................................)', 0, 0,'L');
     

        $pdf->Output();        
    }

}

?>