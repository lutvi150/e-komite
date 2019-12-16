<?php
class model extends CI_Model
{
    // perintah untuk membuat nomor otomatis
    public function nomor_otomatis()
    {
        $tanggal = date('d-m-Y');
        $a = $this->db->query("SELECT MAX(RIGHT(nomor_pengajuan,4)) AS no_max FROM tb_pengajuan WHERE tgl_pengajuan='$tanggal'");
        $no = "";
        if ($a->num_rows() > 0) {
            foreach ($a->result() as $n) {
                $tmp = ((int) $n->no_max) + 1;
                $no = sprintf("%04s", $tmp);
            }
        } else {
            $no = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dmY') . $no;
    }
    // mengambil data
    public function get_data($tabel, $order_reference, $order)
    {
        $this->db->order_by($order_reference, $order);
        return $this->db->get($tabel);
    }
    // get data with limit
    public function get_data_limit($table, $limit, $order_reference, $order)
    {
        $this->db->order_by($order_reference, $order);
        return $this->db->get($table, $limit);
    }
    // untuk update data di database
    public function update_data($table, $id_reference, $referensi, $object)
    {
        $this->db->where($id_reference, $referensi);
        $this->db->update($table, $object);
    }
    // perintah simpan data
    public function create_data($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }
    // perintah mencari data
    public function find_data($tabel, $id_tabel, $id)
    {
        $this->db->where($id_tabel, $id);
        return $this->db->get($tabel);
    }
    public function hitung_database($tabel)
    {
        return $this->db->get($tabel);
    }
    public function check_account($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->get('tb_user');

    }
    public function update($password_lama, $data)
    {
        $this->db->where('password', $password_lama);
        $this->db->update('tb_user', $data);

    }
    // for delete personil data
    public function delete_data($table, $id_reference, $referensi)
    {
        $this->db->where($id_reference, $referensi);
        $this->db->delete($table);
    }
    // tambahan fungsi
    // check pengajuan ada atau belum
    public function check_pengajuan($nim)
    {
         $where="status_pengajuan='Proses' AND nim_mahasiswa=".$nim;
         $this->db->where($where);
         return $this->db->get('tb_pengajuan');
    }
    public function detail_mahasiswa($nim)
    {
        $this->db->from('tb_user,tb_orang_tua,tb_data_jurusan,tb_data_mahasiswa');
        $this->db->where('tb_user.username=tb_orang_tua.nim_mahasiswa');
        $this->db->where('tb_user.username=tb_data_mahasiswa.nim');
        $this->db->where('tb_data_mahasiswa.jurusan=tb_data_jurusan.id_jurusan');
        $this->db->where('tb_user.username', $nim);
        return $this->db->get();
    }
    // ambil data kelompok
    public function get_kelompok_id_2($id)
    {
        $this->db->from('tb_kelompok,tb_data_dosen,tb_nagari,tb_jorong');
        $this->db->where('tb_kelompok.dosen_pembimbing=tb_data_dosen.id_dosen');
        $this->db->where('tb_kelompok.lokasi=tb_jorong.id_jorong');
        $this->db->where('tb_jorong.id_nagari=tb_nagari.id_nagari');
        $this->db->where('tb_kelompok.id_kelompok', $id);
        return $this->db->get();
    }
    public function get_kelompok()
    {
        $this->db->from('tb_kelompok,tb_data_dosen,tb_nagari');
        $this->db->where('tb_kelompok.dosen_pembimbing=tb_data_dosen.id_dosen');
        $this->db->where('tb_kelompok.lokasi=tb_nagari.id_nagari');
        return $this->db->get();
    }
    // get kelompokuntuk account mahasiswa
    public function get_kelompok_mahasiswa($id)
    {
        $this->db->from('tb_kelompok,tb_data_dosen,tb_nagari');
        $this->db->where('tb_kelompok.dosen_pembimbing=tb_data_dosen.id_dosen');
        $this->db->where('tb_kelompok.lokasi=tb_nagari.id_nagari');
        $this->db->where('id_kelompok', $id);
        return $this->db->get();
    }
      // get kelompokuntuk account mahasiswa
      public function get_kelompok_mahasiswa_admin()
      {
          $this->db->from('tb_kelompok,tb_data_dosen,tb_nagari');
          $this->db->where('tb_kelompok.dosen_pembimbing=tb_data_dosen.id_dosen');
          $this->db->where('tb_kelompok.lokasi=tb_nagari.id_nagari');
         // $this->db->where('id_kelompok', $id);
          return $this->db->get();
      }
         // detail data mahasiswa
         public function get_data_mahasiwa_kelompok_mahasiswa_admin()
         {
             $this->db->from('tb_user,tb_data_mahasiswa,tb_data_jurusan');
             $this->db->where('tb_data_mahasiswa.nim=tb_user.username');
             $this->db->where('tb_data_mahasiswa.jurusan=tb_data_jurusan.id_jurusan');
             //$this->db->where('tb_data_mahasiswa.kelompok',$id);
             return $this->db->get();
         }
      // detail data mahasiswa
      public function get_data_mahasiwa_kelompok_mahasiswa($id)
      {
          $this->db->from('tb_user,tb_data_mahasiswa,tb_data_jurusan');
          $this->db->where('tb_data_mahasiswa.nim=tb_user.username');
          $this->db->where('tb_data_mahasiswa.jurusan=tb_data_jurusan.id_jurusan');
          $this->db->where('tb_data_mahasiswa.kelompok',$id);
          return $this->db->get();
      }
    // detail data mahasiswa
    public function get_data_mahasiwa_kelompok($id)
    {
        $this->db->from('tb_user,tb_data_mahasiswa,tb_data_jurusan');
        $this->db->where('tb_data_mahasiswa.nim=tb_user.username');
        $this->db->where('tb_data_mahasiswa.jurusan=tb_data_jurusan.id_jurusan');
        $this->db->where('tb_data_mahasiswa.kelompok',$id);
        return $this->db->get();
    }
    public function get_kelompok_id($id)
    {
        $this->db->from('tb_kelompok,tb_data_dosen,tb_nagari');
        $this->db->where('tb_kelompok.dosen_pembimbing=tb_data_dosen.id_dosen');
        $this->db->where('tb_kelompok.lokasi=tb_nagari.id_nagari');
        $this->db->where('tb_kelompok.id_kelompok', $id); 
        return $this->db->get();
    }
    // untuk check pengajuan data siswa
    public function check_pengajuan_siswa($id)
    {
        $this->db->where('nim_mahasiswa', $id);
        $this->db->where('status_pengajuan','Diterima');
       return $this->db->get('tb_pengajuan');
    }
    // detail mahasiswa di kelompok
    public function detail_mahasiswa_kelompok($nim)
    {
        $this->db->from('tb_data_mahasiswa');
        $this->db->join('tb_user', 'tb_user.username = tb_data_mahasiswa.nim');
        $this->db->join('tb_data_jurusan', 'tb_data_jurusan.id_jurusan = tb_data_mahasiswa.Jurusan');
        $this->db->join('tb_orang_tua', 'tb_orang_tua.nim_mahasiswa = tb_data_mahasiswa.nim');
        $this->db->where('nim', $nim);
        return $this->db->get();        
    }
    public function get_data_pengajuan()
    {
        $this->db->from('tb_pengajuan');
        $this->db->join('tb_data_mahasiswa', 'tb_data_mahasiswa.nim = tb_pengajuan.nim_mahasiswa');
        $this->db->order_by('nomor_pengajuan', 'desc');
        return $this->db->get();
    }
    public function get_data_pengajuan_lengkap()
    {
        $this->db->from('tb_pengajuan');
        $this->db->join('tb_data_mahasiswa', 'tb_data_mahasiswa.nim = tb_pengajuan.nim_mahasiswa');
        $this->db->order_by('nomor_pengajuan', 'desc');
        $this->db->where('tb_pengajuan.status_pengajuan', 'Diterima');
        return $this->db->get();
    }
    // ambil data jorong
    public function get_data_jorong()
    {
        $this->db->from('tb_jorong');
        $this->db->join('tb_nagari', 'tb_nagari.id_nagari = tb_jorong.id_nagari');
        return $this->db->get();
    }
    public function get_data_jorong_perid($id)
    {
        $this->db->from('tb_jorong');
        $this->db->join('tb_nagari', 'tb_nagari.id_nagari = tb_jorong.id_nagari');
        $this->db->where('tb_jorong.id_jorong', $id);
        return $this->db->get();
    }
    public function data_mahasiswa()
    {
        $this->db->from('tb_user');
        $this->db->join('tb_data_mahasiswa', 'tb_data_mahasiswa.nim = tb_user.username');
        $this->db->join('tb_data_jurusan', 'tb_data_jurusan.id_jurusan = tb_data_mahasiswa.Jurusan');
        $this->db->join('tb_kelompok', 'tb_kelompok.id_kelompok =tb_data_mahasiswa.kelompok ');
        $this->db->join('tb_data_dosen', 'tb_data_dosen.id_dosen = tb_kelompok.dosen_pembimbing');
        $this->db->join('tb_jorong', 'tb_jorong.id_jorong = tb_kelompok.lokasi');
        $this->db->join('tb_nagari', 'tb_nagari.id_nagari = tb_jorong.id_nagari');
        
        return $this->db->get();
    }
    // untuk profil
    public function profil($nim)
    {
        $this->db->from('tb_user');
        $this->db->join('tb_data_mahasiswa', 'tb_data_mahasiswa.nim = tb_user.username');
        $this->db->join('tb_orang_tua', 'tb_orang_tua.nim_mahasiswa = tb_data_mahasiswa.nim');
        
        $this->db->where('tb_user.username', $nim);
        return $this->db->get();
    }
}
