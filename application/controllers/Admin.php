<?php
class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');

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
        $sumbangan = $this->model->find_data('tb_sumbangan', 'status', 'lunas');
        if ($sumbangan->num_rows() == '0') {
            $data['profit'] = '0';
        } else {
            foreach ($sumbangan->result_array() as $value) {

                $data_siswa = $this->model->find_data('tb_data_user', 'nisn', $value['nisn'])->row_array();
                $data_kelas = $this->model->find_data('tb_kelas', 'id_kelas', $data_siswa['id_kelas'])->row_array();
                $tarif_komite = $this->model->find_data('tb_tarif', 'id_tarif', $data_siswa['id_golongan'])->row_array();
                # code...
                $hasil[] = $tarif_komite['tarif_komite'];
            }
            $data['profit'] = array_sum($hasil);
        }

        $data['data_murid'] = $this->model->get_data('tb_data_user', 'id_siswa', 'desc')->num_rows();
        $this->menu('admin/home', $data);
    }
    public function tarif_komite(Type $var = null)
    {
        $data['tarif'] = $this->model->get_data('tb_tarif', 'id_tarif', 'DESC')->result_array();
        $this->menu('admin/tarif_komite', $data);
    }
    public function simpan_tarif_komite($status, $id)
    {
        $data =
            [
            'golongan_komite' => $this->input->post('golongan_komite'),
            'keterangan_komite' => $this->input->post('keterangan_komite'),
            'tarif_komite' => $this->input->post('tarif_komite'),
        ];
        if ($status == 'simpan') {
            $this->model->create_data('tb_tarif', $data);
            $this->session->set_flashdata('success', 'Tarif Berhasil di tambahkan');
        } elseif ($status == 'edit') {
            $this->model->update_data('tb_tarif', 'id_tarif', $id, $data);
            $this->session->set_flashdata('success', 'Tarif Berhasil di Ubah');
        }
        redirect('admin/tarif_komite');
        //print_r($data);
    }
    // perintah simpan kelas
    public function simpan_kelas($status, $id)
    {
        $data =
            [
            'nama_kelas' => $this->input->post('nama_kelas'),

        ];
        if ($status == 'simpan') {
            $this->model->create_data('tb_kelas', $data);
            $this->session->set_flashdata('success', 'Kelas Berhasil di tambahkan');
        } elseif ($status == 'edit') {
            $this->model->update_data('tb_kelas', 'id_kelas', $id, $data);
            $this->session->set_flashdata('success', 'Kelas Berhasil di Ubah');
        } elseif ($status == 'hapus') {
            $this->model->delete_data('tb_kelas', 'id_kelas', $id);
            $this->session->set_flashdata('success', 'Kelas Berhasil di Hapus');
        }
        redirect('admin/data_kelas');
        //print_r($data);
    }
    // data siswa json
    public function data_siswa_json(Type $var = null)
    {
        //$id='15500100083';
        $id = $this->input->get('id');
        $response['data_siswa'] = $this->model->find_data('tb_data_user', 'nisn', $id)->row_array();
        $response['tarif'] = $this->model->find_data('tb_tarif', 'id_tarif', $response['data_siswa']['id_golongan'])->row_array();
        echo json_encode($response);
    }
    // detail kelas
    public function detail_json($tabel, $id_reference)
    {
        $id = $this->input->get('id');
        //$id='1';
        $response = $this->model->find_data('tb_kelas', 'id_kelas', $id)->row_array();
        echo json_encode($response);
    }
    // untuk hapus tarif
    public function hapus_tarif($id_tarif)
    {
        $this->model->delete_data('tb_tarif', 'id_tarif', $id_tarif);
        $this->session->set_flashdata('success', 'Data Berhasil Anda Hapus');
        redirect('admin/tarif_komite');
    }
    // detail tarif
    public function detail_tarif(Type $var = null)
    {
        $id = $this->input->get('id');
        $response = $this->model->find_data('tb_tarif', 'id_tarif', $id)->row_array();
        echo json_encode($response);
    }
    // data siswa
    public function data_siswa(Type $var = null)
    {
        $data['golongan'] = $this->model->get_data('tb_tarif', 'id_tarif', 'DESC')->result_array();
        $data['kelas'] = $this->model->get_data('tb_kelas', 'id_kelas', 'DESC')->result_array();
        $data['siswa'] = $this->model->get_data('tb_data_user', 'id_siswa', 'DESC')->result_array();
        $this->menu('admin/data_siswa', $data);
    }
    // view data kelas
    public function data_kelas(Type $var = null)
    {
        $data['kelas'] = $this->model->get_data('tb_kelas', 'id_kelas', 'DESC')->result_array();
        $this->menu('admin/data_kelas', $data);
    }
    public function crud_siswa($status, $id)
    {

        if ($status == 'simpan') {
            $nisn = $this->input->post('nisn');
            $check = $this->model->find_data('tb_data_user', 'nisn', $nisn);
            if ($check->num_rows() > 0) {
                $this->session->set_flashdata('error', 'Maaf NISN sudah terdaftar');
                redirect('admin/data_siswa');
            } else {

                $foto = $this->upload_foto('foto_diri');
                if ($foto['status'] == '0') {
                    $this->session->set_flashdata('error', 'Maaf Foto yang anda upload tidak sesui kriteri sistem' . $foto['error']);

                    redirect('admin/data_siswa');
                } else {

                    $data =
                        [
                        'nisn' => $nisn,
                        'nama_siswa' => $this->input->post('nama_siswa'),
                        'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                        'tempat_lahir' => $this->input->post('tempat_lahir'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'alamat' => $this->input->post('alamat'),
                        'id_kelas' => $this->input->post('id_kelas'),
                        'id_golongan' => $this->input->post('id_kelas'),
                        'status_akun_user' => '0',
                        'no_hp' => $this->input->post('no_hp'),
                        'foto_siswa' => 'upload/' . $foto['error']['foto_diri']['file_name'],
                    ];
                    //print_r($data);
                    $this->model->create_data('tb_data_user', $data);
                    $this->session->set_flashdata('success', 'Data Siswa Berhasil di tambahkan');
                }
            }

        } elseif ($status == 'edit') {
            $this->model->update_data('tb_data_user', 'id_siswa', $id, $data);
            $this->session->set_flashdata('success', 'Data Siswa Berhasil di Ubah');
        } elseif ($status == 'hapus') {
            $this->model->delete_data('tb_data_user', 'id_siswa', $id);
            $this->session->set_flashdata('success', 'Data Siswa Berhasil di Hapus');
        } elseif ($status == 'aktifkan') {
            $check = $this->model->find_data('tb_user', 'username', $id);
            if ($check->num_rows() == '0') {
                $data_diri = $this->model->find_data('tb_data_user', 'nisn', $id)->row_array();
                $data =
                    [
                    'username' => $data_diri['nisn'],
                    'password' => md5($data_diri['nisn']),
                    'level' => 'siswa',
                    'tgl_registrasi' => date('d-m-Y'),
                    'status_akun' => '1',
                ];
                $data_update =
                    [
                    'status_akun_user' => '1',
                ];
                $this->model->create_data('tb_user', $data);
                $this->model->update_data('tb_data_user', 'nisn', $data_diri['nisn'], $data_update);
                $this->session->set_flashdata('success', 'Akun berhasil di aktifkan');
            } else {
                # code...
            }

        }
        redirect('admin/data_siswa');
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
    public function sumbangan_rutin(Type $var = null)
    {
        $sumbangan = $this->model->find_data('tb_sumbangan', 'jenis_sumbangan', 'rutin');
        if ($sumbangan->num_rows() == '0') {
            $data['status_data'] = '0';
        } else {
            $data['status_data'] = '1';
            foreach ($sumbangan->result_array() as $value) {
                $waktu = substr($value['waktu'], 0, 1);
                $tahun = substr($value['waktu'], 2, 4);
                if ($waktu == '1') {
                    $bulan = "Januari Tahun " . $tahun;
                } elseif ($waktu == '2') {
                    $bulan = "Feruari Tahun " . $tahun;
                } elseif ($waktu == '12') {
                    $bulan = "Desember Tahun " . $tahun;
                } elseif ($waktu == '3') {
                    $bulan = "Maret Tahun " . $tahun;
                } elseif ($waktu == '4') {
                    $bulan = "April Tahun " . $tahun;
                } elseif ($waktu == '5') {
                    $bulan = "Mei Tahun " . $tahun;
                } elseif ($waktu == '6') {
                    $bulan = "Juni Tahun " . $tahun;
                } elseif ($waktu == '7') {
                    $bulan = "Juli Tahun " . $tahun;
                } elseif ($waktu == '8') {
                    $bulan = "Agustus Tahun " . $tahun;
                } elseif ($waktu == '9') {
                    $bulan = "September Tahun " . $tahun;
                } elseif ($waktu == '10') {
                    $bulan = "Oktober Tahun " . $tahun;
                } elseif ($waktu == '11') {
                    $bulan = "November Tahun " . $tahun;
                }
                $data_siswa = $this->model->find_data('tb_data_user', 'nisn', $value['nisn'])->row_array();
                $data_kelas = $this->model->find_data('tb_kelas', 'id_kelas', $data_siswa['id_kelas'])->row_array();
                $tarif_komite = $this->model->find_data('tb_tarif', 'id_tarif', $data_siswa['id_golongan'])->row_array();
                $hasil[] = [
                    'id_sumbangan' => $value['id_sumbangan'],
                    'jenis_sumbangan' => $value['jenis_sumbangan'],
                    'nisn' => $value['nisn'],
                    'waktu' => $bulan,
                    'status' => $value['status'],
                    'tgl_bayar' => $value['tgl_bayar'],
                    'nama_siswa' => $data_siswa['nama_siswa'],
                    'nama_kelas' => $data_kelas['nama_kelas'],
                    'tarif_komite' => $tarif_komite['tarif_komite'],
                ];
            }
            $data['sumbangan'] = $hasil;
        }

        $data['kelas'] = $this->model->get_data('tb_kelas', 'id_kelas', 'DESC')->result_array();
        //print_r($data);
        $this->menu('admin/sumbangan_rutin', $data);
    }
    // hapus sumbangan
    public function hapus_sumbangan_k($id_sumbangan)
    {
        $this->model->delete_data('tb_sumbangan', 'id_sumbangan', $id_sumbangan);
        $this->session->set_flashdata('success', 'Data berhasil di hapus');
        redirect('admin/sumbangan_rutin');
    }
    public function tambah_sumbangan_k($status)
    {
        if ($status == 'rutin') {
            $data_siswa = $this->model->find_data('tb_data_user', 'status_akun_user', '1');
            if ($data_siswa->num_rows() == '0') {
                $this->session->set_flashdata('error', 'Maaf Tidak ada data siswa yang terdaftar');
                redirect('admin/sumbangan_rutin');
            } else {
                $bulan = $this->input->post('bulan');
                $tahun = $this->input->post('tahun');
                if ($bulan == null or $tahun == null) {
                    $this->session->set_flashdata('error', 'Maaf Bulan atau taahun tidak boleh kosong');
                    redirect('admin/sumbangan_rutin');
                } else {

                    foreach ($data_siswa->result_array() as $value) {
                        $tarif = $this->model->find_data('tb_tarif', 'id_tarif', $value['id_golongan'])->row_array();
                        $data =
                            [
                            'jenis_sumbangan' => 'rutin',
                            'nisn' => $value['nisn'],
                            'total' => $tarif['tarif_komite'],
                            'waktu' => $bulan . '-' . $tahun,
                            'status' => '-',
                            'tgl_bayar' => '-',
                        ];
                        $pesan = "Sumbangan Komite Rutin anda Bulan " . $bulan . " tahun " . $tahun . " Rp. " . number_format($tarif['tarif_komite']);
                        $nomor = $value['no_hp'];
                        $this->send_sms($pesan, $nomor);
                        $this->model->create_data('tb_sumbangan', $data);
                        $this->session->set_flashdata('success', 'Sumbangan Rutin Berhasil di Buat');
                        //print_r($pesan);
                    }
                }

            }
            redirect('admin/sumbangan_rutin');
        } elseif ($status == 'isidentil') {
            # code...
        }
    }
    // konfirmasi bayar rutin
    public function bayar_sumbangan_rutin($id)
    {
        $data=
        [
            'status'=>'1',
            'tgl_bayar'=>date('d-m-Y'),
        ];
        $this->model->update_data('tb_sumbangan','id_sumbangan',$id,$data);
        $this->session->set_flashdata('success', 'Konfirmasi Pembayaran Berhasil');
        redirect('admin/sumbangan_rutin');
    }
    // sumbangan persiswa
    public function sumbangan_persiswa_rutin(Type $var = null)
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $nisn = $this->input->post('nisn');

        if ($bulan == null or $tahun == null) {
            $this->session->set_flashdata('error', 'Maaf Bulan atau taahun tidak boleh kosong');
            redirect('admin/sumbangan_rutin');
        } else {
            $check = $this->model->find_data('tb_data_user', 'nisn', $nisn);
            if ($check->num_rows() == '0') {
                $this->session->set_flashdata('error', 'Maaf NISN tersebut tidak terdaftar di sistem');
                redirect('admin/sumbangan_rutin');
            } else {
                $data_siswa = $check->row_array();
                $tarif = $this->model->find_data('tb_tarif', 'id_tarif', $data_siswa['id_golongan'])->row_array();
                $data =
                    [
                    'jenis_sumbangan' => 'rutin',
                    'nisn' => $nisn,
                    'total' => $this->input->post('jumlah'),
                    'waktu' => $bulan . '-' . $tahun,
                    'status' => '-',
                    'tgl_bayar' => '-',
                ];
                $pesan = "Sumbangan Komite Rutin anda Bulan " . $bulan . " tahun " . $tahun . " Rp. " . number_format($tarif['tarif_komite']);
                $nomor = $data_siswa['no_hp'];
                $this->send_sms($pesan, $nomor);
                $this->model->create_data('tb_sumbangan', $data);
                $this->session->set_flashdata('success', 'Sumbangan Rutin Berhasil di Buat');
                redirect('admin/sumbangan_rutin');
            }

        }
    }
    // sumbangan isidentil
    public function sumbangan_isi(Type $var = null)
    {
        $sumbangan = $this->model->find_data('tb_sumbangan', 'jenis_sumbangan', 'isidentil');
        if ($sumbangan->num_rows() == '0') {
            $data['status_data'] = '0';
        } else {
            $data['status_data'] = '1';
            foreach ($sumbangan->result_array() as $value) {
                $waktu = substr($value['waktu'], 0, 1);
                $tahun = substr($value['waktu'], 2, 4);
                if ($waktu == '1') {
                    $bulan = "Januari Tahun " . $tahun;
                } elseif ($waktu == '2') {
                    $bulan = "Feruari Tahun " . $tahun;
                } elseif ($waktu == '12') {
                    $bulan = "Desember Tahun " . $tahun;
                } elseif ($waktu == '3') {
                    $bulan = "Maret Tahun " . $tahun;
                } elseif ($waktu == '4') {
                    $bulan = "April Tahun " . $tahun;
                } elseif ($waktu == '5') {
                    $bulan = "Mei Tahun " . $tahun;
                } elseif ($waktu == '6') {
                    $bulan = "Juni Tahun " . $tahun;
                } elseif ($waktu == '7') {
                    $bulan = "Juli Tahun " . $tahun;
                } elseif ($waktu == '8') {
                    $bulan = "Agustus Tahun " . $tahun;
                } elseif ($waktu == '9') {
                    $bulan = "September Tahun " . $tahun;
                } elseif ($waktu == '10') {
                    $bulan = "Oktober Tahun " . $tahun;
                } elseif ($waktu == '11') {
                    $bulan = "November Tahun " . $tahun;
                }
                $data_siswa = $this->model->find_data('tb_data_user', 'nisn', $value['nisn'])->row_array();
                $data_kelas = $this->model->find_data('tb_kelas', 'id_kelas', $data_siswa['id_kelas'])->row_array();
                $tarif_komite = $this->model->find_data('tb_tarif', 'id_tarif', $data_siswa['id_golongan'])->row_array();
                $hasil[] = [
                    'id_sumbangan' => $value['id_sumbangan'],
                    'jenis_sumbangan' => $value['jenis_sumbangan'],
                    'nisn' => $value['nisn'],
                    'waktu' => $bulan,
                    'status' => $value['status'],
                    'tgl_bayar' => $value['tgl_bayar'],
                    'nama_siswa' => $data_siswa['nama_siswa'],
                    'nama_kelas' => $data_kelas['nama_kelas'],
                    'tarif_komite' => $tarif_komite['tarif_komite'],
                ];
            }
            $data['sumbangan'] = $hasil;
        }

        $data['kelas'] = $this->model->get_data('tb_kelas', 'id_kelas', 'DESC')->result_array();
        //print_r($data);
        $this->menu('admin/sumbangan_rutin', $data);
    }
    public function cetak_laporan_rutin(Type $var = null)
    {

        $kelas = $this->input->post('kelas');
        $data_kelas = $this->model->find_data('tb_kelas', 'id_kelas', $kelas)->row_array();
        $data_sumbangan = $this->model->get_data('tb_tarif', 'id_tarif', 'desc')->result_array();
        $tahun = $this->input->post('tahun');
        if ($kelas == null or $tahun == null) {
            $this->session->set_flashdata('error', 'Tahun dan nama kelas tidak boleh kosong');
            redirect('admin/sumbangan_rutin');
        } else {
            $pdf = new FPDF('l', 'mm', 'Legal'); //Ukuran kertas
            //Membuat halaman baru
            $pdf->AddPage();
            //seting jenis font yang di gunakan
            $pdf->SetFont('Arial', 'B', 16);
            // $pdf->Cell(20, 40, $pdf->image(base_url() . 'asset/img/rumah_kemasan_b.jpg', 115, 40, 150), 0, 0, 'C');
            // //mencetak setting
            // $pdf->Cell(20, 7, $pdf->image(base_url() . 'asset/img/rumah_kemasan.jpg', $pdf->GetX(), $pdf->GetY(), 20), 0, 0, 'C');
            $pdf->SetFont('Arial', 'B', 15);
            //mencetak setting
            $pdf->Cell(320, 6, 'DAFTAR SUMBANGAN KOMITE ', 0, 1, 'C');
            $pdf->Cell(320, 6, 'TAHUN PELAJARAN ' . $tahun, 0, 1, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(340, 1, '', ':', 0, 1, 'C');
            $pdf->Cell(300, 5, '', 0, 1, 'C');
            //Membri spasi kEBawah
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(140, 8, 'Kelas : ' . $data_kelas['nama_kelas'], 0, 0, 'L');
            $pdf->Cell(200, 8, 'Jenis Sumbangan : Rutin', 0, 1, 'R');
            $pdf->Cell(7, 8, 'No', 1, 0, 'C');
            $pdf->Cell(47, 8, 'Nama Siswa ', 1, 0, 'C');
            $pdf->Cell(30, 8, 'Jumlah Bayar ', 1, 0, 'C');
            $data_bulan = $this->model->data_bulan($tahun)->result_array();
            foreach ($data_bulan as $value) {
                $w_su = substr($value['waktu'], 0, 1);
                if ($w_su == '1') {
                    $bulan_c = "Januari ";
                } elseif ($w_su == '2') {
                    $bulan_c = "Feruari ";
                } elseif ($w_su == '12') {
                    $bulan_c = "Desember ";
                } elseif ($w_su == '3') {
                    $bulan_c = "Maret ";
                } elseif ($w_su == '4') {
                    $bulan_c = "April ";
                } elseif ($w_su == '5') {
                    $bulan_c = "Mei ";
                } elseif ($w_su == '6') {
                    $bulan_c = "Juni ";
                } elseif ($w_su == '7') {
                    $bulan_c = "Juli ";
                } elseif ($w_su == '8') {
                    $bulan_c = "Agustus ";
                } elseif ($w_su == '9') {
                    $bulan_c = "September ";
                } elseif ($w_su == '10') {
                    $bulan_c = "Oktober ";
                } elseif ($w_su == '11') {
                    $bulan_c = "November ";
                }
                $pdf->Cell(20, 8, $bulan_c, 1, 0, 'C');
            }
            $pdf->Cell(10, 8, '', 0, 1, 'C');
            $pdf->SetFont('Arial', '', 8);
            $no = 1;
            $no2 = 1;
            $data_user = $this->model->find_data('tb_data_user', 'id_kelas', $kelas)->result_array();
            foreach ($data_user as $row) {
                $data_bayar = $this->model->find_data('tb_tarif', 'id_tarif', $row['id_golongan'])->row_array();
                $data_tagihan = $this->model->find_data('tb_sumbangan', 'nisn', $row['nisn'])->result_array();
                $nomor = $no++;

                $pdf->Cell(7, 6, $no2, 1, 0, 'C');
                $pdf->Cell(47, 6, $row['nama_siswa'], 1, 0, 'C');
                $pdf->Cell(30, 6, "Rp. " . number_format($data_bayar['tarif_komite']), 1, 0, 'C');

                foreach ($data_tagihan as $value2) {
                    if ($value2['status'] == '-') {

                        $pdf->Cell(20, 6, '', 1, 0, 'L');
                    } else {

                        $pdf->SetFont('Symbol', 'B', 10);
                        $pdf->Cell(20, 6, '√', 1, 0, 'L');

                        $pdf->SetFont('Arial', 'B', 10);
                    }

                }

                $pdf->Cell(10, 6, '', 0, 1, 'C');
                if ($nomor % 9 == 0) {

                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(0, 20, 'Halaman ' . $pdf->PageNo(), 0, 0, 'R');

                    $pdf->AddPage();
                }
            }

            //$pdf->SetFont('Arial','I',8);
            $pdf->cell(280, 4, '', 0, 1);

            $pdf->Cell(0, 4, 'CATATAN :', 0, 1);
            $no3 = 1;
            foreach ($data_sumbangan as $value) {

                $pdf->Cell(340, 4, $no3++ . '. ' . $value['keterangan_komite'] . " sumbangan rutin Rp. " . number_format($value['tarif_komite']), 0, 1, '');
            }

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetY(270);
            $pdf->Cell(0, 9, 'Halaman ' . $pdf->PageNo(), 0, 1, 'R');

            $pdf->Output();
        }

    }
    // sms fitur
    public function send_sms($message1, $number1)
    {
        ob_start();
        // setting
        $apikey = '53967ae44f61f89b2bb9e2bd05164398'; // api key
        $urlendpoint = 'http://sms241.xyz/sms/api_sms_masking_send_json.php'; // url endpoint api
        $callbackurl = 'http://your_url_for_get_auto_update_status_sms'; // url callback get status sms

        // create header json
        $senddata = array(
            'apikey' => $apikey,
            'callbackurl' => $callbackurl,
            'datapacket' => array(),
        );

        // create detail data json
        // data 1
        $sendingdatetime1 = "";
        array_push($senddata['datapacket'], array(
            'number' => trim($number1),
            'message' => urlencode(stripslashes(utf8_encode($message1))),
            'sendingdatetime' => $sendingdatetime1));

        // data 2
        // $number2='081xxx';
        // $message2='Message 2';
        // $sendingdatetime2 ="2017-01-01 23:59:59";
        // array_push($senddata['datapacket'],array(
        //     'number' => trim($number2),
        //     'message' => urlencode(stripslashes(utf8_encode($message2))),
        //     'sendingdatetime' => $sendingdatetime2));

        // send sms
        $dt = json_encode($senddata);
        $curlHandle = curl_init($urlendpoint);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $dt);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($dt))
        );
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 5);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 5);
        $responjson = curl_exec($curlHandle);
        curl_close($curlHandle);
        header('Content-Type: application/json');
        echo $responjson;
    }
    public function balance()
    {
        ob_start();
        // setting
        $apikey = '53967ae44f61f89b2bb9e2bd05164398'; // api key
        $urlendpoint = 'http://sms241.xyz/sms/api_sms_reguler_balance_json.php'; // url endpoint api

        // create header json
        $senddata = array(
            'apikey' => $apikey,
        );

        // get balance
        $data = json_encode($senddata);
        $curlHandle = curl_init($urlendpoint);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 5);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 5);
        $responjson = curl_exec($curlHandle);
        curl_close($curlHandle);
        header('Content-Type: application/json');
        echo $responjson;
    }

}
