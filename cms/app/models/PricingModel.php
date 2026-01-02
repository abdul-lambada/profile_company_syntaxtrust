<?php
class PricingModel {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function countAll(){
        $this->db->query("SELECT COUNT(*) as total FROM konten_paket_harga");
        $row = $this->db->single();
        return $row->total;
    }

    public function getPaginated($limit, $offset){
        $this->db->query("SELECT * FROM konten_paket_harga ORDER BY urutan ASC LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }

    public function getById($id){
        $this->db->query("SELECT * FROM konten_paket_harga WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data){
        $this->db->query("INSERT INTO konten_paket_harga (nama_paket, label_harga, deskripsi, fitur_json, populer, tema_warna, urutan) VALUES (:nama_paket, :label_harga, :deskripsi, :fitur_json, :populer, :tema_warna, :urutan)");
        
        $this->db->bind(':nama_paket', $data['nama_paket']);
        $this->db->bind(':label_harga', $data['label_harga']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':fitur_json', $data['fitur_json']);
        $this->db->bind(':populer', $data['populer']);
        $this->db->bind(':tema_warna', 'slate'); // Default value
        $this->db->bind(':urutan', $data['urutan']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function update($data){
        $this->db->query("UPDATE konten_paket_harga SET nama_paket = :nama_paket, label_harga = :label_harga, deskripsi = :deskripsi, fitur_json = :fitur_json, populer = :populer, urutan = :urutan WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nama_paket', $data['nama_paket']);
        $this->db->bind(':label_harga', $data['label_harga']);
        $this->db->bind(':deskripsi', $data['deskripsi']);
        $this->db->bind(':fitur_json', $data['fitur_json']);
        $this->db->bind(':populer', $data['populer']);
        $this->db->bind(':urutan', $data['urutan']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $this->db->query("DELETE FROM konten_paket_harga WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
