<?php
class model extends CI_Model
{
    // perintah untuk membuat nomor otomatis
    public function nomor_otomatis()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('d-m-Y');
        $a = $this->db->query("SELECT MAX(RIGHT(nomor_transaksi,4)) AS no_max FROM tb_transaksi WHERE tgl_transaksi='$tanggal'");
        $no = "";
        if ($a->num_rows() > 0) {
            foreach ($a->result() as $n) {
                $tmp = ((int) $n->no_max) + 1;
                $no = sprintf("%04s", $tmp);
            }
        } else {
            $no = "0001";
        }
        return date('dmY') . $no;
    }
    public function nomor_bukti_bayar_otomatis()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('d-m-Y');
        $a = $this->db->query("SELECT MAX(RIGHT(id_bukti_bayar,4)) AS no_max FROM tb_bukti_bayar WHERE tgl_upload='$tanggal'");
        $no = "";
        if ($a->num_rows() > 0) {
            foreach ($a->result() as $n) {
                $tmp = ((int) $n->no_max) + 1;
                $no = sprintf("%04s", $tmp);
            }
        } else {
            $no = "0001";
        }
        return 'BB'.date('dmY') . $no;
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
    public function data_bulan($tahun)
    {
        $this->db->distinct();
        $this->db->select('waktu');
        $this->db->from('tb_sumbangan');
        $this->db->where('SUBSTRING(waktu,3,4)', $tahun);
        return $this->db->get();
        
    }
    public function tagihan_siswa($username)
    {
        $this->db->from('tb_sumbangan');
        $this->db->where('nisn', $username);
        $this->db->where('status','-');
        return $this->db->get();
        
    }
  


}
