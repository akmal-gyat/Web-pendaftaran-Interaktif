<?php
require_once 'config/database.php';

class Pendaftar {
    private $db;
    private $table = "pendaftar";

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM {$this->table} ORDER BY tanggal_daftar DESC");
        return $result;
    }

    public function getById($id) {
        $id = $this->db->escape_string($id);
        $result = $this->db->query("SELECT * FROM {$this->table} WHERE id = {$id}");
        return $result->fetch_assoc();
    }

    public function create($data) {
        $nama = $this->db->escape_string($data['nama']);
        $email = $this->db->escape_string($data['email']);
        $paket = $this->db->escape_string($data['paket']);
        $fasilitas = $this->db->escape_string($data['fasilitas']);
        $lokasi = $this->db->escape_string($data['lokasi']);
        $metode_pembayaran = $this->db->escape_string($data['metode_pembayaran']);
        $catatan = $this->db->escape_string($data['catatan']);
        $price1 = intval($data['price1']);
        $price2 = intval($data['price2']);
        $price3 = intval($data['price3']);
        $price4 = intval($data['price4']);
        $tax = intval($data['tax']);
        $taxes = intval($data['taxes']);
        $total_biaya = intval($data['total_biaya']);
        $tanggal_daftar = date('Y-m-d H:i:s');

        $sql = "INSERT INTO {$this->table} (nama, email, paket, fasilitas, lokasi, metode_pembayaran, catatan, price1, price2, price3, price4, tax, taxes, total_biaya, tanggal_daftar) 
                VALUES ('$nama', '$email', '$paket', '$fasilitas', '$lokasi', '$metode_pembayaran', '$catatan', $price1, $price2, $price3, $price4, $tax, $taxes, $total_biaya, '$tanggal_daftar')";

        return $this->db->query($sql);
    }

    public function update($id, $data) {
        $nama = $this->db->escape_string($data['nama']);
        $email = $this->db->escape_string($data['email']);
        $paket = $this->db->escape_string($data['paket']);
        $fasilitas = $this->db->escape_string($data['fasilitas']);
        $lokasi = $this->db->escape_string($data['lokasi']);
        $metode_pembayaran = $this->db->escape_string($data['metode_pembayaran']);
        $catatan = $this->db->escape_string($data['catatan']);
        $price1 = intval($data['price1']);
        $price2 = intval($data['price2']);
        $price3 = intval($data['price3']);
        $price4 = intval($data['price4']);
        $tax = intval($data['tax']);
        $taxes = intval($data['taxes']);
        $total_biaya = intval($data['total_biaya']);

        $sql = "UPDATE {$this->table} SET 
                nama = '$nama',
                email = '$email',
                paket = '$paket',
                fasilitas = '$fasilitas',
                lokasi = '$lokasi',
                metode_pembayaran = '$metode_pembayaran',
                catatan = '$catatan',
                price1 = $price1,
                price2 = $price2,
                price3 = $price3,
                price4 = $price4,
                tax = $tax,
                taxes = $taxes,
                total_biaya = $total_biaya
                WHERE id = $id";

        return $this->db->query($sql);
    }

    public function delete($id) {
        $id = $this->db->escape_string($id);
        $sql = "DELETE FROM {$this->table} WHERE id = $id";
        return $this->db->query($sql);
    }
}
?>